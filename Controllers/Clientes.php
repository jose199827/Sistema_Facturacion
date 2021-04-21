<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Clientes extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    session_regenerate_id(true);
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
    getPermisos(3);
  }
  //Se crea el método Home
  public function clientes()
  {
    if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $data['page_tag'] = "Clientes - Tienda Virtual";
    $data['page_title'] = "Clientes";
    $data['page_name'] = "Listado de Clientes";
    $data['page_id'] = 2;
    $data['page_funtions_js'] = "funtions_clientes.js";
    $this->views->getView($this, "clientes", $data);
  }
  public function setClientes()
  {
    if ($_POST) {
      if (
        empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtEmail']) || empty($_POST['txtTelefono']) || empty($_POST['txtIdentificacionFiscal']) || empty($_POST['txtNombreFiscal']) || empty($_POST['texDireccionFiscal'])
      ) {
        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
      } else {
        $intIdCliente = intval($_POST['idCliente']);
        $strIdentificacion = strClean($_POST['txtIdentificacion']);
        $strNombre = ucwords(strClean($_POST['txtNombre']));
        $strApellido = ucwords(strClean($_POST['txtApellido']));
        $strTelefono = strClean($_POST['txtTelefono']);
        $strEmail = strtolower(strClean($_POST['txtEmail']));
        $intIdentificacionFiscal = strClean($_POST['txtIdentificacionFiscal']);
        $strNombreFiscal = strClean($_POST['txtNombreFiscal']);
        $strDireccionFiscal = strClean($_POST['texDireccionFiscal']);
        $intTipoId = 2;
        $request_user = "";

        if ($intIdCliente == 0) {
          $option = 1;
          $strPassword = empty($_POST['txtPassword']) ? passGenerator() : $_POST['txtPassword'];
          $strPasswordEncript = hash("SHA256", $strPassword);
          if ($_SESSION['permisosMod']['w']) {
            $request_user = $this->model->insertCliente(
              $strIdentificacion,
              $strNombre,
              $strApellido,
              $strTelefono,
              $strEmail,
              $strPasswordEncript,
              $intIdentificacionFiscal,
              $strNombreFiscal,
              $strDireccionFiscal,
              $intTipoId
            );
          }
        } else {
          $option = 2;
          $strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);
          if ($_SESSION['permisosMod']['u']) {
            $request_user = $this->model->updateCliente(
              $intIdCliente,
              $strIdentificacion,
              $strNombre,
              $strApellido,
              $strTelefono,
              $strEmail,
              $strPassword,
              $intIdentificacionFiscal,
              $strNombreFiscal,
              $strDireccionFiscal,
            );
          }
        }
        if ($request_user > 0) {
          if ($option == 1) {
            $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
            $nombreUsuario = $strNombre . ' ' . $strApellido;
            $dataUsuario = array(
              'nombreUsuario' => $nombreUsuario,
              'email' => $strEmail,
              'password' => $strPassword,
              'asunto' => 'Bienvenido a tu Tienda en Linea',
            );
            sendEmail($dataUsuario, 'email_bienvenidaCliente');
          } else {
            $arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente.');
          }
        } else if ($request_user == 'exist') {
          $arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificacion ya existe.');
        } else if ($request_user == 'sqlinjection') {
          $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
        } else {
          $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
        }
      }
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
  public function getClientes()
  {
    if ($_SESSION['permisosMod']['r']) {
      $arrData = $this->model->selectClientes();
      /* dep($arrData); */
      for ($i = 0; $i < count($arrData); $i++) {
        $btnView = '';
        $btnEdit = '';
        $btnDel = '';
        if ($_SESSION['permisosMod']['r']) {
          $btnView = '<a class="dropdown-item btnViewCliente" href="javascript:;" onClick="fntViewCliente(' . $arrData[$i]['idpersona'] . ')"><i class="dw dw-eye"></i> Ver</a>';
        }
        if ($_SESSION['permisosMod']['u']) {
          $btnEdit = '<a class="dropdown-item btnEditCliente" href="javascript:;" onClick="fntEditCliente(this,' . $arrData[$i]['idpersona'] . ')"><i class="dw dw-edit2"></i> Editar</a>';
        }
        if ($_SESSION['permisosMod']['d']) {
          $btnDel = '<a class="dropdown-item btnDelCliente" href="javascript:;" onClick="fntDelCliente(' . $arrData[$i]['idpersona'] . ')"><i class="dw dw-delete-3"></i> Eliminar</a>';
        }

        $arrData[$i]['nombres'] = $arrData[$i]['nombres'] . " " . $arrData[$i]['apellidos'];

        $arrData[$i]['options'] = '<div class="dropdown ">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="javascript:;" role="button"
                                                  data-toggle="dropdown">
                                                  <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                  ' . $btnView . '
                                                  ' . $btnEdit . '
                                                  ' . $btnDel . '                                                 
                                                </div>
                                              </div>';
      }
      /**/
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
      die();
    }
  }
  public function getCliente($idpersona)
  {
    if ($_SESSION['permisosMod']['r']) {
      $idCliente = intval($idpersona);
      if ($idCliente > 0) {
        $arrData = $this->model->selectCliente($idCliente);
        if (empty($arrData)) {
          $arrResponse = array("status" => false, "msg" => 'Datos no encontrados.');
        } else {
          $arrResponse = array("status" => true, "data" => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }
  }
  public function delCliente()
  {
    if ($_POST) {
      if ($_SESSION['permisosMod']['d']) {
        $intIdpersona = intval($_POST['idUsuario']);
        $requestDelete = "";
        $requestDelete = $this->model->deleteCliente($intIdpersona);

        if ($requestDelete) {
          $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el cliente.');
        } else {
          $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el cliente.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }
  }
}
