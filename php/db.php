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
}
