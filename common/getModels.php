<?php

if(!isset($_POST['mark_id'])) {
    die;
}

$mark_id = intval($_POST['mark_id']);

require_once 'functions.php';
$cfg = getCfg();

$connect = new \mysqli( $cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name'] );
mysqli_set_charset( $connect, 'UTF-8' );

$query = 'select * from `car_models` WHERE `mark_id` = ' . $mark_id;
$result = mysqli_query($connect, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
die(json_encode($data));