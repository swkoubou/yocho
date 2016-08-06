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
      'ivent_id' => $datum['ivent_id'],
      'participant' => $datum['participant'],
      'dates' => $ds,
      'status' => $ss
    ];
  }

  header("Content-Type: application/json");
  echo json_encode($res);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

}
