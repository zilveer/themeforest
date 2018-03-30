<?php 


class LogContainer{
  static $container = array();

  static function add($type, $item) {
    self::$container[$type][] = $item;
  }

  static function print_log() {
    foreach( self::$container as $key => $values ) {
      foreach($values as $val) {
        call_user_func_array(array('ChromePhp', $key), array($val));
      }
    }
  }
}