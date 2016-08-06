<?php

require __DIR__.'/../php/config.php';

class Slack {
	function __construct() {
		$this->token = Config::$SLACK['token'];
	}

	function getUsersList() {
		$url = "https://slack.com/api/users.list?token=".$this->token;
		$response = file_get_contents($url);
		$response = json_decode($response, true);
		$users_list = [];
		foreach ($response['members'] as $member) {
			$users_list[] = ['name' => $member['name'], 'id' => $member['id']];
		}
		return $users_list;
	}

	function postDirectMessage($id, $message) {
		$url = "https://slack.com/api/chat.postMessage?token=".$this->token."&channel=".$id."&text=".$message;
		file_get_contents($url);
	}
}
