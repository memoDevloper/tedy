<?php

class EMR{
	public function success($message){
		$x['type'] = "notify";
		$x['notify'] = "success";
		$x['position'] = "right";
		$x['message'] = $message;
		return $x;
	}
	public function error($message){
		$x['type'] = "notify";
		$x['notify'] = "error";
		$x['position'] = "right";
		$x['message'] = $message;
		return $x;
	}
	public function elementSuccess($message,$element){
		$x['type'] = "elementNotify";
		$x['notify'] = "success";
		$x['element'] = $element;
		$x['message'] = $message;
		return $x;
	}
	public function elementError($message,$element){
		$x['type'] = "elementNotify";
		$x['notify'] = "error";
		$x['element'] = $element;
		$x['message'] = $message;
		return $x;
	}
	public function alert($type, $alert_title, $alert_text){
		$x = [
			'type' => 'alert',
			'alert_type' => $type,
			'alert_title' => $alert_title,
			'alert_text' => $alert_text,
		];
		return $x;
	}
	public function func($function,$data){
		$x['type'] = "func";
		$x['func'] = $function;
		$x['selector'] = $data;
		return $x;
	}
	public function options($name, $value, $extra){
		$x['name'] = $name;
		$x['value'] = $value;
		$x['extra'] = $extra;
		return $x;
	}
	public function send($emr){
		echo json_encode($emr);
	}
}