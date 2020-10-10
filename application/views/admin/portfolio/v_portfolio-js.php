<script>

    $(function () {

        $(".select2").select2();
        CKEDITOR.replace('cDeskripsi');

    });

    $('#f_portfolio').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        //untuk ambil value dari ckeditor
        var cDeskripsi = CKEDITOR.instances.cDeskripsi.getData();
        
        var fd = new FormData(this);
        fd.append('cDeskripsi',cDeskripsi);
        $.ajax({
            url:'<?php echo base_url();?>/admin/portfolio/save',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalPortfolio").modal('hide');
                table.ajax.reload();
        }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/portfolio/delete',
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

    function portfolio_edit(id) {
        $("#modalPortfolio").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/portfolio/detail/"+id,
        success: function(data) {
            $("#nID").val(data.ID);
            $("#cJudul").val(data.Judul);
            CKEDITOR.instances['cDeskripsi'].setData(data.Deskripsi);
            $("#optKategori").val(data.Kategori);
        }
        });
        return false;
    }

    function portfolio_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/portfolio/detail/"+id,
        success: function(data) {
            console.log(data);            
            $("#nIDHapus").val(data.ID);
            $("#cJudulHapus").html(data.Judul);
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
