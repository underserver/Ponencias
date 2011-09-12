<?php
include_once dirname(__FILE__)."/GenericException.php";

class QueryException extends GenericException
{
	private $sql;
	public function __construct($message, $sql, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
  		 $this->sql = $sql;
	}

    // algo para el desarollador
	public function __toString() {
        return __CLASS__ . ": QUERY EXCEPTON [{$this->code}]: {$this->message}\n\n".
        		$sql;
	}

	// algo para el usuario
	public function i18n() {
        echo sprintf(i18n("QUERYEXCEPTION.0x$this->code"), $sql);
	}
}
?>