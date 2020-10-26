<?php
class Kategori_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    public function getDataKategori($nStart,$nLength,$cDraw,$cSearch)
    {
        $vaData = [];
        $vaArr  = [];
        $cField = "*";
        $cWhere = "b.Kode like '%".$cSearch['value']."%'
                    OR b.Keterangan like '%".$cSearch['value']."%'";
        $cOrder = "b.Kode";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_kategori b",$cField,$cWhere,"");
        $dbData    = $this->dbd->select("tbl_kategori b",$cField,$cWhere,"","",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }

    public function getDetailKategori($nID)
    {
        $dbRow  = [];
        $cWhere = "ID='$nID' OR Kode='$nID'";
        $dbData = $this->dbd->select("tbl_kategori", "*", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function save($cKode,$cKeterangan,$nID=0){
        $vaUpd = array("Kode"=>$cKode,
                       "Keterangan"=>$cKeterangan);
        $cWhere = "ID='$nID'";
        if($nID == 0) {
          $this->dbd->insert("tbl_kategori",$vaUpd);
        }else{
          $this->dbd->update("tbl_kategori",$vaUpd,$cWhere,"ID");
        }
    }

    public function getLastKode()
    {
        $cOrder   = "Kode DESC";
        $nLimit   = 1;
        $dbData   = $this->dbd->select("tbl_kategori","*","","","",$cOrder,$nLimit);
        $dbRow    = $this->dbd->getrow($dbData);
        $cKode    = intval($dbRow['Kode']) +1;
        $cKodeNew = str_pad($cKode, 4, 0, STR_PAD_LEFT);
        return $cKodeNew;
    }

    function delete($nID){
		$dbd = $this->dbd->delete("tbl_kategori","ID='$nID'");
		return $dbd;
    }
    
    public function countAllKategori()
    {
        $vaArr  = [];
        $cField = "b.Kategori as Kode, k.Keterangan, COUNT(k.id) as Jml";
        $cJoin  = "left join tbl_kategori k on k.Kode = b.Kategori";
        $cGroup = "b.Kategori";
        $dbData = $this->dbd->select("tbl_blog b",$cField,"",$cJoin,$cGroup);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        return $vaArr;
    }
}