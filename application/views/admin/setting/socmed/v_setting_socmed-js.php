<script>
    $(function () {
        pagination("datatabel", base_url+"/admin/setting/getdatasocmed", []);
    });

    function socmed_edit(id) {
        $("#modalSocmed").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/setting/detailsocmed/"+id,
        success: function(data) {
            $("#nID").val(data.ID);
            $("#cKode").val(data.Kode);
            $("#cKeterangan").val(data.Keterangan);
            $("#cIcon").val(data.Icon);
        }
        });
        return false;
    }

    $('#f_socmed').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        //untuk ambil value dari ckeditor
        
        var fd = new FormData(this);
        $.ajax({
            url:'<?php echo base_url();?>/admin/setting/savesocmed',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalSocmed").modal('hide');
                table.ajax.reload();
        }
        });
    });

    function socmed_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/setting/detailsocmed/"+id,
        success: function(data) {
            $("#nIDHapus").val(data.ID);
            $("#cKeteranganHapus").html(data.Keterangan);
        }
        });
    }

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/setting/deletesocmed',
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

</script>