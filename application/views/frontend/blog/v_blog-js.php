<script>
$(document).ready(function(){
    load_data();
    function load_data(nPage){
        $.ajax({
                url:base_url+"blog/getData",
                method:"POST",
                data:{nPage:nPage},
                success:function(data){
                    // console.log(data);
                    $('#data-blog').html(data.html_data);
                    $('#data-pagination').html(data.html_pagination);
                }
        })
    }
    $(document).on('click', '.halaman', function(){
        var nPage = $(this).attr("id");
        load_data(nPage);
    });
});
</script>