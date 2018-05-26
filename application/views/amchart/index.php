<div id="chartdivd" style="width: 640px; height: 400px; display: none;"></div>

<script type="text/javascript" src="assets/amcharts/amcharts.js"></script>
<script type="text/javascript" src="assets/amcharts/serial.js"></script>

<script type="text/javascript">
AmCharts.makeChart( "chartdivd", {
  "type": "serial",
  "dataProvider": [ {
    "tfv_nombre": "DISTRIBUIDOR AUTORIZADO",
    "ven_monto": 85730.46
  }, {
    "tfv_nombre": "DISTRIBUIDOR AUTORIZADO",
    "ven_monto": 85259.90
  }, {
    "tfv_nombre": "DISTRIBUIDOR AUTORIZADO",
    "ven_monto": 84353.29
  }, {
    "tfv_nombre": "TIENDA EN LINEA",
    "ven_monto": 82056.55
  }, {
    "tfv_nombre": "DISTRIBUIDOR AUTORIZADO",
    "ven_monto": 50561.08
  } ],
  "categoryField": "tfv_nombre",
  "rotate": true,

  "categoryAxis": {
    "gridPosition": "start",
    "axisColor": "#DADADA"
  },
  "valueAxes": [ {
    "axisAlpha": 0.2
  } ],
  "graphs": [ {
    "type": "column",
    "title": "MONTOS",
    "valueField": "ven_monto",
    "lineAlpha": 0,
    "fillColors": "#ADD981",
    "fillAlphas": 0.8,
    "balloonText": "[[title]] in [[category]]:<b>[[value]]</b>"
  } ]
} );
</script>

<?php

?>
<script type="text/javascript">
    function mostrarGrafica() 
    {
       
       $('#chartdivd').show(3000);
       $('.chartdivd').show("slow");
    }

    function ocultarGrafica()
    {
       
       $('#chartdivd').hide(3000);
       $('.chartdivd').hide("fast"); 
    }
</script>