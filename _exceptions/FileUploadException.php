<?php
class FileUploadException extends GenericException
{
	private $name;
	public function __construct($message, $name, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
  		 $this->name = $name;
	}

    // algo para el desarollador
	public function __toString() {
        return __CLASS__ . ": FILE UPLOAD EXCEPTON [{$this->code}]: {$this->message}\n\n".
        		$name;
	}

	// algo para el usuario
	public function i18n() {
        echo sprintf(i18n("FILEUPLOADEXCEPTION.0x$this->code"), $name);
	}
}
?>