<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_flow_model extends CI_Model {

        public $table = 'loan_details';

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
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
			$this->db->insert( $this->table, $data);
		}
		
}