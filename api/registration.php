<?php

require __DIR__.'/../php/db.php';

const TABLE = 'ivent';

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
