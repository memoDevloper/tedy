<?php

class ACT{
	private $emr;
	private $dbm;
	private $poc;

	function __construct($emr,$dbm,$poc){
		$this->emr = $emr;
		$this->dbm = $dbm;
		$this->poc = $poc;
	}

	public function makeTimeSD($date){
		$date = explode("-", $date);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		return mktime(0,0,1,$month,$day,$year);
	}

	public function makeTimeED($date){
		$date = explode("-", $date);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		return mktime(23,59,59,$month,$day,$year);
	}

	public function limitWords($text, $num){
		$text = strip_tags($text);
		$text = explode(' ', $text);
		$return = '';
		$i = 0;
		while ($i < $num) {
			$return .= $text[$i] . ' ';
			++$i;
		}
		return $return;
	}

	public function currency($currentCurrency, $targetCurrency, $price){
	    $query = "
	    SELECT
	        (SELECT rate FROM currencies WHERE code = 'usd') as main,
            (SELECT rate FROM currencies WHERE code = '$currentCurrency') as current,
            (SELECT rate FROM currencies WHERE code = '$targetCurrency') as target,
            (SELECT sign FROM currencies WHERE code = '$targetCurrency') as sign
        FROM currencies LIMIT 1;
	    ";
	    $currency = $this->dbm->query($query);
	    $currency = $currency[0];
	    return number_format((($price / $currency->current) * $currency->target)) . " <sup>" . $currency->sign . "</sup>";
    }

	public function action($validate, $data){
		foreach ($validate as $element => $validateData) {
			$value = $data[$element];
			$optional = false;
			if(in_array('optional', $validateData)){
				$optional = true;
			}
			if(isset($validateData['element'])){
				$element = $validateData['element'];
			}
			foreach ($validateData as $switch => $message) {
				switch ($switch) {
					case 'required':
						if(empty($value)){
							$json[] = $this->emr->elementError(($message === false) ? _REQUIRED_ : $message, "." . $element);
						}
					break;
					case 'email':
						if(!filter_var($value, FILTER_VALIDATE_EMAIL) && $optional != true){
							$json[] = $this->emr->elementError((($message === false)) ? _EMAIL_VALIDATE_ : $message, "." . $element);
						}
					break;
					case 'date':
						if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value) && !$optional){
							$json[] = $this->emr->elementError((($message === false)) ? _DATE_VALIDATE_ : $message, "." . $element);
							$json[] = $value;
						}
					break;
					case 'similarity':
						$elements = explode("-", $element);
						$element1 = $elements[0];
						$element2 = $elements[1];
						if($data[$element1] !== $data[$element2] && !$optional){
							$json[] = $this->emr->elementError((($message === false)) ? _NO_SIMILARITY_ : $message, "." . $element2 . " , ." . $element1);
						}
					break;
					case 'noSimilarity':
						$elements = explode("-", $element);
						$element1 = $elements[0];
						$element2 = $elements[1];
						if($data[$element1] == $data[$element2] && !$optional){
							$json[] = $this->emr->elementError((($message === false)) ? _SIMILARITY_ : $message, "." . $element2 . " , ." . $element1);
						}
					break;
					case 'phone':
						if(!preg_match('/^[\+0-9\-\(\)\s]*$/', $value)){
							$json[] = $this->emr->elementError((($message === false)) ? _PHONE_VALIDATE_ : $message, "." . $element);
						}
					break;
					case 'numeric':
						if(!is_numeric($value)){
							$json[] = $this->emr->elementError((($message === false)) ? _NUMERIC_VALIDATE_ : $message, "." . $element);
						}
					break;
				}
			}
		}
		if(!empty($json)){
			return $json;
		}else{
			return 0;
		}
	}
}