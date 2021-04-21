<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Usuarios extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    session_regenerate_id(true);
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
    getPermisos(2);
  }
  //Se crea el método Home
  public function usuarios()
  {
    if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $data['page_tag'] = "Usuarios - Tienda Virtual";
    $data['page_title'] = "Usuarios";
    $data['page_name'] = "Listado de Usuarios";
    $data['page_funtions_js'] = "funtion_usuarios.js";
    $this->views->getView($this, "usuarios", $data);
  }
  public function setUsuario()
  {
    if ($_POST) {
      if (
        empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtEmail']) || empty($_POST['txtTelefono']) || empty($_POST['listRolid']) || empty($_POST['listStatus'])
      ) {
        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
      } else {
        $intIdUsuario = intval($_POST['idUsuario']);
        $strIdentificacion = strClean($_POST['txtIdentificacion']);
        $strNombre = ucwords(strClean($_POST['txtNombre']));
        $strApellido = ucwords(strClean($_POST['txtApellido']));
        $strTelefono = strClean($_POST['txtTelefono']);
        $strEmail = strtolower(strClean($_POST['txtEmail']));
        $intTipousuario = intval(strClean($_POST['listRolid']));
        $intStatus = intval(strClean($_POST['listStatus']));
        $request_user = "";
        if ($intIdUsuario == 0) {
          $option = 1;
          $strPassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtPassword']);
          if ($_SESSION['permisosMod']['w']) {
            $request_user = $this->model->insertUsuario(
              $strIdentificacion,
              $strNombre,
              $strApellido,
              $strTelefono,
              $strEmail,
              $intTipousuario,
              $intStatus,
              $strPassword
            );
          }
        } else {
          $option = 2;
          $strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);
          if ($_SESSION['permisosMod']['u']) {
            $request_user = $this->model->updateUsuario($intIdUsuario, $strIdentificacion, $strNombre, $strApellido, $strTelefono, $strEmail, $intTipousuario, $intStatus, $strPassword);
          }
        }
        if ($request_user > 0) {

          if ($option == 1) {
            $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.');
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
  public function getUsuarios()
  {
    if ($_SESSION['permisosMod']['r']) {
      $arrData = $this->model->selectUsuarios();
      /* dep($arrData); */
      for ($i = 0; $i < count($arrData); $i++) {
        $btnView = '';
        $btnEdit = '';
        $btnDel = '';
        if ($arrData[$i]['status'] == 1) {
          $arrData[$i]['status'] = '<span class="badge badge-success badge-pill">Activo</span>';
        } else {
          $arrData[$i]['status'] = '<span class="badge badge-warning badge-pill">Inactivo</span>';
        }
        if ($_SESSION['permisosMod']['r']) {
          $btnView = '<a class="dropdown-item btnViewUsuario" href="javascript:;" onClick="fntViewUsuario(' . $arrData[$i]['idpersona'] . ')"><i class="dw dw-eye"></i> Ver</a>';
        }
        if ($_SESSION['permisosMod']['u']) {

          if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
            ($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1)
          ) {
            $btnEdit = '<a class="dropdown-item btnEditUsuario" href="javascript:;" onClick="fntEditUsuario(this,' . $arrData[$i]['idpersona'] . ')"><i class="dw dw-edit2"></i> Editar</a>';
          } else {
            $btnEdit = '<a class="dropdown-item btnEditUsuario" disabled "><i class="dw dw-edit2"></i> Editar</a>';
          }
        }
        if ($_SESSION['permisosMod']['d']) {


          if ((($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) or
              ($_SESSION['userData']['idrol'] == 1) and ($arrData[$i]['idrol'] != 1)) and
            (($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona']))
          ) {
            $btnDel = '<a class="dropdown-item btnDelUsuario" href="javascript:;" onClick="fntDelUsuario(' . $arrData[$i]['idpersona'] . ')"><i class="dw dw-delete-3"></i> Eliminar</a>';
          } else {
            $btnDel = '<a class="dropdown-item btnDelUsuario" disabled "><i class="dw dw-delete-3"></i> Eliminar</a>';
          }
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
  public function getUsuario($idpersona)
  {
    if ($_SESSION['permisosMod']['r']) {
      $idusuario = intval($idpersona);
      if ($idusuario > 0) {
        $arrData = $this->model->selectUsuario($idusuario);
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
  public function delUsuario()
  {
    if ($_POST) {
      if ($_SESSION['permisosMod']['d']) {
        $intIdpersona = intval($_POST['idUsuario']);
        $requestDelete = "";

        $requestDelete = $this->model->deleteUsuario($intIdpersona);

        if ($requestDelete) {
          $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario.');
        } else {
          $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }
  }
  public function perfil()
  {
    /* if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/Errors');
    } */
    $data['page_tag'] = "Perfil - Tienda Virtual";
    $data['page_title'] = "Perfil";
    $data['page_name'] = "Perfil de Usuario";
    $data['page_funtions_js'] = "funtion_usuarios.js";
    $this->views->getView($this, "perfil", $data);
  }
  public function putPerfil()
  {
    if ($_POST) {
      if (
        empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono'])
      ) {
        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
      } else {
        $intIdUsuario = $_SESSION['idUser'];
        $strIdentificacion = strClean($_POST['txtIdentificacion']);
        $strNombre = ucwords(strClean($_POST['txtNombre']));
        $strApellido = ucwords(strClean($_POST['txtApellido']));
        $strTelefono = strClean($_POST['txtTelefono']);
        $strPassword = "";
        if (!empty($_POST['txtPassword'])) {
          $strPassword = hash("SHA256", $_POST['txtPassword']);
        }
        $request_user = $this->model->updatePerfil($intIdUsuario, $strIdentificacion, $strNombre, $strApellido, $strTelefono, $strPassword);
        if ($request_user > 0) {
          sessionUser($_SESSION['idUser']);
          $arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente.');
        } else if ($request_user == 'sqlinjection') {
          $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
        } else {
          $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        }
      }
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
  public function putDFiscal()
  {
    if ($_POST) {
      if (empty($_POST['txtIdentificacionFiscal']) || empty($_POST['txtNombreFiscal']) || empty($_POST['texDireccionFiscal'])) {
        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
      } else {
        $intIdUsuario = $_SESSION['idUser'];
        $strIdentificacionFiscal = strClean($_POST['txtIdentificacionFiscal']);
        $strNombreFiscal = strClean($_POST['txtNombreFiscal']);
        $strDireccionFiscal = strClean($_POST['texDireccionFiscal']);
        $request_DataFiscal = $this->model->updateDatosFiscales($intIdUsuario, $strIdentificacionFiscal, $strNombreFiscal, $strDireccionFiscal);
        if ($request_DataFiscal > 0) {
          sessionUser($_SESSION['idUser']);
          $arrResponse = array("status" => true, "msg" => 'Datos actualizados correctamente.');
        } else if ($request_DataFiscal == 'sqlinjection') {
          $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
        } else {
          $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        }
      }
      sleep(5);
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
}
