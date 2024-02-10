<?php

class CLS{
	private $dbm;
	private $poc;

	function __construct($dbm,$poc){
		$this->dbm = $dbm;
		$this->poc = $poc;
		$this->username = $_SESSION['username'];
		$this->password = $_SESSION['password'];
		$this->hash = $_SESSION['user']->salt;
	}

	public function check($username, $password, $encrypt = 0){
		if($encrypt == 1){
			$password = $this->poc->encrypt($password);
		}
		$data = $this->dbm->getData('users', 'salt',[
			'eq' => ['email' => $username]
		]);
		$data = $data[0];

		return ($this->poc->authenticate($password, $data->salt) == true) ? true : false;
	}

}

