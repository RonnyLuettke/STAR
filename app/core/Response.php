<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Star;

/**
 * Description of Response
 *
 * @author Stefan
 */
class Response {
  
  /**
   * Returns the default Slim App
   *
   * @return null|\Slim\Slim
   */
  private static function slim() {
    return \Slim\Slim::getInstance();
  }

  /**
   * Calls the render method of the default Slim App
   *
   * @param $template
   * @param array $data
   * @param null $status
   */
  public static function render($template, $data = array(), $status = null) {
    self::slim()->render($template, $data, $status);
  }
}
