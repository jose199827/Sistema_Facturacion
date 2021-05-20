<?php if ($grafica = "pagosMesAnio") {
   $pagosMes = $data;
?>
   <script>
      Highcharts.chart('pagosMesAnio', {
         chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
         },
         title: {
            text: 'Ventas por Tipo de Pago, <?= $pagosMes['mes'] ?> de <?= $pagosMes['anio'] ?>'
         },
         tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
         },
         accessibility: {
            point: {
               valueSuffix: '%'
            }
         },
         plotOptions: {
            pie: {
               allowPointSelect: true,
               cursor: 'pointer',
               dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %'
               }
            }
         },
         series: [{
            name: 'Porcentaje',
            colorByPoint: true,
            data: [
               <?php foreach ($pagosMes['tipospagos'] as $pago) {
                  echo "{ name:  '" . $pago['tipopago'] . "', y: " . $pago['total'] . "},";
               }
               ?>
            ]
         }]
      });
   </script>
<?php
} ?>

<?php if ($grafica = "VentaMes") {
   $ventasMes = $data;
?>
   <script>
      Highcharts.chart('VentaMes', {
         chart: {
            type: 'line'
         },
         title: {
            text: 'Ventas de <?= $ventasMes['mes'] . ' del ' . $ventasMes['anio'] ?>'
         },
         subtitle: {
            text: 'Total de las Ventas <?= SMONEY . formatMoney($ventasMes['total']) ?>'
         },
         xAxis: {
            categories: [
               <?php foreach ($ventasMes['ventas'] as $ventasDia) {
                  echo $ventasDia['dia'] . ",";
               } ?>
            ]
         },
         yAxis: {
            title: {
               text: ''
            }
         },
         plotOptions: {
            line: {
               dataLabels: {
                  enabled: true
               },
               enableMouseTracking: false
            }
         },
         series: [{
            name: '',
            data: [<?php foreach ($ventasMes['ventas'] as $ventasDia) {
                        echo $ventasDia['total'] . ",";
                     } ?>]
         }]
      });
   </script>
<?php
} ?>