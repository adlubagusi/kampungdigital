<style>
  #sendmessage {
    color: green;
    border: 1px solid green;
    display: none;
    text-align: center;
    padding: 15px;
    font-weight: 600;
    margin-bottom: 15px;
  }
  #errormessage {
    color: red;
    border: 1px solid red;
    display: none;
    text-align: left;
    padding: 15px;
    font-weight: 600;
    margin-bottom: 15px;
  }
</style>
<section class="blog-post-area section-margin">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
          <div class="main_blog_details">
              <img class="img-fluid" src="<?=base_url()?>assets/images/blog/<?php echo $cData_Foto?>" alt="">
              <a href="#"><h4><?php echo $cData_Judul?></h4></a>
              <div class="user_details">
                <div class="float-left">
                  <a href="<?=base_url().'c/'.$cData_kategori_link?>"><?=$cData_kategori?></a>
                </div>
                <div class="float-right mt-sm-0 mt-3">
                  <div class="media">
                    <div class="media-body">
                      <h5><?php echo $cData_Author?></h5>
                      <p>12 Dec, 2017 11:21 am</p>
                    </div>
                    <div class="d-flex">
                      <img width="42" height="42" src="<?=base_url()?>template/img/blog/user-img.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
              <?php echo $cData_Deskripsi?>
             <div class="news_d_footer flex-column flex-sm-row" style="display:none">
                <a href="#"><span class="align-middle mr-2"><i class="ti-heart"></i></span>Lily and 4 people like this</a>
                <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#"><span class="align-middle mr-2"><i class="ti-themify-favicon"></i></span>06 Comments</a>
                <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-dribbble"></i></a>
                    <a href="#"><i class="fab fa-behance"></i></a>
                </div>
             </div>
            </div>


            <div class="navigation-area" style="display:none">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                        <div class="thumb">
                            <a href="#"><img class="img-fluid" src="<?=base_url()?>template/img/blog/prev.jpg" alt=""></a>
                        </div>
                        <div class="arrow">
                            <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
                        </div>
                        <div class="detials">
                            <p>Prev Post</p>
                            <a href="#"><h4>A Discount Toner</h4></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                        <div class="detials">
                            <p>Next Post</p>
                            <a href="#"><h4>Cartridge Is Better</h4></a>
                        </div>
                        <div class="arrow">
                            <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
                        </div>
                        <div class="thumb">
                            <a href="#"><img class="img-fluid" src="<?=base_url()?>template/img/blog/next.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="comments-area" style="display:none">
                  <h4>05 Comments</h4>
                  <div class="comment-list">
                      <div class="single-comment justify-content-between d-flex">
                          <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                  <img src="<?=base_url()?>template/img/blog/c1.jpg" alt="">
                              </div>
                              <div class="desc">
                                  <h5><a href="#">Emilly Blunt</a></h5>
                                  <p class="date">December 4, 2017 at 3:12 pm </p>
                                  <p class="comment">
                                      Never say goodbye till the end comes!
                                  </p>
                              </div>
                          </div>
                          <div class="reply-btn">
                                  <a href="" class="btn-reply text-uppercase">reply</a>
                          </div>
                      </div>
                  </div>
                  <div class="comment-list left-padding">
                      <div class="single-comment justify-content-between d-flex">
                          <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                  <img src="<?=base_url()?>template/img/blog/c2.jpg" alt="">
                              </div>
                              <div class="desc">
                                  <h5><a href="#">Elsie Cunningham</a></h5>
                                  <p class="date">December 4, 2017 at 3:12 pm </p>
                                  <p class="comment">
                                      Never say goodbye till the end comes!
                                  </p>
                              </div>
                          </div>
                          <div class="reply-btn">
                                  <a href="" class="btn-reply text-uppercase">reply</a>
                          </div>
                      </div>
                  </div>
                  <div class="comment-list left-padding">
                      <div class="single-comment justify-content-between d-flex">
                          <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                  <img src="<?=base_url()?>template/img/blog/c3.jpg" alt="">
                              </div>
                              <div class="desc">
                                  <h5><a href="#">Annie Stephens</a></h5>
                                  <p class="date">December 4, 2017 at 3:12 pm </p>
                                  <p class="comment">
                                      Never say goodbye till the end comes!
                                  </p>
                              </div>
                          </div>
                          <div class="reply-btn">
                                  <a href="" class="btn-reply text-uppercase">reply</a>
                          </div>
                      </div>
                  </div>
                  <div class="comment-list">
                      <div class="single-comment justify-content-between d-flex">
                          <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                  <img src="<?=base_url()?>template/img/blog/c4.jpg" alt="">
                              </div>
                              <div class="desc">
                                  <h5><a href="#">Maria Luna</a></h5>
                                  <p class="date">December 4, 2017 at 3:12 pm </p>
                                  <p class="comment">
                                      Never say goodbye till the end comes!
                                  </p>
                              </div>
                          </div>
                          <div class="reply-btn">
                                  <a href="" class="btn-reply text-uppercase">reply</a>
                          </div>
                      </div>
                  </div>
                  <div class="comment-list">
                      <div class="single-comment justify-content-between d-flex">
                          <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                  <img src="<?=base_url()?>template/img/blog/c5.jpg" alt="">
                              </div>
                              <div class="desc">
                                  <h5><a href="#">Ina Hayes</a></h5>
                                  <p class="date">December 4, 2017 at 3:12 pm </p>
                                  <p class="comment">
                                      Never say goodbye till the end comes!
                                  </p>
                              </div>
                          </div>
                          <div class="reply-btn">
                                  <a href="" class="btn-reply text-uppercase">reply</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div>
                  <h4>Leave a Reply</h4>
                  <div id="sendmessage"></div>
                  <div id="errormessage"></div>
                  <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                      <input type="hidden" id="cBlogId" name="cBlogId" value="<?php echo $cData_Id;?>">
                      <div class="form-group form-inline">
                        <div class="form-group col-lg-6 col-md-6 name" style="padding-left: 0;">
                          <input type="text" class="form-control" id="cName" name="cName" placeholder="Masukkan Nama Anda" style="width: 100%;">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 email">
                          <input type="email" class="form-control" id="cEmail" name="cEmail" placeholder="Masukkan Alamat Email Anda" style="width: 100%;">
                        </div>
                      </div>
                      <div class="form-group">
                          <textarea class="form-control mb-10" rows="5" name="cMessage" id="cMessage" placeholder="Masukkan Pesan Anda" required="" style="height: 120px;"></textarea>
                      </div>
                      <button type="submit" class="button button--active button-contactForm">Kirim Pesan</button>
                  </form>
              </div>
      </div>

      <!-- Start Blog Post Siddebar -->
      <?php $this->load->view('frontend/home/v_sidebar')?>
      <!-- End Blog Post Siddebar -->
    </div>
</section>
