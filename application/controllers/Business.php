<?php
class Business extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Business_model');
		$this->load->model('Socmed_model');
		$this->load->model('Komentar_model');
    $this->mdl = $this->Komentar_model;
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
		$a['vaDataKomentar'] = $this->Business_model->getDataKomentarBidangUsaha($data_detail_business['ID']);
	$a['vaDataKomentarReply'] = $this->Business_model->getDataKomentarBidangUsahaReply();
	$a['vaCountKomentar'] = $this->Business_model->getCountDataKomentar($data_detail_business['ID']);
    $a['p']  = "frontend/business/v_business_detail";
		$a['title']			   = "Bidang Usaha";
    $this->load->view('frontend/v_index', $a);
  }

	public function sendMail()
	{
		$va = $this->input->post();
		// print_r($va);
		$this->Business_model->sendMail($va);
		echo ("Komentar anda akan kami verifikasi terlebih dahulu, terima kasih.");
	}

	public function detailReply()
  {
      //var def uri segment
      $uri2 = $this->uri->segment(2);
      $uri3 = $this->uri->segment(3);
      $uri4 = $this->uri->segment(4);
      $id   = $uri3;
      $data = array();
      $vaData = $this->mdl->getDetailKomentar($id,"bidangUsaha");
      if(count($vaData) > 0){
          $dDate = date_2d($vaData['DateTime']);
          $nTime = substr($vaData['DateTime'],11,5);
          $vaData['Time'] = $dDate." ".$nTime;

          //ambil data pesan balasan
          $data=$vaData;
      }
      j($data);
  }

  public function saveReply()
	{

		$va = $this->input->post();
		$this->Business_model->saveReply($va);
		echo ("Terima kasih telah menghubungi kami. Kami akan membalas pesan anda secepatnya");
	}
}
