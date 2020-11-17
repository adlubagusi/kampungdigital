<script>

    $(function () {

        $(".select2").select2();
        CKEDITOR.replace('cDeskripsi');
        pagination("datatabel", base_url+"/admin/bidangusaha/getdata", []);
    });

    $('#f_bidangusaha').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        //untuk ambil value dari ckeditor
        var cDeskripsi = CKEDITOR.instances.cDeskripsi.getData();
        
        var fd = new FormData(this);
        fd.append('cDeskripsi',cDeskripsi);
        $.ajax({
            url:'<?php echo base_url();?>admin/bidangusaha/save',
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(reply){
                if(reply == "ok"){
                    Swal.fire({
                        icon: "success",
                        title: "Data Disimpan!",
                    });  
                    $("#modalBidangUsaha").modal('hide');
                    table.ajax.reload();
                }else{
                    Swal.fire({
                        icon: "error",
                        title: reply,
                    });  
                }
        }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>admin/bidangusaha/delete',
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

    function bidangusaha_edit(id) {
        $("#nID").val("");
        $("#cJudul").val("");
        $("#cSlug").val("");
        CKEDITOR.instances['cDeskripsi'].setData("");
        $.ajax({
            type: "GET",
            url: base_url+"admin/bidangusaha/detail/"+id,
            success: function(data) {           
                loadFileBidangUsaha(data.File)
                $("#cKode").val(data.Kode);
                $("#cNamaOwner").val(data.NamaOwner);
                $("#cNamaUsaha").val(data.NamaUsaha);
                $("#cAlamatUsaha").val(data.AlamatUsaha);
                $("#cHP").val(data.HP);
                $("#cSlug").val(data.Slug);
                CKEDITOR.instances['cDeskripsi'].setData(data.Deskripsi);
                $("#optJenisUsaha").val(data.JenisUsaha);
                $("#vaFile").val("");
            }
        });
        $("#modalBidangUsaha").modal('show');
        return false;
    }

    function bidangusaha_hapus(id){
        $("#modalHapus").modal('show');
            $.ajax({
            type: "GET",
            url: base_url+"admin/bidangusaha/detail/"+id,
            success: function(data) {
                $("#cKodeHapus").val(data.Kode);
                $("#cNamaOwnerHapus").html(data.NamaOwner);
            }
        });
    }
    function bidangusaha_show(id){
        $("#modalBidangUsahaShow").modal('show');
        $.ajax({
            type: "GET",
            url: base_url+"admin/bidangusaha/detail/"+id,
            success: function(data) {
                $("#nIDShow").val(data.ID);
                $("#cJudulShow").val(data.Judul);
                $("#cDeskripsiShow").html(data.Deskripsi)
                $("#optKategoriShow").html(data.KeteranganKategori);

                //disable input
                $("#nIDShow").prop('disabled', true);
                $("#cJudulShow").prop('disabled', true);
                $("#imgShow").attr('src', base_url+"assets/images/bidangusaha/"+data.Image);
            }
        });
        return false;
    }

    $("#vaFile").on('change', function(e){
        e.preventDefault();
        var name   = $(this).attr("id");
        var file   = $(this)[0].files;
        var fdfile = new FormData();
        for(var i = 0; i < file.length; i++){
            fdfile.append("vaFile[]",file[i]);
        }
        $.ajax({
            url:'<?php echo base_url();?>/admin/bidangusaha/savingFile',
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

    function loadFileBidangUsaha(file){
        $("#listFile").css("display","none");
        $("#areaFileBidangUsaha").html("");
        for(var i=0; i<file.length;i++){
            var id           = file[i].ID;
            var cFileName    = file[i].FileName;
            var cFileNameCut = cFileName.substring(0,20);
            var cFilePath    = file[i].FilePath;
            var cFileSize    = file[i].FileSize;

            var $liFile           = $('<li class="itemFile"></li>');
            var $spanIcon         = $('<span class="mailbox-attachment-icon"><i class="fa fa-file-text"></i></span>');
            var $aDeleteFile      = $('<a href="#" onclick="deleteFile('+id+')" style="float: right;margin: 5px;color: red;font-size:20px;" title="Hapus File?"><i class="fa fa-trash"></i></a>');
            var $divFileInfo      = $('<div class="mailbox-attachment-info"></div>');
            var $aLinkFile        = $('<a href="'+base_url+cFilePath+'" class="mailbox-attachment-name" title="'+cFileName+'" target="_blank"><i class="fa fa-paperclip"></i>&nbsp;'+cFileNameCut+'</a>');
            var $spanDownloadFile = $('<span class="mailbox-attachment-size">'+cFileSize+'</span>');
            var $aLinkDownload    = $('<a href="'+base_url+cFilePath+'" class="btn btn-default btn-xs pull-right" title="Download" download><i class="fa fa-cloud-download"></i></a>');
            
            $spanDownloadFile.append($aLinkDownload);
            $divFileInfo.append($aLinkFile);
            $divFileInfo.append($spanDownloadFile);
            $liFile.append($aDeleteFile);
            $liFile.append($spanIcon);
            $liFile.append($divFileInfo);

            $("#areaFileBidangUsaha").append($liFile);
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
                    url:'<?php echo base_url();?>/admin/bidangusaha/deleteFile',
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
                        $("#modalBidangUsaha").modal('hide');
                }
                });
            }
        });
    }

    $("#cNamaUsaha").on('keypress', function(e){
        var cText = $(this).val();
        var cSlug = convertToSlug(cText)
        $("#cSlug").val(cSlug);
        
    })
    $("#cNamaUsaha").on('blur', function(e){
        var cText = $(this).val();
        var cSlug = convertToSlug(cText)
        $("#cSlug").val(cSlug);
    })
    function convertToSlug(cText){
        return cText
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            ;
    }
</script>