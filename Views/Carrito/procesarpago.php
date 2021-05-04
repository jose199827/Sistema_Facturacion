			<?php headerTienda($data);
			$subtotal = 0;
			$total = 0;
			foreach ($_SESSION['arrCarrito'] as $producto) {
				$ruta = $producto['ruta'];
				$subtotal += $producto['precio'] * $producto['cantidad'];
			}
			$total = $subtotal + COSTOENVIO;
			/* dep($_SESSION['arrCarrito']); */
			?>
			<script src="https://www.paypal.com/sdk/js?client-id=<?= PAYPALCLIENTE ?>&currency=<?= CURRENCY ?>">
				// Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
			</script>
			<script>
				paypal.Buttons({
					createOrder: function(data, actions) {
						// This function sets up the details of the transaction, including the amount and line item details.
						return actions.order.create({
							purchase_units: [{
								amount: {
									value: <?= $total; ?>
								},
								description: "Compra de artículos en <?= NOMBRE_EMPRESA; ?> por un monto de <?= SMONEY . $total; ?>",
							}]
						});
					},
					onApprove: function(data, actions) {
						// This function captures the funds from the transaction.
						return actions.order.capture().then(function(details) {
							/* console.log(details); */
							let base_url = "<?= base_url() ?>";
							let direccion = document.querySelector("#txtDireccion").value;
							let ciudad = document.querySelector("#txtCiudad").value;
							let inttipopago = 1;
							let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
							let ajaxUrl = base_url + '/Tienda/procesarVenta';
							let formData = new FormData();
							formData.append('direccion', direccion);
							formData.append('ciudad', ciudad);
							formData.append('inttipopago', inttipopago);
							formData.append('datapay', JSON.stringify(details));

							request.open("POST", ajaxUrl, true);
							request.send(formData);
							request.onreadystatechange = function() {
								if (request.readyState != 4) return;
								if (request.status == 200) {
									let objData = JSON.parse(request.responseText);
									if (objData.status) {
										window.location = base_url + "/Tienda/confirmarPedido"
										swal("Proceso", objData.msg, "success");
									} else {
										swal("Error", objData.msg, "error");
									}
								}
							}
						});
					}
				}).render('#paypal-button-container');
			</script>
			<br><br><br>
			<hr>
			<!-- breadcrumb -->
			<div class="container">
				<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
					<a href="<?= Base_URL(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
						Inicio
						<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
					</a>

					<span class="stext-109 cl4">
						<?= $data['page_title'] ?>
					</span>
				</div>
			</div>
			<br>
			<!-- Shoping Cart -->
			<div class="container">
				<div class="row">
					<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
						<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-25 m-r--38 m-lr-0-xl">
							<div>
								<?php if (isset($_SESSION['login'])) { ?>
									<div>
										<label for="tipopago" class="stext-104 cl2 plh4">Direccion del envio</label>
										<div class="form-group">
											<input type="text" class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" name="txtDireccion" id="txtDireccion" placeholder="Direccion del envio">
										</div>
										<div class="form-group">
											<input type="text" class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" name="txtCiudad" id="txtCiudad" placeholder="Ciudad/Estado">
										</div>
									</div>
								<?php } else { ?>
									<div class="tab01">
										<ul class="nav nav-tabs" role="tablist">

											<li class="nav-item p-b-10">
												<a class="nav-link active" data-toggle="tab" href="#login" role="tab" aria-expanded="false">Iniciar Sesión</a>
											</li>

											<li class="nav-item p-b-10">
												<a class="nav-link " data-toggle="tab" href="#registro" role="tab" aria-expanded="true">Crear Cuenta</a>
											</li>

										</ul>

										<div class="tab-content p-t-20">
											<!-- - -->
											<div class="tab-pane active show " id="login" role="tabpanel" aria-expanded="false">

												<form id="formLogin">
													<div class="form-group">
														<label for="txtEmail" class="stext-104 cl2 plh4">Usuario</label>
														<input type="email" class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" id="txtEmail" name="txtEmail" placeholder="Email del usuario">
													</div>
													<div class="form-group">
														<label for="txtPassword" class="stext-104 cl2 plh4">Contraseña</label>
														<input type="password" class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" id="txtPassword" name="txtPassword" placeholder="Password">
													</div>

													<button type="submit" class="flex-c-m stext-101 cl0 size-117 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Iniciar sesión</button>
												</form>

											</div>

											<!-- - -->
											<div class="tab-pane fade " id="registro" role="tabpanel" aria-expanded="true">
												<form id="formRegister">

													<div class="row">
														<div class="col col-md-6 form-group">
															<label for="txtNombre" class="stext-104 cl2 plh4">Nombres</label>
															<input type="text" class="valid validText stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" id="txtNombre" name="txtNombre" placeholder="Nombres" required>
														</div>
														<div class="col col-md-6 form-group">
															<label for="txtApellido" class="stext-104 cl2 plh4">Apellidos</label>
															<input type="text" class="valid validText stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" id="txtApellido" name="txtApellido" placeholder="Apellidos" required>
														</div>
													</div>

													<div class="row">
														<div class="col col-md-6 form-group">
															<label for="txtTelefono" class="stext-104 cl2 plh4">Teléfono</label>
															<input type="text" class="valid validNumber stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" id="txtTelefono" name="txtTelefono" placeholder="Teléfono" required onkeypress="return controlTag(event);">
														</div>
														<div class="col col-md-6 form-group">
															<label for="txtEmailCliente" class="stext-104 cl2 plh4">Email</label>
															<input type="email" class="valid validEmail stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" id="txtEmailCliente" name="txtEmailCliente" placeholder="Email" required>
														</div>
													</div>
													<button type="submit" class="flex-c-m stext-101 cl0 size-117 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Registrar</button>
												</form>
											</div>

										</div>
									</div>


								<?php } ?>
							</div>
						</div>

					</div>

					<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
						<div class="bor10 p-lr-40 p-t-30 p-b-30 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
							<h4 class="mtext-109 cl2 p-b-30">
								Resumen
							</h4>

							<div class="flex-w flex-t bor12 p-b-13">
								<div class="size-208">
									<span class="stext-110 cl2">
										Subtotal:
									</span>
								</div>

								<div class="size-209">
									<span id="subTotalCompra" class="mtext-110 cl2">
										<?= SMONEY . formatMoney($subtotal); ?>
									</span>
								</div>

								<div class="size-208">
									<span class="stext-110 cl2">
										Envio:
									</span>
								</div>

								<div class="size-209">
									<span class="mtext-110 cl2">
										<?= SMONEY . formatMoney(COSTOENVIO); ?>
									</span>
								</div>
							</div>

							<!-- cupon de descuento -->

							<div id="divcupon" class="notblock row p-t-27 ">
								<div class="col-6">
									<input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Cupón">
								</div>
								<div class="col-6 m-t-6">
									<button type="buton" name="" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
										Aplicar
									</button>
								</div>
							</div>

							<div class="flex-w flex-t p-t-27 p-b-33">

								<div class="size-208">
									<span class="mtext-101 cl2">
										Total:
									</span>
								</div>

								<div class="size-209 p-t-1">
									<span id="totalCompra" class="mtext-110 cl2">
										<?= SMONEY . formatMoney($total); ?>
									</span>
								</div>
							</div>
							<?php if (isset($_SESSION['login'])) { ?>
								<div id="divmetodpago" class="notblock">
									<h4 class="mtext-109 cl2 p-b-30">Método de Pago</h4>
									<div>
										<label for="paypal">
											<input type="radio" id="paypal" class="methodpago" name="payment-method" checked="" value="Paypal">
											<img src="<?= media() ?>/img/img-paypal.jpg" alt="Icono de Paypal" class="ml-space-sm" width="74" height="20">
										</label>
									</div>
									<div>
										<label for="contraentrega">
											<input type="radio" id="contraentrega" class="methodpago" name="payment-method" value="CT">
											<span class="stext-104 cl2 plh4">Contra Entrega</span>
										</label>
									</div>
									<div id="divtipopago" class="notblock m-b-15 m-t-15">
										<label for="listtipopago" class="stext-104 cl2 plh4">Tipo de pago</label>
										<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
											<select name="time" class="js-select2" id="listtipopago">
												<?php if (count($data['tiposPago']) > 0) {
													foreach ($data['tiposPago'] as $tiposPago) {
														if ($tiposPago['idtipopago'] != 1) {
												?>
															<option value="<?= $tiposPago['idtipopago']; ?>"><?= $tiposPago['tipopago']; ?></option>
												<?php
														}
													}
												}
												?>
											</select>
											<div class="dropDownSelect2">
											</div>
										</div>
										<button type="submit" name="" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
											Procesar Perdido
										</button>
									</div>
									<div id="divpaypal">
										<div class="m-b-15 m-t-15">
											<p class="stext-104 cl2 plh4">Para completar la transacción, te redijiremos a los servidores seguros de PayPal</p>
										</div>
										<div id="paypal-button-container"></div>
									</div>
								</div>



							<?php } ?>
						</div>
					</div>
				</div>
			</div>


			<!-- Footer -->
			<?php footerTienda($data); ?>