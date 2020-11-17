<?php
class BidangUsaha_model extends CI_Model{
	public function __construct() {
      parent::__construct();
      $this->load->model('FuncDB_model');
      $this->dbd = $this->FuncDB_model;
  }

    public function getDataBidangUsaha($nStart,$nLength,$cDraw,$cSearch)
    {
        $vaData = [];
        $vaArr  = [];
        $cField = "b.ID, b.Kode, b.NamaOwner, b.NamaUsaha, b.AlamatUsaha, b.HP, b.Deskripsi, b.JenisUsaha, 
                   b.DateTime, j.Keterangan as KeteranganJenisUsaha, b.Foto, b.Slug";
        $cWhere = "b.NamaOwner like '%".$cSearch['value']."%'
                    OR j.Keterangan like '%".$cSearch['value']."%'";
        $cJoin  = "left join tbl_jenis_usaha j on j.Kode=b.JenisUsaha";
        $cOrder = "b.DateTime DESC";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_bidang_usaha b",$cField,$cWhere,$cJoin);
        $dbData    = $this->dbd->select("tbl_bidang_usaha b",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }

    function getDetailBidangUsaha($cKode){
        $dbRow  = [];
        $dbData = $this->dbd->select("tbl_bidang_usaha", "*", "Kode='$cKode'");
        $dbRow  = $this->dbd->getrow($dbData);
        if(!empty($dbRow)) $dbRow['KeteranganJenisUsaha'] = $this->getKeteranganKategori($dbRow['JenisUsaha']);
        return $dbRow;
    }

    public function save($cKode,$cNamaOwner,$cNamaUsaha,$cAlamatUsaha,$cHP,$cDeskripsi,$cJenisUsaha,$cUserName,$cFoto,$cSlug){
        $vaUpd = array("Kode"=>$cKode,
                        "NamaOwner"=>$cNamaOwner,
                        "NamaUsaha"=>$cNamaUsaha,
                        "AlamatUsaha"=>$cAlamatUsaha,
                        "HP"=>$cHP,
                        "Deskripsi"=>$cDeskripsi,
                        "JenisUsaha"=>$cJenisUsaha,
                        "UserName"=>$cUserName,
                        "Slug"=>$cSlug,
                        "DateTime"=>Now());
        $cWhere = "Kode='$cKode'";
        $this->dbd->update("tbl_bidang_usaha",$vaUpd,$cWhere,"ID");
        if($cFoto <> ""){
            $this->saveFoto($cFoto,$cKode);
        }
    }

    public function saveFoto($cFoto,$cKode)
	{
        $cWhere = "Kode='$cKode'";
        $vaUpd = array("Foto"=>$cFoto);
        $this->dbd->edit("tbl_bidang_usaha",$vaUpd,$cWhere);
    }

	public function saveFile($va)
    {
        $cKode          = $va['cKode'] ;
        $cUserName      = getsession('username') ;
        $vaData = array("Kode"=>$cKode, 
                        "FilePath"=>$va['FilePath'],
                        "UserName"=>$cUserName ,
                        "DateTime"=>Now()
        ) ;
        $this->dbd->insert("tbl_bidang_usaha_file", $vaData) ;
    }


    public function delete($cKode){
		$dbd = $this->dbd->delete("tbl_bidang_usaha","Kode='$cKode'");
		$dbd = $this->dbd->delete("tbl_bidang_usaha_file","Kode='$cKode'");
    }

    public function deleteFilePerID($cID)
    {
        $cWhere = "ID='$cID'";
        $this->dbd->delete('tbl_bidang_usaha_file',$cWhere);
    }

    public function getKeteranganKategori($cKode)
    {
        $cKeterangan  = "";
        $dbData = $this->dbd->select("tbl_jenis_usaha", "*", "Kode='$cKode'");
        if($dbRow  = $this->dbd->getrow($dbData)){
            $cKeterangan = $dbRow['Keterangan'];
        }
        return $cKeterangan;
    }
    
    public function getAllJenisUsaha()
    {
        $vaData = [];
        $dbData = $this->dbd->select("tbl_jenis_usaha","*");
        while($dbRow  = $this->dbd->getrow($dbData)){
            $vaData[] = $dbRow;
        }
        return $vaData;
    }

    public function getKode()
    {
        $dYM        = date('Ymd') ;
        $cKey  		= "BU-" . $dYM;
        $n    		= $this->dbd->getincrement($cKey,true,3);
        $cKode    	= $cKey . "." . $n ;
        return $cKode ;
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
}
