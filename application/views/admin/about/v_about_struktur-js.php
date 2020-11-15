<script>
    $(function () {
        pagination("datatabel", base_url+"/admin/about/getdatastruktur", []);
        $("#cUserName").select2({
            ajax: { 
            url: base_url+"/admin/about/searchanggota",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
            }
        });
    });
    function  struktur_edit(id) {   
        $("#modalStrukturOrganisasi").modal('show');
        
        $.ajax({
        type: "GET",
        url: base_url+"admin/about/detailstrukturanggota/"+id,
        success: function(data) {
            $("#nID").val(data.ID);
            $('#cUserName').select2('data', {id: data.UserName, text: data.Nama});
            $("#cJabatan").val(data.Jabatan);
        }
        });
        return false;
    }

    function  struktur_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/about/detailstrukturanggota/"+id,
        success: function(data) {
            $("#nIDHapus").val(data.ID);
            $("#cLabelUserNameHapus").html(data.UserName);
        }
        });
    }

    $('#f_submit_hapus').submit(function(e){
        e.preventDefault(); 
        var table = $('#datatabel').DataTable();

        $.ajax({
            url:'<?php echo base_url();?>/admin/about/deletestrukturanggota',
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

    $('#f_struktur').submit(function(e){
        e.preventDefault(); 
        var table = $('#datatabel').DataTable();
        
        var fd = new FormData(this);
        $.ajax({
            url:'<?php echo base_url();?>/admin/about/savestruktur',
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
                $("#modalStrukturOrganisasi").modal("hide");
                table.ajax.reload();
            }
        });
    });
</script>