<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Contactos extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    session_regenerate_id(true);
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
    getPermisos(MCONTACTO);
  }
  //Se crea el método Suscripciones
  public function Contactos()
  {
    if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $data['page_tag'] = "Contactos - Tienda Virtual";
    $data['page_title'] = "Contactos";
    $data['page_name'] = "Listado de Contactos";
    $data['page_funtions_js'] = "funtion_contactos.js";
    $this->views->getView($this, "contactos", $data);
  }
  public function getContactos()
  {
    if ($_SESSION['permisosMod']['r']) {
      $arrData = $this->model->selectContactos();
      for ($i = 0; $i < count($arrData); $i++) {
        $btnView = '<a class="dropdown-item btnViewInfo" href="javascript:;" onClick="fntViewMensaje(' . $arrData[$i]['id'] . ')"><i class="dw dw-eye"></i> Ver mensaje</a>';
        $arrData[$i]['options'] = '<div class="dropdown ">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="javascript:;" role="button"
                                                  data-toggle="dropdown">
                                                  <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                  ' . $btnView . '                                              
                                                </div>
                                              </div>';
      }
      /* dep($arrData); */
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
  public function getMensaje(int $idMesaje)
  {
    if ($_SESSION['permisosMod']['r']) {
      $idMesaje = intval($idMesaje);
      if ($idMesaje > 0) {
        $arrData = $this->model->selectMensaje($idMesaje);
        /* dep($arrData);
        exit; */
        if (empty($arrData)) {
          $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
        } else {
          $arrResponse = array('status' => true, 'data' => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }
  }
}
