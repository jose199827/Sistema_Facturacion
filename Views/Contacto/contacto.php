<?php headerTienda($data);
$banner = media() . '/tienda/images/bg-02.jpg';
?>
<script>
  document.querySelector('header').classList.add('header-v4');
</script>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner ?>);">
  <h2 class="ltext-105 cl0 txt-center">
    Contact
  </h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <div class="flex-w flex-tr">
      <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
        <form id="frmContacto">
          <h4 class="mtext-105 cl2 txt-center p-b-30">
            Mandanos un mensaje
          </h4>

          <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="nombrecontancto" id="nombrecontancto" placeholder="Nombre completo">
            <img class="how-pos4 pointer-none" src="<?= media() . '/tienda/images/icons/icon-email.png' ?>" alt=" ICON">
          </div>

          <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="emailcontancto" id="emailcontancto" placeholder="Correo electronico">
            <img class="how-pos4 pointer-none" src="<?= media() . '/tienda/images/icons/icon-email.png' ?>" alt=" ICON">
          </div>

          <div class="bor8 m-b-30">
            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msgcontancto" id="msgcontancto" placeholder="¿Cómo podemos ayudar?"></textarea>
          </div>

          <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
            Enviar
          </button>
        </form>
      </div>

      <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
        <div class="flex-w w-full p-b-42">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-map-marker"></span>
          </span>

          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Dirección
            </span>

            <p class="stext-115 cl6 size-213 p-t-18 cl7 hov-cl1 trans-04">
              <?= DIRECCION ?>
            </p>
          </div>
        </div>

        <div class="flex-w w-full p-b-42">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-phone-handset"></span>
          </span>

          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Teléfono
            </span>

            <p class="stext-115 cl1 size-213 p-t-18">
              <a class="cl7 hov-cl1 trans-04" href="tel:<?= TELEFONO ?>"><?= TELEFONO ?></a>
            </p>
          </div>
        </div>

        <div class="flex-w w-full">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-envelope"></span>
          </span>

          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Email
            </span>

            <p class="stext-115 cl1 size-213 p-t-18">
              <a class="cl7 hov-cl1 trans-04" href="mailto:<?= EMAIL_EMPRESA ?>"><?= EMAIL_EMPRESA ?></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Map -->
<div class="map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.5046400091865!2d-87.20647365849499!3d14.106394087473348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6fa3acb153dac9%3A0xd26071b9dfc95afa!2sMuseo%20Casa%20Moraz%C3%A1n!5e0!3m2!1ses!2shn!4v1662340257491!5m2!1ses!2shn" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<?php footerTienda($data); ?>