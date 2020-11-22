<?php
class Inbox extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
        $this->load->model('Contact_model');
        $this->mdl = $this->Contact_model;
    }
    public function index()
    {
        $a['p']          = 'inbox/v_inbox';
        $a['title']      = "Inbox";
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->mdl->getDataInbox($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $vaStatus = $this->mdl->getStatusInbox($d['ID']);
            $nStatus  = $vaStatus['Status'];
            $cStatus  = $vaStatus['Keterangan'];
            $cColor = "#00aeef";
            if($nStatus == 1){
                $cColor = "#000";
            }else if($nStatus == 2){
                $cColor = "#00a65a";
            }else if($nStatus == 3){
                $cColor = "#dd4b39";
            }

            $data_ok = array();
            $data_ok[] = '<span style="color:'.$cColor.'">' .$no++ .'</span>';
            $data_ok[] = '<span style="color:'.$cColor.'">' .strtolower(date_2text(date_2d($d['DateTime']))) .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$d['Nama'] .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$d['Subject'] .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$cStatus .'</span>';;
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return inbox_open('.$d['ID'].');" class="btn btn-info btn-xs"><i class="fa fa-search" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Buka</a>';
                    //   <a href="#" onclick="return inbox_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
                    //  ';
     	   $data[] = $data_ok;
        }
        $json_data = array(
                    "draw" => $cDraw,
                    "iTotalRecords" => $vaData['row'],
                    "iTotalDisplayRecords" => $vaData['row'],
                    "data" => $data
                );
        j($json_data);
    }
    public function detail()
    {
        //var def uri segment
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $id   = $uri4;
        $data = array();
        $vaData = $this->mdl->getDetailInbox($id);
        if(count($vaData) > 0){
            if($vaData['Status'] == 0){
                $vaData['Status'] = $this->mdl->updateStatusInbox($id);
            } 
            $dDate = date_2d($vaData['DateTime']);
            $nTime = substr($vaData['DateTime'],11,5);
            $vaData['Time'] = $dDate." ".$nTime;

            //ambil data pesan balasan
            if($vaData['Status'] >=2) $vaData['ReplyMsg'] = $this->getReplyMessage($id);
            $data=$vaData;
        }else{
            $data['Kode'] = $this->mdl->getLastKode();
        }
        j($data);
    }

    public function sendReply()
    {
        $va            = $this->input->post();
        $nID           = $va['nID'];
        $cSubjectReply = $va['cSubjectReply'];
        $cMessageReply = $va['cMessageReply'];
        $this->mdl->sendReply($cSubjectReply,$cMessageReply,$nID);
        echo "ok";
    }

    public function delete()
    {
        $nID    = $this->input->post('nIDHapus');
        $this->mdl->delete($nID);
    }

    public function countUnreadInbox()
    {
        $nData = $this->mdl->countUnreadInbox();
        echo $nData;
    }

    public function getReplyMessage($nID)
    {
        $vaData = $this->mdl->getReplyMessage($nID);
        $dDate = date_2d($vaData['DateTime']);
        $nTime = substr($vaData['DateTime'],11,5);
        $vaData['Time'] = $dDate." ".$nTime;
        unset($vaData['DateTime']);
        return $vaData;
    }
}