<?php

require_once 'DBM.php';
require_once 'POC.php';
require_once 'ACT.php';
require_once 'CLS.php';
require_once 'EMR.php';

class WAM{
    public $dbm;
    public $act;
    public $emr;
    public $poc;
    public $cls;
    public $website;
    public $cdn;
    public $headerBG;
    public $time;
    public function __construct($website, $cdn, $host, $user, $password, $database, $lang = 0, $db_errors = false)
    {
        $this->dbm = new DBM("$host", "$user", "$password", "$database", $db_errors);
        $this->poc = new POC();
        $this->cls = new CLS($this->dbm,$this->poc);
        $this->act = new ACT($this->emr, $this->dbm,$this->poc);
        $this->emr = new EMR();
        $this->website = $website;
        $this->cdn = $cdn;
        $this->headerBG = 'transparent';
        $this->time = time();
    }

    public function setHeaderBG($color){
        $this->headerBG = $color;
    }
}