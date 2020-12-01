<?php
class Business extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Business_model');
		$this->load->model('Socmed_model');
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
		$a['vaData'] 					= $this->Business_model->getDataBidangUsaha();
		$a['vaDataSocmed'] = $this->Socmed_model->getDataSocmedAll();
		$a['title']			   = "Bidang Usaha";
		$a['p']				   = 'frontend/business/v_business';
		$this->load->view('frontend/v_index', $a);
	}

	public function det(){
    $uri3 = $this->uri->segment(3);
    $data_detail_business       = $this->Business_model->getDetailBidangUsaha($uri3);
		$kode_file = $data_detail_business['Kode'];
		$kode_jenis = $data_detail_business['JenisUsaha'];
		$data_file_business = $this->Business_model->getFileBidangUsaha($kode_file);
		$data_jenis_business = $this->Business_model->getJenisBidangUsaha($kode_jenis);

    $a['cData_Judul'] = $data_detail_business['NamaUsaha'];
		$a['cData_Id'] = $data_detail_business['ID'];
    $a['cData_Deskripsi'] = $data_detail_business['Deskripsi'];
    $a['cData_Foto'] = $data_detail_business['Foto'];
		$a['cData_File'] = $data_file_business[0]['FilePath'];
		$a['cData_NamaOwner'] = $data_detail_business['NamaOwner'];
		$a['cData_Hp'] = $data_detail_business['HP'];
		$a['cData_Alamat'] = $data_detail_business['AlamatUsaha'];
		$a['cData_Jenis'] = $data_jenis_business[0]['Keterangan'];
		$a['vaDataSocmed'] = $this->Socmed_model->getDataSocmedAll();
    $a['p']  = "frontend/business/v_business_detail";
    $this->load->view('frontend/v_index', $a);
  }

	public function sendMail()
	{
		$va = $this->input->post();
		// print_r($va);
		$this->Business_model->sendMail($va);
		echo ("Komentar anda akan kami verifikasi terlebih dahulu, terima kasih.");
	}
}
