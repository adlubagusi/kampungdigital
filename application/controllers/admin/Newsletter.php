<?php
class Newsletter extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Newsletter_model');
        $this->mdl = $this->Newsletter_model;
    }
    public function index()
    {
        $a['p']          = 'newsletter/v_newsletter';
        $a['title']      = "Newsletter";
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->mdl->getDataNewsletter($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $cStatus = ($d['Status'] == 1) ? "Aktif" : "Non-aktif";
            $cColor  = $this->getSpanColor($d['Status']);
            $cTgl    = strtolower(date_2text(date_2d($d['DateTime'])));
            
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$d['Email'] .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .$cStatus .'</span>';;
            $data_ok[] = '<span style="color:'.$cColor.'">' .strtolower(date_2text(date_2d($d['DateTime']))) .'</span>';;
            $data_ok[4] = '<div class="btn-group">
                      <a href="#" onclick="return newsletter_edit('.$d['ID'].');" class="btn btn-info btn-xs"><i class="fa fa-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                      ';
            if($d['Status'] == 1){
                $data_ok[4] .= '
                    <a href="#" onclick="return newsletter_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Non-aktifkan</a>
                ';
            }else{
                $data_ok[4] .= '
                    <a href="#" onclick="return newsletter_aktifkan('.$d['ID'].');" class="btn btn-success btn-xs"><i class="fa fa-check" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Aktifkan</a>
                ';
            }
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
        $vaData = $this->mdl->getDetailNewsletter($id);
        if(count($vaData) > 0){
            $data=$vaData;
        }
        j($data);
    }

    public function save()
    {
        $va          = $this->input->post();
        $nID         = isset($va['nID']) ? $va['nID'] : 0;
        $cEmail      = $va['cEmail'];
        $cStatus     = ($nID == 0) ? "1" : $va['cStatus'];
        $this->mdl->save($cEmail,$cStatus,$nID);
        echo "ok";
    }

    public function delete()
    {
        $nID    = $this->input->post('nIDHapus');
        $this->mdl->delete($nID);
    }

    public function aktifkan()
    {
        $nID    = $this->input->post('nIDAktif');
        $this->mdl->updateStatusNewsletter($nID,"1");
    }

    public function getSpanColor($nStatus = 0)
    {
        $cColor = "#dd4b39";
        if($nStatus == 1){
            $cColor = "#00a65a";
        }
        return $cColor;
    }

}