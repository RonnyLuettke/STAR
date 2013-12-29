<?php

namespace Star;

class App {

  /**
   * Returns the default Slim App
   *
   * @return null|\Slim\Slim
   */
  public static function slim() {
    return \Slim\Slim::getInstance();
  }

  /**
   * Builds a callable with a controller and method name
   *
   * @param $controller
   * @param $method
   *
   * @return callable
   */
  public static function call($controller, $method){
    if(is_string($controller)) $controller = new $controller();
    return array($controller, $method);
  }
    /**
   * Run
   *
   * This method invokes the middleware stack, including the core Slim application;
   * the result is an array of HTTP status, header, and body. These three items
   * are returned to the HTTP client.
   */
  public static function run() {
    self::slim()->run();
  }

  /**
   * Stop
   *
   * The thrown exception will be caught in application's `call()` method
   * and the response will be sent as is to the HTTP client.
   *
   * @throws \Slim\Exception\Stop
   */
  public static function stop() {
    self::slim()->stop();
  }
}
