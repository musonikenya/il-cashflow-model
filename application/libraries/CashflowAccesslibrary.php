<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cashflowlibrary {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      //  $CI->load->helper('myhelper');
      }

  public function apiHeaders()
  {
    /*
      This function provides the api headers
    */
    $authorizationHeaders = array(
				"authorization: Basic QVBJQ29uc3VtZXI6RkI3cHZxVzdQTFlncnpxdQ==",
				"cache-control: no-cache",
				"content-type: application/json",
				"x-mifos-platform-tenantid: kenya"
			);
      return $authorizationHeaders;
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
                CURLOPT_SSL_VERIFYPEER => false, //turn this off when going live
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
              //	echo $response;
                $obj = json_decode($response, true);
                /*
                  Saving key to the db
                */
                    $data = array(
                      'Authorization' => 'Basic ' . $obj['base64EncodedAuthenticationKey'],
                      'X-Mifos-Platform-TenantId' => 'kenya',
                      'Content-Type' => 'application/json'
                      );
                      /*
                          checking if the authorization key exists in db
                      */
                          $checkAuthoriazation =	$this->CashFlow->accessKey();
                                if ($checkAuthoriazation) {
                                        foreach ($checkAuthoriazation as $row)
                                                {
                                                    //	$key = $row->Authorization; //get the authorization key from the object
                                                      $key = $row['Authorization']; //get the authorization key from the object
                                                    //	$id = $row->id;
                                                }
                                                    if(strcmp($key,$obj['base64EncodedAuthenticationKey']) == 0)
                                                      { //if the key in db is same as the one retrieved run
                                                        $accessArray =	$this->CashFlow->accessKey();
                                                            //	echo "string";
                                                            //	exit;
                                                              return $accessArray;
                                                      } else {
                                                          $update = 'update';  //replace data stored if it does not exist
                                                        //	echo $update;
                                                                $accessArray =	$this->CashFlow->accessKey($data, $update);
                                                              //	print_r($accessArray);
                                                            //	echo "string";
                                                            //	print_r($accessArray);
                                                            //	exit;
                                                        //		echo "funky";
                                                          //	exit;
                                                                return $accessArray;
                                                      }
                                } else {
                                  $accessArray =	$this->CashFlow->accessKey($data);
                                        //	print_r($accessArray);
                                          return $accessArray;
                                }
              }
  }

}
