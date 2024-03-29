<?php
class Letter extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Letter_model');
		$this->load->model('Socmed_model');
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
		$a['vaData'] 					= $this->Letter_model->getDataSurat();
		$a['vaDataSocmed'] = $this->Socmed_model->getDataSocmedAll(); 
		$a['title']			   = "Surat surat";
		$a['p']				   = 'frontend/letter/v_letter';
		$this->load->view('frontend/v_index', $a);
	}
}
