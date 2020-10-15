<script>
  $(document).ready(function(){
     load_data();
     function load_data(page){
          $.ajax({
               url:"<?php echo base_url();?>/home/getData",
               method:"POST",
               data:{page:page},
               success:function(data){
                    $('#data').html(data);
               }
          })
     }
     $(document).on('click', '.halaman', function(){
          var page = $(this).attr("id");
          load_data(page);
     });
  });
</script>