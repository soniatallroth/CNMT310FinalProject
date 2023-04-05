<?php

// This would never be stored in-file for production-level code
// In class example only

class User {

  private $users = array(
      "jim" => array("username" => "jim",
                    "password" => '$2y$10$RNa8uOwFWvbwMJEMCVMSF.4o94FfMgKmBDhiu.HRCLNcRGJu5S.Dy',
                    "userid" => "19146",
                    "realname" => "James Olivetti",
                    "email" => "thejim@example.com",
            ),
       "bob" => array("username" => "bob",
            "password" => '$2y$10$zfQfgKnbG.csTYzZ9p8pROk82k5o3OgiA1SfjufxvED1/WNyprCku',
            "userid" => "19861",
            "realname" => "Bob Enstuf",
            "email" => "bob@example.com",
            ),
        "mary" => array("username" => "mary",
            "password" => '$2y$10$9atCYBJHZWkPOCGhyV5xM.x/ryJw11d49DlwSW798TgDlv59AE4gG',
            "userid" => '0932',
            "realname" => "Mary Higgins",
            "email" => "mh@example.com",
            ),
    );

  function authUser($user,$pass) {
    if (array_key_exists($user,$this->users)) {

      if (password_verify($pass,$this->users[$user]["password"])) {
        $result = array(
                "authResult" => true,
                "message" => "Success",
                "details" => array(
                  "username" => $this->users[$user]['username'],
                  "emailaddress" => $this->users[$user]['email'],
                  "userid" => $this->users[$user]['userid'],
                  "realname" => $this->users[$user]['realname'],
                  )
                );   
      } else {
        $result = array("authResult" => false,
                        "message" => "User not found or password incorrect");
      }

    } else {
      $result = array("authResult" => false,
                        "message" => "User not found or password incorrect");
    }
    return $result;
  } //end function authUser

  function getBookmarks($user) {
    $bookmarks = array();
    $bookmarks["19146"] = array(
                            array( "url" => "https://outlook.office.com/mail/",
                            "title" => "UWSP Email"
                            ),
                            array( "url" => "https://uwsa.instructure.com/",
                            "title" => "Canvas"
                            ),
                            array( "url" => "https://www.uwsp.sis.wisconsin.edu/psp/stpprd-bd/?cmd=login",
                            "title" => "accessPoint"
                            ),
                            array( "url" => "https:/github.com",
                            "title" => "GitHub"
                            ),
                            array( "url" => "https://mypoint.uwsp.edu/login/login2.aspx",
                            "title" => "MyPoint"
                            ),
                            array( "url" => "https://www3.uwsp.edu/library/Pages/default.aspx",
                            "title" => "UWSP Library"
                            ),
                      );
    $bookmarks["19861"] = array(
                            array( "url" => "https://vhnd.com/",
                            "title" => "Van Halen News Desk"
                            ),
                            array( "url" => "https://uwsa.instructure.com/",
                            "title" => "Canvas"
                            ),
                            array( "url" => "https://validator.w3.org/",
                            "title" => "W3C Validator"
                            ),
                            array( "url" => "https://github.com/",
                            "title" => "GitHub"
                            ),
                            array( "url" => "https://www.php.net",
                            "title" => "PHP"
                            ),
                      );
  
    $bookmarks['0932'] = array(array());
    return $bookmarks[$user];
  }
  
} //end class User
