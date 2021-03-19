<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
getModal("modalRoles", $data);
?>

<div class="mobile-menu-overlay"></div>
<div id="contentAjax"></div>
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
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
              </ol>
            </nav>
          </div>
          <div class="col-6 text-right">
            <button type="button" class="btn btn-primary" onclick="openModal()" data-toggle="modal" data-target="#roles-modal">Agregar</button>
          </div>
        </div>
      </div>
      <!-- Contenido de la pagina -->
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
          <div class="pd-20">
            <h4 class="text-blue h4">Tabla de Roles de Usuarios</h4>
          </div>
          <div class="pb-20">
            <table id="tableRoles" class="data-table table stripe hover nowrap">
              <thead>
                <tr>
                  <th class="table-plus">Id</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Estatus</th>
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
    <div class="footer-wrap pd-20 mb-20 card-box">
      DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
    </div>
  </div>
</div>

<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>