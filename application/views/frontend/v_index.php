<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= getCfg("msDeskripsiSEO")?>">
  <meta name="keywords" content="<?=getCfg("msKeywordsSEO")?>">
  <meta name="author" content="<?=$this->config->item("copyright")?>">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?=$this->config->item('nama_aplikasi')?> - <?=$title?></title>
	<link rel="icon" href="<?=base_url()?>template/img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="<?=base_url()?>template/vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/linericon/style.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="<?=base_url()?>template/css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
</head>
<body>
  <!--================Header Menu Area =================-->
  <?php $this->load->view('frontend/v_header');?>
  <!--================Header Menu Area =================-->
  
  <main class="site-main">
    <?php $this->load->view($p);?>
  </main>

  <!--================ Start Footer Area =================-->
  <?php $this->load->view('frontend/v_footer');?>
  <!--================ End Footer Area =================-->
  <script src="<?=base_url()?>template/vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?=base_url()?>template/vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>template/vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="<?=base_url()?>template/js/jquery.ajaxchimp.min.js"></script>
  <script src="<?=base_url()?>template/js/mail-script.js"></script>
  <script src="<?=base_url()?>template/js/main.js"></script>
  <script>
    var base_url = '<?=base_url()?>';
  </script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
  <script src="<?=base_url()?>assets/plugins/leaflet/leaflet.ajax.js"></script>
   <?php 
    //load javascript
    $this->load->view($p."-js");    
  ?>
</body>
</html>