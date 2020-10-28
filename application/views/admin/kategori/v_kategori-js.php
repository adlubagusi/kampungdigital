<script>

    $(function () {
        pagination("datatabel", base_url+"/admin/kategori/getdata", []);
    });

    $('#f_kategori').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        //untuk ambil value dari ckeditor
        
        var fd = new FormData(this);
        $.ajax({
            url:'<?php echo base_url();?>/admin/kategori/Save',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalKategori").modal('hide');
                table.ajax.reload();
        }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/kategori/delete',
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

    function kategori_edit(id) {
        $("#modalKategori").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/kategori/detail/"+id,
        success: function(data) {
            $("#nID").val(data.ID);
            $("#cKode").val(data.Kode);
            $("#cKeterangan").val(data.Keterangan);
        }
        });
        return false;
    }

    function kategori_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/kategori/detail/"+id,
        success: function(data) {
            console.log(data);            
            $("#nIDHapus").val(data.ID);
            $("#cKeteranganHapus").html(data.Keterangan);
        }
        });
    }
</script>

