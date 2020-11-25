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

		function getCountDataBlog(){
			$cField = "tbl_blog.*";
			$dbData = $this->dbd->select("tbl_blog",$cField);
			$nCount = $this->dbd->rows($dbData);

			return $nCount;
		}

		function getDataBlogPagination($limit_start, $limit){
			$vaArray = [];
			$cField = "tbl_blog.*";
			$cOrder = "ID";
			$nLimit = "$limit_start, $limit";
			$dbData = $this->dbd->select("tbl_blog",$cField,"","","",$cOrder,$nLimit);
			while($dbRow = $this->dbd->getrow($dbData)){
				$dbRow['KeteranganKategori'] = $this->getKeteranganKategori($dbRow['Kategori']);
				$vaArray[] = $dbRow;
			}
			return $vaArray;
		}

		function getDetailBlog($nID){
	    $dbRow  = [];
	    $dbData = $this->dbd->select("tbl_blog", "*", "ID='$nID'");
	    $dbRow  = $this->dbd->getrow($dbData);
	    $dbRow['KeteranganKategori'] = $this->getKeteranganKategori($dbRow['Kategori']);
	    return $dbRow;
	  }

		public function getKeteranganKategori($cKode)
	  {
	    $cKeterangan  = "";
	    $dbData = $this->dbd->select("tbl_kategori", "*", "Kode='$cKode'");
	    if($dbRow  = $this->dbd->getrow($dbData)){
	      $cKeterangan = $dbRow['Keterangan'];
	    }
	    return $cKeterangan;
		}

}
?>
