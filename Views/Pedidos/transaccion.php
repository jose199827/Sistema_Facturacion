<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
$transaccion = $data['objTransaccion']->purchase_units[0];
$idTransaccion = $transaccion->payments->captures[0]->id;
$fecha = $transaccion->payments->captures[0]->create_time;
$estado = $transaccion->payments->captures[0]->status;
$moneda  = $transaccion->payments->captures[0]->amount->currency_code;
$monto = $transaccion->payments->captures[0]->amount->value;
//Detalles de la transaccion
$descripccion = $transaccion->description;
$montoDetalle = $transaccion->amount->value;
//Detalles Monto
$totalCompra = $transaccion->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
$comision = $transaccion->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value;
$importeNeto = $transaccion->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
//Datos del Cliente
$cliente = $data['objTransaccion']->payer;
$nombreCompleto = $cliente->name->given_name . " " . $cliente->name->surname;
$emailCliente =  $cliente->email_address;
$telefonoCliente = isset($cliente->phone) ? $cliente->phone->phone_number->national_number : "";
$codigoCiudad = $cliente->address->country_code;
$direccion1 = $transaccion->shipping->address->address_line_1;
$direccion2 = $transaccion->shipping->address->admin_area_2;
$direccion3 = $transaccion->shipping->address->admin_area_2;
$codigoPostal = $transaccion->shipping->address->postal_code;
//Datos del Comercio
$emailComercio = $transaccion->payee->email_address;
//Reembolso
$reembolso = false;
if (isset($transaccion->payments->refunds)) {
   $reembolso = true;
   $importeBruto = $transaccion->payments->refunds[0]->seller_payable_breakdown->gross_amount->value;
   $comisionPaypal = $transaccion->payments->refunds[0]->seller_payable_breakdown->paypal_fee->value;
   $importeNeto = $transaccion->payments->refunds[0]->seller_payable_breakdown->net_amount->value;
   $fechaReembolso = $transaccion->payments->refunds[0]->update_time;
}
?>

<div id="divModal"></div>
<div class="mobile-menu-overlay"></div>

