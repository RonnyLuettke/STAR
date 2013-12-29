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
  public static function render($template, $data = array(), $status = 200) {
    self::slim()->render($template, $data, $status);
  }
  
  public static function json($data, $status = 200) {
    $resp = self::slim()->response();
    $resp->header('Content-Type', 'application/json');
    $resp->status($status);
    $resp->body(json_encode($data));
  }
  
  public static function plain($data, $status = 200, $mime = 'text/html') {
    $resp = self::slim()->response();
    $resp->header('Content-Type', $mime);
    $resp->status($status);
    $resp->body(json_encode($data));
  }
  
  public static function file($filename, $realname, $status = 200, $mime = null) {
    header('Content-disposition: attachment; filename=' . $realname);
    header('Content-type: ' . is_null($mime) ? self::getMime($realname) : $mime);
    header('Content-Length: ' . filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    ob_clean();
    flush();
    readfile($filename);
  }
  
  private static function getMime($file) {
    switch (strtolower(pathinfo($file, PATHINFO_EXTENSION))){
      case 'pdf':  return 'application/pdf';
      
      case 'doc':  return 'application/msword';
      case 'docm': return 'application/vnd.ms-word.document.macroEnabled.12';
      case 'docx': return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
      
      case 'xls':  return 'application/msexcel';
      case 'xlsm': return 'application/vnd.ms-excel.sheet.macroEnabled.12';
      case 'xlsx': return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
      
      case 'pps':
      case 'ppt':  return 'application/mspowerpoint';
      case 'ppsx': return 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
      case 'pptx': return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
        
      case 'odt':  return 'application/vnd.oasis.opendocument.text';
      case 'ods':  return 'application/vnd.oasis.opendocument.spreadsheet';
      case 'odp':  return 'application/vnd.oasis.opendocument.presentation';
        
      case 'jpg':
      case 'jpeg': return 'image/jpeg';
      case 'png':  return 'image/png';
      case 'gif':  return 'image/gif';
      
      case 'mp3':  return 'audio/mpeg';
      case 'ogg':  return 'audio/ogg';
      case 'mpg':
      case 'mpeg': return 'audio/mpeg';

      case 'mp4':  return 'video/mp4';
      case 'avi':  return 'video/avi';
        
      case 'txt':
      case 'log':  return 'text/plain';
        
      default:     return 'application/octet-stream';
    }
  }
}
