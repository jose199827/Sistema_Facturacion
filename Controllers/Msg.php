<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Msg extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
  }
  //Se crea el método Home
  public function msg()
  {
    $data['page_tag'] = "Mensajes - Tienda Virtual";
    $data['page_title'] = "Mensajes";
    $data['page_name'] = "Mensajes de Bienvenida";
    $data['page_id'] = 4;
    $data['page_funtions_js'] = "funtions_msg.js";
    $this->views->getView($this, "msg", $data);
  }
  public function setMsg()
  {
    /* dep($_POST);
    die(); */
    /*     $retVal = (condition) ? a : b; */
    $idMsg = intval($_POST['idMsg']);
    $txtTitulo  = (empty($_POST['txtTitulo'])) ? "Mensaje de Bienvenida" : strClean($_POST['txtTitulo']);
    $txtMensaje = strClean($_POST['txtMensaje']);
    if ($idMsg == 0) {
      $request = $this->model->insertMsg($txtTitulo, $txtMensaje);
      $option = 1;
    } else {
      /* Actualizar */
      $request = $this->model->updateMsg($idMsg, $txtTitulo, $txtMensaje);
      $option = 2;
    }
    if ($request > 0) {
      if ($option == 1) {
        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
      } else {
        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
      }
    } else if ($request == 'exist') {
      $arrResponse = array('status' => false, 'msg' => '¡Atención! El mensaje ya existe.');
    } else if ($request == 'sqlinjection') {
      $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
    } else {
      $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
    }

    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function getMsg()
  {
    $arrData = $this->model->selectMsg();
    if (empty($arrData)) {
      $arrResponse = array("status" => false, "msg" => 'Datos no encontrados.');
    } else {
      $arrResponse = array("status" => true, "data" => $arrData);
    }
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    die();
  }
  /*  public function getMsg()
  {
    $arrData = $this->model->selectMsg();
    $arrMsg['mensajes'] = $arrData;
    $html = getModal("modamsg", $arrMsg);
    die();
  } */
}
