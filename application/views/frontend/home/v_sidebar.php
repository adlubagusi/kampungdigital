<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
        <div class="single-sidebar-widget newsletter-widget">
            <h4 class="single-sidebar-widget__title">Newsletter</h4>
            <div class="form-group mt-30">
            <div class="col-autos">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Enter email'">
            </div>
            </div>
            <button class="bbtns d-block mt-20 w-100">Subscribe</button>
        </div>


        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">Kategori</h4>
            <ul class="cat-list mt-20">
                <?php
                foreach($vaKategori as $i):
                    $cLowKategori = str_replace(" ","_",strtolower($i['Keterangan']));
                ?>
                <li>
                    <a href="<?= base_url().'c/'.$cLowKategori?>" class="d-flex justify-content-between">
                    <p> <?= $i['Keterangan']?> </p>
                    <p> <?= $i['Jml']?> </p>
                    </a>
                </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>

        <!-- <div class="single-sidebar-widget popular-post-widget">
            <h4 class="single-sidebar-widget__title">Popular Post</h4>
            <div class="popular-post-list">
                <div class="single-post-list">
                    <div class="thumb">
                        <img class="card-img rounded-0" src="<?=base_url()?>template/img/blog/thumb/thumb1.png" alt="">
                        <ul class="thumb-info">
                            <li><a href="#">Adam Colinge</a></li>
                            <li><a href="#">Dec 15</a></li>
                        </ul>
                    </div>
                    <div class="details mt-20">
                        <a href="blog-single.html">
                            <h6>Accused of assaulting flight attendant miktake alaways</h6>
                        </a>
                    </div>
                </div>
                <div class="single-post-list">
                    <div class="thumb">
                        <img class="card-img rounded-0" src="<?=base_url()?>template/img/blog/thumb/thumb2.png" alt="">
                        <ul class="thumb-info">
                            <li><a href="#">Adam Colinge</a></li>
                            <li><a href="#">Dec 15</a></li>
                        </ul>
                    </div>
                    <div class="details mt-20">
                        <a href="blog-single.html">
                            <h6>Tennessee outback steakhouse the
                            worker diagnosed</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-sidebar-widget tag_cloud_widget">
            <h4 class="single-sidebar-widget__title">Popular Post</h4>
            <ul class="list">
                <li>
                    <a href="#">project</a>
                </li>
                <li>
                    <a href="#">love</a>
                </li>
                <li>
                    <a href="#">technology</a>
                </li>
                <li>
                    <a href="#">travel</a>
                </li>
                <li>
                    <a href="#">software</a>
                </li>
                <li>
                    <a href="#">life style</a>
                </li>
                <li>
                    <a href="#">design</a>
                </li>
                <li>
                    <a href="#">illustration</a>
                </li>
            </ul>
        </div> -->
    </div>
</div>