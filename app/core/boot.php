<?php
require_once 'helpers.php';
require_once 'autoloader.php';
require_once base_path('vendor/autoload.php');

new Slim\Slim(array(
  'debug'          => Config::get('debug',false),
  'mode'           => Config::get('mode','productive'),
  'view'           => new Slim\Views\Twig(),
  'templates.path' => base_path('views')
));

ActiveRecord\Config::initialize(function(ActiveRecord\Config $cfg) {
  $cfg->set_model_directory(base_path('models'));
  ar_config_connections($cfg, 'database');
});

require_once app_path('routes.php');

App::run();