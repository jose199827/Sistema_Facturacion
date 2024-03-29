		<?php headerTienda($data);
		/* dep($arrProductos); */
		$arrProductos = $data['productos'];
		$arrProducto = $data['producto'];
		$arrImages = $arrProducto['images'];
		$urlshaed = Base_URL() . "/Tienda/Producto/" . $arrProducto['idproducto'] . "/" . $arrProducto['ruta'];
		?>
		<br><br><br>
		<hr>
		<!-- breadcrumb -->
		<div class="container">
		    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		        <a href="<?= Base_URL(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
		            Inicio
		            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		        </a>

		        <a href="<?= Base_URL() . '/Tienda'; ?>" class="stext-109 cl8 hov-cl1 trans-04">
		            Tienda
		            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		        </a>

		        <a href="<?= Base_URL() . '/Tienda/Categoria/' . $arrProducto['categoriaid'] . '/' . $arrProducto['categoriaRuta']; ?>"
		            class="stext-109 cl8 hov-cl1 trans-04">
		            <?= $arrProducto['categoria']; ?>
		            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		        </a>

		        <span class="stext-109 cl4">
		            <?= $arrProducto['nombre']; ?>
		        </span>
		    </div>
		</div>

		<!-- Product Detail -->
		<section class="sec-product-detail bg0 p-t-65 p-b-60">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-6 col-lg-7 p-b-30">
		                <div class="p-l-25 p-r-30 p-lr-0-lg">
		                    <div class="wrap-slick3 flex-sb flex-w">
		                        <div class="wrap-slick3-dots"></div>
		                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

		                        <div class="slick3 gallery-lb">

		                            <?php
									for ($i = 0; $i < count($arrImages); $i++) {
									?>
		                            <div class="item-slick3" data-thumb="<?= $arrImages[$i]['url_img']; ?>">
		                                <div class="wrap-pic-w pos-relative">
		                                    <img src="<?= $arrImages[$i]['url_img']; ?>" alt="<?= $arrProducto['nombre']; ?>">
		                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
		                                        href="<?= $arrImages[$i]['url_img']; ?>">
		                                        <i class="fa fa-expand"></i>
		                                    </a>
		                                </div>
		                            </div>
		                            <?php

									} ?>

		                        </div>
		                    </div>
		                </div>
		            </div>

		            <div class="col-md-6 col-lg-5 p-b-30">
		                <div class="p-r-50 p-t-5 p-lr-0-lg">
		                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
		                        <?= $arrProducto['nombre']; ?>
		                    </h4>

		                    <span class="mtext-106 cl2">
		                        <?= SMONEY . formatMoney($arrProducto['precio']); ?>
		                    </span>

		                    <!-- <p class="stext-102 cl3 p-t-23">
		                  Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
		               </p> -->

		                    <!--  -->
		                    <div class="p-t-33 ">

		                        <div class="flex-w flex-r-m p-b-10">
		                            <div class="size-204 flex-w flex-m respon6-next">
		                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
		                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
		                                        <i class="fs-16 zmdi zmdi-minus"></i>
		                                    </div>

		                                    <input id="cant-product" class="mtext-104 cl3 txt-center num-product"
		                                        type="number" name="num-product" value="1" min="1">

		                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
		                                        <i class="fs-16 zmdi zmdi-plus"></i>
		                                    </div>
		                                </div>
		                                <div class="p-t-30">
		                                    <button
		                                        id="<?= openssl_encrypt($arrProducto['idproducto'], METHODENCRIPT, KEY); ?>"
		                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
		                                        Agregar al Carrito
		                                    </button>
		                                </div>
		                            </div>
		                        </div>
		                    </div>

		                    <!--  -->
		                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
		                        <div class="flex-m bor9 p-r-10 m-r-11">
		                            Compartir en
		                        </div>

		                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
		                            data-tooltip="Facebook"
		                            onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= $urlshaed ?>&t=<?= $arrProducto['nombre'] ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
		                            <i class="fa fa-facebook"></i>
		                        </a>

		                        <a href="https://twitter.com/intent/tweet?text= <?= $arrProducto['nombre']; ?>&url=<?= $urlshaed ?>&hashtags=<?= HASHTAGS ?>"
		                            target="_blank" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
		                            data-tooltip="Twitter">
		                            <i class="fa fa-twitter"></i>
		                        </a>

		                        <a href="https://api.whatsapp.com/send?text= <?= $arrProducto['nombre'] . ' ' . $urlshaed ?>"
		                            target="_blank" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
		                            data-tooltip="Whatsapp">
		                            <i class="fa fa-whatsapp"></i>
		                        </a>
		                    </div>
		                </div>
		            </div>
		        </div>

		        <div class="bor10 m-t-50 p-t-43 p-b-40">
		            <!-- Tab01 -->
		            <div class="tab01">

		                <!-- Tab panes -->
		                <div class="tab-content ">
		                    <!-- - -->
		                    <div class="tab-pane fade show active" id="description" role="tabpanel">
		                        <div class="how-pos2 container p-lr-15-md">
		                            <h3>Descripción de Producto</h3>
		                            <br>
		                            <?= $arrProducto['descripcion']; ?>
		                        </div>
		                    </div>

		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
		        <span class="stext-107 cl6 p-lr-25">
		            SKU: <?= $arrProducto['codigo']; ?>
		        </span>

		        <span class="stext-107 cl6 p-lr-25">
		            Categoría: <?= $arrProducto['categoria'] . ", " . $arrProducto['nombre']; ?>
		        </span>
		    </div>
		</section>


		<!-- Related Products -->
		<section class="sec-relate-product bg0 p-t-45 p-b-105">
		    <div class="container">
		        <div class="p-b-45">
		            <h3 class="ltext-106 cl5 txt-center">
		                Productos Relacionados
		            </h3>
		        </div>

		        <!-- Slide2 -->
		        <div class="wrap-slick2">
		            <div class="slick2">
		                <?php
						if (!empty($arrProductos)) {
							for ($i = 0; $i < count($arrProductos); $i++) {
								$ruta = $arrProductos[$i]['ruta'];
								if (count($arrProductos[$i]['images']) > 0) {
									$portada = $arrProductos[$i]['images'][0]['url_img'];
								} else {
									$portada = media() . '/img/imgUploads/imgProductos/Producto_Default.png';
								}
						?>
		                <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
		                    <!-- Block2 -->
		                    <div class="block2">
		                        <div class="block2-pic hov-img0">
		                            <img src="<?= $portada; ?>" alt="<?= $arrProductos[$i]['nombre']; ?>">

		                            <a href="<?= base_url() . '/Tienda/Producto/' . $arrProductos[$i]['idproducto'] . '/' . $ruta; ?>"
		                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
		                                Ver Producto
		                            </a>
		                        </div>

		                        <div class="block2-txt flex-w flex-t p-t-14">
		                            <div class="block2-txt-child1 flex-col-l ">
		                                <a href="<?= base_url() . '/Tienda/Producto/' . $arrProductos[$i]['idproducto'] . '/' . $ruta; ?>"
		                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
		                                    <?= $arrProductos[$i]['nombre']; ?>
		                                </a>

		                                <span class="stext-105 cl3">
		                                    <?= SMONEY . formatMoney($arrProductos[$i]['precio']); ?>
		                                </span>
		                            </div>
		                            <div class="block2-txt-child2 flex-r p-t-3">
		                                <a href="#"
		                                    id="<?= openssl_encrypt($arrProductos[$i]['idproducto'], METHODENCRIPT, KEY); ?>"
		                                    pr="1"
		                                    class="btn-addwish-b2 dis-block pos-relative js-addwish-b2 js-addcart-detail cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-l-22">
		                                    <i class="zmdi zmdi-shopping-cart"></i>
		                                </a>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <?php
							}
						} else {
							echo "No tenemos productos relacionados a esta Categoría " . $data['page_title'];
						}
						?>

		            </div>
		        </div>
		    </div>
		</section>
		<!-- Footer -->
		<?php footerTienda($data); ?>