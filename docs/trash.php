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

  #  Sandbox account
    joe.zombimann-facilitator@gmail.com
    #Client ID
    AZSJlY5KennACrFW-XCc9sPoDWkROsSklfSKGOxIcsGb8Y-3ftfDBCDgaNmGB18CEfrAp9qOFcV-Go2w
  #  Secret
    EJqsg4KdBl7SZhG7aUE5TmqB4lE9LwajJ3NI-rnItxhJ0hL5t1lr8273iL-l9GXnu8pj-qHs5tZwJqdq

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
/*
We are going to create a function called request_cache to handle caching.
Our function will need to be able to make a request as well as read and write to a file.
In order to perform these functions, three pieces of information will be passed as arguments to request_cache:
the URI for the request, the name of the cache file, and the maximum lifetime of the cache file.
The return value of request_cache will be a string; the parsing of the response will be done later,
thus allowing the data to be in different formats (JSON, serialized PHP, XML).
When using a cache for any application, the first task is to determine whether there is an existent cache or if it is "stale" (expired).
If a "fresh" cache exists, request_cache simply returns the data stored in the cache file. Otherwise, request_cache has to make a request,
cache the response, and finally return the response data. Notice that the actual request is handled by the helper function make_request,
which like the function curl_exec returns a response or a Boolean value of false if the request fails.
The statement rename($tmpf, $dest_file) prevents the previous cache file from being deleted until other processes finish reading and closing
 the file. So, no process will be cutoff or otherwise damaged by the rename.
*/
  // $url is the URI for request, $dest_file is the name of cache file
  // $timeout is the expiration time for cache file
  function request_cache($url, $dest_file, $timeout=7200) {

     // Make request if cache file does not exist or if it's stale
     if(!file_exists($dest_file) || filemtime($dest_file) < (time()-$timeout)) {
        $data = make_request($url);
        // Return false if request was unsuccessful and
        // allow main program to handle failed request
        if($data === false) return false;
        // Create temp file and write response data to it, close file
        $tmpf = tempnam('/tmp','YWS');
        $fp = fopen($tmpf,"w");
        fwrite($fp, $data);
        fclose($fp);
        // Rename temp temp file to cache file name
        rename($tmpf, $dest_file);
     } else {
          // Cache exists and is not stale => return contents of cache file
  return file_get_contents($dest_file);
     }
     // Return response data
     return($data);
  }
  /*
  The function make_request reuses code we wrote earlier in the tutorial.
  The same code to make the request and remove the HTTP header from the response is repeated,
  but the task of checking the HTTP status code is delegated to the function status_code_check.
  In effect, we have modularized the tasks of making the request and checking the HTTP status codes with separate functions.
  In turn, make_request handles the job of checking HTTP status codes to the function status_code_check.
  */
  // Uses curl to make Web services request
  // Returns XML from response or false
  function make_request($request) {

      // Initialize curl request
      $session = curl_init($request);

      // Set curl options: return header and data
      curl_setopt($session, CURLOPT_HEADER, true);
      curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

      // Make the request
      $response = curl_exec($session);
      // Request never transmitted to Web service: return false
      if(!$response) return false;
      // Close the curl session
      curl_close($session);
      // Confirm that HTTP header was 200
      if(status_code_check($response)){
          // Get the XML from the response, bypassing the header
          $xml = strstr($response, '<?xml');
          return $xml;
      }
  }
/*
The function status_code_check returns a Boolean value or exits and displays an error message.
*/
  // Examines Web service response for header codes
function status_code_check($response)
{
    // Get HTTP Status code from the response
    $status_code = array();
    $ok_code = false;
    // Parse first line of header for header code
    preg_match('/\d\d\d/', $response, $status_code);
    // Check the HTTP Status code
    switch( $status_code[0] ) {
        case 200:
            // Success
            $ok_code = true;
            break;
        case 503:
            die('The call to Musoni Services failed and returned 503 error -Servie unavailable-. Hence cant return the data.');
            break;
        case 403:
            die( 'The call to Musoni Services failed and returned 403 error -Forbidden-. Meaning the plugin does not have permission to access
            the resource or are over the rate limit.');
            break;
        case 400:
            // fetch the specific XML error
            die('The call to Musoni Services failed and returned 400 error -Bad request-. The parameters passed to the service did not match
                as expected.The exact error is returned in the XML response.');
                break;
            default:
                die('The call to Musoni Services failed and returned an unexpected HTTP status of:' .        $status_code[0]);
    }
    return $ok_code;
}
/*
This is the main program, we assign the needed information for caching to variables, which are then passed to request_cache.
The return value for request_cache is then assigned to the variable $data, which is later parsed
*/
// Assign query term and request URI to variables
$query = "water bear";
$request =  "http://search.yahooapis.com/ImageSearchService/V1/imageSearch?appid=$appID&query=".urlencode($query).
'&results=5';

// Create cache file name, full path of cache, and define duration of valid cache data
$cache_filename = 'water_bears'. time();
$cache_fullpath = CACHEDIR.$cache_filename;
$cache_timeout = 7200;

// Cache function determines whether the return response data from
// cache file or to make another request
$data = request_cache($request,$cache_fullpath,$cache_timeout);






}
