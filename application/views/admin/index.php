<!--Counter Inbox-->
<?php
    //error_reporting(0);
    $query=$this->db->query("SELECT * FROM tbl_inbox WHERE Status='0'");
    $query2=$this->db->query("SELECT * FROM tbl_komentar WHERE Status='0'");
    $jum_comment=$query2->num_rows();
    $jum_pesan=$query->num_rows();
    $a['jum_comment'] = $jum_comment;
    $a['jum_pesan']   = $jum_pesan;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $this->config->item('nama_aplikasi')?> | <?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/select2/select2.min.css'?>">
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
  <script src="<?php echo base_url().'assets/plugins/sweetalert2/dist/sweetalert2.min.js'?>"></script>
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/sweetalert2/dist/sweetalert2.min.css'?>">
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- SELECT2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/id.js" type="text/javascript"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!--Header-->
  <?php
    $this->load->view('admin/v_header');

    $this->load->view('admin/v_sidebar',$a);
  ?>

    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php 
        $this->load->view('admin/'.$p,$a);    
    ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
       Database: <b><?=$this->db->database;?></b> | <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018 <a href="http://banatechindo.com">Banatech Indonesia</a>.</strong> All rights reserved.
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!-- <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script> -->
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
<!-- CKEDITOR -->
<script src="<?php echo base_url().'assets/ckeditor/ckeditor.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url().'assets/plugins/chartjs/Chart.min.js'?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script>
  var base_url = '<?= base_url()?>';
  getDataInbox();
  getDataKomentarBlog();
  getDataKomentarBidangUsaha();

  // interval function 
  setInterval(function(){
    getDataInbox();
    getDataKomentarBlog();
    getDataKomentarBidangUsaha();
  }, 7000);

  //get url
  function getSiteUrl(){
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('/');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }
  var get_url = getSiteUrl();
	var url = get_url[4];
	var url2 = get_url[5];
	var url3 = get_url[6];
  
  function pagination(indentifier, url, config) {
    $('#'+indentifier).DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
        },
        "ordering": false,
        "columnDefs": config,
        "bProcessing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax":{
            url : url,
            type: "post",
            error: function(){
                $("#"+indentifier).css("display","none");
            }
        }
    });
  }

  function getDataInbox(){
    $.ajax({
        type: "GET",
        url: base_url+"admin/inbox/countUnreadInbox",
        success: function(reply) {
            // console.log(reply);
            $(".countinbox").text(reply);
        }
    });
  }

  function getDataKomentarBlog(){
    $.ajax({
        type: "GET",
        url: base_url+"admin/komentar/countUnreadComment/blog",
        success: function(reply) {
            // console.log(reply);
            $(".countblog-komentar").text(reply);
        }
    });
  }
  function getDataKomentarBidangUsaha(){
    $.ajax({
        type: "GET",
        url: base_url+"admin/komentar/countUnreadComment/bidangusaha",
        success: function(reply) {
            // console.log(reply);
            $(".countbidangusaha-komentar").text(reply);
        }
    });
  }

</script>
<?php 
    //load javascript
    $this->load->view('admin/'.$p."-js",$a);    
?>

</body>
</html>
