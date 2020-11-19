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
</script>
