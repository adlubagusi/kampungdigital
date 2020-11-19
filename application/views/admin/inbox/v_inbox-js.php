<script>

    $(function () {
        pagination("datatabel", base_url+"/admin/inbox/getdata", []);
        CKEDITOR.replace('cMessageReply');

    });

    $('#f_inbox').submit(function(e){
        e.preventDefault();
        
        var table = $('#datatabel').DataTable();
        
        //untuk ambil value dari ckeditor
        var cMessageReply = CKEDITOR.instances.cMessageReply.getData();
        
        var fd = new FormData(this);
        fd.append('cMessageReply',cMessageReply);
                $.ajax({
            url:'<?php echo base_url();?>/admin/inbox/sendreply',
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
                    $("#modalInbox").modal('hide');
                    table.ajax.reload();
                }else{
                    Swal.fire({
                        icon: "error",
                        title: reply,
                    });  
                }
                // $("#modalInbox").modal('hide');
                // table.ajax.reload();
        }
        });
    });

    $('#f_submit_hapus').submit(function(e){
        var table = $('#datatabel').DataTable();
        e.preventDefault(); 
        $.ajax({
            url:'<?php echo base_url();?>/admin/inbox/delete',
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

    function inbox_open(id) {
        $.ajax({
        type: "GET",
        url: base_url+"admin/inbox/detail/"+id,
        success: function(data) {
            console.log(data);
            if(data.Status < 2){
                $("#modalInbox").modal('show');
                $("#modalInboxLabel").text(data.Subject);
                $("#inboxFromText").text(data.Email);
                $("#messageText").text(data.Message);
                $("#inboxTimeText").text(data.Time)
            }else{
                $("#modalInboxShow").modal('show');
                $("#modalInboxLabelShow").text(data.Subject);
                $("#inboxFromTextShow").text(data.Email);
                $("#messageTextShow").text(data.Message);
                $("#inboxTimeTextShow").text(data.Time);

                //reply message
                $("#cSubjectReplyShow").text(data.ReplyMsg.Subject);
                $("#inboxFromReplyTextShow").text(data.ReplyMsg.Email);
                $("#inboxToReplyTextShow").text(data.Email);
                $("#inboxTimeReplyTextShow").text(data.ReplyMsg.Time);
                $("#cMessageReplyShow").html(data.ReplyMsg.Message);
            }$("#nID").val(data.ID);
            
        }
        });
        return false;
    }

    function inbox_hapus(id){
        $("#modalHapus").modal('show');
        $.ajax({
        type: "GET",
        url: base_url+"admin/inbox/detail/"+id,
        success: function(data) {
            $("#nIDHapus").val(data.ID);
            $("#cKeteranganHapus").html(data.Keterangan);
        }
        });
    }
</script>

