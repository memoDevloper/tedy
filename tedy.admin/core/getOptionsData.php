<?php

$at = $_POST['actionType'];
$id = $_POST['determiner'];

if(isset($at)){
	$db = [
		'GET_TYPE_MOLDES' => 'assets_models',
		'GET_MODELS_QUANTITIES' => 'assets_models_quantities',
	];
	$db = $db[$at];
	if($at == "GET_TYPE_MOLDES"){
		$options = $wam->dbm->getData($db, 'id, name_ar, name_en', [
			'eq' => ['section' => $id]
		]);
		foreach ($options as $key => $option) {
			$name = [$option->name_en, $option->name_ar];
			$name = $name[$_SESSION['lang']];
			$json['options'][] = $wam->emr->options($name, $option->id);
		}
	}
	if($at == "GET_MODELS_QUANTITIES"){
		$options = $wam->dbm->getData($db, 'id, quantity, free_quantity, date', [
			'eq' => ['model' => $id]
		]);
		foreach ($options as $key => $option) {
			$quantity = $option->quantity + $option->free_quantity;
			$json['options'][] = $wam->emr->options(date('Y-m-d', $option->date), $option->id, $quantity);
		}
	}
	$json[] = $wam->emr->func('setOptions');
}