			<?php headerTienda($data);
         ?>
			<br><br><br>
			<hr>
			<div class="jumbotron text-center">
			   <h1 class="display-4">¡Gracias por tu compra!</h1>
			   <p class="lead">Tu pedido fue realizado con éxito.</p>
			   <hr class="my-4">
			   <p>Nº Orden: <strong><?= $data['idpedido']; ?></strong>.</p>
			   <?php if (!empty($data['idtransaccion'])) { ?>
			      <p>Transacción: <strong><?= $data['idtransaccion']; ?></strong>.</p>
			   <?php   } ?>
			   <br>
			   <p>Pronto estaremos en contacto para coordinar la entrega.</p>
			   <p>Puedes ver el estado de tu pedido en la seccion de pedidos de tu perfil.</p>
			   <br>
			   <p class="lead">
			      <a class="btn btn-primary btn-lg" href="<?= base_url() . '/Tienda'; ?>" role="button">Ir a la Tienda</a>
			   </p>
			</div>


			<?php footerTienda($data); ?>