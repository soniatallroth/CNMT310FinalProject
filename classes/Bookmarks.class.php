<?php

class Bookmarks {

    protected $_displayName;
    protected $_url;
    protected $_id;
    protected $_bookID;
    
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

        $urlList = $obj->data;

        if ($obj->result == "Success") {
            if (!is_array($urlList) || count($urlList) <= 0) {
                print '<h3>Sorry! No bookmarks were found to be displayed here :(</h3>';
            } else {
                foreach ($urlList as $bookmark) {
                    $href = $bookmark->url;
                    $title = $bookmark->displayname;
                    $bookmarkID = $bookmark->bookmark_id;
                    print '<div class="display list-group-item list-group-item-action">';
                    print "    <li><a href='$href' target='_blank'>$title</a><br>ID: $bookmarkID</li>";
                    print '    <p class="hide"><a class="delete-link" href="#">X</a></p>';
                    print '</div>';
                }
            }
        }
    }
    public function addBookmark() {
        require_once(__DIR__ . "/../../yoyoconfig.php");
    }
}

?>