<?php
class Komentar extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
        $this->load->model('Komentar_model');
        $this->mdl = $this->Komentar_model;
    }
    public function blog()
    {
        $a['p']          = 'komentar/v_komentar_blog';
        $a['title']      = "Komentar";
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $vaGet      = $this->input->get();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];
        $cType     = $vaGet['cType'];
        $vaData = $this->mdl->getDataKomentar($nStart,$nLength,$cDraw,$cSearch,$cType);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $vaStatus = $this->mdl->getStatusKomentar($d['ID']);
            $nStatus  = $vaStatus['Status'];
            $cStatus  = $vaStatus['Keterangan'];
            
            $cColor   = $this->getSpanColor($nStatus);
            
            $cTextBlog = '<a href="'.base_url()."p/".$d['Slug'].'" target="_blank">'.$d['JudulBlog'].'</label></a>';
            
            $cBtnGroup = '<div class="btn-group">';
            if($nStatus == 0){
                $cBtnGroup.='<a href="#" onclick="return komentar_publish('.$d['ID'].');" class="btn btn-info btn-xs"><i class="fa fa-send" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Pubish</a>';
            }else if($nStatus == 1){
                $cBtnGroup.='<a href="#" onclick="return komentar_open('.$d['ID'].');" class="btn btn-primary btn-xs"><i class="fa fa-mail-reply" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Balas</a>';
            }else{
                $cBtnGroup.='<a href="#" onclick="return komentar_open('.$d['ID'].');" class="btn btn-success btn-xs"><i class="fa fa-search" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Buka</a>';
            }
            $cBtnGroup.='<a href="#" onclick="return komentar_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="fa fa-trash" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>';
            $cBtnGroup .= '</div>';
            

            $data_ok = array();
            $data_ok[] = '<span style="color:'.$cColor.'">' .$no++ .'</span>';
            $data_ok[] = '<span style="color:'.$cColor.'">' .$d['Nama'] .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$d['Email'] .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$cTextBlog .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .strtolower(date_2text(date_2d($d['DateTime']))) .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$cStatus .'</span>';;
            $data_ok[] = $cBtnGroup;
            
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
        $vaData = $this->mdl->getDetailKomentar($id);
        if(count($vaData) > 0){
            // if($vaData['Status'] == 0){
            //     $vaData['Status'] = $this->mdl->updateStatusKomentar($id);
            // } 
            $dDate = date_2d($vaData['DateTime']);
            $nTime = substr($vaData['DateTime'],11,5);
            $vaData['Time'] = $dDate." ".$nTime;

            //ambil data pesan balasan
            if($vaData['Status'] >=2) $vaData['ReplyMsg'] = $this->getReplyMessage($id);
            $data=$vaData;
        }
        j($data);
    }

    public function sendReply()
    {
        $va            = $this->input->post();
        $nID           = $va['nID'];
        $cMessageReply = $va['cMessageReply'];
        $nIDBlog       = $va['nIDBlog'];
        $this->mdl->sendReply($cMessageReply,$nID,$nIDBlog);
        echo "ok";
    }

    public function delete()
    {
        $nID    = $this->input->post('nIDHapus');
        $this->mdl->delete($nID);
    }

    public function countUnreadComment()
    {
        $nData = $this->mdl->countUnreadComment();
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

    public function getSpanColor($nStatus = 0)
    {
        $cColor = "#00aeef";
        if($nStatus == 1){
            $cColor = "#000";
        }else if($nStatus == 2){
            $cColor = "#00a65a";
        }else if($nStatus == 3){
            $cColor = "#dd4b39";
        }
        return $cColor;
    }
    public function publish()
    {
        $va = $this->input->post();
        $nID = $va['nIDPublish'];
        $vaData = $this->mdl->getDetailKomentar($nID);
        if(count($vaData) > 0) $this->mdl->updateStatusKomentar($nID);
    }
}