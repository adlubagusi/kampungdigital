<div class="col-lg-8" id="data">
  <?php
    foreach ($vaData as $key=>$i) :
        $cBlog_judul = $i['Judul'];
        $cBlog_deskripsi = $i['Deskripsi'];
        $cBlog_date = $i['DateTime'];
        $cBlog_image = $i['Image'];
        $cBlog_author = $i['Author'];
        ?>
    <div class="single-recent-blog-post">
        <div class="thumb">
        <img class="img-fluid" src="<?=base_url()?>assets/images/blog/<?php echo $cBlog_image;?>" alt="">
        <ul class="thumb-info">
            <li><a href="#"><i class="ti-user"></i><?php echo $cBlog_author;?></a></li>
            <li><a href="#"><i class="ti-notepad"></i>January 12,2019</a></li>
            <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
        </ul>
        </div>
        <div class="details mt-20">
        <a href="blog-single.html">
            <h3><?php echo $cBlog_judul;?></h3>
        </a>
        <p class="tag-list-inline">Tag: <a href="#">travel</a>, <a href="#">life style</a>, <a href="#">technology</a>, <a href="#">fashion</a></p>
        <p><?php echo $cBlog_deskripsi;?></p>
        <a class="button" href="#">Read More <?php echo $nCountDataBlog;?><i class="ti-arrow-right"></i></a>
        </div>
    </div>
    <?php endforeach;?>

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
