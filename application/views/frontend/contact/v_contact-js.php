<script>
    $(function () {
        var mymap = L.map('map').setView([-7.9574174, 112.6075991], 15);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(mymap);

        function popUp(f,l){
            var out = [];
            if (f.properties){
                for(key in f.properties){
                    out.push(key+": "+f.properties[key]);
                }
                l.bindPopup(out.join("<br />"));
            }
        }
        var jsonTest = new L.GeoJSON.AJAX([base_url+"assets/geojson/Sumbersari.geojson"],{onEachFeature:popUp}).addTo(mymap);
    });

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