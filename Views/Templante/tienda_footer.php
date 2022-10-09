<?php
$categoriasFooter = getcatergoriasFooter();
?>
<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-lg-4 p-b-50">
        <h4 class="stext-301 cl0 p-b-30">
          Categorías
        </h4>
        <?php
        if (count($categoriasFooter) > 0) { ?>
          <ul>
            <?php foreach ($categoriasFooter as $categoria) { ?>
              <li class="p-b-10">
                <a href="<?= Base_URL() ?>/Tienda/categoria/<?= $categoria['idcategoria'] . '/' . $categoria['ruta'] ?>" class="stext-107 cl7 hov-cl1 trans-04">
                  <?= $categoria["nombre"] ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>

      <div class="col-sm-6 col-lg-4 p-b-50">
        <h4 class="stext-301 cl0 p-b-30">
          Cotacto
        </h4>

        <p class="stext-107 cl7 size-201">
          <?= DIRECCION ?>
          <br>
          Tel: <a class="stext-107 cl7 hov-cl1 trans-04" href="tel:<?= TELEFONO ?>"><?= TELEFONO ?></a>
          <br>
          Email: <a class="stext-107 cl7 hov-cl1 trans-04" href="mailto:<?= EMAIL_EMPRESA ?>"><?= EMAIL_EMPRESA ?></a>
        </p>

        <div class="p-t-27">
          <a href="<?= FACEBOOK ?>" target="_blanck" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
            <i class="fa fa-facebook"></i>
          </a>

          <a href="<?= INSTAGRAM ?>" target="_blanck" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
            <i class="fa fa-instagram"></i>
          </a>
        </div>
      </div>

      <div class="col-sm-6 col-lg-4 p-b-50">
        <h4 class="stext-301 cl0 p-b-30">
          Suscríbete
        </h4>

        <form id="frmSubscripcion" name="frmSubscripcion">
          <div class="wrap-input1 w-full p-b-4">
            <input class="input1 bg-none plh1 stext-107 cl7" type="text" id="nombreSubcripcion" name="nombreSubcripcion" placeholder="Nombre" required>
            <div class="focus-input1 trans-04"></div>
          </div><br>
          <div class="wrap-input1 w-full p-b-4">
            <input class="input1 bg-none plh1 stext-107 cl7" type="email" id="emailSubcripcion" name="emailSubcripcion" placeholder="email@ejemplo.com" required>
            <div class="focus-input1 trans-04"></div>
          </div>

          <div class="p-t-18">
            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
              Suscribirme
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="p-t-40">
      <p class="stext-107 cl6 txt-center">
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>
          document.write(new Date().getFullYear());
        </script> Todos los derechos reservados | Esta plantilla está hecha con <i class="fa fa-heart-o" aria-hidden="true"></i> por <a href="https://colorlib.com" target="_blank">Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
    </div>
  </div>
</footer>
<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
  <span class="symbol-btn-back-to-top">
    <i class="zmdi zmdi-chevron-up"></i>
  </span>
</div>
<script>
  const base_url = "<?= Base_URL(); ?>";
  const smony = "<?= SMONEY; ?>";
</script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/bootstrap/js/popper.js"></script>
<script src="<?= media() ?>/tienda/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= media() ?>/tienda/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/slick/slick.min.js"></script>
<script src="<?= media() ?>/tienda/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/parallax100/parallax100.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/js/main.js"></script>
<script src="<?= media(); ?>/js/funtions_login.js"></script>
<script src="<?= media(); ?>/js/funtions_admin.js"></script>
<script src="<?= media() ?>/tienda/js/functions.js"></script>

</body>

</html>