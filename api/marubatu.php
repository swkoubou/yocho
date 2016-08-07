<?php

require __DIR__.'/../php/db.php';

const TABLE = 'marubatu';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  DB::connectDb();
  $data = DB::getTable(TABLE);

  $res = [];
  foreach ($data as $datum) {
    $ds = explode(',', $datum['dates']);
    $ss = explode(',', $datum['status']);
    $res[] = [
      'event_id' => $datum['event_id'],
      'participant' => $datum['participant'],
      'dates' => $ds,
      'status' => $ss
    ];
  }

  header("Content-Type: application/json");
  echo json_encode($res);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  DB::connectDb();
  if (DB::check(TABLE, $_POST['event_id'], $_POST['participant'])) {
    $data = [
      'event_id' => intval($_POST['event_id']),
      'participant' => $_POST['participant'],
      'date' => $_POST['dates'],
      'status' => $_POST['status']
    ];
    var_dump($data);
    DB::insertData(TABLE, $data);
  } else {
    $data = [
      'status' => $_POST['status']
    ];
    DB::updateData(TABLE, $data, intval($_POST['event_id']), $_POST['participant']);
  }
  // header("Content-Type: text/html; charset=utf-8");
  var_dump($_POST);
}
