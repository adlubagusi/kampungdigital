
<script>
    $(function () {
        $("#listFile").css("display","none");
        CKEDITOR.replace('cDeskripsi');
    });
    
    $('#f_surat_masuk').submit(function(e){
        e.preventDefault(); 
        var table = $('#datatabel').DataTable();

        var cDeskripsi = CKEDITOR.instances.cDeskripsi.getData();
        
        var fd = new FormData(this);
        fd.append('cDeskripsi',cDeskripsi);
        $.ajax({
            url:'<?php echo base_url();?>/admin/suratmasuk/save',
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
                $("#modalSuratMasuk").modal("hide");
                table.ajax.reload();
        }
        });
    });
    
    $('#f_submit_hapus').submit(function(e){
        e.preventDefault(); 
        var table = $('#datatabel').DataTable();

        $.ajax({
            url:'<?php echo base_url();?>/admin/suratmasuk/delete',
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
            url:'<?php echo base_url();?>/admin/suratmasuk/savingFile',
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

    function surat_masuk_edit(id) {
        $("#vaFile").val("");
        $("#listFile").css("display","none")
        
        $("#modalSuratMasuk").modal('show');
        
        $.ajax({
        type: "GET",
        url: base_url+"admin/suratmasuk/detail/"+id,
        success: function(data) {
            console.log(data);
            loadFileSuratMasuk(data.File)
            $("#cKode").val(data.Kode);
            $("#dTgl").val(data.Tgl);
            $("#cNoSurat").val(data.NoSurat);
            $("#cDari").val(data.Dari);
            $("#cPerihal").val(data.Perihal);
            CKEDITOR.instances['cDeskripsi'].setData(data.Deskripsi);
            $("#cUserName").val(data.UserName);
            $("#cKode").focus();
        }
        });
        return false;
    }

    function surat_masuk_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/suratmasuk/detail/"+id,
        success: function(data) {
            $("#cKodeHapus").val(data.Kode);
            $("#cLabelKodeHapus").html(data.Kode);
        }
        });
    }

    function loadFileSuratMasuk(file){
        console.log(file);
        $("#areaFileSuratMasuk").html("");
        for(var i=0; i<file.length;i++){
            var id           = file[i].ID;
            var cFileName    = file[i].FileName;
            var cFileNameCut = cFileName.substring(0,20);
            var cFilePath    = file[i].FilePath;
            var cFileSize    = file[i].FileSize;

            var $liFileWO         = $('<li class="itemFileWO"></li>');
            var $spanIconWO       = $('<span class="mailbox-attachment-icon"><i class="fa fa-file-text"></i></span>');
            var $aDeleteFile      = $('<a href="#" onclick="deleteFile('+id+')" style="float: right;margin: 5px;color: red;font-size:20px;" title="Hapus File?"><i class="fa fa-trash"></i></a>');
            var $divFileInfo      = $('<div class="mailbox-attachment-info"></div>');
            var $aLinkFile        = $('<a href="'+base_url+cFilePath+'" class="mailbox-attachment-name" title="'+cFileName+'" target="_blank"><i class="fa fa-paperclip"></i>&nbsp;'+cFileNameCut+'</a>');
            var $spanDownloadFile = $('<span class="mailbox-attachment-size">'+cFileSize+'</span>');
            var $aLinkDownload    = $('<a href="'+base_url+cFilePath+'" class="btn btn-default btn-xs pull-right" title="Download" download><i class="fa fa-cloud-download"></i></a>');
            
            $spanDownloadFile.append($aLinkDownload);
            $divFileInfo.append($aLinkFile);
            $divFileInfo.append($spanDownloadFile);
            $liFileWO.append($aDeleteFile);
            $liFileWO.append($spanIconWO);
            $liFileWO.append($divFileInfo);

            $("#areaFileSuratMasuk").append($liFileWO);
        } 
        if(file.length > 0) $("#listFile").css("display","block");
    }

    function deleteFile(id){
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Anda akan menghapus file ini",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya yakin!',
            cancelButtonText: 'Batal!'
        }).then((result) => {
            if (result.value) {
                
                //ajax mulai disini
                var fd = new FormData();
                fd.append('cID', id)
                $.ajax({
                    url:'<?php echo base_url();?>/admin/suratmasuk/deleteFile',
                    type:"post",
                    data:fd,
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data){
                        Swal.fire({
                            icon: "success",
                            title: "File Dihapus!",
                        });  
                        $("#modalSuratMasuk").modal('hide');
                }
                });
            
            
            }
        });
    }
    
</script>