<?php

function createPage() {
  $savedir = __DIR__.'/../event/';
  $pagefile = makeRandStr(10).'.php';
  createFile($savedir, $pagefile);
  return $pagefile;
}

function makeRandStr($length) {
  static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
  $str = '';
  for ($i = 0; $i < $length; ++$i) {
    $str .= $chars[mt_rand(0, 61)];
  }
  return $str;
}

function createFile($dir, $filename) {
  $ORIGFILE = 'page_template.html';
  $html = file_get_contents($dir.$ORIGFILE);
  file_put_contents($dir.$filename, $html);
}
