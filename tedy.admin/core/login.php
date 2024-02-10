<?php

$username = $_POST['username'];
$password = $_POST['password'];


if(empty($password)){$json[] = $wam->emr->alert('warning', 3, "");}

if(!isset($json)){

	if($wam->cls->check($username,$password, 1)){
		$user = $wam->dbm->getData("users",'*',[
			"eqo" => ["email" => $username, 'username' => $username]
		]);
		$user = $user[0];
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		$ip_address = getenv('HTTP_CLIENT_IP')?: getenv('HTTP_X_FORWARDED_FOR')?: getenv('HTTP_X_FORWARDED')?: getenv('HTTP_FORWARDED_FOR')?: getenv('HTTP_FORWARDED')?: getenv('REMOTE_ADDR');
		$ip_address = ip2long($ip_address);
		if($wam->dbm->insert('access_tokens', [
			'user' => $user->id,
			'token' => $token,
			'remember' => (isset($_POST['remember'])) ? 1 : 0,
			'date' => $time,
			'ip_address' => $ip_address
		])){
			if(isset($_POST['remember'])){
				setcookie("token", $token, time() + (60 * 60 * 24 * 365), '/');
			}else{
				setcookie("token", $token, 0, '/');
			}
            $year = date('Y', $time);
            $month = date('m', $time);
            $day = date('d', $time);
            $wam->dbm->update('work_schedule', [
                'set' => [
                    'status' => 0
                ],
                'eq' => ['user' => $user->id, 'status' => 1]
            ]);
            $query = $wam->dbm->insert('work_schedule', [
                'user' => $user->id,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'start' => $time,
                'end' => $time,
                'status' => 1,
            ]);
			$wam->dbm->insert("changelog",[
				"actionName" => "login",
				"actionType" => "login",
				"user" => $user->id,
				"date" => $time
			]);
		}
		if(isset($_POST['SI_X002'])){
			$json[] = $wam->emr->alert('warning', _RELOGIN_SUCCESS_, "");
			$json[] = $wam->emr->func('signinSuccessModal', false);
		}else{
			$json[] = $wam->emr->alert('warning', _RELOGIN_SUCCESS_, "");
			$json[] = $wam->emr->func('reload', false);
		}
	}else{
		$json[] = $wam->emr->alert('warning', 4, "");
		$json[] = $wam->emr->error(_USERNAME_OR_PASSWORD_INCORRECT_);
	}

}