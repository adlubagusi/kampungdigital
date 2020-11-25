<?php
class Home extends CI_Controller{
    function __construct(){
      parent::__construct();
      $this->load->model('Home_model');
      $this->load->model('Kategori_model');
    }

    public function index()
    {
        $a['vaData'] = $this->Home_model->getDataBlog();
        $a['vaDataSocmed'] = $this->Home_model->getDataSocmed();
        $a['vaKategori'] = $this->Kategori_model->countAllKategori();
        $a['title']  = "Home";
        $a['p']      = 'frontend/home/v_home';
        $this->load->view('frontend/v_index', $a);
    }

    public function getData()
    {
      $page = 1;
      if( $this->input->post() ){
        $va = $this->input->post();
        $page = ($va['page'])? $va['page'] : 1;

      }
      $limit = 4;
      $limit_start = ($page - 1) * $limit;
      $no = $limit_start + 1;
      $nCountDataBlog = $this->Home_model->getCountDataBlog();

      $data = array();
      $html = '';

      $vaData = $this->Home_model->getDataBlogPagination($limit_start, $limit);
      foreach ($vaData as $key => $i) {
          $cBlog_judul = $i['Judul'];
          $cBlog_deskripsi = $i['Deskripsi'];
          $cBlog_kategori = $i['KeteranganKategori'];
          $cBlog_kategori_link = strtolower($cBlog_kategori);
          $cBlog_date = $i['DateTime'];
          $cBlog_image = $i['Image'];
          $cBlog_author = (empty($i['Author'])) ? "Admin" : $i['Author'];
          $cBlog_id = $i['ID'];
          $cBlog_slug = $i['Slug'];
          // $cBlog_tgl  = date2String($i['DateTime']);
          $dBlog_tgl  = string2date($i['DateTime']);

          $cDeskripsi = substr($cBlog_deskripsi,0, 200);

          $html .= '<div class="single-recent-blog-post">';
          $html .= '<div class="thumb">';
          $html .= '<img class="img-fluid" src="'.base_url().'assets/images/blog/'.$cBlog_image.'" alt="">';
          $html .= '<ul class="thumb-info">';
          $html .= '<li><a href="#"><i class="ti-user"></i>'.$cBlog_author.'</a></li>';
          $html .= '<li><a href="#"><i class="ti-notepad"></i>'.$dBlog_tgl.'</a></li>';
          $html .= '<li><a href="#"><i class="ti-themify-favicon"></i>0 Comments</a></li>';
          $html .= '</ul>';
          $html .= '</div>';
          $html .= '<div class="details mt-20">';
          $html .= '<a href="'.base_url().'p/'.$cBlog_slug.'">';
          $html .= '<h3>'.$cBlog_judul.'</h3>';
          $html .= '</a>';
          $html .= '<p class="tag-list-inline">Tag: <a href="'.base_url().'c/'.$cBlog_kategori_link.'">'.$cBlog_kategori.'</a></p>';
          $html .= '<p>'.$cDeskripsi.'......</p>';
          // $html .= '<a class="button" href="'.base_url().'home/det/'.$cBlog_id.'">Read More <i class="ti-arrow-right"></i></a>';
          $html .= '<a class="button" href="'.base_url().'p/'.$cBlog_slug.'">Read More <i class="ti-arrow-right"></i></a>';
          $html .= '</div>';
          $html .= '</div>';

      }
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

    public function det(){
      $uri3 = $this->uri->segment(3);

      $data_detail_blog       = $this->Home_model->getDetailBlog($uri3);
      $a['vaKategori']       = $this->Kategori_model->countAllKategori();
      $a['cData_Judul'] = $data_detail_blog['Judul'];
      $a['cData_Deskripsi'] = $data_detail_blog['Deskripsi'];
      $a['cData_Foto'] = $data_detail_blog['Image'];
      $a['cData_Date'] = $data_detail_blog['DateTime'];
      $a['cData_Author'] = $data_detail_blog['Author'];
      $a['cData_kategori'] = $data_detail_blog['KeteranganKategori'];
      $a['cData_kategori_link'] = strtolower($a['cData_Kategori']);
      $a['p']  = "frontend/blog/v_blog_details";
      $this->load->view('frontend/v_index', $a);
    }

}
