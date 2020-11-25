<?php
class Contact extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Contact_model');
    $this->load->model('Socmed_model');
		$this->mdl = $this->Contact_model;
	}
	function index(){
		$a['cAlamat']     = getCfg("msAlamat");
		$a['cNoTelp'] 	  = getCfg("msNoTelp1");
		$a['cEmail'] 	  = getCfg("msEmail");
		$a['title']		  = "Kontak";
    $a['vaDataSocmed'] = $this->Socmed_model->getDataSocmedAll();
		$a['p']				   = 'frontend/contact/v_contact';
		$this->load->view('frontend/v_index', $a);
	}
	public function sendMail()
	{
		$va = $this->input->post();
		// print_r($va);
		$this->mdl->sendMail($va);
		echo ("Terima kasih telah menghubungi kami. Kami akan membalas pesan anda secepatnya");
	}
}
