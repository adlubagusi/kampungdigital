<style>
.job-description {
    background-color: black;
    height: 500px;
    width: 100%;
    overflow-y: scroll;
    color: white;
    margin-bottom: 20px;
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
                <!-- <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card2.png" alt="">
                      <ul class="thumb-info">
                        <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                        <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="blog-single.html">
                        <h3>Harvey Weinstein's senual assault
                            trial set for May</h3>
                      </a>
                      <p>Vel aliquam quis, nulla pede mi commodo no tristique nam hac luctus torquent velit felis lone commodo pellentesque</p>
                      <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card3.png" alt="">
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
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card4.png" alt="">
                      <ul class="thumb-info">
                        <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                        <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="blog-single.html">
                        <h3>Harvey Weinstein's senual assault
                            trial set for May</h3>
                      </a>
                      <p>Vel aliquam quis, nulla pede mi commodo no tristique nam hac luctus torquent velit felis lone commodo pellentesque</p>
                      <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card5.png" alt="">
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
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card6.png" alt="">
                      <ul class="thumb-info">
                        <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                        <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="blog-single.html">
                        <h3>Harvey Weinstein's senual assault
                            trial set for May</h3>
                      </a>
                      <p>Vel aliquam quis, nulla pede mi commodo no tristique nam hac luctus torquent velit felis lone commodo pellentesque</p>
                      <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card7.png" alt="">
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
                <div class="col-md-3">
                  <div class="single-recent-blog-post card-view">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="<?=base_url()?>/template/img/blog/thumb/thumb-card8.png" alt="">
                      <ul class="thumb-info">
                        <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                        <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="blog-single.html">
                        <h3>Harvey Weinstein's senual assault
                            trial set for May</h3>
                      </a>
                      <p>Vel aliquam quis, nulla pede mi commodo no tristique nam hac luctus torquent velit felis lone commodo pellentesque</p>
                      <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                    </div>
                  </div>
                </div> -->
              </div>

            </div>

            </div>
          </div>
        </section>

      <div class="row">
        <div class="col-lg-12">
          <h1>JOB DESKRIPSI KEPENGURUSAN</h1>
          <div class="job-description">
            1.	KETUA
            •	Kewenangan
            Membuat dan mengesahkan seluruh keputusan-keputusan dan kebijakan-kebijakan organisasi yang bersifat strategis (politis) melalui kesepakatan dalam forum Rapat Pengurus Pleno.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaraan organisasi dan program kerjanya dan mempertanggungjawabkan secara internal kepada Rapat Pengurus Pleno (RPP) dan Temu Karya pada masa baktinya.
            •	Tugas
            1)	Memimpin rapat-rapat yang telah di programkan, diantaranya rapat bulanan, setengah tahun, tahunan dan rapat besar lainnya yang memerlukan kehadiran ketua organisasi.
            2)	Mewakili organisasi untuk membuat persetujuan / kesepakatan dengan pihak terkait setelah anggota memutuskan dalam Musyawarah Rapat Pengurus Pleno (MRPP).
            3)	Mewakilan organisasi dalam menghadiri kegiatan strategis kemasyarakatan ataupun lembaga pemerintah, resmi dan tidak resmi dalam rangka mempererat hubungan antara organisasi.
            4)	Menandatangani surat-surat yang berhubungan dengan arah kebijakan dan sikap organisasi, baik luar maupun dalam.
            5)	Bersama sekretaris dan bendahara merancang penggalian sumber pendanaan keuangan organisasi untuk aktivitas operasional program kerja Karang Taruna.
            6)	Memelihara keutuhan, kekompakan dan semangat berorganisasi kepada seluruh anggota Karang Taruna.
            7)	Memberikan atau memutuskan pemikiran dan kebijakan strategis sebagai arah anggota maupun pengurus untuk pelaksanaan kegiatan program kerja yang telah ditetapkan, dalam menyikapi tatanan kehidupan demi tercapainya tujuan Organisasi.
            8)	Mengoptimalkan fungsi dan peran wakil ketua agar tercapainya efesiensi dan efektifitas program kerja.



            2.	WAKIL KETUA
            •	Kewenangan
            Membuat dan mengesahkan seluruh keputusan dan kebijakan organisasi diseluruh bidang dalam pengurusan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mngorganisasikan seluruh penyelenggara progran kerja diseluruh bidang dalam pengurusan dan mempertanggungjawabkan kepada ketua.
            •	Tugas
            1)	Mengkoordinasikan dan mewakili kepentingan organisasi di seluruh bidang dalam pengurusan.
            2)	Mewakili ketua apabila berhalangan untuk setiap aktivitas dalam roda organisasi.
            3)	Merumuskan segala kebijakan di seluruh bidang dalam pengurusan.
            4)	Mengawasi seluruh penyelenggaraan program kegiatan di seluruh bidang dalam pengurusan.

            3.	SEKRETARIS
            •	Kewenangan
            Membuat dan mengesahkan keputusan dan kebijakan organisasi bersama-sama ketua dalam bidang administrasi dan penyelenggaraan roda organisasi.
            •	Tanggung Jawab
            Mengkoordinasikan seluruh penyelenggaraan roda organisasi bidang administrasi dan tata kerja organisasi dan mempertanggung jawabkan kepada ketua.
            •	Tugas
            1)	Bersama ketua menandatangani surat masuk dan keluar pengurus.
            2)	Bersama ketua dan bendahara merupakan Tim Kerja Keuangan (TKK) atau otorisator keuangan ditubuh pengurus.
            3)	Bertanggung jawab untuk setiap aktivitas di bidang administrasi dan tata kerja organisasi.
            4)	Merumuskan dan mengusulkan segala peraturan organisasi di bidang administrasi dan tata kerja organisasi untuk menjadi kebijakan organisasi.
            5)	Mengawasi seluruh penyelenggaraan aktivitas di bidang administrasi dan tata kerja dan menghadiri rapat-rapat pleno dan rapat pengurus harian.
            6)	Memfasilitasi kebutuhan jaringan kerja internal organisasi antara bidang.
            7)	Menjaga dan memlilihara soliditas kepengurusan melalui konsolidasi internal dan managemen konflik yang reprensetif.

            4.	WAKIL SEKRETARIS
            •	Kewenangan
            Membuat dan mengesahkan keputusan dan kebijakan organisasi bersama-sama sekretaris dalam hal kesekretariatan dan kerumahtanggan.
            •	Tanggung Jawab
            Mengkoordinasikan seluruh aktivitas kesekretariatan dan tata usaha organisasi dan mempertanggung jawabkan kepada sekretaris.
            •	Tugas
            1)	Mewakili sekretaris apabila berhalangan terutama untuk setiap aktivitas kesekretariatan dan tata kerja organisasi.
            2)	Bersama sekretaris mengawasi seluruh penyelenggaran aktivitas organisasi di bidang administrasi dan tata kerja dan menghadiri rapat pleno dan rapat pengurus harian.
            3)	Membuat risalah dalam setiap pertemuan/rapat-rapat organisasi baik Rapat Pengurus Pleno (RPP) maupun Rapat Pengurus Harian (RPH).
            4)	Merumuskan, mengusulkan dan mendokumentasikan peraturan dan data yang berkaitan dengan atribut dan aset yang tidak bergerak untuk mendukung kepentigan organisasi baik internal maupun eksternal.
            5)	 Mengusulkan dan mamfasilitasi dalam pengadaan akomodasi logistik dan travel organisasi.

            5.	BENDAHARA
            •	Kewenangan
            Membuat dan mengesahkan keputusan dan kebijakan organisasi bersama-sama ketua dalam hal keuangan dan kekayaan organisasi.
            •	Tanggung Jawab
            Mengkoordinasikan seluruh aktivitas pengolahan keuangan dan kekayaan organisasi dan mempertanggung jawabkan kepada ketua.


            •	Tugas
            1)	Mewakili ketua apabila berhalangan hadir terutama untuk aktivitas di bidang pengelolaan kekayaan dan keuangan organisasi.
            2)	Bersama ketua dan sekretaris merupakan Tim Kerja Keuangan (TKK) atau otorisator di tubuh pengurus.
            3)	Merumuskan dan mengusulkan segala peraturan organisasi di bidang pengelolaan keuangan dan kekayaan organisasi untuk menjadi kebijakan organisasi.
            4)	Memimpin rapat-rapat organisasi di bidang pengelolaan kekayaan dan keuangan organisasi, menghadiri rapat pleno dan rapat pengurus harian.
            5)	Memfasilitasi kebutuhan pembiayaan program kerja dan roda organisasi.

            6.	WAKIL BENDAHARA
            •	Kewenangan
            Membuat dan mengesahkan keputusan organisasi bersama-sama bendahara dalam pengelolaan dalam pengawasan dan pemeriksaan kekayaan keuangan.
            •	Tanggung Jawab
            Mengkoordinasikan seluruh aktivitas pengelolaan/pembukuan keuangan organisasi dan mempertanggung jawabkan kepada bendahara.
            •	Tugas
            1)	Mewakili bendahara apabila berhalangan hadir terutama untuk setiap aktivitas di bidang pengelolaan kekayaan dan keuangan organisasi.
            2)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem pembukuan keuangan organisasi untuk menjadi kebijakan organisasi.
            3)	Menyelenggarakan aktivitas pembukuan terhadap transaksi pengeluaran dan pemasukan keuangan secara rutin.

            7.	BIDANG PEMBINAAN DAN PENDIDIKAN
            •	Kewenangan
            Menyelenggarakan segala aktivitas organisasi pengembangan Sumber Daya Manusia (SDM) yang terkait dengan Pendidikan dan Pelatihan mulai dari perencanaan hingga laporan.


            •	Tanggung Jawab
            Mengkoordinasikan dan mngorganisasikan seluruh penyelenggaraan aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam bidang Pendidikan dan Pelatihan serta mempertanggung jawabkan kepada wakil ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja bidang pendidikan dan pelatihan sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program kegiatan berikut anggaran program kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas pendidikan dan pelatihan yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
            4)	Menyelenggarakan pendidikan dan pelatihan dalam pemberdayaan pemuda dan masyarakat pada umumnnya.
            5)	Membangun hubungan kerjasama kemitraan dengan pihak lain untuk mengembangkan aktivitas pandidikan dan pelatihan bagi warga Karang Taruna maupun masyarakat pada umumnya.
            6)	Menyelenggarakan kegiatan pelatihan-pelatihan.

            8.	BIDANG USAHA KESEJAHTERAAN SOSIAL
            •	Kewenangan
            Menyelenggarakan segala aktivitas usaha kesejahteraan sosial yang terkait dengan pelaksanaan fungsi-fungsi Karang Taruna dalam pelaksanaan bantuan pelayanan dan rehabilitasi sosial khusunya kepada para Penyandang Masalah Kesejahteraan Sosial (PMKS) mulai dari perencanaan hingga laporan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam bidang Usaha Kesejahteraan Sosial serta mempertanggung jawabkan kepada wakil ketua.



            •	Tugas
            Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja bidang Usaha Kesejahteraan Sosial sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            1)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            2)	Mendata dan menginventarisir aktivitas bantuan, pelayanan dan rehabilitasi sosial yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
            3)	Menyelenggarakan aktivitas bantuan sosial dalam berbagai bentuk seperti santunan dan bantuan lainnya dalam momentum tertentu secara berkala.
            4)	Membangun hubungan kerjasama kemitraan dengan pihak lain untuk mengembangkan aktivitas Pelayanan Sosial Terpadu kepada PMKS.

            9.	BIDANG KEROHANIAN
            •	Kewenangan
            Menyelenggarakan segala aktivitas Pengembangan Sumber Daya Manusia yang terkait dengan Kerohanian dan Pembinaan Mental mulai dari perencanaan hingga laporan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam Bidang Kerohaian dan Pembinaan Mental serta mempertanggung jawabkan kepada wakil ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja Bidang Kerohanian sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas Bidang Kerohanian yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
            4)	Menyelenggarakan pembinaan dan pendampingan dalam rangka melalui aktivitas Bidang Kerohaian baik secara temporer maupun rutin melalui lembaga-lembaga keagamaan, perkumpulan keagamaan remaja yang bersifat koordinatif.
            5)	Membangun hubungan kerjasama kemitraan dengan pihak lain untuk mengembangkan aktivitas Bidang Kerohaian.
            6)	Menyelenggarakan peringatan hari-hari besar keagamaan.

            10.	BIDANG PERANAN DAN PEMBERDAYAAN WANITA
            •	Kewenangan
            Menyelenggarakan segala aktivitas Pengembangan Sumber Daya Manusia yang terkait dengan Peranan dan Pemberdayaan Wanita mulai dari perencanaan hingga laporan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam Peranan dan Pemberdayaan Wanita serta mempertanggung jawabkan kepada wakil ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja Bidang Peranan dan Pemberdayaan Wanita sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas Bidang Peranan dan Pemberdayaan Wanita yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
            4)	Menyelenggarakan pembinaan dan pendampingan dalam rangka melalui aktivitas Bidang Peranan dan Pemberdayaan Wanita baik secara temporer maupun rutin melalui kegiatan yang berkejasama dengan ibu-ibu PKK
            5)	Menyelenggarakan Kegiatan Peranan dan Pemberdayaan Wanita secara berkala.

            11.	BIDANG SENI BUDAYA
            •	Kewenangan
            Menyelenggarakan segala aktivitas Pengembangan Sumber Daya Manusia yang terkait dengan Seni Budaya mulai dari perencanaan hingga laporan.



            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam Seni Budaya serta mempertanggung jawabkan kepada wakil ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja Bidang Seni Budaya sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas Bidang Seni Budaya yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
            4)	Menyelenggarakan pembinaan dan pendampingan dalam rangka melalui aktivitas Bidang Seni Budaya baik secara temporer maupun rutin melalui klub-klub dan sanggar seni budaya.
            5)	Membangun hubungan kerjasama kemitraan dengan pihak lain untuk mengembangkan aktivitas Seni Budaya.
            6)	Menyelenggarakan Kegiatan Pekan Seni secara berkala.

            12.	BIDANG PEMUDA DAN OLAHRAGA
            •	Kewenangan
            Menyelenggarakan segala aktivitas Pengembangan Sumber Daya Manusia yang terkait dengan oahraga mulai dari perencanaan hingga laporan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam olahraga serta mempertanggung jawabkan kepada wakil ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja Bidang olahraga sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas Bidang olahraga yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
            4)	Menyelenggarakan pembinaan dan pendampingan dalam rangka melalui aktivitas Bidang Olahraga baik secara temporer maupun rutin melalui klub-klub olahraga
            5)	Membangun hubungan kerjasama kemitraan dengan pihak lain untuk mengembangkan aktivitas pemuda dan olahraga
            6)	Menyelenggarakan Kegiatan olahraga secara berkala.

            13.	BIDANG PERLENGKAPAN DAN PERALATAN
            •	Kewenangan
            Menyelenggarakan segala aktivitas produktif yang terkait dengan Pemeliharaan Perlengkapan dan Peralatan mulai dari perencanaan hingga laporan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam Pemeliharaan Perlengkapan dan Peralatan serta mempertanggung jawabkan kepada wakil ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja Bidang Pemeliharaan Perlengkapan dan Peralatan sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas Bidang Pemeliharaan Perlengkapan dan Peralatan yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
            4)	Menyelenggarakan pembinaan dan pendampingan dalam rangka melalui aktivitas Bidang Pemeliharaan Perlengkapan dan Peralatan baik secara temporer maupun rutin.
            5)	Membangun hubungan kerjasama kemitraan dengan pihak lain untuk mengembangkan aktivitas Pemeliharaan Perlengkapan dan Peralatan.


            14.	BIDANG DANA USAHA
            •	Kewenangan
            Menyelenggarakan segala aktivitas produktif yang terkait dengan pelaksanaan fungsi dana usaha mulai dari perencanaan hingga laporan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam Dana Usaha serta mempertanggung jawabkan kepada wakil ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja Bidang Dana Usaha sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas pendanaan kegiatan UMKM, Investasi yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.

            15.	LINGKUNGAN HIDUP
            •	Kewenangan
            Menyelenggarakan segala aktivitas produktif yang terkait dengan pelaksanaan fungsi Lingkungan Hidup mulai dari perencanaan hingga laporan.
            •	Tanggung Jawab
            Mengkoordinasikan dan mengorganisasikan seluruh penyelenggaran aktivitas program kerja dan pelaksanaan kebijakan organisasi dalam Lingkungan Hidup serta mempertanggung jawabkan kepada ketua.
            •	Tugas
            1)	Merumuskan dan mengusulkan segala peraturan organisasi tentang sistem dan mekanisme pelaksanaan program kerja Bidang Lingkungan Hidup sesuai dengan visi dan misi organisasi untuk menjadi kebijakan organisasi.
            2)	Merumuskan dan mengusulkan program berikut anggaran kegiatan setiap tahunnya untuk disetujui oleh RPP.
            3)	Mendata dan menginventarisir aktivitas Lingkungan Hidup yang sudah ada untuk diteliti dan dikaji menjadi bahan pengembangan lebih lanjut.
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
