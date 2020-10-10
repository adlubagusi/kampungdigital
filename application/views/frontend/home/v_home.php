
<!--================Hero Banner start =================-->  
<?php $this->load->view('frontend/home/v_banner')?>
<!--================Hero Banner end =================-->  

<!--================ Blog slider start =================-->  
<?php $this->load->view('frontend/home/v_blog_slider')?>
<!--================ Blog slider end =================-->  

<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin mt-4">
    <div class="container">
        <div class="row">
        <?php $this->load->view('frontend/home/v_blog_post')?>
        <!-- Start Blog Post Siddebar -->
        <?php $this->load->view('frontend/home/v_sidebar')?>
        <!-- End Blog Post Siddebar -->
        </div>
    </div>
</section>
<!--================ End Blog Post Area =================-->