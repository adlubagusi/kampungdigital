<?php
class SuratMasuk extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('SuratMasuk_model');
        $this->load->model('FuncDB_model');
		$this->load->library('upload');
	}


	public function index(){
        savesession("ss_surat_masuk_vaFile" , "") ;
		$nID=$this->session->userdata('idadmin');
		$a['p']    = 'suratmasuk/v_suratmasuk';
        $a['title'] = "Surat Masuk";
        $this->load->view('admin/index',$a);
    }

    public function getData()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->SuratMasuk_model->getDataSuratMasuk($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = $d['Kode'];
            $data_ok[] = $d['Perihal'];
            $data_ok[] = $d['NoSurat'];
            $data_ok[] = string2Date($d['Tgl']);
            $data_ok[] = $d['Dari'];
            $data_ok[] = $d['UserName'];
            $data_ok[] = '<div class="btn-group">
                      <a href="#" onclick="return surat_masuk_edit(`'.$d['Kode'].'`);" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                      <a href="#" onclick="return surat_masuk_hapus(`'.$d['Kode'].'`);" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
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
        savesession("ss_surat_masuk_vaFile" , "") ;
		$uri2  = $this->uri->segment(2);
		$uri3  = $this->uri->segment(3);
        $uri4  = $this->uri->segment(4);
        $cKode = $uri4;
        $data  = array();
        $vaData = $this->SuratMasuk_model->getDetailSuratMasuk($cKode);
        if(count($vaData) > 0){
            $data=$vaData;
        }
        $data['File'] = $this->getFileSuratMasuk($cKode);
        j($data);
    }

    public function getFileSuratMasuk($cKode)
    {
        $vaData = [];
        $vaFile = $this->SuratMasuk_model->getFileSuratMasuk($cKode);
        foreach($vaFile as $file){
            $cPathWO     = $file['FilePath'];
            $cFileSize   = "0.00";
            $cNamaFileWO = "File Not Found";
            if(file_exists($cPathWO)){
                $nFileSize      = filesize($cPathWO);
                $vaPathWO       = explode("/",$cPathWO);
                $cNamaFileWO    = end($vaPathWO); 
                $cFileSize      = formatSizeUnits($nFileSize);
            }
            $file['FileSize'] = $cFileSize;
            $file['FileName'] = $cNamaFileWO;
            $vaData[] = $file;
        }
        return $vaData;
    }

    public function save(){
        $va         = $this->input->post();
        // print_r($va);

        $vaKode         = $va['cKode'];
        if($vaKode == "" || trim(empty($vaKode))){
            $cKode = $this->SuratMasuk_model->getKodeSurat() ;
        }else{
            $cKode = $vaKode ;
        }
        $va['cKode'] = $cKode;
        $cPerihal   = $va['cPerihal'];
        $cNoSurat   = $va['cNoSurat'];
        $cDari      = $va['cDari'];
        $dTgl       = $va['dTgl'];
        $cDeskripsi = $va['cDeskripsi'];
        $cUserName  = getSession("username");
        $nYear      = date('Y');
        $cKategori  = "/SuratMasuk";
        $adir       = $this->config->item('upload_dokumen_dir') . $nYear . $cKategori ;
        if(!is_dir($adir)){
            mkdir($adir,0777,true);
        }
        $upload         = array("vaFile"=>getSession("ss_surat_masuk_vaFile")) ;
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
                                $this->SuratMasuk_model->saveFile($va) ;
                            }
                        }
                    }
                }
            }
        }
        $saving = $this->SuratMasuk_model->save($cKode,$dTgl,$cNoSurat,$cDari,$cPerihal,$cDeskripsi,$cUserName) ;
        savesession("ss_surat_masuk_vaFile" , "") ;
        echo ('OK');
    }

   
    public function delete(){
        $va 	= $this->input->post() ;
        $this->SuratMasuk_model->delete($va['cKodeHapus']) ;    
    }

    public function deleteFile()
    {
        $va 	  = $this->input->post() ;
        $cID      = $va['cID'];
        $this->SuratMasuk_model->deleteFilePerID($cID);
    }

    public function savingFile()
    {
        savesession("ss_surat_masuk_vaFile" , "") ;
        $cFileName = "SuratMasuk_". date_now();
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
                savesession("ss_surat_masuk_vaFile", $vaFile ) ;
            
            }
        }
    }

}