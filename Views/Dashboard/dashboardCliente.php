<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
$nombre  = explode(" ", $_SESSION['userData']['nombres']);
$apellido  = explode(" ", $_SESSION['userData']['apellidos']);
?>

<div class="mobile-menu-overlay"></div>

<div class="main-container">
   <div class="pd-ltr-20">
      <div class="row pb-20">

         <!-- <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
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
         <?php } ?> -->

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
                  <h4 class="text-blue h4 mb-20">Ultimos Pedidos</h4>
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
               <h4 class="text-blue h4 mb-20">Ultimos Prouctos</h4>
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th scope="col">Id</th>
                           <th scope="col">Producto</th>
                           <th scope="col" class="text-right">Precio</th>
                           <th scope="col" class="text-center">Ver</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if (count($data['ultimosProductos']) > 0) {
                           foreach ($data['ultimosProductos'] as $producto) {
                        ?>
                              <tr>
                                 <td><?= $producto['idproducto'] ?></td>
                                 <td><?= $producto['nombre'] ?></td>
                                 <td class="text-right"><?= SMONEY . formatMoney($producto['precio']) ?></td>
                                 <td class="text-center"><a href="<?= base_url() ?>/Tienda/Producto/<?= $producto['idproducto'] ?>/<?= $producto['ruta'] ?>" target="_blank"><i class="font-18 dw dw-eye"></i></a></td>
                              </tr>
                        <?php }
                        } ?>
                     </tbody>
                  </table>
               </div>
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
               <div id="VentaMes"></div>
            </div>
         </div>
      </div>

      <?php footer($data); ?>
   </div>
</div>
<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
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
</script>