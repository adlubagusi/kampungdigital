<?php
class Setting extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Socmed_model');
		$this->load->library('upload');
    }

    public function index()
    {
        $a['p']          = 'setting/general/v_setting';
        $a['title']      = "Pengaturan Umum";
        $a['cAlamat']    = getCfg("msAlamat");
        $a['cEmail']     = getCfg("msEmail");
        $a['cNoTelp1']   = getCfg("msNoTelp1");
        $a['cNoTelp2']   = getCfg("msNoTelp2");
        $a['cDeskripsiSingkat'] = getCfg("msDeskripsiSingkat");
        $this->load->view('admin/index',$a);
    }

    public function save()
    {
        $va = $this->input->post();
        $cKey = $va['cKey'];
        $cVal = $va['cVal'];
        saveCfg($cKey, $cVal);
    }

    public function seo()
    {
        $a['p']             = 'setting/seo/v_setting_seo';
        $a['title']         = "Pengaturan SEO";
        $a['cDeskripsiSEO'] = getCfg("msDeskripsiSEO");
        $a['cKeywordsSEO']  = getCfg("msKeywordsSEO");
        
        $this->load->view('admin/index',$a);
    }

    public function socmed()
    {
        $a['p']             = 'setting/socmed/v_setting_socmed';
        $a['title']         = "Pengaturan SEO";
        
        $this->load->view('admin/index',$a);
    }

    public function getDataSocmed()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->Socmed_model->getDataSocmed($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = $d['Kode'];
            $data_ok[] = $d['Keterangan'];
            $data_ok[] = "<i class='fa fa-".$d['Icon']."'></i>";
            $data_ok[] = $d['Link'];
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return socmed_edit('.$d['ID'].');" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                      <a href="#" onclick="return socmed_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
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

    public function detailSocmed()
    {
        //var def uri segment
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $id   = $uri4;
        $data = array();
        $vaData = $this->Socmed_model->getDetailSocmed($id);
        if(count($vaData) > 0){
            $data=$vaData;
        }else{
            $data['Kode'] = $this->Socmed_model->getLastKode();
        }
        j($data);
    }

    public function saveSocmed()
    {
        $va          = $this->input->post();
        $nID         = $va['nID'];
        $cKode       = $va['cKode'];
        $cKeterangan = $va['cKeterangan'];
        $cIcon       = $va['cIcon'];
        $cLink       = $va['cLink'];
        $this->Socmed_model->save($cKode,$cKeterangan,$cIcon,$cLink,$nID);
    }

    public function deleteSocmed()
    {
        $nID    = $this->input->post('nIDHapus');
        $this->Socmed_model->delete($nID);
    }
}