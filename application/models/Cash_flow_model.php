<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_flow_model extends CI_Model {

        public $loanDetailsTable = 'loan_details';
        public $accessTable = 'systemAccess';
        public $webhookTable = 'post_notification';
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
  function webHookRecord($data)
        {
        	$this->db->insert( $this->webhookTable, $data);
          $insert_id = $this->db->insert_id();
        //	return true;
        	return $insert_id;
        }
  function updateWebHookRecord($data)
        {
          $this->db->set('processed', 1);
          $this->db->where('id', $data);
        	$this->db->update( $this->webhookTable);
        //	return true;
        	return true;
        }

		function save_file($savedFilePath)
		{
			/*
				This function is to be used in saving the path of generated file to db.
			*/
			$loanId = '000158498';
			$data = array (
				'file_path' => $savedFilePath,
				'loan_id' => $loanId ,
				'time_created' => date('Y-m-d H:i:s')
			);
			$this->db->insert( $this->loanDetailsTable, $data);
		}
    function accessKey($data = NULL, $update = NULL)
    {
      /*
          This function stores the authorization key and headers to the db, and fetches the same data for use
      */
          if(isset($data) && !isset($update))
          {
            $this->db->insert ($this->accessTable, $data);
              if ($this->db->affected_rows() == 1) {
                        $this->db->from($this->accessTable);
                        $query = $this->db->get();
                          return $query->result_array();
                      //    return $query->result();
              }
          }elseif (isset($data) && isset($update)) {
            $this->db->replace($this->accessTable, $data);
                $this->db->from($this->accessTable);
                  $query = $this->db->get();
                      return $query->result_array();
          }
          else {
              $this->db->from($this->accessTable);
              $query = $this->db->get();
                return $query->result_array();
              //  return $query->result();
          }


    }

}
