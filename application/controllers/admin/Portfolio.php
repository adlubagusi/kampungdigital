<?php
class Portfolio extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Portfolio_model');
		$this->load->library('upload');
    }
    
    public function index()
    {
        // $a['vaData'] = $this->Portfolio_model->getAllPortfolio();
        $a['p']          = 'portfolio/v_portfolio';
        $a['title']      = "Portfolio";
        $a['vaKategori'] = $this->Portfolio_model->getAllKategoriPortfolio();
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->Portfolio_model->getDataPortfolio($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = $d['Judul'];
            $data_ok[] = $d['Deskripsi'];
            $data_ok[] = "<img src=".base_url().'assets/images/portfolio/'.$d['Foto']." style='width:300px;'>";
            $data_ok[] = $d['Kategori'];
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return portfolio_edit('.$d['ID'].');" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                      <a href="#" onclick="return portfolio_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
                     ';
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
        $vaData = $this->Portfolio_model->getDetailPortfolio($id);
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
        $cDeskripsi  = $va['cDeskripsi'];
        $optKategori = $va['optKategori'];
        $config['upload_path'] = './assets/images/portfolio/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $cGambar     = "";
        $this->upload->initialize($config);
        if(!empty($_FILES['cFileFoto']['name'])){
            if ($this->upload->do_upload('cFileFoto')){
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/images/portfolio/'.$gbr['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '60%';
                    $config['width']= 300;
                    $config['height']= 300;
                    $config['new_image']= './assets/images/'.$gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $cGambar    = $gbr['file_name'];
            }else{
                echo $this->session->set_flashdata('msg','warning');
                redirect('admin/portfolio');
            }
        }
        $this->Portfolio_model->save($cJudul,$cDeskripsi,$optKategori,$cGambar,$nID);
        echo $this->session->set_flashdata('msg','success');
        redirect('admin/portfolio');
    
    }

    public function delete(){
        $nID    = $this->input->post('nIDHapus');
        $vaData = $this->Portfolio_model->getDetailPortfolio($nID);
        $cFoto  = $vaData['Foto'];
        $cPath   = base_url().'assets/images/portfolio/'.$cFoto;
        delete_files($cPath);
        $this->Portfolio_model->delete($nID);
        echo $this->session->set_flashdata('msg','success-hapus');
        
    }
}