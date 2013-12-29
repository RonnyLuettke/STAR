<?php

namespace Star;

/**
 * Description of Config
 *
 * @author Stefan
 */
class Config {
  private static $confName;
  private static $data;
  
  public static function init($config = 'default'){
    if (empty($config) || !is_string($config)) {
      throw new \InvalidArgumentException('$config is not a string or an empty string');
    }
    if(self::$confName != $config) {
      $filename = app_path("config/$config.json");
      if (!file_exists($filename)) {
        throw new \FileNotFoundException("config file '$filename' not found");
      }
      
      $json = file_get_contents($filename);
      self::$data = json_decode($json, true);
      self::$confName = $config;
    }
  }
  
  public static function get($keyPath,$default = NULL){
    self::init(self::$confName ?: 'default');
    $keys = explode('/', $keyPath);
    $current = self::$data;
    foreach ($keys as $key){
      if(!is_array($current) || !key_exists($key, $current)) {
        return $default;
      }
      $current = $current[$key];
    }
    return $current;
  }
}
