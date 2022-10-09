<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Suscripciones extends Controllers
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
  public function Suscripciones()
  {
    if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/dashboard');
    }
    $data['page_tag'] = "Suscripciones - Tienda Virtual";
    $data['page_title'] = "Suscripciones";
    $data['page_name'] = "Listado de Suscripciones";
    $data['page_funtions_js'] = "funtion_suscripciones.js";
    $this->views->getView($this, "suscripciones", $data);
  }
  public function getSuscriptores()
  {
    if ($_SESSION['permisosMod']['r']) {
      $arrData = $this->model->selectSuscriptores();
      /* dep($arrData); */
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
}
