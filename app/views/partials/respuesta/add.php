<?php
$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;
$data = $this->view_data;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;

?>


<!-- Plotly.js -->
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<style type="text/css">
.gd{
  width: 210px;
  height:200px;
  background: #ccc;
  float: left;
  margin: 1em;
}

</style>


<div id="myDiv" style="width: 480px; height: 400px;"><!-- Plotly chart will be drawn inside this DIV --></div>
<br /><br /><br /><br /><br /><br /><br /><br />
<hr />
<br />
<div id="gd" style="margin-left: 12%;"></div>
<br />
<hr /><br />
<div style="margin-left: 10%;"><h4>Tamaño</h4></div>
  <?php
    $all = $data["all"];
    $cnt = 1;
    $datas = array();
    $colores = array('#4285f4', '#ea4335', '#fbbc04', '#34a853', '#ff6d01', '#46bdc6', '#7baaf7', '#f07b72');
    $medianas = array();
    $cnt = 1;

    foreach($all as $k => $v){
      echo '<div class="gd" id="gd' . $cnt . '"></div>' . PHP_EOL;

      $str = '<script> var data = [
        {
          domain: { x: [0, 1], y: [0, 1] },
          value: ' . $v["mediana"] . ',
          title: { text: "' . $k  . '" , font: { size: 14 }},
          type: "indicator",
          mode: "gauge+number",
          delta: { reference: 100 },
          gauge: { axis: { range: [-100, 100] }, bar: { color: "' . $colores[$cnt -1] . '" } }
        }
      ];

      var layout = { width: 280, height: 250 };
      Plotly.newPlot(gd' . $cnt . ', data, layout);  </script>';
      echo PHP_EOL . PHP_EOL . $str . PHP_EOL . PHP_EOL;

      $cnt++;
    }
  ?>

<br /><br /><br /><br />
<script>

  Plotly.setPlotConfig({
    modeBarButtonsToRemove: ['sendDataToCloud', 'autoScale2d', 'hoverClosestCartesian', 'hoverCompareCartesian', 'lasso2d', 'select2d', 'displaylogo: false', 'showTips: true']
  })


  <?php
  $all = $data["all"];
  $cnt = 1;
  $datas = array();
  $colores = array('#4285f4', '#ea4335', '#fbbc04', '#34a853', '#ff6d01', '#46bdc6', '#7baaf7', '#f07b72');
  $medianas = array();

  foreach($all as $k => $v){
   $str = 'var c' . $cnt . ' = {';
   $str .= 'x: [' . $v[0] . '],';
   $str .= 'y: [' . $v[1] . '],';
   $str .= 'name: "' . $k . '",';
   $str .= 'text: ["<b>' . $k . '</b><br />Accesibilidad: <b>' . $v[0] . '</b><br />Preservación: <b>' . $v[1] . '</b><br />Tamaño: <b>' . $v["mediana"] . '</b><br />"],';
   $str .= 'mode: "markers",';
   $str .= '  marker: {
     size: [' . ($v["mediana"] < 0 ? (-10 * $v["mediana"]) :  (10 * $v["mediana"])) . '],
     sizeref: 0.2,
     sizemode: "area",
     color: "' . $colores[$cnt - 1] . '"
   }
 };';
 $datas[] = 'c' . $cnt;
$medianas[] = $v["mediana"];
 $cnt++;
 echo $str . PHP_EOL;
}

echo 'var data = ' . str_replace('"', '', json_encode($datas)) . ';';

?>

/*
var c1 = {
  x: [1],
  y: [20],
  name: 'Pol. Preservación',

  text: ['<b>Pol. Preservación</b><br />Accesibilidad: <b>0.00</b><br />Preservación: <b>0.00</b><br />Tamaño: <b>0.00</b><br />'],
  mode: 'markers',
  marker: {
    size: [80, 150, 300, 800],
    //setting 'sizeref' to less than 1, increases the rendered marker sizes
    sizeref: 0.2,
    sizemode: 'area',
    color: '#fbbc04'
  }
};
*/

//var data = [c1];

var layout = {
  xaxis: {
    range: [ -110, 100 ] 
  },
  yaxis: {
    range: [-110, 100]
  },
  title: 'Análisis de riesgos y fortalezas',
  showlegend: true,
  height: 600,
  width: 900
};

Plotly.newPlot('myDiv', data, layout);




var data = [
  {
    type: "indicator",
    mode: "gauge+number+delta",
    value: <?php echo array_sum($medianas) == 0 ? "0" : array_sum($medianas) / count($medianas) ?>,
    title: { text: "Calificación", font: { size: 34 } },
    gauge: {
      axis: { range: [-100, 100], tickwidth: 1, tickcolor: "darkblue" },
      bar: { color: "darkblue" },
      bgcolor: "white",
      borderwidth: 2,
      bordercolor: "gray",
      steps: [
        { range: [-100, 0], color: "red" },
        { range: [0, 50], color: "orange" },
        { range: [50, 100], color: "green" }
      ],
      threshold: {
        line: { color: "red", width: 4 },
        thickness: 0.75,
        value: 100
      }
    }
  }
];

var layout = {
  width: 600,
  height: 430,
  margin: { t: 25, r: 25, l: 25, b: 25 },
  paper_bgcolor: "lavender",
  font: { color: "darkblue", family: "Arial" }
};

Plotly.newPlot(gd, data, layout);


</script>
