<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
$nombre  = explode(" ", $_SESSION['userData']['nombres']);
$apellido  = explode(" ", $_SESSION['userData']['apellidos']);
?>

<div class="mobile-menu-overlay"></div>

<div class="main-container">
   <div class="pd-ltr-20">
      <div class="card-box pd-20 height-100-p mb-30">
         <div class="row align-items-center">
            <div class="col-md-4">
               <img src="<?= vendors(); ?>/images/banner-img.png" alt="">
            </div>
            <div class="col-md-8">
               <h4 class="font-35 weight-500 mb-10 text-capitalize">
                  Bienvenido de nuevo
                  <div class="weight-600 font-30 text-blue">
                     <?= $_SESSION['userData']['nombres']  . "  " . $_SESSION['userData']['apellidos'] ?>
                  </div>
               </h4>
               <p class="font-18" id="txtMsg">


               </p>
            </div>
         </div>
      </div>

      <div class="row pb-20">

         <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
               <a href="<?= Base_URL(); ?>/Usuarios">
                  <div class="card-box height-100-p widget-style3">
                     <div class="d-flex flex-wrap">
                        <div class="widget-data">
                           <div class="weight-700 font-24 text-dark"><?= $data['usuarios'] ?></div>
                           <div class="font-14 text-secondary weight-500">Usuarios</div>
                        </div>
                        <div class="widget-icon">
                           <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);"><i class="micon dw dw-id-card1"></i></div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
         <?php } ?>

         <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
               <a href="<?= Base_URL(); ?>/Clientes">
                  <div class="card-box height-100-p widget-style3">
                     <div class="d-flex flex-wrap">
                        <div class="widget-data">
                           <div class="weight-700 font-24 text-dark"><?= $data['clientes'] ?></div>
                           <div class="font-14 text-secondary weight-500">Clientes</div>
                        </div>
                        <div class="widget-icon">
                           <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);"><span class="micon dw dw-group"></span></div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
         <?php } ?>

         <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
               <a href="<?= Base_URL(); ?>/Pedidos">
                  <div class="card-box height-100-p widget-style3">
                     <div class="d-flex flex-wrap">
                        <div class="widget-data">
                           <div class="weight-700 font-24 text-dark"><?= $data['pedidos'] ?></div>
                           <div class="font-14 text-secondary weight-500">Pedidos</div>
                        </div>
                        <div class="widget-icon">
                           <div class="icon"><i class="micon dw dw-shopping-cart1" aria-hidden="true"></i></div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
         <?php } ?>

         <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
               <a href="<?= Base_URL(); ?>/Productos">
                  <div class="card-box height-100-p widget-style3">
                     <div class="d-flex flex-wrap">
                        <div class="widget-data">
                           <div class="weight-700 font-24 text-dark"><?= $data['productos'] ?></div>
                           <div class="font-14 text-secondary weight-500">Productos</div>
                        </div>
                        <div class="widget-icon">
                           <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);"><i class="micon dw dw-price-tag" aria-hidden="true"></i></div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
         <?php } ?>
      </div>

      <div class="row">
         <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <div class="col-xl-7 mb-30">
               <div class="card-box height-100-p pd-20">
                  <h4 class="text-blue h4 mb-20">Total de pedidos</h4>
                  <p>Últimos 7 días</p>
                  <div class="table-responsive">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Cliente</th>
                              <th scope="col" class="text-right">Monto</th>
                              <th scope="col" class="text-center">Estado</th>
                              <th scope="col" class="text-center">Ver</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (count($data['ultimosPedidos']) > 0) {
                              foreach ($data['ultimosPedidos'] as $pedido) {
                           ?>
                                 <tr>
                                    <td><?= $pedido['idpedido'] ?></td>
                                    <td><?= $pedido['nombre'] ?></td>
                                    <td class="text-right"><?= SMONEY . formatMoney($pedido['monto']) ?></td>
                                    <td class="text-center"><?= $pedido['status'] ?></td>
                                    <td class="text-center"><a href="<?= base_url() ?>/pedidos/orden/<?= $pedido['idpedido'] ?>" target="_blank"><i class="font-18 dw dw-eye"></i></a></td>
                                 </tr>
                           <?php }
                           } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         <?php } ?>
         <div class="col-xl-5 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="contenedor">
                  <h4 class="text-blue h4 mb-20">Pagos por Mes</h4>
                  <div class="dflex">
                     <input class="form-control month-picker pagosMes" name="pagosMes" placeholder="Selecione un Mes" type="text">
                     <button type="button" class="btn btn-primary" onClick="fntSearchPagos()"><i class="font-18 dw dw-search1"></i></button>
                  </div>
               </div>
               <div id="pagosMesAnio"></div>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="contenedor">
                  <h4 class="text-blue h4 mb-20">Ventas por Mes</h4>
                  <div class="dflex">
                     <input class="form-control month-picker ventasMes" name="ventasMes" placeholder="Selecione un Mes" type="text">
                     <button type="button" class="btn btn-primary" onClick="fntSearchVentasMes()"><i class="font-18 dw dw-search1"></i></button>
                  </div>
               </div>
               <div id="VentaMes">

               </div>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="contenedor">
                  <h4 class="text-blue h4 mb-20">Ventas del Año <?= $data['ventasAnio']['anio']  ?></h4>
                  <div class="dflex">
                     <input class="form-control ventasAnio" name="ventasAnio" placeholder="Año" type="text" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
                     <button type="button" class="btn btn-primary btnVentasAnio" onClick="fntSearchVentasAnio()"><i class="font-18 dw dw-search1"></i></button>
                  </div>
               </div>
               <div id="VentaAnio"></div>
            </div>
         </div>
      </div>

      <!-- Estoy haciendo una prueba de grafica -->

      <div class="row">
         <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <div class="col-xl-7 mb-30">
               <div class="card-box height-100-p pd-20">
                  <h4 class="text-blue h4 mb-20">Total de pedidos</h4>
                  <p>Últimos 7 días</p>
                  <div class="table-responsive">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Cliente</th>
                              <th scope="col" class="text-right">Monto</th>
                              <th scope="col" class="text-center">Estado</th>
                              <th scope="col" class="text-center">Ver</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (count($data['ultimosPedidos']) > 0) {
                              foreach ($data['ultimosPedidos'] as $pedido) {
                           ?>
                                 <tr>
                                    <td><?= $pedido['idpedido'] ?></td>
                                    <td><?= $pedido['nombre'] ?></td>
                                    <td class="text-right"><?= SMONEY . formatMoney($pedido['monto']) ?></td>
                                    <td class="text-center"><?= $pedido['status'] ?></td>
                                    <td class="text-center"><a href="<?= base_url() ?>/pedidos/orden/<?= $pedido['idpedido'] ?>" target="_blank"><i class="font-18 dw dw-eye"></i></a></td>
                                 </tr>
                           <?php }
                           } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         <?php } ?>
         <div class="col-xl-5 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="contenedor">
                  <h4 class="text-blue h4 mb-20">Pagos por Mes</h4>
                  <div class="dflex">
                     <input class="form-control month-picker pagosMes" name="pagosMes" placeholder="Selecione un Mes" type="text">
                     <button type="button" class="btn btn-primary" onClick="fntSearchPagos()"><i class="font-18 dw dw-search1"></i></button>
                  </div>
               </div>
               <div>
                  <canvas id="pagosMesAniomyChart"></canvas>
               </div>
            </div>
         </div>
      </div>


      <div class="row">
         <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="contenedor">
                  <div>
                     <h4 class="text-blue h4">PVentas de <?= $data['ventasMesDia']['mes'] . ' del ' . $data['ventasMesDia']['anio'] ?></h4>
                     <p class="mb-30">Total de las Ventas <?= SMONEY . formatMoney($data['ventasMesDia']['total']) ?></p>
                  </div>
                  <div class="">
                     <input class="form-control month-picker pagosMes" name="pagosMes" placeholder="Selecione un Mes" type="text">
                     <button type="button" class="btn btn-primary" onClick="fntSearchPagos()"><i class="font-18 dw dw-search1"></i></button>
                  </div>
               </div>
               <div>
                  <canvas id="VentaMesmyChart"></canvas>
               </div>
            </div>
         </div>
      </div>


      <div class="row">
         <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="clearfix">
                  <div class="pull-left">
                     <h4 class="text-blue h4" _msthash="1552122" _msttexthash="1087658">Ventas del Año <?= $data['ventasAnio']['anio']  ?></h4>
                     <p class="mb-30" _msthash="1498276" _msttexthash="1121263">Estadística de ventas por mes</p>
                  </div>
                  <div class="pull-right">
                     <input class="form-control ventasAnio" name="ventasAnio" placeholder="Año" type="text" minlength="4" maxlength="4" onkeypress="return controlTag(event);">
                     <button type="button" class="btn btn-primary btnVentasAnio" onClick="fntSearchVentasAnio()"><i class="font-18 dw dw-search1"></i></button>
                  </div>
               </div>
               <div>
                  <canvas id="myChart"></canvas>
               </div>
            </div>
         </div>
      </div>









      <div class="row">
         <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="contenedor">
                  <div class="pull-left">
                     <h4 class="text-blue h4" _msthash="1552122" _msttexthash="1087658">Pagar vs no pagar</h4>
                     <p class="mb-30" _msthash="1498276" _msttexthash="1121263">Últimos 7 días</p>
                  </div>
               </div>
               <div>
                  <canvas id="completomyChart"></canvas>
               </div>
            </div>
         </div>
         <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
               <div class="contenedor">
                  <h4 class="text-blue h4 mb-20">Pagos por Mes</h4>
               </div>
               <div>
                  <canvas id="pagosMesAniomyChart"></canvas>
               </div>
            </div>
         </div>
      </div>

      <!-- Fin prueba de grafica -->


      <?php footer($data); ?>
   </div>
