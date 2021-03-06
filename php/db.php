<?php

require __DIR__.'/config.php';

class DB {
  static $db;
  static $config;

  public function __construct() {
      if (!isset($db)) {
          $this->connectDb();
      }
  }

  public static function connectDb() {
    self::$config = Config::$DB;
    self::$db = new \PDO(
      sprintf(
        'mysql:host=%s;dbname=%s;charset=utf8;',
        self::$config['host'],
        self::$config['dbname']
      ),
      self::$config['dbuser'],
      self::$config['password']
    );
  }

  public static function getTable($table) {
    $sql = 'select * from '.$table.';';
    $stmt = self::$db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function insertData($table, $data) {
    // $sql = "insert into " . $table . " set ";
    // $sql = array_reduce(array_keys($data), function (&$res, $key) {
    //     return $res . $key . " = :" . $key . ",";
    // }, $sql);
    // $sql = substr_replace($sql, "", -1);
    $sql = 'insert into '.$table.' (';
    $sql .= implode(',', array_keys($data)).') values(';
    $sql = array_reduce(array_keys($data), function (&$res, $key) {
        return $res . ":" . $key . ",";
    }, $sql);
    $sql = substr_replace($sql, "", -1).");";
    $stmt = self::$db->prepare($sql);
    foreach ($data as $k => $v) {
      if (is_null($v)) {
        $stmt->bindValue(':'.$k, null, PDO::PARAM_NULL);
      } else if (is_int($v)) {
        $stmt->bindValue(':'.$k, intval($v), PDO::PARAM_INT);
      } else {
        $stmt->bindValue(':'.$k, $v, PDO::PARAM_STR);
      }
    }
    $stmt->execute();
  }

  public static function updateData($table, $data, $id, $name) {
    $sql = "update " . $table . " set ";
    $sql = array_reduce(array_keys($data), function (&$res, $key) {
        return $res . $key . " = :" . $key . ",";
    }, $sql);
    $sql = substr_replace($sql, "", -1);
    $sql = $sql.' where event_id='.$id.' and participant="'.$name.'";';
    $stmt = self::$db->prepare($sql);
    foreach ($data as $k => $v) {
      if (is_null($v)) {
        $stmt->bindValue(':'.$k, null, PDO::PARAM_NULL);
      } else if (is_int($v)) {
        $stmt->bindValue(':'.$k, $v, PDO::PARAM_INT);
      } else {
        $stmt->bindValue(':'.$k, $v, PDO::PARAM_STR);
      }
    }
    $stmt->execute();
  }

  public function check($table, $id, $name) {
    $sql = 'select * from '.$table.' where event_id='.$id.' and participant="'.$name.'";';
    $stmt = self::$db->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return empty($res)? true : false;
  }
}
