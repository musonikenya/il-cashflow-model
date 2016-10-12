<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  =======================================
 *  Author     : Raphael Ndwiga
 *  License    : Protected
 *  Email      : raphndwi@gmail.com
 *
 *  =======================================
 */
require_once APPPATH."/third_party/phpexcel/PHPExcel.php";

class Excel extends PHPExcel
{
    public function __construct()
    {
        parent::__construct();
    }
    
}
?>
