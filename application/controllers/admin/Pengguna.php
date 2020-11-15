<?php
class Pengguna extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Pengguna_model');
		$this->load->library('upload');
	}


	public function index(){
		$nID=$this->session->userdata('idadmin');
		$a['vaUser'] = $this->Pengguna_model->getPenggunaLogin($nID);
		$a['p']    = 'pengguna/v_pengguna';
        $a['title'] = "Pengguna";
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->Pengguna_model->getDataPengguna($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = "<img src=".base_url().'assets/images/pp/'.$d['Foto']." style='width:80px;'>";
            $data_ok[] = $d['Nama'];
            $data_ok[] = $d['UserName'];
            $data_ok[] = $d['Email'];
            $data_ok[] = $d['JK'];
            $data_ok[] = $d['NoHP'];
            $data_ok[] = $d['Level'];
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return pengguna_edit('.$d['ID'].');" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                      <a href="#" onclick="return pengguna_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
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
        $vaData = $this->Pengguna_model->getDetailPengguna($id);
        if(count($vaData) > 0){
            $data=$vaData;
        }
        j($data);
    }

   
    public function save(){
        $va         = $this->input->post();
        $nID        = $va['nID'];
        $cNama      = $va['cNama'];
        $optJK      = $va['optJK'];
        $cUserName  = $va['cUserName'];
        $cPassword  = $va['cPassword'];
        $cPassword2 = $va['cPassword2'];
        $cEmail     = $va['cEmail'];
        $cKontak    = $va['cKontak'];
        $optLevel   = $va['optLevel'];
        $cDivisi    = $va['cDivisi'];
        $lTampil    = (isset($va['chckTampil'])) ? true : false;
        $config['upload_path'] = './assets/images/pp'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if(!empty($_FILES['cFileFoto']['name'])){
            if ($this->upload->do_upload('cFileFoto')){
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/images/pp/'.$gbr['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '60%';
                    $config['width']= 300;
                    $config['height']= 300;
                    $config['new_image']= './assets/images/pp/'.$gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $cGambar    = $gbr['file_name'];
            }else{
                echo $this->session->set_flashdata('msg','warning');
                redirect('admin/pengguna');
            }
        }
        if ($cPassword <> "" && $cPassword <> $cPassword2) {
            echo $this->session->set_flashdata('msg','error');
            //redirect('admin/pengguna');
        }else{
            $this->Pengguna_model->save($cNama,$optJK,$cUserName,$cPassword,$cEmail,$cKontak,$optLevel,$cDivisi,$lTampil,$cGambar,$nID);
            echo $this->session->set_flashdata('msg','success');
                //redirect('admin/pengguna');
        }
    }

   
    public function delete(){
        $nID    = $this->input->post('nIDHapus');
        $vaData = $this->Pengguna_model->getPenggunaLogin($nID);
        $cFoto  = $vaData['pengguna_photo'];
        $cPath   = base_url().'assets/images/pp/'.$cFoto;
        delete_files($cPath);
        $this->Pengguna_model->delete($nID);
        echo $this->session->set_flashdata('msg','success-hapus');
        redirect('admin/pengguna');
    }

    public function resetPassword(){
        $id=$this->uri->segment(4);
        $get=$this->Pengguna_model->get_detail_pengguna($id);
        if($get->num_rows()>0){
            $a=$get->row_array();
            $b=$a['pengguna_username'];
        }
        $pass=rand(123456,999999);
        $this->Pengguna_model->resetpass($id,$pass);
        echo $this->session->set_flashdata('msg','show-modal');
        echo $this->session->set_flashdata('uname',$b);
        echo $this->session->set_flashdata('upass',$pass);
        redirect('admin/pengguna');

    }

}