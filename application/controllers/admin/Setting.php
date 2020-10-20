<?php
class Setting extends CI_Controller{
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
        $a['p']          = 'setting/v_setting';
        $a['title']      = "Pnegaturan Umum";
        $a['cAlamat']    = getCfg("msAlamat");
        $a['cEmail']     = getCfg("msEmail");
        $a['cNoTelp1']   = getCfg("msNoTelp1");
        $a['cNoTelp2']   = getCfg("msNoTelp2");
        $this->load->view('admin/index',$a);
    }

    public function save()
    {
        $va = $this->input->post();
        $cKey = $va['cKey'];
        $cVal = $va['cVal'];
        saveCfg($cKey, $cVal);
    }
}