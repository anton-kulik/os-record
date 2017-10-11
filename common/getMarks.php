<?php

if(!isset($_POST['getMarks'])) {
    die;
}

require_once 'functions.php';
$cfg = getCfg();

$connect = new \mysqli( $cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name'] );
mysqli_set_charset( $connect, 'UTF-8' );

$query = 'SELECT * FROM `car_marks`';
$result = mysqli_query($connect, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
die(json_encode($data));