<script>

    $(function () {
        pagination("datatabel", base_url+"/admin/komentar/getdata?cType=blog", []);
        CKEDITOR.replace('cMessageReply');

    });

    $('#f_komentar').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        
        //untuk ambil value dari ckeditor
        var cMessageReply = CKEDITOR.instances.cMessageReply.getData();
        
        var fd = new FormData(this);
        fd.append('cMessageReply',cMessageReply);
                $.ajax({
            url:'<?php echo base_url();?>/admin/komentar/sendreply',
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
                    $("#modalKomentar").modal('hide');
                    table.ajax.reload();
                }else{
                    Swal.fire({
                        icon: "error",
                        title: reply,
                    });  
                }
                // $("#modalKomentar").modal('hide');
                // table.ajax.reload();
        }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/komentar/delete',
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

    function reload_tabel(){
        var table = $('#datatabel').DataTable();
        table.ajax.reload();
    }

    function komentar_open(id) {
        $.ajax({
        type: "GET",
        url: base_url+"admin/komentar/detail/"+id,
        success: function(data) {
            console.log(data);
            if(data.Status < 2){
                $("#modalKomentar").modal('show');
                $("#modalKomentarLabel").text(data.Subject);
                $("#komentarFromText").text(data.Email);
                $("#messageText").text(data.Message);
                $("#komentarTimeText").text(data.Time);
                $("#komentarNamaReplyText").text(data.Nama);
            }else{
                $("#modalKomentarShow").modal('show');
                $("#modalKomentarLabelShow").text(data.Subject);
                $("#komentarFromTextShow").text(data.Email);
                $("#messageTextShow").text(data.Message);
                $("#komentarTimeTextShow").text(data.Time);
                $("#komentarNamaReplyTextShow").text(data.Nama);

                //reply message
                if(data.ReplyMsg){
                    $("#cSubjectReplyShow").text(data.ReplyMsg.Subject);
                    $("#komentarFromReplyTextShow").text(data.ReplyMsg.Email);
                    $("#komentarToReplyTextShow").text(data.Email);
                    $("#komentarTimeReplyTextShow").text(data.ReplyMsg.Time);
                    $("#cMessageReplyShow").html(data.ReplyMsg.Message);
                }
            }
            $("#nID").val(data.ID);
            $("#nIDBlog").val(data.BlogID);
            
        }
        });
        return false;
    }

    function komentar_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/komentar/detail/"+id,
        success: function(data) {
            $("#nIDHapus").val(data.ID);
            $("#cKeteranganHapus").html(data.Keterangan);
        }
        });
    }
    function komentar_publish(id){
        $.ajax({
        type: "GET",
        url: base_url+"admin/komentar/detail/"+id,
        success: function(data) {
            $("#nIDPublish").val(data.ID);
            $("#komentarFromTextPublish").text(data.Email);
            $("#messageTextPublish").text(data.Message);
            $("#komentarTimeTextPublish").text(data.Time);
            $("#komentarNamaReplyTextPublish").text(data.Nama);
            $("#modalPublish").modal('show');
        }
        });
    }
    $('#f_submit_publish').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/komentar/publish',
            type:"post",
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
                $("#modalPublish").modal('hide');
                table.ajax.reload();
        }
        });
    }); 
</script>

