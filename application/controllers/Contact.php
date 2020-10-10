<?php
class Contact extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Contact_model');
		$this->mdl = $this->Contact_model;
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
		$a['p']				   = 'frontend/contact/v_contact';
		$a['js']			   = 'frontend/contact/v_contact-js';
		$this->load->view('frontend/v_index', $a);
	}
	public function sendMail()
	{
		$va = $this->input->post();
		$this->mdl->sendMail($va);
		echo ("Terima kasih telah menghubungi kami. Kami akan membalas pesan anda secepatnya");
	}
}