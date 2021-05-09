<?php
$orden = $data['pedido']['orden'];
$detalle = $data['pedido']['detalle'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orden</title>
   <style type="text/css">
      p {
         font-family: arial, sans-serif;
         letter-spacing: 1px;
         color: #7f7f7f;
         font-size: 12px;
      }

      hr {
         border: 0;
         border-top: 1px solid #ccc;
      }

      h4 {
         font-family: arial, sans-serif;
         margin: 0;
      }

      table {
         width: 100%;
         max-width: 600px;
         margin: 10px auto;
         border: 1px solid #ccc;
         border-spacing: 0;
      }

      table tr td,
      table tr th {
         padding: 5px 10px;
         font-family: arial, sans-serif;
         font-size: 12px;
      }

      #detalleOrden tr td {
         border: 1px solid #ccc;
      }

      .table-active {
         background-color: #ccc;
      }

      .text-center {
         text-align: center;
      }

      .text-right {
         text-align: right;
      }

      @media screen and (max-width: 470px) {
         .logo {
            width: 90px;

         }

         p,
         table tr td,
         table tr th {
            font-size: 9px;
         }
      }
   </style>
</head>

<body>
   <p class="text-center">Se ha generado una orden, a continuación encontrarás los datos.</p>
   <br>
   <hr>
   <br>
   <table>
      <tr>
         <td width="33.33%">
            <img class="logo" src="<?= media(); ?>/tienda/images/icons/logo-01.png" alt="">
         </td>
         <td width="33.33%">
            <div class="text-center">
               <p>
                  <strong><?= NOMBRE_EMPRESA; ?></strong>
                  <br>
                  <?= DIRECCION; ?><br>
                  Teléfono:<?= TELEFONO; ?> <br>
                  Email: <?= EMAIL_EMPRESA; ?>
               </p>
            </div>
         </td>
         <td width="33.33%">
            <div class="text-right">
               <p>
                  Nº. Orden: <strong><?= $orden['idpedido']; ?></strong><br>
                  Fecha: <?= $orden['fecha']; ?> <br>
                  <?php if ($orden['tipopagoid'] == 1) { ?>
                     Metodo de Pago: <?= $orden['tipopago']; ?><br>
                     Transacción: <?= $orden['idtransaccionpaypal']; ?><br>
                  <?php   } else { ?>
                     Metodo de Pago: Pago contra entrega<br>
                     Tipo Pago:<?= $orden['tipopago']; ?>
                  <?php   } ?>
               </p>
            </div>
         </td>
      </tr>
   </table>
   <table>
      <tr>
         <td width="140">Nombre: </td>
         <td><?= $_SESSION['userData']['nombres'] . ' ' . $_SESSION['userData']['apellidos']; ?></td>
      </tr>
      <tr>
         <td>Teléfono: </td>
         <td><?= $_SESSION['userData']['telefono']; ?></td>
      </tr>
      <tr>
         <td>Dirección de Envio: </td>
         <td><?= $orden['Direccion_envio']; ?></td>
      </tr>
   </table>
   <table>
      <thead class="table-active">
         <tr>
            <th>Descripción</th>
            <th class="text-right">Precio</th>
            <th class="text-center">Cantidad</th>
            <th class="text-right">Importe</th>
         </tr>
      </thead>
      <tbody id="detalleOrden">
         <?php if (count($detalle) > 0) {
            $subtotal = 0;
            $total = 0;
            foreach ($detalle as $producto) {
               $subtotal = $producto['precio'] * $producto['cantidad'];
               $total += $subtotal;

         ?>
               <tr>
                  <th><?= $producto['producto']; ?></th>
                  <th class="text-right"><?= SMONEY . formatMoney($producto['precio']); ?></th>
                  <th class="text-center"><?= $producto['cantidad']; ?></th>
                  <th class="text-right"><?= SMONEY . formatMoney($subtotal); ?></th>
               </tr>
         <?php }
         } ?></td>
      </tbody>
      <tfoot>
         <tr>
            <th colspan="3" class="text-right">Subtotal</th>
            <td class="text-right"><?= SMONEY . formatMoney($total); ?></td>
         </tr>
         <tr>
            <th colspan="3" class="text-right">Envio</th>
            <td class="text-right"><?= SMONEY . formatMoney($orden['costo_envio']); ?></td>
         </tr>
         <tr>
            <th colspan="3" class="text-right">Total</th>
            <td class="text-right"><?= SMONEY . formatMoney($orden['monto']); ?></td>
         </tr>
      </tfoot>
   </table>
   <div class="text-center">
      <p>Si tienes preguntas sobre tu pedido, <br> ponte en contacto con nosotros </p>
      <h4> Gracias por tu compra </h4>
   </div>
</body>

</html>