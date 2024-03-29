<?php
class Blog extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Blog_model');
		$this->load->library('upload');
    }
    
    public function index()
    {
        // $a['vaData'] = $this->blog_model->getAllblog();
        $a['p']          = 'blog/v_blog';
        $a['title']      = "Blog";
        $a['vaKategori'] = $this->Blog_model->getAllKategoriBlog();
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->Blog_model->getDataBlog($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = "<img src=".base_url().'assets/images/blog/'.$d['Image']." style='width:100px;height:100px'>";
            $data_ok[] = $d['Judul'];
            $data_ok[] = $d['Kategori'];
            $data_ok[4] = '<div class="btn-group">
                        <a href="#" onclick="return blog_show('.$d['ID'].');" class="btn btn-success btn-xs"><i class="fa fa-eye" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Show</a>
                        <a href="#" onclick="return blog_edit('.$d['ID'].');" class="btn btn-info btn-xs"><i class="fa fa-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                        <a href="#" onclick="return blog_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
                     ';
            if($d['SendNotif'] == 0){
                $data_ok[4] .= '
                    <a href="#" onclick="return blog_sendnotif('.$d['ID'].');" class="btn btn-primary btn-xs"><i class="fa fa-share" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Kirim Notifikasi</a>
                ';
            }
     	   $data[] = $data_ok;
        }
        $json_data = array(
                    "draw" => $cDraw,
                    "iTotalRecords" => $vaData['row'],
                    "iTotalDisplayRecords" => $vaData['row'],
                    "data" => $data
                );
        j($json_data);
    }

    public function detail()
    {
        //var def uri segment
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $id   = $uri4;
        $data = array();
        $vaData = $this->Blog_model->getDetailBlog($id);
        if(count($vaData) > 0){
            $data=$vaData;
        }
        j($data);
    }

    public function save()
    {
        $va          = $this->input->post();
        $nID         = $va['nID'];
        $cJudul      = $va['cJudul'];
        $cSlug       = $va['cSlug'];
        $cDeskripsi  = $va['cDeskripsi'];
        $optKategori = $va['optKategori'];
        $config['upload_path'] = './assets/images/blog/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $cGambar     = "";
        $this->upload->initialize($config);
        if(!empty($_FILES['cFileFoto']['name'])){
            if ($this->upload->do_upload('cFileFoto')){
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/images/blog/'.$gbr['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '60%';
                    $config['width']= 710;
                    $config['height']= 460;
                    $config['new_image']= './assets/images/blog/'.$gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $cGambar    = $gbr['file_name'];
            }else{
                echo "error upload gambar";
            }
        }
        $this->Blog_model->save($cJudul,$cSlug,$cDeskripsi,$optKategori,$cGambar,$nID);
        echo "ok";    
    }

    public function delete(){
        $nID    = $this->input->post('nIDHapus');
        $vaData = $this->Blog_model->getDetailBlog($nID);
        $cFoto  = $vaData['Foto'];
        $cPath   = base_url().'assets/images/blog/'.$cFoto;
        delete_files($cPath);
        $this->Blog_model->delete($nID);
        echo $this->session->set_flashdata('msg','success-hapus');
        
    }

    public function sendNotif()
    {
        $va   = $this->input->post();
        $nIDBlog   = $va['nIDSendNotif'];
        $vaData = $this->Blog_model->getDetailBlog($nIDBlog);
        if(count($vaData) > 0){
            $this->Blog_model->sendMailToSubscriber($nIDBlog);
            $this->Blog_model->updateStatusNotif($nIDBlog);
            echo "ok";
        }
    }
}