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
		$a['vaData'] 					= $this->Business_model->getDataBidangUsaha();
		$a['p']				   = 'frontend/business/v_business';
		$this->load->view('frontend/v_index', $a);
	}

	public function det(){
    $uri3 = $this->uri->segment(2);
		echo "uri3 = ".$uri3;
    $data_detail_business       = $this->Business_model->getDetailBidangUsaha($uri3);
		$kode_file = $data_detail_business['Kode'];
		$kode_jenis = $data_detail_business['JenisUsaha'];
		$data_file_business = $this->Business_model->getFileBidangUsaha($kode_file);
		$data_jenis_business = $this->Business_model->getJenisBidangUsaha($kode_jenis);

    $a['cData_Judul'] = $data_detail_business['NamaUsaha'];
    $a['cData_Deskripsi'] = $data_detail_business['Deskripsi'];
    $a['cData_Foto'] = $data_detail_business['Foto'];
		$a['cData_File'] = $data_file_business[0]['FilePath'];
		$a['cData_NamaOwner'] = $data_detail_business['NamaOwner'];
		$a['cData_Hp'] = $data_detail_business['HP'];
		$a['cData_Alamat'] = $data_detail_business['AlamatUsaha'];
		$a['cData_Jenis'] = $data_jenis_business[0]['Keterangan'];
    $a['p']  = "frontend/business/v_business_detail";
    $this->load->view('frontend/v_index', $a);
  }
}
