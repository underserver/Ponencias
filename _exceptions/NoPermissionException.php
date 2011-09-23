<?php
include_once dirname(__FILE__)."/GenericException.php";

class NoPermissionException extends GenericException
{
	public function __construct($message, $code = 0, Exception $previous = null) {
		parent::__construct($message, $code);
	}

	// algo para el desarollador
	public function __toString() {
		return __CLASS__ . ": NO PERMISSION EXCEPTON [{$this->code}]: {$this->message}\n";
	}

	// algo para el usuario
	public function i18n() {
		return i18n("NOPERMISSIONEXCEPTION.0x$this->code");
	}
}
?>