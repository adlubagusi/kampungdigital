<?php
class Download_model extends CI_Model{
	public function __construct() {
      parent::__construct();
      $this->load->model('FuncDB_model');
      $this->dbd = $this->FuncDB_model;
    }

    public function getDataDownload($nStart,$nLength,$cDraw,$cSearch)
    {
        $vaData = [];
        $vaArr  = [];
        $cField = "d.ID, d.Judul, d.Kode, d.File, d.DateTime, d.UserName";
        $cWhere = "d.Judul like '%".$cSearch['value']."%'
                    OR d.File like '%".$cSearch['value']."%'
                    OR d.UserName like '%".$cSearch['value']."%'";
        $cJoin  = "";
        $cOrder = "d.DateTime DESC";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_download d",$cField,$cWhere,$cJoin);
        $dbData    = $this->dbd->select("tbl_download d",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }

    public function getDetailDownload($cKode){
        $dbRow  = [];
        $dbData = $this->dbd->select("tbl_download", "*", "Kode='$cKode'");
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }


    public function save($cKode,$cJudul,$cFile="",$cUserName){
        $vaUpd = array("Kode"=>$cKode,
                        "Judul"=>$cJudul,
                        "UserName"=>$cUserName,
                        "DateTime"=>date_now());
        $cWhere = "Kode='$cKode'";
        $this->dbd->update("tbl_download",$vaUpd,$cWhere,"ID");
        if(!empty($cFile)){
            $this->saveFile($cKode,$cFile);
        }
    }

    public function saveFile($cKode,$cFile)
    {
        $vaUpd = array("File"=>$cFile,
                        "DateTime"=>date_now());
        $cWhere = "Kode='$cKode'";
        $this->dbd->update("tbl_download",$vaUpd,$cWhere,"ID");
        
    }

    public function delete($cKode){
		$dbd = $this->dbd->delete("tbl_download","Kode='$cKode'");
    }

    public function getKode()
    {
        $dYM        = date('Ymd') ;
        $cKey  		= "SD-" . $dYM;
        $n    		= $this->dbd->getincrement($cKey,true,3);
        $cKode    	= $cKey . "." . $n ;
        return $cKode ;
    }
}
