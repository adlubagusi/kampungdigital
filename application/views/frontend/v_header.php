<header class="header_area">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container box_1620">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand logo_h" href="<?=base_url()?>"><img src="<?=base_url()?>assets/images/logo-karang-taruna.png" alt="" style="width:100px;height:100px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <?= gen_menu();?>
          <ul class="nav navbar-nav navbar-right navbar-social">
            <?php
              foreach ($vaDataSocmed as $key => $i) {
                $cSocmed_keterangan = $i["Keterangan"];
                $cSocmed_icon = $i["Icon"];
                $cSocmed_link = $i["Link"];
            ?>
            <li><a href="<?php echo $cSocmed_link;?>"><i class="fab <?php echo $cSocmed_icon?>"></i></a></li>
            <?php
              }
            ?>

          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
