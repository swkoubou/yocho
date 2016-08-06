<?php

require __DIR__.'/../php/config.php';

header('Access-Control-Allow-Origin: *');

$token = Config::$SLACK['token'];

$url = "https://slack.com/api/users.list?token=".$token;
$response = file_get_contents($url);
$response = json_decode($response, true);

// slack apiの結果からnameとidだけ抽出
$users_list = [];
foreach ($response['members'] as $member) {
	$users_list[] = ['name' => $member['name'], 'id' => $member['id']];
}

$list =  json_encode($users_list);
echo $list;


