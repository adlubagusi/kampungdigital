<?php
class Blog extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Blog_model');
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
		$a['p']				   = 'frontend/blog/v_blog';
		$a['js']			   = 'frontend/blog/v_blog-js';
		$this->load->view('frontend/v_index', $a);
	}
}
