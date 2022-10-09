<div class="right-sidebar">
  <div class="sidebar-title">
    <h3 class="weight-600 font-16 text-blue">
      Opciones de Diseño
      <span class="btn-block font-weight-400 font-12">Configuración de la interfaz de usuario</span>
    </h3>
    <div class="close-sidebar" data-toggle="right-sidebar-close">
      <i class="icon-copy ion-close-round"></i>
    </div>
  </div>
  <div class="right-sidebar-body customscroll">
    <div class="right-sidebar-body-content">
      <h4 class="weight-600 font-18 pb-10">Fondo del encabezado</h4>
      <div class="sidebar-btn-group pb-30 mb-10">
        <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">Blanco</a>
        <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Negro</a>
      </div>

      <h4 class="weight-600 font-18 pb-10">Fondo de la barra lateral</h4>
      <div class="sidebar-btn-group pb-30 mb-10">
        <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">Blanco</a>
        <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Negro</a>
      </div>

      <h4 class="weight-600 font-18 pb-10">Icono de menú desplegable</h4>
      <div class="sidebar-radio-group pb-10 mb-10">
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
          <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
          <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
          <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
        </div>
      </div>

      <h4 class="weight-600 font-18 pb-10">Icono de lista de menú</h4>
      <div class="sidebar-radio-group pb-30 mb-10">
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
          <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
          <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
          <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
          <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
          <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
          <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
        </div>
      </div>

      <div class="reset-options pt-30 text-center">
        <button class="btn btn-danger" id="reset-settings">Reiniciar ajustes</button>
      </div>
    </div>
  </div>
</div>

<div class="left-side-bar">
  <div class="brand-logo">
    <a href="<?= Base_URL(); ?>/dashboard">
      <img src="<?= vendors(); ?>/images/deskapp-logo.svg" alt="" class="dark-logo">
      <img src="<?= vendors(); ?>/images/deskapp-logo-white.svg" alt="" class="light-logo">
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">

        <?php if (!empty($_SESSION['permisos'][1]['r'])) { ?>
          <li>
            <a href="<?= Base_URL(); ?>/dashboard" class="dropdown-toggle no-arrow">
              <span class="micon dw dw-house1"></span><span class="mtext">Inicio</span>
            </a>
          </li>
        <?php } ?>
        <li>
          <a href="<?= Base_URL(); ?>" target="_blanck" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-worldwide"></span><span class="mtext">Ver Sitio Web</span>
          </a>
        </li>
        <?php if (!empty($_SESSION['permisos'][2]['r']) || !empty($_SESSION['permisos'][7]['r'])) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-id-card1"></span><span class="mtext">Usuarios</span>
            </a>
            <ul class="submenu">
              <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
                <li><a href="<?= Base_URL(); ?>/usuarios">Usuarios</a></li>
              <?php } ?>
              <?php if (!empty($_SESSION['permisos'][7]['r'])) { ?>
                <li><a href="<?= Base_URL(); ?>/roles">Roles</a></li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
          <li>
            <a href="<?= Base_URL(); ?>/clientes" class="dropdown-toggle no-arrow">
              <span class="micon dw dw-group"></span><span class="mtext">Clientes</span>
            </a>
          </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][6]['r'])) { ?>
          <li class="dropdown">
            <a href="javascript:;" class="dropdown-toggle">
              <span class="micon dw dw-price-tag"></span><span class="mtext">Productos</span>
            </a>
            <ul class="submenu">
              <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
                <li><a href="<?= Base_URL(); ?>/Productos">Productos</a></li>
              <?php } ?>
              <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
                <li><a href="<?= Base_URL(); ?>/Categorias">Categorías</a></li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
          <li>
            <a href="<?= Base_URL(); ?>/Pedidos" class="dropdown-toggle no-arrow">
              <span class="micon dw dw-shopping-cart1"></span><span class="mtext">Pedidos</span>
            </a>
          </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][MSUSCIPTORES]['r'])) { ?>
          <li>
            <a href="<?= Base_URL(); ?>/Suscripciones" class="dropdown-toggle no-arrow">
              <span class="micon dw dw-email1"></span><span class="mtext">Suscripciones</span>
            </a>
          </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][MCONTACTO]['r'])) { ?>
          <li>
            <a href="<?= Base_URL(); ?>/contactos" class="dropdown-toggle no-arrow">
              <span class="micon dw dw-notification1"></span><span class="mtext">Contactos</span>
            </a>
          </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][MPAGINAS]['r'])) { ?>
          <li>
            <a href="<?= Base_URL(); ?>/Paginas" class="dropdown-toggle no-arrow">
              <span class="micon dw dw-edit-file"></span><span class="mtext">Páginas</span>
            </a>
          </li>
        <?php } ?>
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle">
            <span class="micon dw dw-settings1"></span><span class="mtext">Configuración</span>
          </a>
          <ul class="submenu">
            <li><a href="<?= Base_URL(); ?>/msg">Mesajes de Bienvenida</a></li>
          </ul>
          <ul class="submenu">
            <li><a href="<?= Base_URL(); ?>/msg">Mesajes de Bienvenida</a></li>
          </ul>
        </li>
        <li>
          <a href="<?= Base_URL(); ?>/logout" class="dropdown-toggle no-arrow">
            <span class="micon dw dw-logout1"></span><span class="mtext">Cerrar sesión</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>