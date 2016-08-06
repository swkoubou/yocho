<?php

require __DIR__.'/../php/db.php';

const TABLE = 'ivent';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  DB::connectDb();
  $data = DB::getTable(TABLE);

  $res = [];
  foreach ($data as $datum) {
    $ps = explode(',', $datum['participants']);
    $ds = explode(',', $datum['dates']);
    $res[] = [
      'ivent_id' => $datum['ivent_id'],
      'ivent_name' => $datum['ivent_name'],
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
    'ivent_id' => null,
    'ivent_name' => $_POST['eventname'],
    'participants' => '染谷,高畑,浦野',
    'dates' => implode(',', $dates),
    'url' => 'http://yocho/hogehoge.html',
    'deadline' => '2016/8/6'
  ];
  DB::insertData(TABLE, $data);
  header("Content-Type: text/html; charset=utf-8");
  echo '参加者記入ページを生成しました。URLは<a href="'.$data['url'].'">'.$data['url'].'</a>になります。';
}
