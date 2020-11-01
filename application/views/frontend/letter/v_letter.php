<section class="blog-post-area section-margin">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <?php
            for($i = 0; $i < 8; $i++){


          ?>
          <div class="col-md-3">
            <div class="single-recent-blog-post card-view">
              <div class="thumb">
                <img class="card-img rounded-0" src="<?=base_url()?>template/img/blog/thumb/thumb-card1.png" alt="">

              </div>
              <div class="details mt-20">
                <a href="blog-single.html">
                  <h3>Fast cars and rickety bridges as
                      he grand tour returns</h3>
                </a>
                <a class="button" href="#" style="width: 100%;text-align: center;">Download <i class="ti-arrow-right"></i></a>
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
