<section class="blog-post-area section-margin">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <?php
          foreach ($vaData as $key => $i) {
              $cBidangUsaha_Nama = $i['NamaUsaha'];
              $cBidangUsaha_Foto = $i['Foto'];
              $cBidangUsaha_Id = $i['ID'];
              $cBidangUsaha_Kode = $i['Kode'];

          ?>
          <div class="col-md-3">
            <div class="single-recent-blog-post card-view">
              <div class="thumb">
                <img class="card-img rounded-0" src="<?=base_url()?>assets/images/bidangusaha/<?php echo $cBidangUsaha_Foto?>" alt="">

              </div>
              <div class="details mt-20">
                <a href="#">
                  <h3><?php echo $cBidangUsaha_Nama?></h3>
                </a>
                <a href="<?=base_url()?>business/<?php echo $cBidangUsaha_Kode;?>" class="button" href="#" style="width: 100%;text-align: center;"> Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>



        <div class="row">
          <div class="col-lg-12">
              <nav class="blog-pagination justify-content-center d-flex">
                  <ul class="pagination">
                      <li class="page-item">
                          <a href="#" class="page-link" aria-label="Previous">
                              <span aria-hidden="true">
                                  <i class="ti-angle-left"></i>
                              </span>
                          </a>
                      </li>
                      <li class="page-item active"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item">
                          <a href="#" class="page-link" aria-label="Next">
                              <span aria-hidden="true">
                                  <i class="ti-angle-right"></i>
                              </span>
                          </a>
                      </li>
                  </ul>
              </nav>
          </div>
        </div>
      </div>

</section>
