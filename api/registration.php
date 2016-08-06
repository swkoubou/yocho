<?php

require __DIR__.'/../php/db.php';

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
  $data = [
    'event_id' => null,
    'event_name' => $_POST['eventname'],
    'participants' => '染谷,高畑,浦野',
    'dates' => implode(',', $dates),
    'url' => 'http://yocho/hogehoge.html',
    'deadline' => '2016/8/6'
  ];
  DB::insertData(TABLE, $data);
  header("Content-Type: text/html; charset=utf-8");
  echo '参加者記入ページを生成しました。URLは<a href="'.$data['url'].'">'.$data['url'].'</a>になります。';
}
