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
    <?php

    /* echo getTokenPaypal();

    $requestApiGet = curlConnectionGet(URLPAYPAL . "v2/checkout/orders/98A45056771623619", "application/json", getTokenPaypal());
    dep($requestApiGet); */
    /* $requestApi = curlConnectionPost(URLPAYPAL . "/v2/payments/captures/91E075079T722911M/refund", "application/json", getTokenPaypal());
    dep($requestApi); */
    ?>
    <div class="row pb-20">
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <a href="<?= Base_URL(); ?>/Usuarios">
          <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark">75</div>
                <div class="font-14 text-secondary weight-500">Usuarios</div>
              </div>
              <div class="widget-icon">
                <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);"><i class="micon dw dw-id-card1"></i></div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <a href="<?= Base_URL(); ?>/Clientes">
          <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark">124,551</div>
                <div class="font-14 text-secondary weight-500">Clientes</div>
              </div>
              <div class="widget-icon">
                <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);"><span class="micon dw dw-group"></span></div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <a href="<?= Base_URL(); ?>/Pedidos">
          <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark">400+</div>
                <div class="font-14 text-secondary weight-500">Pedidos</div>
              </div>
              <div class="widget-icon">
                <div class="icon"><i class="micon dw dw-shopping-cart1" aria-hidden="true"></i></div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <a href="<?= Base_URL(); ?>/Productos">
          <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
              <div class="widget-data">
                <div class="weight-700 font-24 text-dark">$50,000</div>
                <div class="font-14 text-secondary weight-500">Productos</div>
              </div>
              <div class="widget-icon">
                <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);"><i class="micon dw dw-price-tag" aria-hidden="true"></i></div>
              </div>
            </div>
          </div>
        </a>
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