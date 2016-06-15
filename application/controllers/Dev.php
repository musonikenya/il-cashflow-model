<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dev extends CI_Controller {

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


}
