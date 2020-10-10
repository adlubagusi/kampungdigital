<?php
class Login_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model; 
    }
    public function cekadmin($u,$p){
        $vaArray = [];
        $cField = "*";
        $cWhere = "pengguna_username='$u' AND pengguna_password='$p'";
        $dbData = $this->dbd->select("tbl_pengguna",$cField,$cWhere,'','','');
        if($dbRow = $this->dbd->getrow($dbData)){
            $vaArray = $dbRow;
        }
        return $vaArray;
    }
}