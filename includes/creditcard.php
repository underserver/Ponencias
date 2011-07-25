<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Funcion que valida una tarjeta de credito
 * 			 cardnumber		: Numero de la tarjeta de credito
 * 			 cardname		: Tipo de tarjeta de credito
 * 			 errornumber	: Varible donde se regresara el error, en caso de haber uno
 * 			 errortext		: Varible donde se regresara la descripcion del error, el casi de haber uno
 *
 ***********************************************************************/
function checkCreditCard ($cardnumber, $cardname, &$errornumber, &$errortext) {

	$cards = array (  array ('name' => 'American',
                          'length' => '15', 
                          'prefixes' => '34,37',
                          'checkdigit' => true
	),
	array ('name' => 'Carte Blanche',
                          'length' => '14', 
                          'prefixes' => '300,301,302,303,304,305,36,38',
                          'checkdigit' => true
	),
	array ('name' => 'Dinners',
                          'length' => '14',
                          'prefixes' => '300,301,302,303,304,305,36,38',
                          'checkdigit' => true
	),
	array ('name' => 'Discover',
                          'length' => '16', 
                          'prefixes' => '6011',
                          'checkdigit' => true
	),
	array ('name' => 'Enroute',
                          'length' => '15', 
                          'prefixes' => '2014,2149',
                          'checkdigit' => true
	),
	array ('name' => 'JCB',
                          'length' => '15,16', 
                          'prefixes' => '3,1800,2131',
                          'checkdigit' => true
	),
	array ('name' => 'Maestro',
                          'length' => '16', 
                          'prefixes' => '5020,6',
                          'checkdigit' => true
	),
	array ('name' => 'Master',
                          'length' => '16', 
                          'prefixes' => '51,52,53,54,55',
                          'checkdigit' => true
	),
	array ('name' => 'Solo',
                          'length' => '16,18,19', 
                          'prefixes' => '6334, 6767',
                          'checkdigit' => true
	),
	array ('name' => 'Switch',
                          'length' => '16,18,19', 
                          'prefixes' => '4903,4905,4911,4936,564182,633110,6333,6759',
                          'checkdigit' => true
	),
	array ('name' => 'Visa',
                          'length' => '13,16', 
                          'prefixes' => '4',
                          'checkdigit' => true
	),
	array ('name' => 'Visa Electron',
                          'length' => '16', 
                          'prefixes' => '417500,4917,4913',
                          'checkdigit' => true
	)
	);

	$ccErrorNo = 0;

	$ccErrors [0] = "Unknown card type";
	$ccErrors [1] = "No card number provided";
	$ccErrors [2] = "Credit card number has invalid format";
	$ccErrors [3] = "Credit card number is invalid";
	$ccErrors [4] = "Credit card number is wrong length";
	 

	$cardType = -1;
	for ($i=0; $i<sizeof($cards); $i++) {


		if (strtolower($cardname) == strtolower($cards[$i]['name'])) {
			$cardType = $i;
			break;
		}
	}


	if ($cardType == -1) {
		$errornumber = 0;
		$errortext = $ccErrors [$errornumber];
		return false;
	}
	 

	if (strlen($cardnumber) == 0)  {
		$errornumber = 1;
		$errortext = $ccErrors [$errornumber];
		return false;
	}


	$cardNo = str_replace (' ', '', $cardnumber);
	 

	if (!eregi('^[0-9]{13,19}$',$cardNo))  {
		$errornumber = 2;
		$errortext = $ccErrors [$errornumber];
		return false;
	}
	 

	if ($cards[$cardType]['checkdigit']) {
		$checksum = 0;
		$mychar = "";
		$j = 1;


		for ($i = strlen($cardNo) - 1; $i >= 0; $i--) {


			$calc = $cardNo{$i} * $j;


			if ($calc > 9) {
				$checksum = $checksum + 1;
				$calc = $calc - 10;
			}


			$checksum = $checksum + $calc;

			if ($j ==1) {$j = 2;} else {$j = 1;};
		}


		if ($checksum % 10 != 0) {
			$errornumber = 3;
			$errortext = $ccErrors [$errornumber];
			return false;
		}
	}


	$prefix = split(',',$cards[$cardType]['prefixes']);


	$PrefixValid = false;
	for ($i=0; $i<sizeof($prefix); $i++) {
		$exp = '^' . $prefix[$i];
		if (ereg($exp,$cardNo)) {
			$PrefixValid = true;
			break;
		}
	}


	if (!$PrefixValid) {
		$errornumber = 3;
		$errortext = $ccErrors [$errornumber];
		return false;
	}


	$LengthValid = false;
	$lengths = split(',',$cards[$cardType]['length']);
	for ($j=0; $j<sizeof($lengths); $j++) {
		if (strlen($cardNo) == $lengths[$j]) {
			$LengthValid = true;
			break;
		}
	}


	if (!$LengthValid) {
		$errornumber = 4;
		$errortext = $ccErrors [$errornumber];
		return false;
	};


	return true;
}

?>