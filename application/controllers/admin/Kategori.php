<?php
class Kategori extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Kategori_model');
    }
    public function index()
    {
        $a['p']          = 'kategori/v_kategori';
        $a['title']      = "Kategori";
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->Kategori_model->getDataKategori($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = $d['Kode'];
            $data_ok[] = $d['Keterangan'];
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return kategori_edit('.$d['ID'].');" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                      <a href="#" onclick="return kategori_hapus('.$d['ID'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
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
        $vaData = $this->Kategori_model->getDetailKategori($id);
        if(count($vaData) > 0){
            $data=$vaData;
        }else{
            $data['Kode'] = $this->Kategori_model->getLastKode();
        }
        j($data);
    }

    public function save()
    {
        $va          = $this->input->post();
        $nID         = $va['nID'];
        $cKode       = $va['cKode'];
        $cKeterangan = $va['cKeterangan'];
        $this->Kategori_model->save($cKode,$cKeterangan,$nID);
    }

    public function delete()
    {
        $nID    = $this->input->post('nIDHapus');
        $this->Kategori_model->delete($nID);
    }
}