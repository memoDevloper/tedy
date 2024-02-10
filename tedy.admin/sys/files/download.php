<?php

if(isset($_POST['file_name'])){
	if($file = $wam->dbm->getData('project_items', ['id', 'name', 'original_name', 'file', 'extension', 'mime'], ['eq' => ['name' => $_POST['file_name']]])){
		$file = $file[0];
		$json[] = $wam->emr->func('redirect', [
			'url' => "/donwload/" . $_POST['file_name'],
		]);
		$json[] = $wam->emr->alert('success', 'The file is being downlaoded');
	}else{
		$json[] = $wam->emr->error('The file you have requested is not availabel');
	}
}else{
	if($file = $wam->dbm->getData('project_items', ['id', 'name', 'original_name', 'file', 'extension', 'mime', 'translators'], ['eq' => ['name' => $dir2]])){
		$file = $file[0];
        $name = $file->original_name;
		$original_filename = '../' . $file->file;
		$mime = mime_content_type($original_filename);
		$new_filename = $name . '.' . $file->extension;

		// headers to send your file
		header("Content-Type: $file->mime");
		header("Content-Length: " . filesize($original_filename));
		header('Content-Disposition: attachment; filename="' . $new_filename . '"');
		readfile($original_filename);
		exit;
	}else{
		echo 'The file you have requested is not availabel';
	}
}

?>