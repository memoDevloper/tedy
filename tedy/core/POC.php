<?php

class POC{

	private function getNewSalt(){
		$saltStrings = array(
			'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
			'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
			'1','2','3','4','5','6','7','8','9','0',
			'!','@','#','$','%','^','&','*','-','_','+','=','/','~','.','?'
		);
		$salt = "";
		$i = 0;
		while ($i <= 100) {
			$salt .= $saltStrings[rand(0,77)];
			++$i;
		}
		return $salt;
	}

	public function getPasswordHash($password){
		$salt = self::getNewSalt();
		$options = [
			'salt' => $salt,
			'cost' => 5
		];
		return password_hash($password, PASSWORD_DEFAULT, $options);
	}

	public function encrypt($password){
		return sha1(md5(sha1(md5($password))));
	}

	public function authenticate($password, $hash){
		return password_verify($password, $hash) ? true : false;
	}

}

