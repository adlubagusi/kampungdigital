<?php
class Login extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('Login_model','mdl');
        $this->load->model('FuncDB_model','dbd');
    }
    function index(){
        $this->load->view('admin/v_login');
    }
    function auth(){
        $cUserName = strip_tags(str_replace("'", "", $this->input->post('cUserName')));
        $cPassword = strip_tags(str_replace("'", "", $this->input->post('cPassword')));
        $cPassword = md5($cPassword);
        $vaAdmin    = $this->mdl->cekadmin($cUserName,$cPassword);
        // echo json_encode($cadmin);
        if(count($vaAdmin) > 0){
            $this->session->set_userdata('masuk',true);
            $this->session->set_userdata('user',$cUserName);

            $cIdAdmin   = $vaAdmin['pengguna_id'];
            $cNamaUser  = $vaAdmin['pengguna_nama'];
            $cUser      = $vaAdmin['pengguna_username'];
            $this->session->set_userdata('idadmin',$cIdAdmin);
            $this->session->set_userdata('nama',$cNamaUser);
            $this->session->set_userdata('username',$cUser);
            if($vaAdmin['pengguna_level']=='1'){
                $this->dbd->CheckDatabase();
                $this->session->set_userdata('akses','1');
                redirect('admin/dashboard');
            }else{
                $this->session->set_userdata('akses','2');
                redirect('admin/dashboard');
            }

        }else{
            echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
            redirect('admin/login');
        }

    }

    function logout(){
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
