<?php

$date = gmdate('Ymd');

$redis = new Redis();
$redis->connect('localhost', 6969);

if ( isset($_POST['add']) )
{
  $add = intval($_POST['add']);
  $add > 0 ? $redis->incrby($date, $add) : $redis->decrby($date, abs($add));
}

$val = $redis->get($date);
echo json_encode(Array('count' => $val));
