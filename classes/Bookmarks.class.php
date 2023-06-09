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
                usort($this->urlList, function($a, $b) {
                    return $b->visits <=> $a->visits;
                });
                $output = '';
                foreach ($this->urlList as $bookmark) {
                    $href = $bookmark->url;
                    $title = $bookmark->displayname;
                    $bookmarkID = $bookmark->bookmark_id;
                    $numVisits = $bookmark->visits;
                    $sharedstatus = $bookmark->shared;
                    //below code adds prefixes based on tab and underscores to each ID so there are no duplicate IDs
                    $idPrefix = ($tab == 'main') ? 'm' : 'p';
                    $prefixedID = $idPrefix . '_' . $bookmarkID;
                    if($tab == 'main' || ($tab == 'popular' && $numVisits >= 10 && $sharedstatus !== "private")) {
                        $output .=  '<div id="' . $prefixedID . '" class="display list-group-item list-group-item-action">';
                        $output .=  "   <img class='bookmark-favicon' src='https://s2.googleusercontent.com/s2/favicons?domain=$href' alt='website favicon'>";
                        $output .=  '   <div class="li-container">';
                        $output .=  '       <div class="li-left">';
                        $output .=  "           <p><a class='li-title' href='$href' data-bookmark-id=" . $bookmarkID . " target='_blank'>$title</a></p>";
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

        $data = array("url" => $this->_url, "displayname" => $this->_displayName, "user_id" => $this->_id, "shared" => $this->_sharedStatus);
        $action = "addbookmark";
        $fields = array("apikey" => APIKEY,
                        "apihash" => APIHASH,
                        "data" => $data,
                        "action" => $action,
                    );
        $client->setPostFields($fields);

        $returnValue = $client->send();
        $obj = json_decode($returnValue);
        if(!property_exists($obj, "result")) {
            die(print("Error, no result property"));
        }

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

        $returnValue = $client->send();
        $obj = json_decode($returnValue);
        if(!property_exists($obj, "result")) {
            die(print("Error, no result property"));
        }
        
        if($obj->result !== "Success") {
            $sessManager['results'][] = "Sorry! There was an error adding your bookmark.";
        }
        
        return $sessManager['results'];
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

        return $sessManager['results'];
    }
    
	public function autocomplete() {
        $ac = array();
        foreach ($this->urlList as $key => $val) {
                $ac[$key]['id'] = $val->bookmark_id;
                $ac[$key]['label'] = $val->displayname;
                $ac[$key]['value'] = $val->url;
        }
			print "<link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css\">";
			print "<script src=\"https://code.jquery.com/jquery-3.6.0.js\"></script>";
			print "<script src=\"https://code.jquery.com/ui/1.13.2/jquery-ui.js\"></script>";
			print '<script>';
			print '$( function() {';
			print 'var srcdata = ' . json_encode($ac) . ";\n";
			print '$("#search").on("keyup", function() {';
			print 'var value = $(this).val().toLowerCase();';
			print '$(".list-group-item-action").filter(function() { $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);';
			print '});';
			print '});';
            print '$("#popSearch").on("keyup", function() {';
            print 'var value = $(this).val().toLowerCase();';
            print '$(".list-group-item-action").filter(function() { $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);';
            print '});';
            print '});';
			print '});';
			print '</script>';
	}

}

?>