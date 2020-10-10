<?php
    /* Mengambil query report*/
    foreach($visitor as $result){
        $bulan[] = $result->tgl; //ambil bulan
        $value[] = (float) $result->jumlah; //ambil nilai
    }
    /* end mengambil query*/
?>
<script src="<?php echo base_url().'assets/dist/js/pages/dashboard2.js'?>"></script>
<script>
    var lineChartData = {
        labels : <?php echo json_encode($bulan);?>,
        datasets : [

            {
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(152,235,239,1)",
                data : <?php echo json_encode($value);?>
            }

        ]

    }

    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

    var canvas = new Chart(myLine).Line(lineChartData, {
        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.005)",
        scaleGridLineWidth : 0,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve : true,
        bezierCurveTension : 0.4,
        pointDot : true,
        pointDotRadius : 4,
        pointDotStrokeWidth : 1,
        pointHitDetectionRadius : 2,
        datasetStroke : true,
        tooltipCornerRadius: 2,
        datasetStrokeWidth : 2,
        datasetFill : true,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });

</script>