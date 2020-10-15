<?php
class SuratMasuk_model extends CI_Model{
	public function __construct() {
      parent::__construct();
      $this->load->model('FuncDB_model');
      $this->dbd = $this->FuncDB_model;
    }

    public function getDataSuratMasuk($nStart,$nLength,$cDraw,$cSearch)
    {
        $vaData = [];
        $vaArr  = [];
        $cField = "b.ID, b.Perihal, b.Kode, b.NoSurat, b.Tgl, b.Dari, b.UserName";
        $cWhere = "b.Perihal like '%".$cSearch['value']."%'
                    OR b.Deskripsi like '%".$cSearch['value']."%'
                    OR b.NoSurat like '%".$cSearch['value']."%'
                    OR b.Kode like '%".$cSearch['value']."%'";
        $cJoin  = "";
        $cOrder = "b.DateTime DESC";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_surat_masuk b",$cField,$cWhere,$cJoin);
        $dbData    = $this->dbd->select("tbl_surat_masuk b",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }

    public function getDetailSuratMasuk($cKode){
        $dbRow  = [];
        $dbData = $this->dbd->select("tbl_surat_masuk", "*", "Kode='$cKode'");
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function getFileSuratMasuk($cKode)
    {
        $vaArr  = [];
        $dbData = $this->dbd->select("tbl_surat_masuk_file", "*", "Kode='$cKode'");
        while($dbRow  = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        return $vaArr;
    }

    public function save($cKode,$dTgl,$cNoSurat,$cDari,$cPerihal,$cDeskripsi,$cUserName){
        $vaUpd = array("Kode"=>$cKode,
                        "Tgl"=>$dTgl,
                        "NoSurat"=>$cNoSurat,
                        "Dari"=>$cDari,
                        "Perihal"=>$cPerihal,
                        "Deskripsi"=>$cDeskripsi,
                        "UserName"=>$cUserName,
                        "DateTime"=>date('Y-m-d h:i:s'));
        $cWhere = "Kode='$cKode'";
        $this->dbd->update("tbl_surat_masuk",$vaUpd,$cWhere,"ID");
    }

	public function saveFile($va)
    {
        $cKode          = $va['cKode'] ;
        $cUserName      = getsession('username') ;
        $vaData = array("Kode"=>$cKode, 
                        "FilePath"=>$va['FilePath'],
                        "UserName"=>$cUserName ,
                        "DateTime"=>date('Y-m-d H:i:s')
        ) ;
        $this->dbd->insert("tbl_surat_masuk_file", $vaData) ;
    }

    public function delete($cKode){
		$dbd = $this->dbd->delete("tbl_surat_masuk","Kode='$cKode'");
		$dbd = $this->dbd->delete("tbl_surat_masuk_file","Kode='$cKode'");
    }
    
    public function deleteFile($va)
    {
        $cKode  = $va['cKode'] ;
        $cUserName  = getsession("username");
        $cWhere = "Kode = '$cKode' AND UserName='$cUserName'" ;
        $this->dbd->delete('tbl_surat_masuk_file',$cWhere);
    }

    public function deleteFilePerID($cID)
    {
        $cWhere = "ID='$cID'";
        $this->dbd->delete('tbl_surat_masuk_file',$cWhere);
    }

    public function getKodeSurat()
    {
        $dYM        = date('Ymd') ;
        $cKey  		= "SM-" . $dYM;
        $n    		= $this->dbd->getincrement($cKey,true,3);
        $cKode    	= $cKey . "." . $n ;
        return $cKode ;
    }
}
