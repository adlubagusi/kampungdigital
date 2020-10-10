<?php
class Home extends CI_Controller{
    function __construct(){
      parent::__construct();
      $this->load->model('Home_model');
    }

    public function index()
    {
        $a['vaData'] = $this->Home_model->getDataPortofolio();
        $a['p']      = 'frontend/home/v_home';
        $this->load->view('frontend/v_index', $a);
    }
}
