<?php
  /**
   *
   */
  class CashClass
  {

    function __construct()
    {
      # code...
    }
    public function displayPage(){

      phpinfo();
    }
    public function accessApi(){


                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_PORT => "8443",
                  CURLOPT_URL => "https://demo.musonisystem.com:8443/api/v1/authentication?username=APIConsumer&password=FB7pvqW7PLYgrzqu",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "",
                  CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: multipart/form-data; boundary=---011000010111000001101001",
                    "postman-token: bdffadce-8331-0a8b-290f-7e3d63a0420e",
                    "x-mifos-platform-tenantid: kenya"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                  echo "cURL Error #:" . $err;
                } else {
                  echo $response;
                }
        }
}



?>
