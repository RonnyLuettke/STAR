<?php
function base_path($subpath = NULL) {
  $dir = dirname(dirname(dirname(__FILE__)));
  return is_null($subpath) ? $dir : combine_path($dir, $subpath);
}

function app_path($subpath) {
  return combine_path(base_path(), 'app', $subpath);
}

function storage_path($subpath) {
  return combine_path(base_path(), 'storage', $subpath);
}

function combine_path($args){
  $args = implode(DIRECTORY_SEPARATOR, func_get_args());
  return preg_replace('~[\\/]+~', DIRECTORY_SEPARATOR, $args);
}

function assure_path($path){
  if(!file_exists($path)) {
    mkdir($path, 0777, true);
  }
}

function ar_config_connections(ActiveRecord\Config $cfg, $key) {
  $data = Config::get($key, array());
  $default_connection = key_exists('default_db', $data) ? $data['default_db'] : 'default';
  $connections = array();
  foreach($data as $name => $connection) {
    if(is_array($connection)) {
      $con_str = $connection['dbms'] . '://';
      if($con_str != 'sqlite') {
         $con_str .= $connection['username'];
         $con_str .= ':' . $connection['password'];
         $con_str .= '@' . $connection['host'] . '/';
      }
      $con_str .= $connection['schema'];
      $connection[$name] = $con_str; 
    }
  }
  $cfg->set_connections($connections, $default_connection);
}

/**
 * Debug output & Die
 *
 * @param $var
 */
function dd($var){
  echo '<b>debug:</b><pre>';
  var_dump($var);
  App::slim()->response()->status(401);
  die();
}