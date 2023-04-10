<?php

/**
*
* Page class
* 
* Used to create multiple unique HTML pages.
*
* Always call "freeze" methods before calling any "get" methods,
* as in the example here:
*
* Usage:
*   $page = new Page("My Page");
*   $page->freezeTop();
*   $page->freezeBottom();
*
*   print $page->getTopSection();
*   print "<h1>Some page-specific HTML goes here</h1>" . PHP_EOL;
*   print $page->getBottomSection();
*
* @author Steve Suehring <steve.suehring@uwsp.edu>
*/

class Page {

  protected $_top;
  protected $_bottom;
  protected $_title;
  protected $_lang;
  protected $_headElements = array();
  protected $_bottomElements = array();
  protected $_headSection = "";
  private $_topFrozen = false;
  private $_bottomFrozen = false;

  function __construct($title = "Default", $lang = "en") {
    $this->_title = $title;
    $this->_lang = $lang;
  }

  /**
  * function addHeadElement($include)
  *
  * Used to add things to the <head> section of an HTML doc.
  * For example, it is typical to add CSS <link> tags
  * and <script> tags in the <head> section.
  *
  * This must be called __before__ freezeTopSection and 
  * will typically be called once for each <link> or <script>
  * that will appear in the <head> section.
  *
  * @param string $include  The element to include
  */

  function addHeadElement($include) {
    $this->_headElements[] = $include . PHP_EOL;
  } //end function addHeadElement

  function freezeTopSection() {
    $returnVal = "";
    $returnVal .= "<!doctype html>" . PHP_EOL;
    $returnVal .= "<html lang=\"" . $this->_lang . "\">" . PHP_EOL;
    $returnVal .= "<head>" . PHP_EOL;
    $returnVal .= "<title>";
    $returnVal .= $this->_title;
    $returnVal .= "</title>" . PHP_EOL;
    foreach ($this->_headElements as $elm) {
      $returnVal .= $elm;
    }
    $returnVal .= $this->_headSection;
    $returnVal .= "</head>" . PHP_EOL;
    $returnVal .= "<body>" . PHP_EOL;

    $this->_top = $returnVal;
    $this->_topFrozen = true;

  } //end function freezeTopSection

  /**
  * function addBottomElement($include)
  *
  * Used to add things to the bottom section of an HTML doc.
  * For example, some libraries require JavaScript right 
  * before the closing </body> tag.
  *
  * This must be called __before__ freezeBottom and
  * will typically be called once for each <script>
  * that will appear in the section.
  *
  *
  * @param string $include  The element to include
  */

  function addBottomElement($include) {
    $this->_bottomElements[] = $include . PHP_EOL;
  } //end function addHeadElement

  function freezeBottomSection() {
    $returnVal = "";
    foreach ($this->_bottomElements as $elm) {
      $returnVal .= $elm;
    }
    $returnVal .= "</body>" . PHP_EOL;
    $returnVal .= "</html>" . PHP_EOL;

    $this->_bottom = $returnVal;
    $this->_bottomFrozen = true;

  } //end function freezeBottomSection

  function getTopSection() {
    if ($this->_topFrozen === false) {
      $this->freezeTopSection();
    }
    return $this->_top;
  }

  function getBottomSection() {
    if ($this->_bottomFrozen === false) {
      $this->freezeBottomSection();
    }
    return $this->_bottom;
  }

} // end class

?>
