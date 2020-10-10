<?php

function j($data) {
	$CI 	=& get_instance();
	header('Content-Type: application/json');
	echo json_encode($data);
}

function getSession($cKode){
	$CI 	    = & get_instance();
  $cSession = $CI->session->userdata($cKode);
  return $cSession;
}

function gen_menu()
{
    $CI 	=& get_instance();
    $url = $CI->uri->segment(1);
    
    $menu = array(
        array("icon"=>"", "url"=>"", "text"=>"Home"),
        array("icon"=>"", "url"=>"about", "text"=>"Tentang Kami"),
        array("icon"=>"", "url"=>"blog", "text"=>"Blog"),
        array("icon"=>"", "url"=>"contact", "text"=>"Kontak")
      );

    if ($menu != null) {
      echo '
            <ul class="nav navbar-nav menu_nav justify-content-center">';
                foreach($menu as $m){
                  if ($url == $m['url']) {
                      echo   '<li class="nav-item active">
                                  <a class="nav-link" href="'.base_url().''.$m['url'].'">'.$m['text'].'</a>
                              </li>';
                  }else{
                      echo   '<li class="nav-item">
                                  <a class="nav-link" href="'.base_url().''.$m['url'].'">'.$m['text'].'</a>
                              </li>';
                  }
                } 
          echo'
            </ul>
          ' ; 
    }
}

function gen_menu_admin(){
  $CI 	=& get_instance();
  $url = $CI->uri->segment(2);
  return $url;
}

function getCfg($cKode,$cDefault=""){
  $CI 	=& get_instance();
  $cVal  = $cDefault;
  $query = $CI->db->query("SELECT Kode,Keterangan FROM tbl_config WHERE Kode='$cKode'");
  if($data = $query->row()){
    $cVal = $data->Keterangan;
  }
  return $cVal;
}

function saveCfg($cKode,$cKeterangan){
  $CI 	=& get_instance();
  $dbd  = $CI->db->query("UPDATE tbl_config SET Keterangan='$cKeterangan' WHERE Kode='$cKode'");  
}