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
          <h4 class="text-blue h4 mb-20">Tipos de Pagos por Mes</h4>
          <div id="pagosMesAnio"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 mb-30">
        <div class="card-box height-100-p pd-20">
          <h4 class="text-blue h4 mb-20">Ventas por Mes</h4>
          <div id="VentaMes"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 mb-30">
        <div class="card-box height-100-p pd-20">
          <h4 class="text-blue h4 mb-20">Ventas por Año</h4>
          <div id="VentaAnio"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-8 mb-30">
        <div class="card-box height-100-p pd-20">
          <h2 class="h4 mb-20">Activity</h2>
          <div id="chart5"></div>
        </div>
      </div>
      <div class="col-xl-4 mb-30">
        <div class="card-box height-100-p pd-20">
          <h2 class="h4 mb-20">Lead Target</h2>
          <div id="chart6"></div>
        </div>
      </div>
    </div>
    <div class="card-box">
      <h2 class="h4 pd-20">Best Selling Products</h2>
      <table class="data-table table nowrap">
        <thead>
          <tr>
            <th class="table-plus datatable-nosort">Product</th>
            <th>Name</th>
            <th>Color</th>
            <th>Size</th>
            <th>Price</th>
            <th>Oty</th>
            <th class="datatable-nosort">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="table-plus">
              <img src="<?= vendors(); ?>/images/product-1.jpg" width="70" height="70" alt="">
            </td>
            <td>
              <h5 class="font-16">Shirt</h5>
              by John Doe
            </td>
            <td>Black</td>
            <td>M</td>
            <td>$1000</td>
            <td>1</td>
            <td>
              <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                  <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                  <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="table-plus">
              <img src="<?= vendors(); ?>/images/product-2.jpg" width="70" height="70" alt="">
            </td>
            <td>
              <h5 class="font-16">Boots</h5>
              by Lea R. Frith
            </td>
            <td>brown</td>
            <td>9UK</td>
            <td>$900</td>
            <td>1</td>
            <td>
              <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                  <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                  <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="table-plus">
              <img src="<?= vendors(); ?>/images/product-3.jpg" width="70" height="70" alt="">
            </td>
            <td>
              <h5 class="font-16">Hat</h5>
              by Erik L. Richards
            </td>
            <td>Orange</td>
            <td>M</td>
            <td>$100</td>
            <td>4</td>
            <td>
              <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                  <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                  <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="table-plus">
              <img src="<?= vendors(); ?>/images/product-4.jpg" width="70" height="70" alt="">
            </td>
            <td>
              <h5 class="font-16">Long Dress</h5>
              by Renee I. Hansen
            </td>
            <td>Gray</td>
            <td>L</td>
            <td>$1000</td>
            <td>1</td>
            <td>
              <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                  <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                  <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="table-plus">
              <img src="<?= vendors(); ?>/images/product-5.jpg" width="70" height="70" alt="">
            </td>
            <td>
              <h5 class="font-16">Blazer</h5>
              by Vicki M. Coleman
            </td>
            <td>Blue</td>
            <td>M</td>
            <td>$1000</td>
            <td>1</td>
            <td>
              <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                  <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                  <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                  <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

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
        color: '#FFFFFF',
        align: 'right',
        format: '{point.y:.1f}', // one decimal
        y: 10, // 10 pixels down from the top
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    }]
  });
</script>