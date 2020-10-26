<script>
     $(document).ready(function(){
          load_data();
     });
     function load_data(page){
          var get_url = getSiteUrl();
          var url     = get_url[4];
          var kategori  = (url === "c") ? get_url[5] : ""; //jika url terdapat kategori, maka tambahkan parameter kategori.

          var formData = new FormData(); //siapkan data yg akan dikirim ke server
          formData.append('page', page);
          formData.append('kategori', kategori);

          $.ajax({
               url: "<?php echo base_url();?>blog/getData",
               method: "POST",
               data: formData,
               processData:false,
               contentType:false,
               cache:false,
               async:false,
               success:function(data){
                    $('#data').html(data.html);
                    if(page > 0){ //jika page > 0, berarti btn pagination sudah diklik. scroll ke blog area.
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

     //get url
     function getSiteUrl(){
          var vars = [], hash;
          var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('/');
          for(var i = 0; i < hashes.length; i++)
          {
               hash = hashes[i].split('=');
               vars.push(hash[0]);
               vars[hash[0]] = hash[1];
          }
          return vars;
     }
</script>
