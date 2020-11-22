<?php
class Komentar_model extends CI_Model{
	public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    public function getDataKomentar($nStart,$nLength,$cDraw,$cSearch,$cType="")
    {
        /*  Status komentar :
            0=Belum dipublish, 
            1=Telah dipublish, 
            2=Telah dibalas, 
            3=Dihapus
            4=Pesan balasan admin
        */
        $cTable = ($cType == "blog") ? "tbl_komentar" : "tbl_bidangusaha_komentar";
        $vaData = [];
        $vaArr  = [];
        $cField = "i.*,b.Judul JudulBlog,b.Slug";
        $cWhere = "(i.Nama like '%".$cSearch['value']."%'
                    OR i.Email like '%".$cSearch['value']."%'
                    OR b.Judul like '%".$cSearch['value']."%')
                    AND i.Status <= 2";
        $cOrder = "i.DateTime DESC";
        $nLimit = "$nStart,$nLength";
        $cJoin  = "left join tbl_blog b on b.ID=i.BlogID";
        $dbDataRow = $this->dbd->select("$cTable i",$cField,$cWhere,$cJoin);
        $dbData    = $this->dbd->select("$cTable i",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
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
        $this->dbd->insert("tbl_komentar",$vaInsert);

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
                
                mail($cReceiverEmail,$subjectMail,$message,$headers);
            }
        }
    }

    public function sendReply($cMessageReply,$nIDParent,$nIDBlog)
    {
        $cNama    = getSession('nama');
        $cSubject = "Balasan Dari ".base_url();
        $cMessage = $cMessageReply;
        $cEmailFrom     = getSession('email');
        $cHost    = $_SERVER['HTTP_HOST'];
        
        //simpan ke tbl_komentar dengan status '4'
        $vaInsert = array("Nama"=>$cNama, "Email"=>$cEmailFrom, "Status"=>4,
                         "Message"=>$cMessage,"Parent"=>$nIDParent,"BlogID"=>$nIDBlog);
        $this->dbd->insert("tbl_komentar",$vaInsert);

        //update status komentar yang dibalas oleh admin menjadi '2'
        $this->updateStatusKomentar($nIDParent,2);

        // Kirim email balasan kepada pengirim pesan.
        if($cHost <> "localhost"){
            $cReceiverEmail = getVal($nIDParent,"Email","tbl_komentar","ID");
            
            $subjectMail    = $cSubject .". Oleh: ".$cNama;
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
            
            mail($cReceiverEmail,$subjectMail,$message,$headers);
            
        }
    }
    public function countUnreadComment()
    {
        $dbData = $this->dbd->select("tbl_komentar","IFNULL(COUNT(ID),0) as Count","Status=0","","","ID DESC",5);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow['Count'];
    }

    public function getDetailKomentar($nID)
    {
        $dbRow  = [];
        $cWhere = "ID='$nID'";
        $dbData = $this->dbd->select("tbl_komentar", "*", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function updateStatusKomentar($nID,$nStatus=1)
    {
        $vaUpd  = array('Status' => $nStatus);
        $cWhere = "ID='$nID'"; 
        $this->dbd->update("tbl_komentar",$vaUpd,$cWhere,"ID");
        return 1;
    }

    public function getReplyMessage($nID)
    {
        $dbRow  = [];
        $cWhere = "Parent='$nID' and Status=4";
        $dbData = $this->dbd->select("tbl_komentar", "*", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        return $dbRow;
    }

    public function getStatusKomentar($nID)
    {
        $dbRow  = [];
        $cWhere = "ID='$nID'";
        $dbData = $this->dbd->select("tbl_komentar", "Status", $cWhere);
        $dbRow  = $this->dbd->getrow($dbData);
        $dbRow['Keterangan'] = $this->getKeteranganStatus($dbRow['Status']);
        return $dbRow;
    }

    public function getKeteranganStatus($nStatus)
    {
        /*  Status komentar :
            0=Belum dipublish, 
            1=Telah dipublish, 
            2=Telah dibalas, 
            3=Dihapus
            4=Pesan balasan admin
        */
        if($nStatus == 0){
            $cKet = "Belum Dipublish";
        }else if($nStatus == 1){
            $cKet = "Sudah Dipublish";
        }else if($nStatus == 2){
            $cKet = "Sudah Dibalas";
        }else if($nStatus == 3){
            $cKet = "Dihapus";
        }else if($nStatus == 4){
            $cKet = "Pesan balasan oleh admin";
        }
        return $cKet;
    }

    public function delete($nID)
    {
        $this->updateStatusKomentar($nID,3);
    }
}