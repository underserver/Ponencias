<?php
require_once dirname(__FILE__)."/../_exceptions/ViewException.php";
require_once dirname(__FILE__)."/Renderable.php";

class HtmlPage implements Renderable{
  private $file;
  
  public function __construct($file){
      $this->file = $file;
  }
  
  public function getHtml(){
  	if(file_exists($this->file)){
		ob_start();
    	include($this->file);
		return ob_get_clean();
  	} else {
      	throw new ViewException($file, ViewException::$NOT_FOUND);
    }
  }
}
?>