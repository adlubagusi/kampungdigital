<?php
class Pengguna_model extends CI_Model{
	public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model; 
    }
	function getDataPengguna($nStart,$nLength,$cDraw,$cSearch){
		// $vaData = [];
		// $cField = "tbl_pengguna.*,IF(pengguna_jenkel='L','Laki-Laki','Perempuan') AS jenkel";
		// $dbData = $this->dbd->select("tbl_pengguna",$cField);
		// while($dbRow = $this->dbd->getrow($dbData)){
		// 	$vaArray[] = $dbRow;
		// }
		// return $vaArray;
        $vaData = [];
        $vaArr  = [];
		$cField = "pengguna_id ID, pengguna_nama Nama, pengguna_email Email, pengguna_username UserName,
				   pengguna_nohp NoHP, pengguna_level Level, pengguna_photo Foto,
				   pengguna_jenkel AS JK";
        $cWhere = "pengguna_nama like '%".$cSearch['value']."%'
				   OR pengguna_email like '%".$cSearch['value']."%'
                   OR pengguna_username like '%".$cSearch['value']."%'";
        $cJoin  = "";
        $cOrder = "pengguna_register DESC";
        $nLimit = "$nStart,$nLength";
        
        $dbDataRow = $this->dbd->select("tbl_pengguna",$cField,$cWhere,$cJoin);
        $dbData    = $this->dbd->select("tbl_pengguna",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        } 
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;
        
        return $vaData;	
	}
	public function save($cNama,$optJK,$cUserName,$cPassword,$cEmail,$cKontak,$optLevel,$cDivisi='',$lTampil=false,$cGambar,$nID=0)
	{
		$cTampil = ($lTampil) ? 'Y' : 'T';
		$vaUpd = array("pengguna_nama"=>$cNama,
					   "pengguna_jenkel"=>$optJK,
					   "pengguna_username"=>$cUserName,
					   "pengguna_email"=>$cEmail,
					   "pengguna_nohp"=>$cKontak,
					   "pengguna_level"=>$optLevel,
					   "pengguna_divisi"=>$cDivisi,
					   "pengguna_tampilhome"=>$cTampil);
		$cWhere = "pengguna_id='$nID'";
		if($nID == 0) {
			$this->dbd->insert("tbl_pengguna",$vaUpd); 
		}else{
			$this->dbd->update("tbl_pengguna",$vaUpd,$cWhere,"pengguna_id");
		}
		
		if($cPassword <> ""){
			$this->updatePassword($cUserName,$cPassword);	
		}

		if($cGambar <> ""){
			$this->saveImage($cGambar,$cUserName);
		}
	}

	public function updatePassword($cUserName,$cPassword)
	{
		$cWhere = "pengguna_username='$cUserName'";
		$vaUpd = array("pengguna_password"=>md5($cPassword));
		$this->dbd->edit("tbl_pengguna",$vaUpd,$cWhere);
	}

	public function saveImage($cGambar,$cUserName)
	{
		$cWhere = "pengguna_username='$cUserName'";
		$vaUpd = array("pengguna_photo"=>$cGambar);
		$this->dbd->edit("tbl_pengguna",$vaUpd,$cWhere);
	}
	// function simpan_pengguna($nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar){
	// 	$hsl=$this->db->query("INSERT INTO tbl_pengguna (pengguna_nama,pengguna_jenkel,pengguna_username,pengguna_password,pengguna_email,pengguna_nohp,pengguna_level,pengguna_photo) VALUES ('$nama','$jenkel','$username',md5('$password'),'$email','$nohp','$level','$gambar')");
	// 	return $hsl;
	// }

	// function simpan_pengguna_tanpa_gambar($nama,$jenkel,$username,$password,$email,$nohp,$level){
	// 	$hsl=$this->db->query("INSERT INTO tbl_pengguna (pengguna_nama,pengguna_jenkel,pengguna_username,pengguna_password,pengguna_email,pengguna_nohp,pengguna_level) VALUES ('$nama','$jenkel','$username',md5('$password'),'$email','$nohp','$level')");
	// 	return $hsl;
	// }

	// //UPDATE PENGGUNA //
	// function update_pengguna_tanpa_pass($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar){
	// 	$hsl=$this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_email='$email',pengguna_nohp='$nohp',pengguna_level='$level',pengguna_photo='$gambar' where pengguna_id='$kode'");
	// 	return $hsl;
	// }
	// function update_pengguna($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level,$gambar){
	// 	$hsl=$this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_password='$password',pengguna_email='$email',pengguna_nohp='$nohp',pengguna_level='$level',pengguna_photo='$gambar' where pengguna_id='$kode'");
	// 	return $hsl;
	// }

	// function update_pengguna_tanpa_pass_dan_gambar($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level){
	// 	$hsl=$this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_email='$email',pengguna_nohp='$nohp',pengguna_level='$level' where pengguna_id='$kode'");
	// 	return $hsl;
	// }
	// function update_pengguna_tanpa_gambar($kode,$nama,$jenkel,$username,$password,$email,$nohp,$level){
	// 	$hsl=$this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_password='$password',pengguna_email='$email',pengguna_nohp='$nohp',pengguna_level='$level' where pengguna_id='$kode'");
	// 	return $hsl;
	// }
	// //END UPDATE PENGGUNA//

	function delete($nID){
		$dbd = $this->dbd->delete("tbl_pengguna","pengguna_id='$nID'");
		return $dbd;
	}
	function getDetailPengguna($nID){
		$dbRow  = [];
		$dbData = $this->dbd->select("tbl_pengguna", "*", "pengguna_id='$nID'");
		$dbRow  = $this->dbd->getrow($dbData);
		return $dbRow;
	}
	// function resetpass($id,$pass){
	// 	$hsl=$this->db->query("UPDATE tbl_pengguna set pengguna_password=md5('$pass') where pengguna_id='$id'");
	// 	return $hsl;
	// }

	function getPenggunaLogin($nID){
		$dbRow  = [];
		$dbData = $this->dbd->select("tbl_pengguna", "*", "pengguna_id='$nID'");
		$dbRow  = $this->dbd->getrow($dbData);
		return $dbRow;
	}


}