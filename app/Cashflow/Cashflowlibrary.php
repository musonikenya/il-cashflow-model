<?php

namespace App\Cashflow;

class Cashflowlibrary {

  public function __construct() {
      }
public function curlOption($urlOption)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "8443",
      CURLOPT_URL => env('CASHFLOW_URL') . $urlOption ,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live.
      CURLOPT_HTTPHEADER => array(
                 env('CASHFLOW_AUTHORIZATION'),
  				"cache-control: no-cache",
  				"content-type: application/json",
                env('CASHFLOW_TENANT')
  			),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err; //build a function that notifies the admin of the failure
        } else {
          $obj = json_decode($response, true);
          return $obj;
        }
  }
  public function curlPostData($data)
  {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_PORT => "8443",
              CURLOPT_URL => env('CASHFLOW_URL') . $data['urlExtention'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //  CURLOPT_CUSTOMREQUEST => "DELETE",
            //  CURLOPT_CUSTOMREQUEST => "PUT",
            //  CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_CUSTOMREQUEST => $data['httpRequestMethod'],
              CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
              CURLOPT_POSTFIELDS => $data['postData'],
              CURLOPT_HTTPHEADER => array(
                  env('CASHFLOW_AUTHORIZATION'),
                "cache-control: no-cache",
                "content-type: application/json",
                  env('CASHFLOW_TENANT')
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
              $response = "cURL Error #:" . $err;
              return $response;
            } else {
              return $response;
            }
  }
  public function curlUploadFile($data)
  {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => env('CASHFLOW_URL') . $data['urlExtention'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_POST => true,
              CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
              CURLOPT_POSTFIELDS => $data['postData'],
              CURLOPT_HTTPHEADER => array(
                    env('CASHFLOW_AUTHORIZATION'),
                    "cache-control: no-cache",
                    "content-type: multipart/form-data",
                    env('CASHFLOW_TENANT')
                  ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
              $response = "cURL Error #:" . $err;
              return $response;
            } else {
              return $response;
            }
  }

}
