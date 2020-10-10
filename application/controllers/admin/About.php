<?php
class About extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		// $this->load->model('About_model');
		$this->load->library('upload');
    }

    public function index()
    {
        $a['p']          = 'about/v_about_text';
        $a['title']      = "About";
        $a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
        $a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
        $this->load->view('admin/index',$a);
    }

    public function save()
    {
        $cJudul = $this->input->post('cJudul');
        $cDeskripsi = $this->input->post('cDeskripsi');
        // echo $cJudul." ".$cDeskripsi;
        saveCfg("msAboutUs_Judul", $cJudul);
        saveCfg("msAboutUs_Deskripsi", $cDeskripsi);
    }
}