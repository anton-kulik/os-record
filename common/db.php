<?php

require_once 'functions.php';

class db
{
    private $connect = FALSE;
    private function __clone(){}
    private function __wakeup(){}

    public function __construct()
    {
        if( !$this->connect ) {
            $cfg = getCfg();
            $this->connect = new \mysqli( $cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
            mysqli_set_charset($this->connect, 'UTF-8');
        }
    }

    public function query($query) {
        $result = $this->connect->query($query);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function execute($query)
    {
        $result = $this->connect->query($query);
        return $result;
    }
}