<section class="blog-post-area section-margin">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row" id="data-blog">
          
          <div class="col-md-6">
            <div class="single-recent-blog-post card-view">
              <div class="thumb">
                <img class="card-img rounded-0" src="<?=base_url()?>template/img/blog/thumb/thumb-card1.png" alt="">
                <ul class="thumb-info">
                  <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                  <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                </ul>
              </div>
              <div class="details mt-20">
                <a href="blog-single.html">
                  <h3>Fast cars and rickety bridges as
                      he grand tour returns</h3>
                </a>
                <p>Vel aliquam quis, nulla pede mi commodo no tristique nam hac luctus torquent velit felis lone commodo pellentesque</p>
                <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>
        
        </div>

        <div class="row">
          <div class="col-lg-12">
              <nav class="blog-pagination justify-content-center d-flex">
                  <ul class="pagination" id="data-pagination">
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
      <!-- Start Blog Post Siddebar -->
      <?php $this->load->view('frontend/home/v_sidebar')?>
        <!-- End Blog Post Siddebar -->
    </div>
</section>
