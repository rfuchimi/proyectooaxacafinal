<div id="chartdiv" style="width: 640px; height: 400px;"></div>

<script type="text/javascript" src="assets/amcharts/amcharts.js"></script>
<script type="text/javascript" src="assets/amcharts/serial.js"></script>

<script>
  var chartData = [ {
    "country": "USA",
    "visits": 4252
  }, {
    "country": "China",
    "visits": 1882
  }, {
    "country": "Japan",
    "visits": 1809
  }, {
    "country": "Germany",
    "visits": 1322
  }, {
    "country": "UK",
    "visits": 1122
  }, {
    "country": "France",
    "visits": 1114
  }, {
    "country": "India",
    "visits": 984
  }, {
    "country": "Spain",
    "visits": 711
  }, {
    "country": "Netherlands",
    "visits": 665
  }, {
    "country": "Russia",
    "visits": 580
  }, {
    "country": "South Korea",
    "visits": 443
  }, {
    "country": "Canada",
    "visits": 441
  }, {
    "country": "Brazil",
    "visits": 395
  }, {
    "country": "Italy",
    "visits": 386
  }, {
    "country": "Australia",
    "visits": 384
  }, {
    "country": "Taiwan",
    "visits": 338
  }, {
    "country": "Poland",
    "visits": 328
} ];
</script>

<script type="text/javascript">
  Amcharts.makeChart("chartdiv", {
    "type":"serial",
    "dataprovider":chartData,
    "categoryField": "country",
    "graphs": [ {
      "valueField": "visits",
      "type": "column"
    } ]
  });
</script>

<?php

?>
