<?php
class ViewException extends Exception
{
	private $view;
	public function __construct($view, $code = 0, Exception $previous = null) {
		parent::__construct($view, $code);
		$this->view = $view;
	}

	// algo para el desarollador
	public function __toString() {
		return __CLASS__ . ": VIEW EXCEPTON [{$this->code}]: {$this->view}";
	}

	// algo para el usuario
	public function i18n() {
		return sprintf(i18n("VIEWEXCEPTION.0x$this->code"), $view);
	}

	public static $NOT_FOUND = 1;
}
?>