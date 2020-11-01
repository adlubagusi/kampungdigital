
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
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FF4859'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='warning'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Warning',
                    text: "Gambar yang Anda masukan terlalu besar.",
                    showHideTransition: 'slide',
                    icon: 'warning',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FFC017'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Pengguna Berhasil disimpan ke database.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='info'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Info',
                    text: "Pengguna berhasil di update",
                    showHideTransition: 'slide',
                    icon: 'info',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#00C9E6'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Pengguna Berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='show-modal'):?>
        <script type="text/javascript">
                $('#ModalResetPassword').modal('show');
        </script>
    <?php else:?>

    <?php endif;?>
