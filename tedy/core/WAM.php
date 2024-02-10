<?php

require_once 'DBM.php';
require_once 'POC.php';
require_once 'ACT.php';
require_once 'CLS.php';
require_once 'EMR.php';
require_once 'LNG.php';
require_once 'SEO.php';
require_once 'SCR.php';

class WAM
{
    public $dbm;
    public $act;
    public $emr;
    public $poc;
    public $cls;
    public $lng;
    public $seo;
    public $scr;
    public $website;
    public $cdn;
    public $headerBG;
    public $time;
    private $user = [
        'id' => null,
        'name' => null,
        'email' => null,
    ];
    public function __construct(
        $website,
        $cdn,
        $logo,
        $host,
        $user,
        $password,
        $database,
        $socialAccounts,
        $lang = 0,
        $db_errors = false
    ) {
        $this->dbm = new DBM("$host", "$user", "$password", "$database", $db_errors);
        $this->poc = new POC();
        $this->cls = new CLS($this->dbm, $this->poc);
        $this->act = new ACT($this->emr, $this->dbm, $this->poc);
        $this->emr = new EMR();
        $this->lng = new LNG($lang);
        $this->seo = new SEO($this->lng->language['_SITE_'], $logo, $website, $socialAccounts, $this->lng->language['_DESCRIPTION_']);
        $this->scr = new SCR();
        $this->website = $website;
        $this->cdn = $cdn;
        $this->headerBG = 'transparent';
        $this->time = time();
    }

    public function setHeaderBG($color)
    {
        $this->headerBG = $color;
    }

    public function setUser($id, $name, $email)
    {
        $this->user['id'] = $id;
        $this->user['name'] = $name;
        $this->user['email'] = $email;
    }

    public function getUser()
    {
        return json_encode($this->user);
    }

    public function getUserData($key)
    {
        return $this->user[$key];
    }
}