<div class="main-container">
   <div class="pd-ltr-20 xs-pd-20-10">
      <div class="min-height-200px">
         <div class="page-header">
            <div class="row">
               <div class="col-6">
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
                  <a href="javascript:window.print('#sPedido');">
                     <button type="button" class="btn btn-primary">Imprimir</button>
                  </a>
                  <?php if (!$reembolso) {
                     if ($_SESSION['permisosMod']['u'] && $_SESSION['userData']['idrol'] != RCLIENTES) {
                  ?>
                        <button type="button" class="btn btn-warning" onclick="fntTransaccion('<?= $idTransaccion ?>')">Reembolso</button>
                  <?php
                     }
                  } ?>
               </div>
            </div>
         </div>
         <?php
         /* dep($data['objTransaccion']); */
         ?>
         <div class="invoice-wrap pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div id="sPedido" class="invoice-box">
               <div class="invoice-header">
                  <div class="logo text-center">
                     <img src="<?= media(); ?>/img/img-paypal.jpg">
                  </div>
               </div>
               <!-- <h4 class="text-center mb-30 weight-600">Orden de Compra</h4> -->
               <div class="row pb-20">
                  <div class="col-md-4">
                     <h5 class="mb-15">Transacción: <?= NOMBRE_EMPRESA ?></h5>
                     <p class="font-14 mb-5">Dirección: <strong class="weight-600"><?= DIRECCION ?></strong></p>
                     <p class="font-14 mb-5">Teléfono: <strong class="weight-600"><?= TELEFONO ?></strong></p>
                     <p class="font-14 mb-5">Email: <strong class="weight-600"><?= $emailComercio  ?></strong></p>
                     <p class="font-14 mb-5">Web: <strong class="weight-600"><a href="<?= WEB_EMPRESA  ?>"><?= WEB_EMPRESA  ?></a></strong></p>
                  </div>
                  <div class="col-md-4">
                     <div class="text-center">
                        <h5 class="mb-15 "><?= $nombreCompleto ?></h5>
                        <p class="font-14 mb-5">Teléfono: <strong class="weight-600"><?= $telefonoCliente ?></strong></p>
                        <p class="font-14 mb-5">Email: <strong class="weight-600"><?= $emailCliente ?></strong></p>
                        <p class="font-14 mb-5">Dirección: <strong class="weight-600"><?= $direccion1 . " " . $direccion2 . " " . $codigoPostal . " " . $codigoCiudad ?></strong></p>

                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="text-right">
                        <h5 class="mb-15 ">Transacción: #<?= $idTransaccion ?></h5>
                        <p class="font-14 mb-5">Fecha: <strong class="weight-600"><?= $fecha ?></strong></p>
                        <p class="font-14 mb-5">Estado: <strong class="weight-600"><?= $estado ?></strong></p>
                        <p class="font-14 mb-5">Importe Bruto: <strong class="weight-600"><?= SMONEY . formatMoney($monto) ?></strong></p>
                        <p class="font-14 mb-5">Moneda: <strong class="weight-600"><?= $moneda ?></strong></p>
                     </div>
                  </div>
               </div>
               <div class="invoice-desc ">
                  <?php if ($reembolso) {
                  ?>
                     <div class="invoice-desc-head clearfix">
                        <div class="invoice-sub">Movimiento</div>
                        <div class="invoice-hours text-center">Importe Bruto</div>
                        <div class="invoice-rate text-right">Comisión</div>
                        <div class="invoice-subtotal text-right">Importe Neto</div>
                     </div>
                     <div class="invoice-desc-body customscroll">
                        <ul>
                           <?php if ($_SESSION['userData']['idrol'] == RCLIENTES) {
                              # code...
                           ?>
                              <li class="clearfix">
                                 <div class="invoice-sub"><?= $fechaReembolso . ' Reembolso para ' . $nombreCompleto; ?></div>
                                 <div class="invoice-hours text-center"><?= SMONEY . formatMoney($importeBruto) ?></div>
                                 <div class="invoice-rate text-right">-<?= SMONEY . formatMoney(0); ?></div>
                                 <div class="invoice-subtotal text-right"><span class="weight-600"><?= SMONEY . formatMoney($importeBruto); ?></span></div>
                              </li>
                           <?php } else { ?>
                              <li class="clearfix">
                                 <div class="invoice-sub"><?= $fechaReembolso . ' Reembolso para ' . $nombreCompleto; ?></div>
                                 <div class="invoice-hours text-center"><?= SMONEY . formatMoney($importeBruto) ?></div>
                                 <div class="invoice-rate text-right">-<?= SMONEY . formatMoney($comisionPaypal); ?></div>
                                 <div class="invoice-subtotal text-right"><span class="weight-600"><?= SMONEY . formatMoney($importeNeto); ?></span></div>
                              </li>
                              <li class="clearfix">
                                 <div class="invoice-sub"><?= $fechaReembolso ?> Cancelación de la comisión de PayPal</div>
                                 <div class="invoice-rate text-center"><?= SMONEY . formatMoney($comisionPaypal); ?></div>
                                 <div class="invoice-hours text-right"><?= SMONEY . formatMoney(0) ?></div>
                                 <div class="invoice-subtotal text-right"><span class="weight-600"><?= SMONEY . formatMoney($comisionPaypal); ?></span></div>
                              </li>
                           <?php } ?>
                        </ul>
                     </div>
                  <?php
                  } ?>
                  <div class="invoice-desc-head clearfix">
                     <div class="invoice-sub">Detalle Pedido</div>
                     <div class="invoice-hours text-center">Cantidad</div>
                     <div class="invoice-rate text-right">Precio</div>
                     <div class="invoice-subtotal text-right">Importe</div>
                  </div>
                  <div class="invoice-desc-body customscroll">
                     <ul>
                        <li class="clearfix">
                           <div class="invoice-sub"><?= $descripccion; ?></div>
                           <div class="invoice-hours text-center"><?= 1 ?></div>
                           <div class="invoice-rate text-right"><?= SMONEY . formatMoney($montoDetalle); ?></div>
                           <div class="invoice-subtotal text-right"><span class="weight-600"><?= SMONEY . formatMoney($montoDetalle); ?></span></div>
                        </li>
                     </ul>
                  </div>
                  <?php if ($_SESSION['userData']['idrol'] != RCLIENTES) {
                     # code...
                  ?>
                     <div class="invoice-desc-footer">
                        <div class="invoice-desc-head clearfix">
                           <div class="invoice-sub">Total Compra</div>
                           <div class="invoice-rate text-center">Comision PayPal</div>
                           <div class="invoice-subtotal text-right">Importe Neto</div>
                        </div>
                        <div class="invoice-desc-body">
                           <ul>
                              <li class="clearfix">
                                 <div class="invoice-sub  font-20 weight-600">
                                    <?= SMONEY . formatMoney($totalCompra);   ?>
                                 </div>
                                 <div class="invoice-rate font-20 weight-600 text-danger text-center">
                                    -<?= SMONEY . formatMoney($comision);   ?>
                                 </div>
                                 <div class="invoice-subtotal text-right">
                                    <span class="weight-600 font-24 text-primary ">
                                       <?= SMONEY . formatMoney($importeNeto);   ?>
                                    </span>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  <?php
                  } ?>
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