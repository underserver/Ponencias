<?php
class ApplicationContext{

	public static function addMessage($message, $severity=NULL){
		if( $severity != NULL ){
			$message = new Message($message, $severity);
		}
		$messages = ApplicationContext::getMessages();
		$messages[] = $message;
		$_SESSION["Messages"] = base64_encode(serialize($messages));
	}

	public static function getMessages() {
		$messages = $_SESSION["Messages"];
		if( isset($messages) && $messages != NULL ){
			$session_data = base64_decode($messages);
			$messages = unserialize($session_data);
			return $messages;
		} else {
			return array();
		}
	}

	public static function clearMessages(){
		$_SESSION["Messages"] = NULL;
	}
}
?>