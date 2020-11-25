<?php
class About extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('About_model');
		$this->load->model('Socmed_model');
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
		$a['vaDataSocmed'] = $this->Socmed_model->getDataSocmedAll();
		$a['vaData'] 		   = $this->About_model->getDataPengguna();
		$a['vaDataPanitia'] 		   = $this->About_model->getDataPanitia();
		$a['p']				   = 'frontend/about/v_about';
		$a['title']			   = "Tentang Kami";
		$this->load->view('frontend/v_index', $a);
	}


}
