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