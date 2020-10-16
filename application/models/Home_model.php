<?php if ( ! defined('BASEPATH')) exit('No direct script access
allowed');
class Home_model extends CI_Model{
	 public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    function getDataPortofolio(){
  		$vaArray = [];
  		$cField = "tbl_portfolio.*";
  		$dbData = $this->dbd->select("tbl_portfolio",$cField);
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
  	}

		function getDataBlog(){
  		$vaArray = [];
  		$cField = "tbl_blog.*";
  		$dbData = $this->dbd->select("tbl_blog",$cField);
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
  	}

		function getCountDatatBlog(){
			$cField = "tbl_blog.*";
			$dbData = $this->dbd->select("tbl_blog",$cField);
			$dbCount = $dbData->num_rows();

			return $dbCount;
		}

}
?>
