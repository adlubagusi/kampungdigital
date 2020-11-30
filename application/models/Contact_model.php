<?php
class Contact_model extends CI_Model{
	public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    public function getDataInbox($nStart,$nLength,$cDraw,$cSearch)
    {
        /*  Status inbox :
            0=Belum dilihat, 
            1=Telah dilihat, 
            2=Telah dibalas, 
            3=Dihapus
            4=Pesan balasan oleh admin 
        */
        $vaData = [];
        $vaArr  = [];
        $cField = "*";
        $cWhere = "(i.Nama like '%".$cSearch['value']."%'
                    OR i.Email like '%".$cSearch['value']."%'
                    OR i.Subject like '%".$cSearch['value']."%')
                    AND i.Parent=0";
        $cOrder = "i.DateTime DESC";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_inbox i",$cField,$cWhere,"");
        $dbData    = $this->dbd->select("tbl_inbox i",$cField,$cWhere,"","",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }
    public function sendMail($va)
    {
        $cNama    = $va['cNama'];
        $cEmail   = $va['cEmail'];
        $cSubject = $va['cSubject'];
        $cMessage = $va['cMessage'];
        $cHost    = $_SERVER['HTTP_HOST'];
        
        $vaInsert = array("Nama"=>$cNama, "Email"=>$cEmail, 
                          "Subject"=>$cSubject, "Message"=>$cMessage);
        $this->dbd->insert("tbl_inbox",$vaInsert);

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
                
                //$cReceiverEmail,$subjectMail,$message,$headers);
            }
        }
    }
    public function sendReply($cSubjectReply,$cMessageReply,$nIDParent)
    {
        $cNama    = getSession('nama');
        $cSubject = $cSubjectReply;
        $cMessage = $cMessageReply;
        $cEmailFrom     = getSession('email');
        $cHost    = $_SERVER['HTTP_HOST'];
        
        //simpan ke tbl_inbox dengan status '4'
        $vaInsert = array("Nama"=>$cNama, "Email"=>$cEmailFrom, "Status"=>4, 
                          "Subject"=>$cSubject, "Message"=>$cMessage,"Parent"=>$nIDParent);
        $this->dbd->insert("tbl_inbox",$vaInsert);

        //update status inbox yang dibalas oleh admin menjadi '2'
        $this->updateStatusInbox($nIDParent,2);

        // Kirim email balasan kepada pengirim pesan.
        if($cHost <> "localhost"){
            $cReceiverEmail = getVal($nIDParent,"Email","tbl_inbox","ID");
            
            $subjectMail    = $cSubject .". Dari: ".$cNama;
            $headers        = "MIME-Version: 1.0" . "\r\n";
            $headers        .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers        .= 'From: <'.$cEmailFrom.'>' . "\r\n";
            $message = "
                <html>
                    <body>
                    ".$cMessage."
                    </body>
                </html>
            ";
            
           // mail($cReceiverEmail,$subjectMail,$message,$headers);
            
        }
    }
    public function countUnreadInbox()
    {
        $dbData = $this->dbd->select("tbl_inbox","IFNULL(COUNT(ID),0) as Count","Status=0","","","ID DESC",5);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow['Count'];
    }

    public function getDetailInbox($nID)
    {
        $dbRow  = [];
        $cWhere = "ID='$nID'";
        $dbData = $this->dbd->select("tbl_inbox", "*", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function updateStatusInbox($nID,$nStatus=1)
    {
        $vaUpd  = array('Status' => $nStatus);
        $cWhere = "ID='$nID'"; 
        $this->dbd->update("tbl_inbox",$vaUpd,$cWhere,"ID");
        return 1;
    }

    public function getReplyMessage($nID)
    {
        $dbRow  = [];
        $cWhere = "Parent='$nID' and Status=4";
        $dbData = $this->dbd->select("tbl_inbox", "*", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function getStatusInbox($nID)
    {
        $dbRow  = [];
        $cWhere = "ID='$nID'";
        $dbData = $this->dbd->select("tbl_inbox", "Status", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        $dbRow['Keterangan'] = $this->getKeteranganStatus($dbRow['Status']);
        return $dbRow;
    }

    public function getKeteranganStatus($nStatus)
    {
        /*  Status inbox :
            0=Belum dilihat, 
            1=Telah dilihat, 
            2=Telah dibalas, 
            3=Dihapus
            4=Pesan balasan oleh admin 
        */
        if($nStatus == 0){
            $cKet = "Belum Dilihat";
        }else if($nStatus == 1){
            $cKet = "Sudah Dilihat";
        }else if($nStatus == 2){
            $cKet = "Sudah Dibalas";
        }else if($nStatus == 3){
            $cKet = "Dihapus";
        }else if($nStatus == 4){
            $cKet = "Pesan balasan oleh admin";
        }
        return $cKet;
    }
}