<?php
class Portfolio extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
    $this->load->model('Portfolio_model');
		// $this->load->model('About_model');
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
    $a['vaData'] 		   = $this->Portfolio_model->getDataPortfolioHome();
		$a['p']				   = 'frontend/portfolio/v_portfolio';
		$a['js']			   = 'frontend/portfolio/v_portfolio-js';
		$this->load->view('frontend/v_index', $a);
	}
}
