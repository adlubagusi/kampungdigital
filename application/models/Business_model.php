<?php
class Business_model extends CI_Model{
	 public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

		function getDataBidangUsaha(){
  		$vaArray = [];
  		$cField = "tbl_bidang_usaha.*";
  		$dbData = $this->dbd->select("tbl_bidang_usaha",$cField);
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
  	}

		public function getFileBidangUsaha($cKode)
    {
        $vaArr  = [];
        $dbData = $this->dbd->select("tbl_bidang_usaha_file", "*", "Kode='$cKode'");
        while($dbRow  = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        return $vaArr;
    }

		public function getJenisBidangUsaha($cKode)
    {
        $vaArr  = [];
        $dbData = $this->dbd->select("tbl_jenis_usaha", "*", "Kode='$cKode'");
        while($dbRow  = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        return $vaArr;
    }

		public function getDetailBidangUsaha($cKode){
        $dbRow  = [];
        $dbData = $this->dbd->select("tbl_bidang_usaha", "*", "Kode='$cKode'");
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }


}
?>
