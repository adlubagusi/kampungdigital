<?php
class BidangUsaha extends CI_Controller{
    function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
        $this->load->model('BidangUsaha_model');
        $this->mdl = $this->BidangUsaha_model;
		$this->load->library('upload');
    }

    public function index()
    {
        savesession("ss_bidang_usaha_vaFile" , "") ;
        $a['p']          = 'bidangusaha/v_bidangusaha';
        $a['title']      = "Bidang Usaha";
        $a['vaJenisUsaha'] = $this->mdl->getAllJenisUsaha();
        $this->load->view('admin/index',$a);
    }

    public function getdata()
    {
        $va         = $this->input->post();
        $nStart     = $va['start'];
        $nLength    = $va['length'];
        $cDraw      = $va['draw'];
        $cSearch    = $va['search'];

        $vaData = $this->mdl->getDataBidangUsaha($nStart,$nLength,$cDraw,$cSearch);
        // print_r($vaData);
        // exit;
        $data = array();
        $no = ($nStart+1);
        foreach ($vaData['data'] as $d) {
            $data_ok = array();
            $data_ok[] = $no++;
            $data_ok[] = '<img src="'.base_url().'assets/images/bidangusaha/'.$d['Foto'].'" width="150px">';
            $data_ok[] = $d['NamaOwner'];
            $data_ok[] = $d['NamaUsaha'];
            $data_ok[] = $d['HP'];
            $data_ok[] = $d['KeteranganJenisUsaha'];
            $data_ok[] = '<div class="btn-group">
                        <a href="#" onclick="return bidangusaha_edit(`'.$d['Kode'].'`);" class="btn btn-info btn-xs"><i class="fa fa-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                        <a href="#" onclick="return bidangusaha_hapus(`'.$d['Kode'].'`);" class="btn btn-danger btn-xs"><i class="fa fa-times" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
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
        savesession("ss_bidang_usaha_vaFile" , "") ;
		$uri2  = $this->uri->segment(2);
		$uri3  = $this->uri->segment(3);
        $uri4  = $this->uri->segment(4);
        $cKode = $uri4;
        $data  = array();
        $vaData = $this->mdl->getDetailBidangUsaha($cKode);
        if(count($vaData) > 0){
            $data=$vaData;
        }
        $data['File'] = $this->getFileBidangUsaha($cKode);
        j($data);
    }
    
    public function save(){
        $va         = $this->input->post();
        $cError     = "";
        $vaKode         = $va['cKode'];
        if($vaKode == "" || trim(empty($vaKode))){
            $cKode = $this->mdl->getKode() ;
        }else{
            $cKode = $vaKode ;
        }
        $va['cKode']  = $cKode;
        $cNamaOwner   = $va['cNamaOwner'];
        $cNamaUsaha   = $va['cNamaUsaha'];
        $cAlamatUsaha = $va['cAlamatUsaha'];
        $cHP          = $va['cHP'];
        $cDeskripsi   = $va['cDeskripsi'];
        $cJenisUsaha  = $va['optJenisUsaha'];
        $cUserName    = getSession("username");
        $cSlug        = $va['cSlug'];
        
        $config['upload_path'] = './assets/images/bidangusaha/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'],0777,true);
        }
        $cFoto     = "";
        $this->upload->initialize($config);
        if(!empty($_FILES['cFileFoto']['name'])){
            if ($this->upload->do_upload('cFileFoto')){
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/images/bidangusaha/'.$gbr['file_name'];
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '60%';
                    $config['width']= 710;
                    $config['height']= 410;
                    $config['new_image']= './assets/images/bidangusaha/'.$gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $cFoto    = $gbr['file_name'];
            }else{
                $cError.= "error upload gambar";
            }
        }

        $nYear        = date('Y');
        $cKategori    = "/BidangUsaha";
        $adir         = $this->config->item('upload_file_dir') . $nYear . $cKategori ;
        if(!is_dir($adir)){
            mkdir($adir,0777,true);
        }
        $vaUploadFile     = array("vaFile"=>getSession("ss_bidang_usaha_vaFile")) ;
        $va['FilePath'] = ""; 
        $dir            = "" ;
        // print_r($upload);
        // exit;
        if(!empty($vaUploadFile)){
            //$this->mdl->deleteFile($va) ;
            foreach ($vaUploadFile as $key => $value) {
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
                                $this->mdl->saveFile($va) ;
                            }
                        }
                    }
                }
            }
        }
        $saving = $this->mdl->save($cKode,$cNamaOwner,$cNamaUsaha,$cAlamatUsaha,$cHP,
                                    $cDeskripsi,$cJenisUsaha,$cUserName,$cFoto,$cSlug);
        savesession("ss_bidang_usaha_vaFile" , "") ;
        if($cError == "") $cError.= "ok";
        echo $cError;
    }

    public function savingFile()
    {
        savesession("ss_bidang_usaha_vaFile" , "") ;
        $cFileName = "BidangUsaha_". date_now();
        
        $cDir      = "./tmp/";
        if(!is_dir($cDir)){
            @mkdir($cDir, 0777,true);
        }
        $config    = array("upload_path"=>$cDir,"allowed_types"=>"*","overwrite"=>true) ;
        $this->upload->initialize($config);
        // print_r($_FILES['vaFile']);
        $nTotalFile = count($_FILES['vaFile']['name']);
        for($i = 0; $i < $nTotalFile; $i++){
            $_FILES["file"]["name"]     = $cFileName."_".$_FILES["vaFile"]["name"][$i];
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
                savesession("ss_bidang_usaha_vaFile", $vaFile ) ;
            
            }
        }
    }

    public function getFileBidangUsaha($cKode)
    {
        $vaData = [];
        $vaFile = $this->mdl->getFileBidangUsaha($cKode);
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

    public function delete(){
        $va 	= $this->input->post() ;
        $this->mdl->delete($va['cKodeHapus']) ;    
    }

    public function deleteFile()
    {
        $va 	  = $this->input->post() ;
        $cID      = $va['cID'];
        $this->mdl->deleteFilePerID($cID);
    }
}