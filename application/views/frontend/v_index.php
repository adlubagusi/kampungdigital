<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sensive Blog - Home</title>
	<link rel="icon" href="<?=base_url()?>template/img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="<?=base_url()?>template/vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/linericon/style.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?=base_url()?>template/vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="<?=base_url()?>template/css/style.css">
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
</body>
</html>