<?php
class Letter_model extends CI_Model{
	 public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    function getDataPengguna(){
  		$vaArray = [];
  		$cField = "tbl_pengguna.*";
  		$dbData = $this->dbd->select("tbl_pengguna",$cField, "pengguna_tampilhome = 'Y'");
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
  	}

		function getDataSurat(){
  		$vaArray = [];
  		$cField = "tbl_download.*";
  		$dbData = $this->dbd->select("tbl_download",$cField);
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
  	}

}
?>
