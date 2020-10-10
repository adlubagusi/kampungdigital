<script>
    $('#contactform').submit(function(e){
        e.preventDefault();
        loading("show");
        var fd = new FormData(this);
        setTimeout(() => {
            $.ajax({
                url:'<?php echo base_url();?>/contact/sendmail',
                type:"post",
                data:fd,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(reply){
                    showAlert(reply);
                    clearInput();
                    loading("hide");
            }
            });
        }, 5000);
       
    });

    function showAlert(cMessage){
        $("#sendmessage").html(cMessage);
        $("#sendmessage").css("display", "block");
    }

    function clearInput(){
        $("#cNama").val("");
        $("#cEmail").val("");
        $("#cSubject").val("");
        $("#cMessage").val("");
        $("#cNama").focus();

    }

    function loading(l){
        $("#modalLoading").modal(l);
    }
</script>