<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rndwiga {
    protected $CI;
    protected $modelOne = 'Login_database';
  public function __construct() {
        $this->CI =& get_instance();
      //  $CI->load->helper('myhelper');
      }

  public function reverifyUser($data)
  {
    /*
      This function is used to automatically logout a user using the difference in stored time
    */
    $this->CI->load->library('session');
      $session_expiry = 60;

      if(time() - $data >= $session_expiry){
    ## time to terminate the session for this user
          $this->CI->session->sess_destroy();
          redirect('/', 'refresh');
      }
  }
  public function dashlets()
  {
    /*
      This function is used to load data on the dashboard widgets.
    */
    $this->CI->load->model($modelOne);
  }
}
