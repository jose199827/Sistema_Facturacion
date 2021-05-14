<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
$cliente = $data['arrPedido']['cliente'];
$orden = $data['arrPedido']['orden'];
$detalle = $data['arrPedido']['detalle'];
$transaccion = ($orden['idtransaccionpaypal'] != "") ? $orden['idtransaccionpaypal'] : $orden['referenciacobro'];
/* getModal("modalProductos", $data); */
?>
<div class="mobile-menu-overlay"></div>

<div class="main-container">
   <div class="pd-ltr-20 xs-pd-20-10">
      <div class="min-height-200px">
         <div class="page-header">
            <div class="row">
               <div class="col-md-6 col-sm-12">
                  <div class="title">
                     <h4><?= $data['page_title']; ?></h4>
                  </div>
                  <nav aria-label="breadcrumb" role="navigation">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Base_URL(); ?>/Dashboard">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $data['page_name']; ?></li>
                     </ol>
                  </nav>
               </div>
               <div class="col-6 text-right">
                  <a href="javascript:window.print('#sPedido');"><button type="button" class="btn btn-primary">Imprimir</button></a>
               </div>
            </div>
         </div>

         <div id="sPedido" class="invoice-wrap pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="invoice-box">
               <div class="invoice-header">
                  <div class="logo text-center">
                     <img src="<?= media(); ?>/tienda/images/icons/logo-01.png">
                  </div>
               </div>
               <!-- <h4 class="text-center mb-30 weight-600">Orden de Compra</h4> -->
               <div class="row pb-20">
                  <div class="col-md-4">
                     <h5 class="mb-15"><?= NOMBRE_EMPRESA ?></h5>
                     <p class="font-14 mb-5">Dirección: <strong class="weight-600"><?= DIRECCION ?></strong></p>
                     <p class="font-14 mb-5">Teléfono: <strong class="weight-600"><?= TELEFONO ?></strong></p>
                     <p class="font-14 mb-5">Email: <strong class="weight-600"><?= EMAIL_EMPRESA  ?></strong></p>
                     <p class="font-14 mb-5">Web: <strong class="weight-600"><a href="<?= WEB_EMPRESA  ?>"><?= WEB_EMPRESA  ?></a></strong></p>
                  </div>
                  <div class="col-md-4">
                     <div class="text-center">
                        <h5 class="mb-15 "><?= $cliente['nombres'] . " " . $cliente['apellidos'] ?></h5>
                        <p class="font-14 mb-5">Envio: <strong class="weight-600"><?= $orden['Direccion_envio']   ?></strong></p>
                        <p class="font-14 mb-5">Teléfono: <strong class="weight-600"><?= $cliente['telefono']   ?></strong></p>
                        <p class="font-14 mb-5">Email: <strong class="weight-600"><?= $cliente['email_user']   ?></strong></p>

                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="text-right">
                        <h5 class="mb-15 ">Orden: #<?= $orden['idpedido']   ?></h5>
                        <p class="font-14 mb-5">Pago: <strong class="weight-600"><?= $orden['tipopago']  ?></strong></p>
                        <p class="font-14 mb-5">Transacción: <strong class="weight-600"><?= $transaccion ?></strong></p>
                        <p class="font-14 mb-5">Estado: <strong class="weight-600"><?= $orden['status']   ?></strong></p>
                        <p class="font-14 mb-5">Monto: <strong class="weight-600"><?= SMONEY . formatMoney($orden['monto']);   ?></strong></p>
                     </div>
                  </div>
               </div>
               <div class="invoice-desc ">
                  <div class="invoice-desc-head clearfix">
                     <div class="invoice-sub">Descripción</div>
                     <div class="invoice-rate text-right">Precio</div>
                     <div class="invoice-hours text-center">Cantidad</div>
                     <div class="invoice-subtotal text-right">Subtotal</div>
                  </div>
                  <div class="invoice-desc-body customscroll">
                     <ul>
                        <?php
                        $subtotal = 0;
                        $importe = 0;
                        if (count($detalle) > 0) {
                           foreach ($detalle as $producto) {
                              $importe  = ($producto['precio'] * $producto['cantidad']);
                              $subtotal += $importe;
                        ?>
                              <li class="clearfix">
                                 <div class="invoice-sub"><?= $producto['producto']; ?></div>
                                 <div class="invoice-rate text-right"><?= SMONEY . formatMoney($producto['precio']); ?></div>
                                 <div class="invoice-hours text-center"><?= $producto['cantidad']; ?></div>
                                 <div class="invoice-subtotal text-right"><span class="weight-600"><?= SMONEY . formatMoney($importe); ?></span></div>
                              </li>
                        <?php }
                        }
                        ?>
                     </ul>
                  </div>
                  <div class="invoice-desc-footer">
                     <div class="invoice-desc-head clearfix">
                        <div class="invoice-sub">Subtotal</div>
                        <div class="invoice-rate text-center">Envio</div>
                        <div class="invoice-subtotal text-right">Total</div>
                     </div>
                     <div class="invoice-desc-body">
                        <ul>
                           <li class="clearfix">
                              <div class="invoice-sub  font-20 weight-600">
                                 <?= SMONEY . formatMoney($subtotal);   ?>
                              </div>
                              <div class="invoice-rate font-20 weight-600 text-center">
                                 <?= SMONEY . formatMoney($orden['costo_envio']);   ?>
                              </div>
                              <div class="invoice-subtotal">
                                 <span class="weight-600 font-24 text-danger text-right">
                                    <?= SMONEY . formatMoney($orden['monto']);   ?>
                                 </span>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="footer-wrap pd-20 mb-20 card-box">
         DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
      </div>
   </div>
</div>

<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>