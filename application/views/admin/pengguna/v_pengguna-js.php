
<script>
    $(function () {

        pagination("datatabel", base_url+"/admin/pengguna/getdata", []);
        
        $("#example1").DataTable();
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
        });

        $('#f_pengguna').submit(function(e){
            e.preventDefault(); 
            var table = $('#datatabel').DataTable();

            $.ajax({
                url:'<?php echo base_url();?>/admin/pengguna/save',
                type:"post",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data){
                    $("#modalPengguna").modal('hide');                    
                    table.ajax.reload();
            }
            });
        });
        
        $('#f_submit_hapus').submit(function(e){
            e.preventDefault(); 
            $.ajax({
                url:'<?php echo base_url();?>/admin/pengguna/delete',
                type:"post",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data){
                    $("#modalHapus").modal('hide');
                    location.reload();
            }
            });
        }); 
    });
    
    function pengguna_edit(id) {
        $("#modalPengguna").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/pengguna/detail/"+id,
        success: function(data) {
            
            $("#nID").val(data.pengguna_id);
            $("#cNama").val(data.pengguna_nama);
            $("#cUserName").val(data.pengguna_username);
            $("#cEmail").val(data.pengguna_email);
            $("#cKontak").val(data.pengguna_nohp);
            if(data.pengguna_jenkel == "L"){
                $("#optLakiLaki").prop('checked',true);
            }else{
                $("#optPerempuan").prop('checked',true);
            }
            $("#optLevel").val(data.pengguna_level);
            $("#cPassword").val("");
            $("#cPassword2").val("");
            $("#cFileFoto").val("");
            $("#cDivisi").val(data.pengguna_divisi);
            $("#cDivisi").prop('disabled',true);
            if(data.pengguna_tampilhome == "Y"){
                $("#chckTampil").prop('checked',true);
            } else{
                $("#chckTampil").prop('checked',false);
            }
            $("#cNama").focus();
        }
        });
        return false;
    }

    function pengguna_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/pengguna/detail/"+id,
        success: function(data) {
            $("#nIDHapus").val(data.pengguna_id);
            $("#cNamaHapus").html(data.pengguna_nama);
        }
        });
    }

    
</script>