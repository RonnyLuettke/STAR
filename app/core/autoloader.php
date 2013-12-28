<?php

spl_autoload_register(function($class){
  $dirs = array(
      app_path('core'),
      base_path('controllers')
  );
  
  foreach($dirs as $dir) {
    $file = find_file_recursive("$class.php", $dir);
    if ($file) {
      require_once $file;
      if (class_exists($class)) {
        return;
      }
    }
  }
});

function find_file_recursive($filename, $dir) {
  $dir_list = array_diff(scandir($dir), array('.','..'));
  foreach ($dir_list as $element){
    $current_path = combine_path($dir, $element);
    if (is_dir($current_path)){      
      return find_file_recursive($filename, $current_path);
    }
    if ($filename == $element){
      return $current_path;
    }
  }
  return false;
}

