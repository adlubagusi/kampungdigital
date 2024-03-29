<style>
.job-description {
  background-color: white;
  height: 500px;
  width: 100%;
  overflow-y: scroll;
  color: black;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  padding: 20px;
  box-shadow: 4px 4px #888888;
  border-radius: 10px;
}
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #282828;
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #888;
}
</style>
  <section id="content">
    <div class="container">
      <div class="row">
        <div class="container">
        <div class="hero-banner" style="background: url(<?=base_url()?>assets/images/struktur.png) left center no-repeat;"></div>
        </div>

        <!-- <div class="span6">
          <h4><?php echo $cAbout_Judul;?></h4>
          <?php echo $cAbout_Deskripsi;?>
        </div> -->
<!--
        <div class="span6">
          <iframe src="http://player.vimeo.com/video/24535181?title=0&amp;byline=0" width="500" height="281" seamless></iframe>
        </div> -->
      </div>
      <section class="blog-post-area section-margin" style="margin-bottom: 0px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h1>Foto-Foto Panitian Karang Taruna Sumbersari RW 03</h1>
              <div class="row">
                <?php
                foreach ($vaDataPanitia['data'] as $key => $i) {
                    $cPanitia_nama = $i['UserName'];
                    $cPanitia_jabatan = $i['Jabatan'];
                    $cPanitia_foto = $i['Foto'];
                ?>
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/assets/images/pp/<?php echo $cPanitia_foto;?>" alt="">
                      <ul class="thumb-info" style="position: relative;">
                        <li style="display: block;"><a href="#"><i class="ti-user"></i><?php echo $cPanitia_nama;?></a></li>
                        <li><a href="#"><i class="ti-themify-favicon"></i><?php echo $cPanitia_jabatan;?></a></li>
                      </ul>
                    </div>

                  </div>
                </div>
                <?php
                }
                ?>
              </div>

            </div>

            </div>
          </div>
        </section>
      <!-- <section class="blog-post-area section-margin" style="margin-bottom: 0px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h1>Foto-Foto Panitian Karang Taruna Sumbersari RW 03</h1>
              <div class="row">
                <?php
                  for($i = 0; $i < 24; $i++){
                ?>
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card1.png" alt="">
                      <ul class="thumb-info" style="position: relative;">
                        <li style="display: block;"><a href="#"><i class="ti-user"></i>gigih prasetya</a></li>
                        <li><a href="#"><i class="ti-themify-favicon"></i>Ketua</a></li>
                      </ul>
                    </div>

                  </div>
                </div>
                <?php
                }
                ?>
              </div>

            </div>

            </div>
          </div>
        </section> -->

      <div class="row">
        <div class="col-lg-12">
          <h1>JOB DESKRIPSI KEPENGURUSAN</h1>
          <div class="job-description">
            <?php echo $cAbout_Deskripsi;?>
          </div>
        </div>
      </div>

      <!-- divider -->
      <!-- <div class="row">
        <div class="span12">
          <div class="solidline"></div>
        </div>
      </div> -->
      <!-- end divider -->

    </div>
  </section>
