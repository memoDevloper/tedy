<?php

if($user->type == 1 || in_array('account', $user->permissions)){
	if (in_array($dir2, ['trns', 'review', 'compile', 'check', 'format', 'edit'])) {
		if($file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]])){
			$file = $file[0];
            $name_explode = explode('-', $file->item);
            $name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
            $item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
            $item = $item[0];
            $name = $item->original_name;
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
			echo 'The file you have requested is not available';
		}
	}elseif($dir2 == 'multiple'){
		$file = $wam->dbm->getData('project_items_missions_files', ['id', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]]);
		$file = $file[0];
		if($item = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['id' => $file->mission]])){
			$item = $item[0];
			$name = $item->item . '-' . strtoupper($dir2) . '-' . $file->id;
			$original_filename = '../' . $file->file;
			$new_filename = $name . '.' . $file->extension;

			// headers to send your file
			header("Content-Type: $file->mime");
			header("Content-Length: " . filesize($original_filename));
			header('Content-Disposition: attachment; filename="' . $new_filename . '"');
			readfile($original_filename);
			exit;
		}else{
			echo 'The file you have requested is not available';
		}
	}elseif($dir2 == 'done'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]])){
			$file = $file[0];
            $name_explode = explode('-', $file->item);
            $name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
            $item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
            $item = $item[0];
            $name = $item->original_name . '-' . strtoupper($file->mission);
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
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}elseif($dir2 == 'final'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]])){
			$file = $file[0];
			$name_explode = explode('-', $file->item);
			$name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
			$item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
			$item = $item[0];
			$name = $item->original_name;
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
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}
}elseif($user->type == 2){
	if (in_array($dir2, ['trns', 'review', 'compile', 'check', 'format', 'edit'])) {
		if($file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['translator' => $user->id, 'id' => $dir3]])){
			$file = $file[0];
            $name_explode = explode('-', $file->item);
            $name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
            $item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
            $item = $item[0];
            $name = $item->original_name;
			$original_filename = '../' . $file->file;
			$mime = mime_content_type($original_filename);
			$new_filename = $name . '.' . $file->extension;

			// headers to send your file
			header("Content-Type: $file->mime");
			header("Content-Length: " . filesize($original_filename));
			header('Content-Disposition: attachment; filename="' . $new_filename . '"');
			readfile($original_filename);
			exit;
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]]);
			$file = $file[0];
			$name = $file->item . '-' . strtoupper($dir2);
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
			echo 'The file you have requested is not available';
		}
	}elseif($dir2 == 'multiple'){
		$file = $wam->dbm->getData('project_items_missions_files', ['id', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]]);
		$file = $file[0];
		if($item = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['translator' => $user->id, 'id' => $file->mission]])){
			$item = $item[0];
			$name = $item->item . '-' . strtoupper($dir2) . '-' . $file->id;
			$original_filename = '../' . $file->file;
			$new_filename = $name . '.' . $file->extension;

			// headers to send your file
			header("Content-Type: $file->mime");
			header("Content-Length: " . filesize($original_filename));
			header('Content-Disposition: attachment; filename="' . $new_filename . '"');
			readfile($original_filename);
			exit;
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$item = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission'], ['eq' => ['id' => $file->mission]]);
			$item = $item[0];
			$name = $item->item . '-' . strtoupper($dir2) . '-' . $file->id;
			$original_filename = '../' . $file->file;
			$new_filename = $name . '.' . $file->extension;

			// headers to send your file
			header("Content-Type: $file->mime");
			header("Content-Length: " . filesize($original_filename));
			header('Content-Disposition: attachment; filename="' . $new_filename . '"');
			readfile($original_filename);
			exit;
		}else{
			echo 'The file you have requested is not available';
		}
	}elseif($dir2 == 'done'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['user' => $user->id, 'id' => $dir3]])){
			$file = $file[0];
            $name_explode = explode('-', $file->item);
            $name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
            $item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
            $item = $item[0];
            $name = $item->original_name . '-' . strtoupper($file->mission);
			$original_filename = '../' . $file->file;
			$mime = mime_content_type($original_filename);
			$new_filename = $name . '.' . $file->extension;

			// headers to send your file
			header("Content-Type: $file->mime");
			header("Content-Length: " . filesize($original_filename));
			header('Content-Disposition: attachment; filename="' . $new_filename . '"');
			readfile($original_filename);
			exit;
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]]);
			$file = $file[0];
			$name = $file->item . '-' . strtoupper($file->mission);
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
			echo 'The file you have requested is not available';
		}
	}elseif($dir2 == 'final'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]])){
			$file = $file[0];
			$name_explode = explode('-', $file->item);
			$name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
			$item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
			$item = $item[0];
			$name = $item->original_name;
			$original_filename = '../' . $file->file;
			$mime = mime_content_type($original_filename);
			$new_filename = $name . '.' . $file->extension;

			// headers to send your file
			header("Content-Type: $file->mime");
			header("Content-Length: " . filesize($original_filename));
			header('Content-Disposition: attachment; filename="' . $new_filename . '"');
			readfile($original_filename);
			exit;
		}elseif($wam->dbm->check('projects', ['li' => ['translators' => "[$user->id]"]])){
			$file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]]);
			$file = $file[0];
			$name_explode = explode('-', $file->item);
			$name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
			$item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
			$item = $item[0];
			$name = $item->original_name;
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
			echo 'The file you have requested is not available';
		}
	}
}elseif($user->type == 3){
	if (in_array($dir2, ['trns', 'review', 'compile', 'check', 'format', 'edit'])) {
		if($file = $wam->dbm->getData('project_items_missions', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['translator' => $user->id, 'id' => $dir3]])){
			$file = $file[0];
            $name_explode = explode('-', $file->item);
            $name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
            $item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
            $item = $item[0];
            $name = $item->original_name;
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
			echo 'The file you have requested is not available 1';
		}
	}elseif($dir2 == 'multiple'){
		$file = $wam->dbm->getData('project_items_missions_files', ['id', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]]);
		$file = $file[0];
		if($item = $wam->dbm->getData('project_items_missions', ['id', 'item'], ['eq' => ['translator' => $user->id, 'id' => $file->mission]])){
			$item = $item[0];
			$name = $item->item . '-' . strtoupper($dir2) . '-' . $file->id;
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
			echo mysql_error();
		}
	}elseif($dir2 == 'done'){
		if($file = $wam->dbm->getData('project_items_translated', ['id', 'item', 'mission', 'file', 'extension', 'mime'], ['eq' => ['id' => $dir3]])){
			$file = $file[0];
            $name_explode = explode('-', $file->item);
            $name = "$name_explode[0]-$name_explode[1]-$name_explode[2]-$name_explode[3]";
            $item = $wam->dbm->getData('project_items', ['original_name'], ['eq' => ['name' => $name]]);
            $item = $item[0];
            $name = $item->original_name . '-' . strtoupper($file->mission);
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
			$json[] = $wam->emr->error('The file you have requested is not available');
		}
	}
}

?>