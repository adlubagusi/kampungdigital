<?php
class Contact_model extends CI_Model{
	public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
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
                
                mail($cReceiverEmail,$subjectMail,$message,$headers);
            }
        }
    }
}