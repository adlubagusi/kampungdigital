<script>
  $(document).ready(function(){
     load_data();
  });
  function load_data(page){
       $.ajax({
            url:"<?php echo base_url();?>home/getData",
            method:"POST",
            data:{page:page},
            success:function(data){
                 $('#data').html(data.html);
                 if(page >0){ //jika page > 0, berarti btn pagination sudah diklik. scroll ke blog area.
                    $('html, body').animate({
                         scrollTop: $("#blog-post-area").offset().top
                    }, 2000);
                 }
            }
       })
  }
  $(document).on('click', '.halaman', function(){
       var page = $(this).attr("id");
       load_data(page);
  });
</script>
