<?php

require __DIR__.'/../php/config.php';

$token = Config::$SLACK['token'];

$name = $_GET['name'];
$message = $_GET['message'];

$url = "https://slack.com/api/users.list?token=".$token;
$response = file_get_contents($url);
$response = json_decode($response, true);

foreach ($response['members'] as $member) {
	if ($member['name'] === $name) {
		$id = $member['id'];
		break;
	}
}
$url = "https://slack.com/api/chat.postMessage?token=".$token."&channel=".$id."&text=".$message;
file_get_contents($url);
