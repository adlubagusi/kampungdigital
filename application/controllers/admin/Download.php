<?php
class Download extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('Kategori_model');
		$this->load->model('Download_model');
		$this->load->library('upload');
    }
    public function index()
    {
        $a['p']          = 'download/v_download';
        $a['title']      = "Surat Digital";
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->Download_model->getDataDownload($nStart,$nLength,$cDraw,$cSearch);
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = $d['Kode'];
            $data_ok[] = $d['Judul'];
            $data_ok[] = string2Date($d['DateTime']);
            $data_ok[] = $d['UserName'];
            $data_ok[] = '<div class="btn-group">
                            <a href="'.base_url().$d['File'].'" class="btn btn-info btn-xs" download><i class="fa fa-download" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Download</a>
                            <a href="'.base_url().$d['File'].'" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-search" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Open (PDF Only)</a>
                        ';;
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return download_edit(`'.$d['Kode'].'`);" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                      <a href="#" onclick="return download_hapus(`'.$d['Kode'].'`);" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
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

    public function save(){
        $va         = $this->input->post();
            
        $vaKode         = $va['cKode'];
        if($vaKode == "" || trim(empty($vaKode))){
            $cKode = $this->Download_model->getKode() ;
        }else{
            $cKode = $vaKode ;
        }
        $va['cKode'] = $cKode;
        $cJudul     = $va['cJudul'];
        $cUserName  = getSession("username");
        $nYear      = date('Y');
        $cKategori  = "/Download";
        $adir       = $this->config->item('upload_dokumen_dir') . $nYear . $cKategori ;
        if(!is_dir($adir)){
            mkdir($adir,0777,true);
        }
        $upload         = array("vaFile"=>getSession("ss_download_vaFile")) ;
        $va['FilePath'] = ""; 
        $dir            = "" ;
        // print_r($upload);
        // exit;
        if(!empty($upload)){
            //$this->SuratMasuk_model->deleteFile($va) ;
            foreach ($upload as $key => $value) {
                if(!empty($value)){
                    foreach ($value as $tkey => $tval) {
                        if(!empty($tval)){
                            foreach($tval as $fkey=>$file){
                                $vi     = pathinfo($file) ;
                                $dir    = $adir.'/' ;
                                $dir   .=  $vi['filename'] . "." . $vi['extension'] ;
                                if(is_file($dir)) @unlink($dir) ;
                                if(@copy($file,$dir)){
                                    @unlink($file) ;
                                    $this->FuncDB_model->saveconfig($key, $dir) ;
                                }
                                $va['FilePath'] = $dir ;
                                // $this->SuratMasuk_model->saveFile($va) ;
                            }
                        }
                    }
                }
            }
        }
        $cFile = $va['FilePath'];
        // echo $cKode." ".$cJudul." ".$cFile." ".$cUserName;
        $saving = $this->Download_model->save($cKode,$cJudul,$cFile,$cUserName) ;
        savesession("ss_download_vaFile" , "") ;
        echo ('OK');
    }

    public function savingFile()
    {
        savesession("ss_download_vaFile" , "") ;
        $cFileName = "Download_". date_now();
        $cDir      = "./tmp/";
        if(!is_dir($cDir)){
            @mkdir($cDir, 0777,true);
        }
        $config    = array("upload_path"=>$cDir,"allowed_types"=>"*","overwrite"=>true) ;
        $this->upload->initialize($config);
        // print_r($_FILES['vaFile']);
        $nTotalFile = count($_FILES['vaFile']['name']);
        for($i = 0; $i < $nTotalFile; $i++){
            $_FILES["file"]["name"]     = $cFileName.$_FILES["vaFile"]["name"][$i];
            $_FILES["file"]["type"]     = $_FILES["vaFile"]["type"][$i];
            $_FILES["file"]["tmp_name"] = $_FILES["vaFile"]["tmp_name"][$i];
            $_FILES["file"]["error"]    = $_FILES["vaFile"]["error"][$i];
            $_FILES["file"]["size"]     = $_FILES["vaFile"]["size"][$i];
            
            if ( ! $this->upload->do_upload("file") ){
                echo('
                    alert("'. $this->upload->display_errors('','') .'") ;
                ') ;
            }else{
                $data        = $this->upload->data() ;
                $fname       = "vaFile" . $data['file_ext'] ;
                $tname       = str_replace($data['file_ext'], "", $data['client_name']) ;
                $vaFile[$i]  = array( $tname => $data['full_path']) ;
                savesession("ss_download_vaFile", $vaFile ) ;
                echo 'ok';
            }
        }
    }

    public function detail()
    {
        //var def uri segment
        savesession("ss_download_vaFile" , "") ;
		$uri2  = $this->uri->segment(2);
		$uri3  = $this->uri->segment(3);
        $uri4  = $this->uri->segment(4);
        $cKode = $uri4;
        $data  = array();
        $vaData = $this->Download_model->getDetailDownload($cKode);
        if(count($vaData) > 0){
            $data=$vaData;
        }
        j($data);
    }
    
    public function delete(){
        $va 	= $this->input->post() ;
        $this->Download_model->delete($va['cKodeHapus']) ;    
    }
}