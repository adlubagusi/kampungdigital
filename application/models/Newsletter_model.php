<?php
class Newsletter_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    public function getDataNewsletter($nStart,$nLength,$cDraw,$cSearch)
    {
        /*  Status news letter :
            0= Berhenti subscribe (non-aktif), 
            1= Subscribe (aktif), 
        */
        $vaData = [];
        $vaArr  = [];
        $cField = "*";
        $cWhere = "n.Email like '%".$cSearch['value']."%'";
        $cOrder = "n.Email";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_newsletter n",$cField,$cWhere,"");
        $dbData    = $this->dbd->select("tbl_newsletter n",$cField,$cWhere,"","",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }

    public function getDetailNewsletter($nID)
    {
        $dbRow  = [];
        $cWhere = "ID='$nID' OR Email='$nID'";
        $dbData = $this->dbd->select("tbl_newsletter", "*", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function save($cEmail,$cStatus,$nID=0){
        $vaUpd = array("Email"=>$cEmail,
                       "Status"=>$cStatus);
        $cWhere = "ID='$nID'";
        if($nID == 0) {
          $this->dbd->insert("tbl_newsletter",$vaUpd);
        }else{
          $this->dbd->update("tbl_newsletter",$vaUpd,$cWhere,"ID");
        }
    }

    public function delete($nID){
        $this->updateStatusNewsletter($nID,"0");
        return $dbd;
    }

    public function updateStatusNewsletter($nID,$nStatus="1")
    {
        $vaUpd  = array('Status' => $nStatus);
        $cWhere = "ID='$nID'"; 
        $this->dbd->update("tbl_newsletter",$vaUpd,$cWhere,"ID");
        return 1;
    }
    
    public function getDataAllNewsletter($cStatus="0")
    {
        $cWhere = "Status='$cStatus'";
        $vaData = [];
        $dbData = $this->dbd->select("tbl_newsletter","*",$cWhere);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaData[$dbRow['ID']] = $dbRow;
        }
        return $vaData;
    }
}