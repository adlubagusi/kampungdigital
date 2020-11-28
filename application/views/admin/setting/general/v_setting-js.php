<script>
function saveCfg(cKey,cVal){
    var fd = new FormData();
    fd.append('cVal',cVal);
    fd.append('cKey',cKey);
    $.ajax({
        url: base_url+'admin/setting/save',
        type:"post",
        data:fd,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(data){
            location.reload();
    }
    });
}

function save_alamat(){
    var cKey = "msAlamat";
    var cVal = $("#cAlamat").val();
    saveCfg(cKey,cVal);
}

function save_notelp1(){
    var cKey = "msNoTelp1";
    var cVal = $("#cNoTelp1").val();
    saveCfg(cKey,cVal);
}

function save_notelp2(){
    var cKey = "msNoTelp2";
    var cVal = $("#cNoTelp2").val();
    saveCfg(cKey,cVal);
}

function save_email(){
    var cKey = "msEmail";
    var cVal = $("#cEmail").val();
    saveCfg(cKey,cVal);
}

function save_email_sendnotif(){
    var cKey = "msEmailSendNotif";
    var cVal = $("#cEmailSendNotif").val();
    saveCfg(cKey,cVal);
}

function save_deskripsi_singkat(){
    var cKey = "msDeskripsiSingkat";
    var cVal = $("#cDeskripsiSingkat").val();
    saveCfg(cKey,cVal);
}
</script>