<?php
class Home extends CI_Controller{
    function __construct(){
      parent::__construct();
      $this->load->model('Home_model');
    }

    public function index()
    {
        $a['vaData'] = $this->Home_model->getDataBlog();
        // $a['nCountDataBlog'] = $this->Home_model->getCountDatatBlog();
        $a['p']      = 'frontend/home/v_home';

        $this->load->view('frontend/v_index', $a);
    }

    public function GetData()
    {
        $page = (isset($_POST['page']))? $_POST['page'] : 1;
        $limit = 5;
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $a['nCountDataBlog'] = $this->Home_model->getCountDatatBlog();
        $a['p']      = 'frontend/home/v_home';
        $this->load->view('frontend/v_index', $a);
    }
}
