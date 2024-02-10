<?php

class CLS
{
	private $dbm;
	private $poc;

	function __construct($dbm, $poc)
	{
		$this->dbm = $dbm;
		$this->poc = $poc;
	}

	public function check($username, $password, $db, $encrypt = 0)
	{
		$dbs = [
			1 => 'clients',
		];
		$db = $dbs[$db];
		if ($encrypt == 1) {
			$password = $this->poc->encrypt($password);
		}
		$data = $this->dbm->getData($db, 'salt', [
			'eq' => ['email' => $username]
		]);
		$data = $data[0];

		return ($this->poc->authenticate($password, $data->salt) == true) ? true : false;
	}
}
