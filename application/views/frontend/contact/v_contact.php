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
<section class="section-margin--small section-margin">
  <div class="container">
    <div class="d-none d-sm-block mb-5 pb-4">
      <div id="map" style="height: 500px;"></div>
    </div>


    <div class="row">
      <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="ti-home"></i></span>
          <div class="media-body">
            <h3><?=$cAlamat?></h3>
          </div>
        </div>
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="ti-headphone"></i></span>
          <div class="media-body">
            <h3><a href="tel:454545654"><?=$cNoTelp?></a></h3>
            <p>Senin s/d Jum'at, 09 - 18 WIB</p>
          </div>
        </div>
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="ti-email"></i></span>
          <div class="media-body">
            <h3><a href="mailto:support@colorlib.com"><?=$cEmail?></a></h3>
            <p>Kirim pesan kapanpun!</p>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">
        <div id="sendmessage"></div>
        <div id="errormessage"></div>
        <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <input class="form-control" name="cNama" id="cNama" type="text" placeholder="Masukkan Nama Anda" autocomplete="off" required>
              </div>
              <div class="form-group">
                <input class="form-control" name="cEmail" id="cEmail" type="email" placeholder="Masukkan Alamat Email" autocomplete="off" required>
              </div>
              <div class="form-group">
                <input class="form-control" name="cSubject" id="cSubject" type="text" placeholder="Subjek" autocomplete="off" required>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="form-group">
                  <textarea class="form-control different-control w-100" name="cMessage" id="cMessage" cols="30" rows="5" placeholder="Masukkan Pesan Anda" required></textarea>
              </div>
            </div>
          </div>
          <div class="form-group text-center text-md-right mt-3">
            <button type="submit" class="button button--active button-contactForm">Kirim Pesan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
