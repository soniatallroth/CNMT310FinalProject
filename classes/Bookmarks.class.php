<?php

class Bookmarks {

    protected $_displayName;
    protected $_url;
    protected $_id;
    protected $_bookID;
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
    public function setBookmakID($bookmarkId = 0) {
        $this->_bookID = $bookmarkId;
        return $this;
    }

    public function getBookmarks($id, $client) {
        require_once(__DIR__ . "/../../yoyoconfig.php");

        $data = array("user_id" => $id);
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
                print '<h3>Sorry! No bookmarks were found to be displayed here :(</h3>';
            } else {
                foreach ($this->urlList as $bookmark) {
                    $href = $bookmark->url;
                    $title = $bookmark->displayname;
                    $bookmarkID = $bookmark->bookmark_id;
                    print   '<div class="display list-group-item list-group-item-action">';
                    print   '   <div class="li-container">';
                    print   '       <div class="li-left">';
                    print   "           <li><a class='li-title' href='$href' target='_blank'>$title</a></li>";
                    print   "           <p class='li-link'>$href</p>";
                    print   '       </div>';
                    print   '       <div class="li-right">';
                    print   "           <p class'li-bookmarkID' >ID: $bookmarkID</p>";  
                    print   "           <p class='li-viewcount' >View count: $id</p>"; // change this variable to correctly add in view count! 
                    print   '       </div>';
                    print   '   </div>'; // end of .li-container
                    print   '   <a class="delete-link xmark" href="#"><i class="fa-solid fa-xmark"></i></a>';
                    print   '</div>';
                }
            }
        }
    }
    public function addBookmark($id, $client) {
        require_once(__DIR__ . "/../../yoyoconfig.php");

        $required = array('url', 'displayname');

        // checks to make sure both form fields were set, displays error message if not 
        foreach($required as $element) {
            if(!isset($_POST[$element])){
                $_SESSION['errors'][] = "Please enter a URL/link and/or label.";
                die(header("location: " . BOOKMARKS));
            }
        }

        // checks if URL or label field is empty, displays error message if so 
        foreach($required as $element) {
            if(empty($_POST[$element])) {
                $_SESSION['errors'][] = "Please input a " .ucfirst($element);
                die(header("location: " . BOOKMARKS));
            }
        }

        if(!str_contains($_POST['url'], 'https://')) {
            $_SESSION['errors'][] = "Please enter a valid URL that contains 'https://'";
            die(header("location: " . BOOKMARKS));
        }

        $link = strtolower($_POST['url']);
        $linkLabel = $_POST['displayname'];
        $id = $_SESSION['userid'];

        $data = array("url" => $link, "displayname" => $linkLabel, "user_id" => $id);
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

        if($obj->result == "Success") {
            die(header("Location: " . BOOKMARKS));
        }
        else {
            $_SESSION['errors'][] = "Sorry! There was an error adding your bookmark.";
            die(header("Location: " . BOOKMARKS));
        }
    }
    public function deleteBookmark($id, $client) {
        require_once(__DIR__ . "/../../yoyoconfig.php");

        $required = array('bookID');

        // checks to make sure both form fields were set, displays error message if not 
        foreach($required as $element) {
        if(!isset($_POST[$element])){
            $_SESSION['errors'][] = "Please enter a bookmark ID.";
            die(header("location: " . BOOKMARKS));
        }
        }

        // checks if URL or label field is empty, displays error message if so 
        foreach($required as $element) {
        if(empty($_POST[$element])) {
            $_SESSION['errors'][] = "Please input a " .ucfirst($element);
            die(header("location: " . BOOKMARKS));
        }
        }

        $bookID = $_POST['bookID'];
        $id = $_SESSION['userid'];

        $data = array("bookmark_id" => $bookID, "user_id" => $id);
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

        if($obj->result == "Success") {
        die(header("Location: " . BOOKMARKS));
        }
        else {
        $_SESSION['errors'][] = "Sorry! There was an error deleting your bookmark.";
        die(header("Location: " . BOOKMARKS));
        }
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
			print "<script type=\"text/javascript\">";

			print "  $( function() {\n";

			print "\t\tvar bookmarks = " . json_encode($ac) . ";\n";

			print "\t\t$(\"#search\").autocomplete({\n";

			print "\t\t\tminLength: 0,\n";
			print "\t\t\tsource: bookmarks,\n";

			print "\t\t\tselect: function( event, ui ) {\n";
			print "\t\t\t\twindow.location.href = ui.item.value;\n";
			print "\t\t\t}\n";
			print "\t\t});\n";
			print "\t} );\n";
			print "</script>";
	}
}

?>