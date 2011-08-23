<?php
require dirname(__FILE__)."/../_exceptions/ViewException.php";
require dirname(__FILE__)."/Renderable.php";

class HtmlPage implements Renderable{
  private $file;
  
  public function __construct($file){
    if(file_exists($file)){
      $this->file = $file;
    } else {
      throw new ViewException($file, ViewException::$NOT_FOUND);
    }
  }
  
  public function getHtml(){
    return include($file);
  }
}
?>