<?php
class About_model extends CI_Model{
	 public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    function getDataPengguna(){
  		$vaArray = [];
  		$cField = "tbl_pengguna.*";
  		$dbData = $this->dbd->select("tbl_pengguna",$cField, "pengguna_tampilhome = 'Y'");
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
  	}

	public function getDataStruktur($nStart,$nLength,$cDraw,$cSearch)
	{
		$vaData = [];
        $vaArr  = [];
        $cField = "s.ID, s.UserName, s.Jabatan, p.pengguna_nama Nama, p.pengguna_photo as Foto";
        $cWhere = "s.Jabatan like '%".$cSearch['value']."%'
                    OR s.UserName like '%".$cSearch['value']."%'";
        $cJoin  = "left join tbl_pengguna p on p.pengguna_username=s.UserName";
        $cOrder = "s.Jabatan DESC";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_struktur_organisasi s",$cField,$cWhere,$cJoin);
        $dbData    = $this->dbd->select("tbl_struktur_organisasi s",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
	}

	public function searchAnggota($cSearch)
	{
		$vaArr = [];
		$cWhere = ($cSearch <> "") ? "pengguna_username LIKE '%$cSearch%'" : "";
		$dbData = $this->dbd->select("tbl_pengguna", "pengguna_username,pengguna_nama", $cWhere);
		while($dbRow = $this->dbd->getrow($dbData)){
			$vaArr[] = array('id'=>$dbRow['pengguna_username'], "text"=>$dbRow['pengguna_nama']);
		}
		return $vaArr;
	}

	public function saveStruktur($cUserName,$cJabatan,$nID)
	{
		$vaUpd = array("UserName"=>$cUserName,
                       "Jabatan"=>$cJabatan);
        $cWhere = "ID='$nID'";
        if($nID == 0) {
          $this->dbd->insert("tbl_struktur_organisasi",$vaUpd);
        }else{
          $this->dbd->update("tbl_struktur_organisasi",$vaUpd,$cWhere,"ID");
        }
	}

	public function getDetailStruktur($nID)
	{
		$dbRow  = [];
		$cField = "s.*, p.pengguna_nama as Nama";
		$cWhere = "s.ID='$nID'";
		$cJoin  = "left join tbl_pengguna p on p.pengguna_username=s.UserName";
        $dbData = $this->dbd->select("tbl_struktur_organisasi s", $cField, $cWhere,$cJoin);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
	}

	function deleteStrukturAnggota($nID){
		$dbd = $this->dbd->delete("tbl_struktur_organisasi","ID='$nID'");
		return $dbd;
    }
}
?>
