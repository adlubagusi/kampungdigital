<?php
class Socmed_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    public function getDataSocmed($nStart,$nLength,$cDraw,$cSearch)
    {
        $vaData = [];
        $vaArr  = [];
        $cField = "*";
        $cWhere = "b.Kode like '%".$cSearch['value']."%'
                    OR b.Keterangan like '%".$cSearch['value']."%'";
        $cOrder = "b.Kode";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_socmed b",$cField,$cWhere,"");
        $dbData    = $this->dbd->select("tbl_socmed b",$cField,$cWhere,"","",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }

    public function getDetailSocmed($nID)
    {
        $dbRow  = [];
        $cWhere = "ID='$nID' OR Kode='$nID'";
        $dbData = $this->dbd->select("tbl_socmed", "*", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function save($cKode,$cKeterangan,$cIcon,$cLink,$nID){
        $vaUpd = array("Kode"=>$cKode,
                       "Keterangan"=>$cKeterangan,
                       "Icon"=>$cIcon,
                       "Link"=>$cLink,
                    );
        $cWhere = "ID='$nID'";
        if($nID == 0) {
          $this->dbd->insert("tbl_socmed",$vaUpd);
        }else{
          $this->dbd->update("tbl_socmed",$vaUpd,$cWhere,"ID");
        }
    }

    function delete($nID){
		$dbd = $this->dbd->delete("tbl_socmed","ID='$nID'");
		return $dbd;
    }

    public function getLastKode()
    {
        $cOrder   = "Kode DESC";
        $nLimit   = 1;
        $dbData   = $this->dbd->select("tbl_socmed","*","","","",$cOrder,$nLimit);
        $dbRow    = $this->dbd->getrow($dbData);
        $cKode    = intval($dbRow['Kode']) +1;
        $cKodeNew = str_pad($cKode, 4, 0, STR_PAD_LEFT);
        return $cKodeNew;
    }

}