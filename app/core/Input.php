<?php

class Input {

  /**
   * Returns the full Slim Request
   *
   * @return \Slim\Http\Request
   */
  public static function request() {
    return \Slim\Slim::getInstance()->request();
  }

  /**
   * Returns all parameters
   *
   * @return array|mixed|null
   */
  public static function all() {
    return self::request()->params();
  }

  /**
   * Returns if there is a value for $key
   *
   * @param $key
   *
   * @return bool
   */
  public static function has($key) {
    return !is_null(self::request()->params($key));
  }

  /**
   * Returns the value for $key. If it doesn't exist $default will be returned
   *
   * @param $key
   * @param null $default
   *
   * @return mixed|null
   */
  public static function param($key, $default = null) {
    $res = self::request()->params($key);
    return is_null($res) ? $default : $res;
  }
  
  // TODO: files($name) - hochgeladene Files parsen
}