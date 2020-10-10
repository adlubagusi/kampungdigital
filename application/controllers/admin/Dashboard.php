<?php
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Pengunjung_model');
	}
	function index(){
		if($this->session->userdata('akses')=='1'){
			$a['visitor'] = $this->Pengunjung_model->statistik_pengujung();
			$a['p']		  = 'dashboard/v_dashboard';
			$a['title']   = "Dashboard";
			$this->load->view('admin/index',$a);
		}else{
			redirect('administrator');
		}
	
	}
	
}