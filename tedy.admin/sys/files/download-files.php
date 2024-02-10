<?php

$download_type = $_POST['download_type'];
$file_id = $_POST['file_id'];

if($user->type == 1 || in_array('account', $user->permissions)){
	if (in_array($download_type, ['TRNS', 'REVIEW', 'COMPILE', 'CHECK', 'FORMAT', 'EDIT'])) {
		if($file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id]])){
			$file = $file[0];
			$urlType = strtolower($download_type);
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/$urlType/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'multiple'){
		$file = $wam->dbm->getData('project_items_missions_files', ['id', 'mission'], ['eq' => ['id' => $file_id]]);
		$file = $file[0];
		if($wam->dbm->check('project_items_missions', ['eq' => ['id' => $file->mission]])){
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/multiple/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'translated'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id]])){
			$file = $file[0];
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/done/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'final'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id]])){
			$file = $file[0];
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/final/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}else{
		$json[] = $wam->emr->error('The file you have requested is not available - ' . $download_type);
	}
}elseif($user->type == 2){
	if (in_array($download_type, ['TRNS', 'REVIEW', 'COMPILE', 'CHECK', 'FORMAT', 'EDIT'])) {
		if($file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['translator' => $user->id, 'id' => $file_id]])){
			$file = $file[0];
			$urlType = strtolower($download_type);
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/$urlType/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id]]);
			$file = $file[0];
			$urlType = strtolower($download_type);
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/$urlType/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'multiple'){
		$file = $wam->dbm->getData('project_items_missions_files', ['id', 'mission'], ['eq' => ['id' => $file_id]]);
		$file = $file[0];
		if($wam->dbm->check('project_items_missions', ['eq' => ['translator' => $user->id, 'id' => $file->mission]])){
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/multiple/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/multiple/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'translated'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id, 'user' => $user->id]])){
			$file = $file[0];
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/done/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id]]);
			$file = $file[0];
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/done/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'final'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id]])){
			$file = $file[0];
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/final/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id]]);
			$file = $file[0];
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/final/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}else{
		$json[] = $wam->emr->error('The file you have requested is not available - ' . $download_type);
	}
}elseif($user->type == 3){
	if (in_array($download_type, ['TRNS', 'REVIEW', 'COMPILE', 'CHECK', 'FORMAT', 'EDIT'])) {
		if($file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['translator' => $user->id, 'id' => $file_id]])){
			$file = $file[0];
			$urlType = strtolower($download_type);
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/$urlType/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded', '');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'multiple'){
		$file = $wam->dbm->getData('project_items_missions_files', ['id', 'mission'], ['eq' => ['id' => $file_id]]);
		$file = $file[0];
		if($wam->dbm->check('project_items_missions', ['eq' => ['translator' => $user->id, 'id' => $file->mission]])){
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/multiple/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($download_type == 'translated'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission'], ['eq' => ['id' => $file_id, 'user' => $user->id]])){
			$file = $file[0];
			$json[] = $wam->emr->func('redirect', [
				'url' => "/download-files/done/" . $file->id,
			]);
			$json[] = $wam->emr->alert('success', 'The file is being downloaded');
		}else{
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}else{
		$json[] = $wam->emr->error('The file you have requested is not available - ' . $download_type);
	}
}

?>