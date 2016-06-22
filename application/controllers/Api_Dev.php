<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_Dev extends CI_Controller {

    public function index()
    {
        //Login using username and password
$curl = curl_init();
$username = 'rndwiga';
$password = 'demo';
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://demo.musonisystem.com/kenya/api/v1/authentication',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        //CURLOPT_USERPWD => "rndwiga:)R31nA?21",

    ));
    curl_setopt($curl, CURLOPT_POSTFIELDS, 'username='.$username.'&password='.$password);

    $result = curl_exec($curl);
    curl_close($curl);
    print_r($result);
    //print_r(json_decode($result));

    }

    public function validate_post_request()
    {
      /*
        This function is to be used in ensuring that data received from url is post
      */
      //Make sure that it is a POST request.
          if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
              throw new Exception('Request method must be POST!');
          }

          //Make sure that the content type of the POST request has been set to application/json
          $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
          if(strcasecmp($contentType, 'application/json') != 0){
              throw new Exception('Content type must be: application/json');
          }

          //Receive the RAW post data.
          $content = trim(file_get_contents("php://input"));

          //Attempt to decode the incoming RAW post data from JSON.
          $decoded = json_decode($content, true);

          //If json_decode failed, the JSON is invalid.
          if(!function_exists('json_last_error')){
      if($decoded === false || $decoded === null){
          throw new Exception('Could not decode JSON!');
      }
  } else{

      //Get the last JSON error.
      $jsonError = json_last_error();

      //In some cases, this will happen.
      if(is_null($decoded) && $jsonError == JSON_ERROR_NONE){
          throw new Exception('Could not decode JSON!');
      }

      //If an error exists.
      if($jsonError != JSON_ERROR_NONE){
          $error = 'Could not decode JSON! '; //JSON_ERROR_NONE: No error has occured.

          //Use a switch statement to figure out the exact error.

          switch($jsonError){
              case JSON_ERROR_DEPTH:
                  $error .= 'Maximum depth exceeded!';
              break;
              case JSON_ERROR_STATE_MISMATCH:
                  $error .= 'Underflow or the modes mismatch!'; //JSON_ERROR_STATE_MISMATCH: Invalid JSON.
              break;
              case JSON_ERROR_CTRL_CHAR:
                  $error .= 'Unexpected control character found'; //JSON_ERROR_CTRL_CHAR: Bad character was found.
              break;
              case JSON_ERROR_SYNTAX:
                  $error .= 'Malformed JSON';
              break;
              case JSON_ERROR_UTF8:
                   $error .= 'Malformed UTF-8 characters found!';
              break;
              default:
                  $error .= 'Unknown error!';
              break;
          }
          throw new Exception($error);
      }
  }
    }


}
