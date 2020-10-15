<script>

    $(function () {

        $(".select2").select2();
        CKEDITOR.replace('cDeskripsi');

    });

    $('#f_blog').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        //untuk ambil value dari ckeditor
        var cDeskripsi = CKEDITOR.instances.cDeskripsi.getData();
        
        var fd = new FormData(this);
        fd.append('cDeskripsi',cDeskripsi);
        $.ajax({
            url:'<?php echo base_url();?>/admin/blog/save',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalBlog").modal('hide');
                table.ajax.reload();
        }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/blog/delete',
            type:"post",
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalHapus").modal('hide');
                table.ajax.reload();
        }
        });
    }); 

    function blog_edit(id) {
        $("#modalBlog").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/blog/detail/"+id,
        success: function(data) {
            $("#nID").val(data.ID);
            $("#cJudul").val(data.Judul);
            CKEDITOR.instances['cDeskripsi'].setData(data.Deskripsi);
            $("#optKategori").val(data.Kategori);
        }
        });
        return false;
    }

    function blog_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/blog/detail/"+id,
        success: function(data) {
            console.log(data);            
            $("#nIDHapus").val(data.ID);
            $("#cJudulHapus").html(data.Judul);
        }
        });
    }
</script>