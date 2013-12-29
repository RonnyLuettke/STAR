<?php

namespace Star;

/**
 * Description of Route
 *
 * @author Stefan
 */
class Route {
  
  /**
   * Returns the default Slim App
   *
   * @return null|\Slim\Slim
   */
  private static function slim() {
    return \Slim\Slim::getInstance();
  }

  
  /**
   * Add GET route
   * @return \Slim\Route
   */
  public static function get(){
    self::callSlim('get', func_get_args());
  }

  /**
   * Add POST route
   * @return \Slim\Route
   */
  public static function post(){
    self::callSlim('post', func_get_args());
  }

  /**
   * Add PUT route
   * @return \Slim\Route
   */
  public static function put(){
    self::callSlim('put', func_get_args());
  }

  /**
   * Add PATCH route
   * @return \Slim\Route
   */
  public static function patch(){
    self::callSlim('patch', func_get_args());
  }

  /**
   * Add DELETE route
   * @return \Slim\Route
   */
  public static function delete(){
    self::callSlim('delete', func_get_args());
  }

  /**
   * Add OPTION route
   * @return \Slim\Route
   */
  public static function options(){
    self::callSlim('options', func_get_args());
  }

  /**
   * Add route for any HTTP method
   * @return \Slim\Route
   */
  public static function any(){
    self::callSlim('any', func_get_args());
  }

  /**
   * Route Groups
   *
   * This method accepts a route pattern and a callback all Route
   * declarations in the callback will be prepended by the group(s)
   * that it is in
   *
   * Accepts the same parameters as a standard route so:
   * (pattern, middleware1, middleware2, ..., $callback)
   */
  public static function group(){
    self::callSlim('group', func_get_args());
  }

  private static function callSlim($method,$arguments){
    call_user_func_array(array(self::slim(),$method),$arguments);
  }
}
