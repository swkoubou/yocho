<?php

require __DIR__.'/../php/config.php';

$token = Config::$SLACK['token'];

$id = $_GET['id'];
$message = $_GET['message'];

$url = "https://slack.com/api/chat.postMessage?token=".$token."&channel=".$id."&text=".$message;
file_get_contents($url);
