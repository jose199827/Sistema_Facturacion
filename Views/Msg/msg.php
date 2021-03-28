<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
getModal("modalMsg", $data);
?>

<div class="mobile-menu-overlay"></div>

<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-6">
            <div class="title">
              <!-- Para el encabezado  de la pagina-->
              <h4><?= $data['page_title']; ?></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= Base_URL(); ?>/dashboard">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data['page_name']; ?></li>
              </ol>
            </nav>
          </div>
          <div class="col-6 text-right">
            <button type="button" class="btn btn-primary" onclick="openModal()" data-toggle="modal" data-target="#msg-modal">Agregar</button>
          </div>
        </div>
      </div>

      <!-- Contenido de la pagina -->
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="row clearfix" id="contentAjax">

        </div>
      </div>
      <!-- Fin contenido de la pagina -->
    </div>
    <?php footer($data); ?>
  </div>
</div>
<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>