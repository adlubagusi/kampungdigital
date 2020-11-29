<script>
$('#contactForm').submit(function(e){
    e.preventDefault();
    err = validSaving();
    if(err === ""){
        $("#errormessage").html("");
        $("#errormessage").css("display", "none");
        $(".button-contactForm").text("Loading...")
        $(".button-contactForm").attr('disabled','true');
        var fd = new FormData(this);
        setTimeout(() => {
            $.ajax({
                url:'<?php echo base_url();?>/blog/sendmail',
                type:"post",
                data:fd,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(reply){
                    showAlert(reply);
                    clearInput();
            }
            });
        }, 5000);
    }else{
        $("#errormessage").html(err);
        $("#errormessage").css("display", "block");
    }

});

$('#replyKomentar').submit(function(e){
    e.preventDefault();

    var fd = new FormData(this);
    $.ajax({
        url:'<?php echo base_url();?>/blog/saveReply',
        type:"post",
        data:fd,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(data){
            $("#modalKomentar").modal('hide');
    }
    });
});

function showAlert(cMessage){
    $("#sendmessage").html(cMessage);
    $("#sendmessage").css("display", "block");

    $(".button-contactForm").text("Kirim Pesan");
    $(".button-contactForm").attr('disabled','false');
}

function clearInput(){
    $("#cNama").val("");
    $("#cEmail").val("");
    $("#cSubject").val("");
    $("#cMessage").val("");
    $("#cNama").focus();

}

function validSaving(){
    var cNama    = $("#cNama").val();
    var cEmail   = $("#cEmail").val();
    var cSubject = $("#cSubject").val();
    var cMessage = $("#cMessage").val();
    var cError   = "";
    if(cNama  === "") cError += "Nama Harus Diisi<br>";
    if(cEmail  === "") cError += "Email Harus Diisi<br>";
    if(cSubject  === "") cError += "Subjek Harus Diisi<br>";
    if(cMessage  === "") cError += "Pesan Harus Diisi<br>";
    return cError;
}

function komentar_open(id) {
    $.ajax({
    type: "GET",
    url: base_url+"blog/detailReply/"+id,
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
            $("#cSubjectReplyShow").text(data.ReplyMsg.Subject);
            $("#komentarFromReplyTextShow").text(data.ReplyMsg.Email);
            $("#komentarToReplyTextShow").text(data.Email);
            $("#komentarTimeReplyTextShow").text(data.ReplyMsg.Time);
            $("#cMessageReplyShow").html(data.ReplyMsg.Message);
        }
        $("#nID").val(data.ID);
        $("#nIDBlog").val(data.BlogID);

    }
    });
    return false;
}

function reload_tabel(){
    var table = $('#datatabel').DataTable();
    table.ajax.reload();
}
</script>
