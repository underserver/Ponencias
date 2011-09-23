<?php
include_once dirname(__FILE__)."/GenericException.php";

class TransactionException extends GenericException
{
	private $entity;
	public function __construct($message, $entity, $code = 0, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
		$this->entity = $entity;
	}

	// algo para el desarollador
	public function __toString() {
		return __CLASS__ . ": ENTITY TRANSACTION EXCEPTON [{$this->code}]: {$this->message}\n\n".
			get_class($entity) . "\n" . $entity;
	}

	// algo para el usuario
	public function i18n() {
		return sprintf(i18n("TRANSACTIONEXCEPTION.0x$this->code"), get_class($entity));
	}
	
	public static $SAVE_CODE   = 0x1;
	public static $UPDATE_CODE = 0x2;
	public static $DELETE_CODE = 0x3;
}
?>