<!-- Modal de Ver Usuarios -->
<?php /* dep($data); */

$transaccion = $data->purchase_units[0];
$cliente = $data->payer;

$idTransaccion = $transaccion->payments->captures[0]->id;
$nombreCompleto = $cliente->name->given_name . " " . $cliente->name->surname;
$emailCliente =  $cliente->email_address;
$telefonoCliente = isset($cliente->phone) ? $cliente->phone->phone_number->national_number : "";
//Detalles Monto
$totalCompra = $transaccion->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
$comision = $transaccion->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value;
$importeNeto = $transaccion->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
?>
<div class="modal fade" id="reembolso-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="titleModal">Hacer Reembolso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
               <i class="font-16 icon-copy dw dw-cancel"></i>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="table-responsive">
                  <table class="table">
                     <input type="hidden" id="idtransaccion" name="idtransaccion" value="<?= $idTransaccion; ?>">
                     <tbody>
                        <tr>
                           <td>Transacción</th>
                           <td><?= $idTransaccion; ?></td>
                        </tr>
                        <tr>
                           <td>Datos de Contacto</th>
                           <td>
                              <?= $nombreCompleto; ?> <br>
                              <?= $emailCliente; ?><br>
                              <?= $telefonoCliente; ?>
                           </td>
                        </tr>
                        <tr>
                           <td>Importe Total del Reembolso</th>
                           <td><?= SMONEY . formatMoney($totalCompra);   ?></td>
                        </tr>
                        <tr>
                           <td>Importe Neto del Reembolso</th>
                           <td><?= SMONEY . formatMoney($importeNeto);   ?></td>
                        </tr>
                        <tr>
                        <tr>
                           <td>Comisión del Reembolso por PayPal</th>
                           <td><?= SMONEY . formatMoney($comision);   ?></td>
                        </tr>
                        <tr>
                           <td>Observación</th>
                           <td>
                              <textarea name="txtObservacion" id="txtObservacion" rows="2" placeholder="Observación del Reembolso" class="form-control"></textarea>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="text-right">
               <button id="btnActionForm" type="button" class="btn btn-warning" onclick="fntReembolsar()"><span id="btnTex">Reembolsar</span></button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
         </div>
      </div>
   </div>
</div>