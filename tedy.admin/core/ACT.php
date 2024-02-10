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

	public function makeBoldDeadline($date){
        $deadline = "<b class='text-info' >";
        $deadline .= date('d', $date);
        $deadline .= "</b>";
        $deadline .= ' ';
        $deadline .= date('M', $date);
        $deadline .= ' ';
	    $deadline .= date('Y', $date);
	    $deadline .= ' ';
        $deadline .= "<b class='text-info' >";
	    $deadline .= date('h', $date);
	    $deadline .= ':';
        $deadline .= date('i', $date);
        $deadline .= ' ';
        $deadline .= date('A', $date);
        $deadline .= "</b>";
        return $deadline;
    }

	public function makeTime($date){
		$date = str_ireplace([' ', ':'], '-', $date);
		$date = explode("-", $date);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		$hour = (isset($date[3])) ? $date[3] : 0;
		$minutes = (isset($date[4])) ? $date[4] : 0;
		return mktime($hour,$minutes,0,$month,$day,$year);
	}

	public function makeTimeSD($date){
		$date = str_ireplace([' ', ':'], '-', $date);
		$date = explode("-", $date);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		return mktime(0,0,0,$month,$day,$year);
	}

	public function makeTimeED($date){
		$date = explode("-", $date);
		$year = $date[0];
		$month = $date[1];
		$day = $date[2];
		return mktime(23,59,59,$month,$day,$year);
	}

	public function wordCount($text, $num){
		$text = strip_tags($text);
		$text = explode(' ', $text);
		$returnedText = '';
		for ($i=0; $i < $num; $i++) { 
			$returnedText .= $text[$i] . ' ';
		}
		return $returnedText;
	}

	public function action($validate,$data){
		$validateElements = explode("|", $validate);
		foreach ($validateElements as $key) {
			$validateData = explode(":", $key);
			$element = $validateData[0];
			$value = $data[$element];
			$i = 0;
			foreach ($validateData as $switch) {
				if($i > 0){
					switch ($switch) {
						case 'required':
							if(empty($value)){
								$json[] = $this->emr->elementError(_REQUIRED_, "#" . $element);
							}
						break;
						case 'email':
							if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
								$json[] = $this->emr->elementError(_EMAIL_VALIDATE_, "." . $element);
							}
						break;
						case 'date':
							if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value)){
								$json[] = $this->emr->elementError(_DATE_VALIDATE_, "." . $element);
								$json[] = $value;
							}
						break;
						case 'similarity':
							$elements = explode("-", $element);
							$element1 = $elements[0];
							$element2 = $elements[1];
							if($data[$element1] !== $data[$element2]){
								$json[] = $this->emr->elementError(_NO_SIMILARITY_, "." . $element2 . " , ." . $element1);
							}
						break;
						case 'noSimilarity':
							$elements = explode("-", $element);
							$element1 = $elements[0];
							$element2 = $elements[1];
							if($data[$element1] == $data[$element2]){
								$json[] = $this->emr->elementError(_SIMILARITY_, "." . $element2 . " , ." . $element1);
							}
						break;
					}
				}
				++$i;
			}
		}
		if(!empty($json)){
			return $json;
		}else{
			return 0;
		}
	}
}