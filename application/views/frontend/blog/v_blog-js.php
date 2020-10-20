<script>
  $(document).ready(function(){
     load_data();
  });
  function load_data(page){
       $.ajax({
            url:"<?php echo base_url();?>blog/getData",
            method:"POST",
            data:{page:page},
            success:function(data){
                 $('#data').html(data.html);
            }
       })
  }
  $(document).on('click', '.halaman', function(){
       var page = $(this).attr("id");
       load_data(page);
  });
</script>
