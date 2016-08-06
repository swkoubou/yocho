<?php

require __DIR__.'/../php/db.php';
require __DIR__.'/../php/createpage.php';

const TABLE = 'event';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  DB::connectDb();
  $data = DB::getTable(TABLE);

  $res = [];
  foreach ($data as $datum) {
    $ps = explode(',', $datum['participants']);
    $ds = explode(',', $datum['dates']);
    $res[] = [
      'event_id' => $datum['event_id'],
      'event_name' => $datum['event_name'],
      'participants' => $ps,
      'dates' => $ds,
      'url' => $datum['url'],
      'deadline' => $datum['deadline']
    ];
  }

  header("Content-Type: application/json");
  echo json_encode($res);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  DB::connectDb();
  $count = 0;
  $dates = [];
  while (isset($_POST['date'.strval($count)])) {
    $dates[] = $_POST['date'.strval($count)];
    $count++;
  }
  $pagefile = createPage();
  $data = [
    'event_id' => null,
    'event_name' => $_POST['eventname'],
    'participants' => 'uryoya,tibimosu,someya',
    'dates' => implode(',', $dates),
    'url' => 'http://localhost/GitHub/yocho/event/'.$pagefile,
    'deadline' => '2016/8/6'
  ];
  DB::insertData(TABLE, $data);
  $message = '「'.$data['event_name'].'」の参加者記入ページを作成しました。こちら( '.$data['url'].' )から希望日時を入力してください。';
  // foreach (explode(',', $data['participants']) as $p) {
  //   $api = __DIR__.'/post_dm.php?id='.$p.'&message='.$message;
  //   print $api.'<br>';
  //   file_get_contents($api);
  //   sleep(1);
  // }
  header("Content-Type: text/html; charset=utf-8");
  // echo '参加者に「'.$data['event_name'].'」の告知を送りました。';
  echo $message;
}
