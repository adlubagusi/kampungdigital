<script>
    $(function () {

        CKEDITOR.replace('cDeskripsi');

    });
    function save_about(){

        var cJudul     = $("#cJudul").val();
        var cDeskripsi = CKEDITOR.instances.cDeskripsi.getData();
        var fd = new FormData();
        fd.append('cJudul',cJudul);
        fd.append('cDeskripsi',cDeskripsi);
        $.ajax({
            url:'<?php echo base_url();?>/admin/about/save',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                location.reload();
        }
        });
    }
</script>