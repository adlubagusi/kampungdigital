<?php
class Business_model extends CI_Model{
	 public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

		function getDataBidangUsaha(){
  		$vaArray = [];
  		$cField = "tbl_bidang_usaha.*";
  		$dbData = $this->dbd->select("tbl_bidang_usaha",$cField);
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
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

		public function getJenisBidangUsaha($cKode)
    {
        $vaArr  = [];
        $dbData = $this->dbd->select("tbl_jenis_usaha", "*", "Kode='$cKode'");
        while($dbRow  = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        return $vaArr;
    }

		public function getDetailBidangUsaha($cKode){
        $dbRow  = [];
        $dbData = $this->dbd->select("tbl_bidang_usaha", "*", "Kode='$cKode'");
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

		public function sendMail($va)
		{
				$cBidangUsahaId    = $va['cBidangUsahaId'];
				$cNama    = $va['cName'];
				$cEmail   = $va['cEmail'];
				$cMessage = $va['cMessage'];
				$cStatus = "0";
				$cParent = null;
				$cHost    = $_SERVER['HTTP_HOST'];

				$vaInsert = array("Nama"=>$cNama, "Email"=>$cEmail, "Parent"=>$cParent, "Status"=>$cStatus, "Message"=>$cMessage, "BidangUsahaId"=>$cBidangUsahaId);
				$this->dbd->insert("tbl_komentar_bidang_usaha",$vaInsert);

				// Send Email
				if($cHost <> "localhost"){
						$cMail   = getCfg("msEmail","");
						$vaMail  = explode(";",$cMail);
						foreach($vaMail as $mail){
								$cReceiverEmail = $mail;
								$subjectMail    = $cSubject ." Dari: ".$cNama;
								$headers        = "MIME-Version: 1.0" . "\r\n";
								$headers        .= "Content-type:text/html;charset=UTF-8" . "\r\n";
								$headers        .= 'From: <'.$cEmail.'>' . "\r\n";
								$message = "
										<html>
												<body>
												".$cMessage."
												</body>
										</html>
								";

								//mail($cReceiverEmail,$subjectMail,$message,$headers);
						}
				}
		}
}
?>
