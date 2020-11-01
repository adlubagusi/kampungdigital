<?php
class About extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
        $this->load->model('About_model');
        $this->load->helper('url');
		// $this->load->library('upload');
    }

    public function index()
    {
        $a['p']          = 'about/v_about_text';
        $a['title']      = "About";
        $a['cAbout_Judul']     = getCfg("msAboutUs_Judul");
        $a['cAbout_Deskripsi'] = getCfg("msAboutUs_Deskripsi");
        $this->load->view('admin/index',$a);
    }

    public function save()
    {
        $cJudul = $this->input->post('cJudul');
        $cDeskripsi = $this->input->post('cDeskripsi');
        // echo $cJudul." ".$cDeskripsi;
        saveCfg("msAboutUs_Judul", $cJudul);
        saveCfg("msAboutUs_Deskripsi", $cDeskripsi);
    }

    public function struktur()
    {
        $a['p']          = 'about/v_about_struktur';
        $a['title']      = "Struktur Organisasi";
        $this->load->view('admin/index',$a);
    }

    public function getDataStruktur()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->About_model->getDataStruktur($nStart,$nLength,$cDraw,$cSearch);
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = "<img src='".base_url()."assets/images/pp/".$d['Foto']."' style='width:80px;'>";
            $data_ok[] = $d['Nama'];
            $data_ok[] = $d['Jabatan'];
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return struktur_hapus(`'.$d['ID'].'`);" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
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

    public function searchAnggota()
    {
        $cSearch = $this->input->post('search');
        $vaData  = $this->About_model->searchAnggota($cSearch);
        j($vaData);
    }

    public function saveStruktur()
    {
        $va          = $this->input->post();
        $nID         = $va['nID'];
        $cUserName   = $va['cUserName'];
        $cJabatan    = $va['cJabatan'];
        $this->About_model->saveStruktur($cUserName,$cJabatan,$nID);
    }

    public function detailStrukturAnggota()
    {
        //var def uri segment
		$uri2 = $this->uri->segment(2);
		$uri3 = $this->uri->segment(3);
        $uri4 = $this->uri->segment(4);
        $id   = $uri4;
        $data = array();
        $vaData = $this->About_model->getDetailStruktur($id);
        
        j($vaData);
    }

    public function deleteStrukturAnggota()
    {
        $nID    = $this->input->post('nIDHapus');
        $this->About_model->deleteStrukturAnggota($nID);
    }
}