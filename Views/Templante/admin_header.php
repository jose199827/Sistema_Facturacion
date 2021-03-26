<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8">
  <meta name="desciption" content="Tienda Virtual">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="Jose Pineda">
  <title><?= $data['page_tag']; ?></title>

  <!-- Site favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= media(); ?>/img/favicon.ico">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- CSS -->


  <link rel="stylesheet" type="text/css" href="<?= vendors(); ?>/styles/core.css">
  <link rel="stylesheet" type="text/css" href="<?= vendors(); ?>/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/plugins/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/plugins/datatables/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="<?= vendors(); ?>/styles/style.css">


  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/estilos.css">

</head>

<body>

  <div class="pre-loader">
    <div class="pre-loader-box">
      <div class="loader-logo"><img src="vendors/images/deskapp-logo.svg" alt=""></div>
      <div class='loader-progress' id="progress_div">
        <div class='bar' id='bar1'></div>
      </div>
      <div class='percent' id='percent1'>0%</div>
      <div class="loading-text">
        Cargando...
      </div>
    </div>
  </div>

  <div class="header">
    <div class="header-left">
      <div class="menu-icon dw dw-menu"></div>
    </div>
    <div class="header-right">
      <div class="user-info-dropdown">
        <div class="dropdown">
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">
              <img src="<?= vendors(); ?>/images/photo1.jpg" alt="">
            </span>
            <span class="user-name">Jose Pineda </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item" href="<?= Base_URL(); ?>/perfil"><i class="dw dw-user1"></i> Perfil</a>
            <a class="dropdown-item" href="javascript:;" data-toggle="right-sidebar"><i class="dw dw-paint-palette"></i> Diseño</a>
            <a class="dropdown-item" href="<?= Base_URL(); ?>/logout"><i class="dw dw-logout1"></i>Cerrar Seccion</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Se manda a llamar el menu -->
  <?php require_once("admin_nav.php") ?>