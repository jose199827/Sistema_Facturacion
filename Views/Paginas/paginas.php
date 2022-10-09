<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
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
          <?php if ($_SESSION['permisosMod']['w']) { ?>
            <div class="col-6 text-right">
              <a href="<?= Base_URL(); ?>/paginas/crear" class=" btn btn-primary">Agregar</a>
            </div>
          <?php } ?>
        </div>
      </div>
      <!-- Contenido de la pagina -->
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <!-- Simple Datatable start -->
        <div class="card-box">
          <div class="pd-20">
            <h4 class="text-blue h4">Tabla de <?= $data['page_title']; ?></h4>
          </div>
          <div class="pb-20">
            <table id="tablePaginas" class="data-table table stripe hover nowrap">
              <thead>
                <tr>
                  <th class="table-plus">Id</th>
                  <th>Título</th>
                  <th>Estado</th>
                  <th>Fecha</th>
                  <th class="datatable-nosort">Acciones</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <!-- Simple Datatable End -->
      </div>
      <!-- Fin contenido de la pagina -->
    </div>
    <?php footer($data); ?>
  </div>
  <!-- Se cierra la llave del IF  -->

</div>

<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>