</div>
<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>

<script>
   Highcharts.chart('pagosMesAnio', {
      chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         type: 'pie'
      },
      title: {
         text: 'Ventas por Tipo de Pago, <?= $data['pagosMes']['mes'] ?> de <?= $data['pagosMes']['anio'] ?>'
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
            <?php foreach ($data['pagosMes']['tipospagos'] as $pago) {
               echo "{ name:  '" . $pago['tipopago'] . "', y: " . $pago['total'] . "},";
            }
            ?>
         ]
      }]
   });

   Highcharts.chart('VentaMes', {
      chart: {
         type: 'line'
      },
      title: {
         text: 'Ventas de <?= $data['ventasMesDia']['mes'] . ' del ' . $data['ventasMesDia']['anio'] ?>'
      },
      subtitle: {
         text: 'Total de las Ventas <?= SMONEY . formatMoney($data['ventasMesDia']['total']) ?>'
      },
      xAxis: {
         categories: [
            <?php foreach ($data['ventasMesDia']['ventas'] as $ventasDia) {
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
         data: [<?php foreach ($data['ventasMesDia']['ventas'] as $ventasDia) {
                     echo $ventasDia['total'] . ",";
                  } ?>]
      }]
   });

   Highcharts.chart('VentaAnio', {
      chart: {
         type: 'column'
      },
      title: {
         text: 'Ventas del Año <?= $data['ventasAnio']['anio']  ?>'
      },
      subtitle: {
         text: 'Estadística de Ventas por Mes'
      },
      xAxis: {
         type: 'category',
         labels: {
            rotation: -45,
            style: {
               fontSize: '13px',
               fontFamily: 'Verdana, sans-serif'
            }
         }
      },
      yAxis: {
         min: 0,
         title: {
            text: ''
         }
      },
      legend: {
         enabled: false
      },
      tooltip: {
         pointFormat: 'Total de las Ventas en el Mes : <b>{point.y:.1f} </b>'
      },
      series: [{
         name: 'Population',
         data: [
            <?php foreach ($data['ventasAnio']['mesesVenta'] as $mesesVenta) {
               echo "['" . $mesesVenta['mes'] . "'," . $mesesVenta['venta'] . "],";
            } ?>
         ],
         dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#EBEFF3',
            align: 'right',
            format: '{point.y:.2f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
               fontSize: '13px',
               fontFamily: 'Verdana, sans-serif'
            }
         }
      }]
   });

   const labelsw = [
      <?php foreach ($data['ventasAnio']['mesesVenta'] as $mesesVenta) {
         echo "['" . $mesesVenta['mes'] . "'," . "],";
      } ?>
   ];
   const data = {
      labels: labelsw,
      datasets: [{
         label: "Total de ventas en el mes",
         backgroundColor: "rgb(0, 140, 234)",
         borderColor: "rgb(0, 140, 234)",
         data: [
            <?php foreach ($data['ventasAnio']['mesesVenta'] as $mesesVenta) {
               echo "'" . $mesesVenta['venta'] . "',";
            } ?>
         ],
      }, ],
   };
   const config = {
      type: 'bar',
      data: data,
      options: {
         responsive: true,
      },
   };
   const myChart = new Chart(document.getElementById("myChart"), config);


   const labelsVentaMesmyChart = [
      <?php foreach ($data['ventasMesDia']['ventas'] as $ventasDia) {
         echo $ventasDia['dia'] . ",";
      } ?>
   ];

   const dataVentaMesmyChart = {
      labels: labelsVentaMesmyChart,
      datasets: [{
         label: "Total de ventas diario",
         data: [
            <?php foreach ($data['ventasMesDia']['ventas'] as $ventasDia) {
               echo $ventasDia['total'] . ",";
            } ?>
         ],
         backgroundColor: "rgb(0, 140, 234)",
         borderColor: "rgb(0, 140, 234)",
      }, ],
   };

   const configVentaMesmyChart = {
      type: 'line',
      data: dataVentaMesmyChart,
      options: {
         responsive: true,
      },
   };
   const VentaMesmyChart = new Chart(document.getElementById("VentaMesmyChart"), configVentaMesmyChart);




   const labels = [
      <?php foreach ($data['pagosMes']['tipospagos'] as $pago) {
         echo "['" . $pago['tipopago'] . "'," . "],";
      } ?>
   ];

   const datapagosMesAniomyChart = {
      labels: labels,
      datasets: [{
         label: "Total de ventas por mes",
         data: [
            <?php foreach ($data['pagosMes']['tipospagos'] as $pago) {
               echo "'" . $pago['total'] . "',";
            } ?>
         ],
         backgroundColor: [
            "rgb(255, 64, 105)",
            "rgb(255, 144, 32)",
            "rgb(255, 194, 52)",
            "rgb(34, 207, 207)",
            "rgb(5, 155, 255)",
            "rgb(129, 66, 255)",
            "rgb(178, 182, 190)",
         ],
      }, ],
   };

   const configpagosMesAniomyChart = {
      type: 'pie',
      data: datapagosMesAniomyChart,
      options: {
         responsive: true,
         plugins: {
            legend: {
               position: 'top',
            },
            title: {
               display: false,
               text: 'Ventas por Tipo de Pago, <?= $data['pagosMes']['mes'] ?> de <?= $data['pagosMes']['anio'] ?>'
            }
         }
      },
   };
   const pagosMesAniomyChart = new Chart(document.getElementById("pagosMesAniomyChart"), configpagosMesAniomyChart);

   const labelscompletomyChart = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "domingo"];
   const datacompletomyChart = {
      labels: labelscompletomyChart,
      datasets: [{
            label: 'Pagado',
            data: [9],
            backgroundColor: "rgb(5, 155, 255)",
         },
         {
            label: 'No Pago',
            data: [13],
            backgroundColor: "rgb(178, 182, 190)"
         },
      ],
   };

   const configcompletomyChart = {
      type: 'bar',
      data: datacompletomyChart,
      options: {
         responsive: true,
         scales: {
            x: {
               stacked: true,
            },
            y: {
               stacked: true
            }
         }
      }
   };
   const completomyChart = new Chart(document.getElementById("completomyChart"), configcompletomyChart);
</script>