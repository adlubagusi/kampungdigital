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
        array("icon"=>"", "url"=>"contact", "text"=>"Kontak"),
				array("icon"=>"", "url"=>"letter", "text"=>"Surat")
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

  $menu = array(
      ["icon"=>"fa-home", "url"=>"dashboard", "text"=>"Dashboard"], //menu biasa
      ["icon"=>"fa-users", "url"=>"pengguna", "text"=>"Pengguna"],
      ["icon"=>"fa-envelope", "url"=>"suratmasuk", "text"=>"Surat Masuk", "submenu"=>[
        ["icon"=>"fa-envelope-o", "url"=>"suratmasuk-list", "text"=>"List Surat Masuk"]
      ]],
      ["icon"=>"fa-newspaper-o", "url"=>"blog", "text"=>"Blog", "submenu"=>[      //menu spesial
          ["icon"=>"fa-list", "url"=>"blog", "text"=>"List Postingan"], //
          ["icon"=>"fa-wrench", "url"=>"blog-kategori", "text"=>"Kategori"] //
      ]],                                                                    //
      ["icon"=>"fa-gear", "url"=>"setting", "text"=>"Pengaturan", "submenu"=>[
          ["icon"=>"fa-file-o", "url"=>"setting-general", "text"=>"Pengaturan Umum"],
          ["icon"=>"fa-file-o", "url"=>"setting-about", "text"=>"Teks About Us"]
      ]],
      ["icon"=>"fa-sign-out", "url"=>"logout", "text"=>"Logout"],
  );


  $vaMenu = $menu;
  foreach($vaMenu as $k=>$m){
    $cUrl  = "#";

    $cActive = "";
    if($m['url'] <> "") $cUrl = base_url()."admin/".$m['url'];
    $cIcon = $m['icon'];
    $cText = $m['text'];
    $cIconRight = '<small class="label pull-right"></small>';
    if(isset($m['submenu'])) $cIconRight = '<i class="fa fa-angle-left pull-right"></i>';
    $vaUrl     = explode('-',$url);
    if($url == $m['url'] || $vaUrl[0] == $m['url']) $cActive = "active";
    echo '<li class="'.$cActive.'">
            <a href="'.$cUrl.'">
            <i class="fa '.$cIcon.'"></i>
            <span>'.$cText.'</span>';
    echo '  <span class="pull-right-container">
              '.$cIconRight.'
            </span>';
    echo '  </a>';
    if(isset($m['submenu'])){
      $vaSubmenu = $m['submenu'];
      echo '<ul class="treeview-menu">';
      foreach($vaSubmenu as $sm){
        echo '<li><a href="'.base_url().'admin/'.$sm['url'].'"><i class="fa '.$sm['icon'].'"></i> '.$sm['text'].'</a></li>';
      }
      echo '</ul>';
    }
    echo '</li>';
  }
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
  $dbData = $CI->db->query("SELECT * FROM tbl_config WHERE Kode='$cKode'");
  if($dbRow = $dbData->row()){
    $dbd  = $CI->db->query("UPDATE tbl_config SET Keterangan='$cKeterangan' WHERE Kode='$cKode'");
  }else{
    $dbd  = $CI->db->query("INSERT INTO tbl_config (Kode, Keterangan) VALUES('$cKode','$cKeterangan')");
  }

}

function getVal($cKode,$cField,$cTable,$cWhereField="Kode"){
  $CI 	=& get_instance();
  $cVal   = "";
  $dbData = $CI->db->query("SELECT $cField FROM $cTable WHERE $cWhereField='$cKode'");
  if($dbRow = $dbData->row()){
    $cVal = $dbRow->$cField;
  }
  return $cVal;
}


function savesession($cKey, $cVal)
{
  $CI 	=& get_instance();
  $CI->session->set_userdata($cKey, $cVal);
}


function formatSizeUnits($bytes){
  if ($bytes >= 1073741824){
      $bytes = number_format($bytes / 1073741824, 2) . ' GB';
  }else if ($bytes >= 1048576){
      $bytes = number_format($bytes / 1048576, 2) . ' MB';
  }else if ($bytes >= 1024){
      $bytes = number_format($bytes / 1024, 2) . ' KB';
  }else if ($bytes > 1){
      $bytes = $bytes . ' bytes';
  }else if ($bytes == 1){
      $bytes = $bytes . ' byte';
  }else{
      $bytes = '0 bytes';
  }
  return $bytes;
}
