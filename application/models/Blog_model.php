<?php
class Blog_model extends CI_Model{
	public function __construct() {
      parent::__construct();
      $this->load->model('FuncDB_model');
      $this->dbd = $this->FuncDB_model;
  }

  public function getDataBlog($nStart,$nLength,$cDraw,$cSearch)
  {
      $vaData = [];
      $vaArr  = [];
      $cField = "b.ID, b.Judul, b.Image, b.DateTime, k.Keterangan as Kategori";
      $cWhere = "b.Judul like '%".$cSearch['value']."%'
                OR Kategori like '%".$cSearch['value']."%'";
      $cJoin  = "left join tbl_kategori k on k.Kode=b.Kategori";
      $cOrder = "b.DateTime DESC";
      $nLimit = "$nStart,$nLength";

      $dbDataRow = $this->dbd->select("tbl_blog b",$cField,$cWhere,$cJoin);
      $dbData    = $this->dbd->select("tbl_blog b",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
      while($dbRow = $this->dbd->getrow($dbData)){
          $vaArr[] = $dbRow;
      }
      $vaData['row']  = $this->dbd->rows($dbDataRow);
      $vaData['data'] = $vaArr;

      return $vaData;
  }

  function getDataBlogHome(){
    $vaArray = [];
    $cField = "tbl_blog.*";
    $dbData = $this->dbd->select("tbl_blog",$cField);
    while($dbRow = $this->dbd->getrow($dbData)){
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

  public function getDetailBlogBySlug($cSlug)
  {
    $dbRow  = [];
    $dbData = $this->dbd->select("tbl_blog", "*", "Slug='$cSlug'");
    $dbRow  = $this->dbd->getrow($dbData);
    $dbRow['KeteranganKategori'] = $this->getKeteranganKategori($dbRow['Kategori']);
    return $dbRow;
  }

  public function save($cJudul,$cSlug,$cDeskripsi,$optKategori,$cGambar='',$nID=0){
    $vaUpd = array("Judul"=>$cJudul,
            "Slug"=>$cSlug,
            "Deskripsi"=>$cDeskripsi,
            "Kategori"=>$optKategori,
            "DateTime"=>date_now());
    $cWhere = "ID='$nID'";
    if($nID == 0) {
      $vaUpd['Image'] = $cGambar;
      $this->dbd->insert("tbl_blog",$vaUpd);
    }else{
      $this->dbd->update("tbl_blog",$vaUpd,$cWhere,"ID");
    }

    if($cGambar <> "" && $nID <> 0){
      $this->saveImage($cGambar,$nID);
    }

  }

	public function saveImage($cGambar,$nID)
	{
    $cWhere = "ID='$nID'";
    $vaUpd = array("Image"=>$cGambar);
    $this->dbd->edit("tbl_blog",$vaUpd,$cWhere);
  }

  public function getAllKategoriBlog()
  {
      $vaData = [];
      $dbData = $this->dbd->select("tbl_kategori","*");
      while($dbRow  = $this->dbd->getrow($dbData)){
          $vaData[] = $dbRow;
      }
      return $vaData;
  }

  function delete($nID){
		$dbd = $this->dbd->delete("tbl_blog","ID='$nID'");
		return $dbd;
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

	function getCountDataBlog($cKategori=""){
    $cField = "tbl_blog.*";
    $cWhere = ($cKategori <> "") ? "Kategori = '$cKategori' " : "";
		$dbData = $this->dbd->select("tbl_blog",$cField,$cWhere);
		$nCount = $this->dbd->rows($dbData);

		return $nCount;
	}

	function getDataBlogPagination($limit_start, $limit,$cKategori=""){
		$vaArray = [];
    $cField = "tbl_blog.*";
    $cWhere = ($cKategori <> "") ? "Kategori = '$cKategori' " : "";
		$cOrder = "ID";
		$nLimit = "$limit_start, $limit";
		$dbData = $this->dbd->select("tbl_blog",$cField,$cWhere,"","",$cOrder,$nLimit);
		while($dbRow = $this->dbd->getrow($dbData)){
			$vaArray[] = $dbRow;
		}
		return $vaArray;
	}
}
