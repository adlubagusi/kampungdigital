<?php
class Blog extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('Pengunjung_model');
		$this->Pengunjung_model->count_visitor();
		$this->load->model('Blog_model');
		$this->load->model('Kategori_model');
    $this->load->model('Socmed_model');
    $this->load->model('Komentar_model');
    $this->mdl = $this->Komentar_model;
	}
	function index(){
		$a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
		$a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
    $a['vaKategori']       = $this->Kategori_model->countAllKategori();
    $a['vaDataSocmed'] = $this->Socmed_model->getDataSocmedAll();
    $a['title']                 = "Blog";
    $a['p']				         = 'frontend/blog/v_blog';
		$this->load->view('frontend/v_index', $a);
	}

  function getData(){
    $page = 1;
    if( $this->input->post() ){
      $va = $this->input->post();
      $page = (floatval($va['page']) >0) ? $va['page'] : 1;

      //ambil kode kategori jika ada
      $cKategori = $va['kategori'];
      if($cKategori <> "") {
        $cKategori = str_replace("_"," ",$cKategori);
        $cKategori = getVal($cKategori, "Kode", "tbl_kategori","Keterangan"); //ambil Kode dari tbl_kategori where keterangan=cKategori
      }
    }
    $limit = 4;
    $limit_start = ($page - 1) * $limit;
    $no = $limit_start + 1;
    $nCountDataBlog = $this->Blog_model->getCountDataBlog($cKategori);

    $data = array();
    $html = '';

    $vaData = $this->Blog_model->getDataBlogPagination($limit_start, $limit, $cKategori);

    $html .= '<div class="row">';
    foreach ($vaData as $key => $i) {
        $cBlog_judul = $i['Judul'];
        $cBlog_deskripsi = $i['Deskripsi'];
        $cBlog_date = $i['DateTime'];
        $cBlog_image = $i['Image'];
        $cBlog_author = (empty($i['Author'])) ? "Admin" : $i['Author'];
        $cBlog_id = $i['ID'];
        $cBlog_slug = $i['Slug'];

        $cDeskripsi = substr($cBlog_deskripsi,0, 200);


        $html .= '<div class="col-md-6">';
        $html .= '<div class="single-recent-blog-post card-view">';
        $html .= '<div class="thumb">';
        $html .= '<img class="card-img rounded-0" src="'.base_url().'assets/images/blog/'.$cBlog_image.'" alt="" style="width:350px;height:300px;">';
        $html .= '<ul class="thumb-info">';
        $html .= '<li><a href="#"><i class="ti-user"></i>'.$cBlog_author.'</a></li>';
        $html .= '<li><a href="#"><i class="ti-themify-favicon"></i>0 Comments</a></li>';
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '<div class="details mt-20">';
        // $html .= '<a href="'.base_url().'blog/det/'.$cBlog_id.'"><h3>'.$cBlog_judul.'</h3></a>';
        $html .= '<a href="'.base_url().'p/'.$cBlog_slug.'"><h3>'.$cBlog_judul.'</h3></a>';
        $html .= '<p>'.$cDeskripsi.'........</p>';
        // $html .= '<a class="button" href="'.base_url().'blog/det/'.$cBlog_id.'">Read More <i class="ti-arrow-right"></i></a>';
        $html .= '<a class="button" href="'.base_url().'p/'.$cBlog_slug.'">Read More <i class="ti-arrow-right"></i></a>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

    }
    $html .= '</div>';
    $jumlah_page = ceil($nCountDataBlog / $limit);
    $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
    $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
    $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
    //view bagian pagination
    $html .= '<div class="row">';
    $html .= '<div class="col-lg-12">';
    $html .= '<nav class="blog-pagination justify-content-center d-flex">';
    $html .= '<ul class="pagination">';

    if($page == 1){
      $html .= '<li class="page-item disabled">';
      $html .= '<a href="#" class="page-link" aria-label="Previous">';
      $html .= '<span aria-hidden="true">';
      $html .= '<i class="ti-angle-left"></i>';
      $html .= '</span>';
      $html .= '</a>';
      $html .= '</li>';
    } else{
      $link_prev = ($page > 1)? $page - 1 : 1;
      $html .= '<li class="page-item halaman" id="'.$link_prev.'">';
      $html .= '<a href="#" class="page-link" aria-label="Previous">';
      $html .= '<span aria-hidden="true">';
      $html .= '<i class="ti-angle-left"></i>';
      $html .= '</span>';
      $html .= '</a>';
      $html .= '</li>';
    }

    for($i =$start_number; $i <=$end_number; $i++){
      $link_active = ($page == $i)? ' active' : '';
      $html .= '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a href="#" class="page-link">'.$i.'</a></li>';
    }

    if($page == $jumlah_page){
      $html .= '<li class="page-item disabled">';
      $html .= '<a href="#" class="page-link" aria-label="Next">';
      $html .= '<span aria-hidden="true">';
      $html .= '<i class="ti-angle-right"></i>';
      $html .= '</span>';
      $html .= '</a>';
      $html .= '</li>';
    } else {
      $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
      $html .= '<li class="page-item halaman" id="'.$link_next.'"">';
      $html .= '<a href="#" class="page-link" aria-label="Next">';
      $html .= '<span aria-hidden="true">';
      $html .= '<i class="ti-angle-right"></i>';
      $html .= '</span>';
      $html .= '</a>';
      $html .= '</li>';
    }

    $html .= '</ul>';
    $html .= '</nav>';
    $html .= '</div>';
    $html .= '</div>';

    $data['page'] = $page;
    $data['html'] = $html;
    j($data);
  }

  public function detail(){
    $uri2 = $this->uri->segment(2);
    // $data_detail_blog       = $this->Blog_model->getDetailBlog($uri3);
    $data_detail_blog       = $this->Blog_model->getDetailBlogBySlug($uri2);

    $a['vaKategori'] = $this->Kategori_model->countAllKategori();
    $a['cData_Id'] = $data_detail_blog['ID'];
    $a['cData_Judul'] = $data_detail_blog['Judul'];
    $a['cData_Deskripsi'] = $data_detail_blog['Deskripsi'];
    $a['cData_Foto'] = $data_detail_blog['Image'];
    $a['cData_Date'] = $data_detail_blog['DateTime'];
    $a['cData_Author'] = $data_detail_blog['Author'];
    $a['cData_kategori'] = $data_detail_blog['KeteranganKategori'];
    $a['cData_kategori_link'] = strtolower($a['cData_kategori']);
    $a['vaDataSocmed'] = $this->Socmed_model->getDataSocmedAll();
    $a['vaDataKomentar'] = $this->Blog_model->getDataKomentarBlog($data_detail_blog['ID']);
    $a['vaDataKomentarReply'] = $this->Blog_model->getDataKomentarBlogReply();
    $a['nCountKomentar'] = 0;
    if(!empty($a['vaDataKomentar'])){
      $a['nCountKomentar'] = $this->Blog_model->getCountDataKomentar($data_detail_blog['ID']);
    } 
    $a['title'] = $data_detail_blog['Judul'];
    $a['p']  = "frontend/blog/v_blog_details";
    $this->load->view('frontend/v_index', $a);
  }

  public function sendMail()
	{

		$va = $this->input->post();
		// print_r($va);
    // $cKategori = getVal($cKategori, "Kode", "tbl_kategori","Keterangan"); //ambil Kode dari tbl_kategori where keterangan=cKategori
    // $cBlogID = getVal($cKategori, "ID", "tbl_blog","Keterangan");
		$this->Blog_model->sendMail($va);
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
      $vaData = $this->mdl->getDetailKomentar($id,"blog");
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
		$this->Blog_model->saveReply($va);
    echo ("Komentar anda akan kami verifikasi terlebih dahulu, terima kasih.");
	}

}
