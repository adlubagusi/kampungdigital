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
      <div class="col-lg-12">
          <div class="main_blog_details">
              <img class="img-fluid" src="<?=base_url()?>assets/images/bidangusaha/<?php echo $cData_Foto?>" alt="">
              <a href="#"><h4><?php echo $cData_Judul?></h4></a>
              <div class="user_details">
                <div class="float-left">

                </div>
                <!-- <div class="float-right mt-sm-0 mt-3">
                  <div class="media">
                    <div class="media-body">
                      <h5></h5>
                      <p>12 Dec, 2017 11:21 am</p>
                    </div>
                    <div class="d-flex">
                      <img width="42" height="42" src="<?=base_url()?>template/img/blog/user-img.png" alt="">
                    </div>
                  </div>
                </div> -->
              </div>
              <div style="border: 1px solid #aabbcc; padding: 15px;border-radius:10px;">
                <table width="100%" style="color: black;font-size: 20px;font-family: sans-serif;">
                  <tr>
                    <td>Nama Owner</td>
                    <td style="text-align: center;">:</td>
                    <td><?php echo $cData_NamaOwner?></td>
                  </tr>
                  <tr>
                    <td>Nomer Handphone</td>
                    <td style="text-align: center;">:</td>
                    <td><?php echo $cData_Hp?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td style="text-align: center;">:</td>
                    <td><?php echo $cData_Alamat?></td>
                  </tr>
                  <tr>
                    <td>File PDF</td>
                    <td style="text-align: center;">:</td>
                    <td><a href="<?=base_url().$cData_File?>" download>Download.pdf</a></td>
                  </tr>
                </table>
                <div style="border-top: 1px solid #aabbcc;padding-top: 5px;">
                  <span style="color: black;font-size: 20px;font-family: sans-serif;">Keterangan : </span>
                  <?php echo $cData_Deskripsi?>
                </div>
              </div>

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
            <div style="margin-top: 25px;">
                <h4>Leave a Reply</h4>
                <div id="sendmessage"></div>
                <div id="errormessage"></div>
                <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                    <input type="hidden" id="cBidangUsahaId" name="cBidangUsahaId" value="<?php echo $cData_Id;?>">
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
      </div>
      
    </div>

</section>
