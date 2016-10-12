<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cashflowlibrary {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      }
public function curlOption($urlOption)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "8443",
      CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1" . $urlOption ,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
      CURLOPT_HTTPHEADER => array(
  				"authorization: Basic QVBJQ29uc3VtZXI6RkI3cHZxVzdQTFlncnpxdQ==",
  				"cache-control: no-cache",
  				"content-type: application/json",
  				"x-mifos-platform-tenantid: kenya"
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
              CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1" . $data['urlExtention'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //  CURLOPT_CUSTOMREQUEST => "DELETE",
            //  CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
              CURLOPT_POSTFIELDS => $data['postData'],
              CURLOPT_HTTPHEADER => array(
                "authorization: Basic QVBJQ29uc3VtZXI6RkI3cHZxVzdQTFlncnpxdQ==",
                "cache-control: no-cache",
                "content-type: application/json",
                "x-mifos-platform-tenantid: kenya"
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
              CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1" . $data['urlExtention'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_POST => true,
              CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
              CURLOPT_POSTFIELDS => $data['postData'],
              CURLOPT_HTTPHEADER => array(
                    "authorization: Basic QVBJQ29uc3VtZXI6RkI3cHZxVzdQTFlncnpxdQ==",
                    "cache-control: no-cache",
                    "content-type: multipart/form-data",
                    "x-mifos-platform-tenantid: kenya"
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
