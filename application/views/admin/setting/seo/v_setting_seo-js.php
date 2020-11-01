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

function save_deskripsi_seo(){
    var cKey = "msDeskripsiSEO";
    var cVal = $("#cDeskripsiSEO").val();
    saveCfg(cKey,cVal);
}

function save_keywords_seo(){
    var cKey = "msKeywordsSEO";
    var cVal = $("#cKeywordsSEO").val();
    saveCfg(cKey,cVal);
}

</script>