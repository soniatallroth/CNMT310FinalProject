<?php
require_once("autoload.php");
require_once("WebServiceClient.php");

class Bookmarks {

    protected $_displayName;
    protected $_url;
    protected $_id;
    protected $_bookmarkID;
    protected $_sharedStatus;
	protected $urlList;
    
    function __construct() {}
    public static function create() {
        return new self();
    }
    public function setURL($url = "https://www.uwsp.edu") {
        $this->_url = $url;
        return $this;
    }
    public function setDisplayName($displayName = "UWSP") {
        $this->_displayName = $displayName;
        return $this;
    }
    public function setID($id = 0) {
        $this->_id = $id;
        return $this;
    }
    public function setBookmarkID($bookmarkID = 0) {
        $this->_bookmarkID = $bookmarkID;
        return $this;
    }

    public function setSharedStatus($shared = true) {
        $this->_sharedStatus = $shared;
        return $this;
    }

    public function getBookmarks($client, $tab = 'main') {
        require_once(__DIR__ . "/../../yoyoconfig.php");
    
        $data = array("user_id" => $this->_id);
        $action = "getbookmarks";
        $fields = array(
            "apikey" => APIKEY,
            "apihash" => APIHASH,
            "data" => $data,
            "action" => $action
        );
        $client->setPostFields($fields);
    
        $returnValue = $client->send();
        $obj = json_decode($returnValue);
    
        if (!property_exists($obj, "result")) {
            die(print("Error, no result property"));
        }
    
        $this->urlList = $obj->data;
        
        if ($obj->result == "Success") {
            if (!is_array($this->urlList) || count($this->urlList) <= 0) {
                $output = '<h3>Sorry! No bookmarks were found to be displayed here :(</h3>';
            } else {
                $output = '';
                foreach ($this->urlList as $bookmark) {
                    $href = $bookmark->url;
                    $title = $bookmark->displayname;
                    $bookmarkID = $bookmark->bookmark_id;
                    $numVisits = $bookmark->visits;
                    if($tab == 'main' || ($tab == 'popular' && $numVisits >= 10)) {
                        $output .=  '<div id="' . $bookmarkID . '" class="display list-group-item list-group-item-action">';
                        $output .=  '   <div class="li-container">';
                        $output .=  '       <div class="li-left">';
                        $output .=  "           <li><a class='li-title' href='$href' data-bookmark-id=" . $bookmarkID . " target='_blank'>$title</a></li>";
                        $output .=  "           <p class='li-link'>$href</p>";
                        $output .=  '       </div>';
                        $output .=  '       <div class="li-right">'; 
                        $output .=  "           <p class='li-viewcount' >View count: $numVisits</p>";  
                        $output .=  '       </div>';
                        $output .=  '   </div>'; // end of .li-container
                        $output .=  '   <a class="delete-link xmark" href="#" data-user-id="' . $_SESSION['info']->id . '" data-bookmark-id="' . $bookmarkID . '"><i class="fa-solid fa-xmark"></i></a>';
                        $output .=  '</div>';
                    }
                }
            }
            }
            return $output;
        }
    public function addBookmark($client, $sessManager) {
        require_once(__DIR__ . "/../../yoyoconfig.php");

        //$link = strtolower($_POST['url']);
        //$linkLabel = $_POST['displayname'];
        //$shared = $_POST['sharingBookmarks']; //this defaults to true (public), even if not selected
        //$id = $_SESSION['info']->id;

        $data = array("url" => $this->_url, "displayname" => $this->_displayName, "user_id" => $this->_id, "shared" => $this->_sharedStatus);
        $action = "addbookmark";
        $fields = array("apikey" => APIKEY,
                        "apihash" => APIHASH,
                        "data" => $data,
                        "action" => $action,
                    );
        $client->setPostFields($fields);

        //For Debugging:
        //var_dump($client);

        $returnValue = $client->send();
        $obj = json_decode($returnValue);
        if(!property_exists($obj, "result")) {
            die(print("Error, no result property"));
        }

        //dumps JSON server response containing data + result
        //var_dump($returnValue);

        //print $obj->result;
        //all checks above are passed, so below code *should* be safe to run

        if($obj->result !== "Success") {
            $sessManager['results'][] = "Sorry! There was an error adding your bookmark.";
        }

        return $sessManager['results'];
    }
    public function deleteBookmark($client, $sessManager) {
        require_once(__DIR__ . "/../../yoyoconfig.php");

        $data = array("bookmark_id" => $this->_bookmarkID, "user_id" => $this->_id);
        $action = "deletebookmark";
        $fields = array("apikey" => APIKEY,
                    "apihash" => APIHASH,
                    "data" => $data,
                    "action" => $action,
                    );
        $client->setPostFields($fields);

        //For Debugging:
        //var_dump($client);

        $returnValue = $client->send();
        $obj = json_decode($returnValue);
        if(!property_exists($obj, "result")) {
            die(print("Error, no result property"));
        }
        //dumps JSON server response containing data + result
        //var_dump($returnValue);

        //print $obj->result;
        //all checks above are passed, so below code *should* be safe to run

        if($obj->result !== "Success") {
            $sessManager['results'][] = "Sorry! There was an error adding your bookmark.";
        }

        return $sessManager['results'];
    }
    
	public function autocomplete($tab) {
        $ac = array();
        foreach ($this->urlList as $key => $val) {
            if($tab == 'main' || ($tab == 'popular' && $val->visits >= 10)) {
                $ac[$key]['id'] = $val->bookmark_id;
                $ac[$key]['label'] = $val->displayname;
                $ac[$key]['value'] = $val->url;
            }
        }
			print "<link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css\">";
			print "<script src=\"https://code.jquery.com/jquery-3.6.0.js\"></script>";
			print "<script src=\"https://code.jquery.com/ui/1.13.2/jquery-ui.js\"></script>";
/*			print "<script type=\"text/javascript\">";

			print "  $( function() {\n";

			print "\t\tvar bookmarks = " . json_encode($ac) . ";\n";

			print "\t\t$(\"#search\").autocomplete({\n";

			print "\t\t\tminLength: 0,\n";
			print "\t\t\tsource: bookmarks,\n";
			// print 'position: { my : "center", at: "center" }';
			print 'appendTo: "#search"';

			print "\t\t\tselect: function( event, ui ) {\n";
			print "\t\t\t\twindow.location.href = ui.item.value;\n";
			print "\t\t\t}\n";
			print "\t\t});\n";
			print "\t} );\n";
			print "</script>";
*/
			print '<script>';
			print '$( function() {';
			print 'var srcdata = ' . json_encode($ac) . ";\n";
			print '$("#search").on("keyup", function() {';
			print 'var value = $(this).val().toLowerCase();';
			print '$(".list-group-item-action").filter(function() { $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);';
			print '});';
			print '});';
			print '});';
			print '</script>';
	}

    function addVisit($client, $sessManager)
    {
        require_once(__DIR__ . "/../../yoyoconfig.php");

        $data = array("bookmark_id" => $this->_bookmarkID, "user_id" => $this->_id);
        $action = "addvisit";
        $fields = array(
            "apikey" => APIKEY,
            "apihash" => APIHASH,
            "data" => $data,
            "action" => $action
        );
        $client->setPostFields($fields);

        $returnValue = $client->send();
        $obj = json_decode($returnValue);
        if(!property_exists($obj, "result")) {
            die(print("Error, no result property"));
        }

        if ($obj->result !== 'Success') {
            $sessManager['results'][] = "Sorry! There was an error adding a visit to this bookmark.";
        }

        return $_SESSION['results'];
    }
}

?>