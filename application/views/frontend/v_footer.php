<footer class="footer-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>About Us</h6>
            <p>
              <?= getCfg("msDeskripsiSingkat")?>
            </p>
          </div>
        </div>
        <div class="col-lg-4  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Buletin</h6>
            <p>Tetap update dengan postingan terbaru kami</p>
            <div class="" id="mc_embed_signup">

              <form novalidate="true" id="f_newsletter" method="post" class="form-inline">
                <div class="d-flex flex-row">

                  <input id="cEmailNewsLetter" class="form-control" name="cEmail" placeholder="Masukkan Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                    required="" type="email">


                  <button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
                  <div style="position: absolute; left: -5000px;">
                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                  </div>

                  <!-- <div class="col-lg-4 col-md-4">
                        <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                      </div>  -->
                </div>
                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget mail-chimp">
            <!-- <h6 class="mb-20">Instragram Feed</h6>
            <ul class="instafeed d-flex flex-wrap">
              <li><img src="<?=base_url()?>template/img/instagram/i1.jpg" alt=""></li>
              <li><img src="<?=base_url()?>template/img/instagram/i2.jpg" alt=""></li>
              <li><img src="<?=base_url()?>template/img/instagram/i3.jpg" alt=""></li>
              <li><img src="<?=base_url()?>template/img/instagram/i4.jpg" alt=""></li>
              <li><img src="<?=base_url()?>template/img/instagram/i5.jpg" alt=""></li>
              <li><img src="<?=base_url()?>template/img/instagram/i6.jpg" alt=""></li>
              <li><img src="<?=base_url()?>template/img/instagram/i7.jpg" alt=""></li>
              <li><img src="<?=base_url()?>template/img/instagram/i8.jpg" alt=""></li>
            </ul> -->
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Follow Us</h6>
            <p>Let us be social</p>
            <div class="footer-social d-flex align-items-center">
              <?php
                foreach ($vaDataSocmed as $key => $i) {
                  $cSocmed_keterangan = $i["Keterangan"];
                  $cSocmed_icon = $i["Icon"];
                  $cSocmed_link = $i["Link"];
              ?>
              <a href="<?php echo $cSocmed_link;?>" target="_blank">
                <i class="fab <?php echo $cSocmed_icon?>"></i>
              </a>
              <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |  Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://banatechindo.com" target="_blank">Banatech Indonesia</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      </div>
    </div>
  </footer>
