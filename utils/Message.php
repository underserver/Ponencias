<?php
class Message implements Renderable{
	private $message;
	private $type;
	private $showDetails;
  
	public function __construct($message, $type, $showDetails=false, $exception=NULL){
		$this->message = $message;
		$this->type = $type;
		$this->showDetails = $showDetails;
	}
	
	public function getMessage(){ return $this->message; }
	public function getType(){ return $this->type; }
	public function isShowDetails(){ return $this->showDetails; }

	public function getHtml(){
		$html  = '<div align="center" class="msg_' . $this->getType() . '">';
		$html .= '	<div class="bl3">';
		$html .= '		<div class="br">';
		$html .= '			<div class="tl">';
		$html .= '				<div class="tr2">';
		$html .= 					$this->getMessage();
		$html .= '				</div>';
		$html .= '			</div>';
		$html .= '		</div>';
		$html .= '	</div>';
		$html .= '</div>';
	}
	
	public function setMessage($message){ $this->message = $message; }
	public function setType($type){ $this->type = $type; }
	public function setShowDetails($showDetails){ $this->showDetails = $showDetails; }

  	public static $ERROR = 1;
  	public static $WARN  = 2;
  	public static $INFO  = 3;
}
?>