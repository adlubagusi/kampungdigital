<?php
class Business extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Business_model');
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
		$a['vaData'] 					= $this->Business_model->getDataSurat();
		$a['p']				   = 'frontend/business/v_business';
		$this->load->view('frontend/v_index', $a);
	}
}
