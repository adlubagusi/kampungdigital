<script>
    $(function () {
        pagination("datatabel", base_url+"/admin/download/getdata", []);
    });

    $('#f_download').submit(function(e){
        e.preventDefault(); 
        var table = $('#datatabel').DataTable();
        
        var fd = new FormData(this);
        $.ajax({
            url:'<?php echo base_url();?>/admin/download/save',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                Swal.fire({
                    icon: "success",
                    title: "Data Disimpan!",
                });  
                $("#modalDownload").modal("hide");
                table.ajax.reload();
            }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        e.preventDefault(); 
        var table = $('#datatabel').DataTable();

        $.ajax({
            url:'<?php echo base_url();?>/admin/download/delete',
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

    $("#vaFile").on('change', function(e){
        e.preventDefault();
        var name   = $(this).attr("id");
        var file   = $(this)[0].files;
        var fdfile = new FormData();
        for(var i = 0; i < file.length; i++){
            fdfile.append("vaFile[]",file[i]);
        }
        $.ajax({
            url:'<?php echo base_url();?>/admin/download/savingFile',
            type:"post",
            data:fdfile,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                return false;
        }
        });
    })

    function  download_edit(id) {   
        $("#modalDownload").modal('show');
        
        $.ajax({
        type: "GET",
        url: base_url+"admin/download/detail/"+id,
        success: function(data) {
            $("#cKode").val(data.Kode);
            $("#cJudul").val(data.Judul);
            $("#vaFile").val("");
            $("#cJudul").focus();
        }
        });
        return false;
    }

    function  download_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/download/detail/"+id,
        success: function(data) {
            $("#cKodeHapus").val(data.Kode);
            $("#cLabelKodeHapus").html(data.Kode);
        }
        });
    }
</script>