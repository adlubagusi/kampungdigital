<script>

    $(function () {
        pagination("datatabel", base_url+"/admin/newsletter/getdata", []);
    });

    $('#f_newsletter').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        //untuk ambil value dari ckeditor
        
        var fd = new FormData(this);
        $.ajax({
            url:'<?php echo base_url();?>/admin/newsletter/Save',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalNewsletter").modal('hide');
                table.ajax.reload();
        }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/newsletter/delete',
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

    function newsletter_edit(id) {
        $("#modalNewsletter").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/newsletter/detail/"+id,
        success: function(data) {
            $("#nID").val(data.ID);
            $("#cEmail").val(data.Email);
            $("#cStatus").val(data.Status);
        }
        });
        return false;
    }

    function newsletter_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/newsletter/detail/"+id,
        success: function(data) {
            $("#nIDHapus").val(data.ID);
            $("#cEmailHapus").html(data.Email);
        }
        });
    }

    function newsletter_aktifkan(id){
        $("#modalAktif").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/newsletter/detail/"+id,
        success: function(data) {
            $("#nIDAktif").val(data.ID);
            $("#cEmailAktif").html(data.Email);
        }
        });
    }

    $('#f_submit_aktif').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/newsletter/aktifkan',
            type:"post",
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalAktif").modal('hide');
                table.ajax.reload();
        }
        });
    });
</script>

