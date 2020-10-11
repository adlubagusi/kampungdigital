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
  
  $menu = array(
      ["icon"=>"fa-home", "url"=>"dashboard", "text"=>"Dashboard"], //menu biasa
      ["icon"=>"fa-users", "url"=>"pengguna", "text"=>"Pengguna"],
      ["icon"=>"fa-newspaper-o", "url"=>"blog", "text"=>"Blog", "submenu"=>[      //menu spesial    
          ["icon"=>"fa-list", "url"=>"blog", "text"=>"List Postingan"], //
          ["icon"=>"fa-wrench", "url"=>"blog-kategori", "text"=>"Kategori"] //
      ]],                                                                    //
      ["icon"=>"fa-gear", "url"=>"about", "text"=>"Setting", "submenu"=>[            
          ["icon"=>"fa-file-o", "url"=>"about", "text"=>"Teks About Us"]  
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
    if(isset($m['submenu'])){
      $vaSubmenu = $m['submenu'];
      echo '<ul class="treeview-menu">';
      foreach($vaSubmenu as $sm){
        echo '<li><a href="'.base_url().'admin/'.$sm['url'].'"><i class="fa '.$sm['icon'].'"></i> '.$sm['text'].'</a></li>';
      }
      echo '</ul>';
    }      
    echo '</a>';
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
  $dbd  = $CI->db->query("UPDATE tbl_config SET Keterangan='$cKeterangan' WHERE Kode='$cKode'");  
}