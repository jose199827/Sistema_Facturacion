<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Roles extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    session_regenerate_id(true);
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
    getPermisos(7);
  }
  //Se crea el método Home
  public function roles()
  {
    if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $data['page_tag'] = "Roles de usuarios - Tienda Virtual";
    $data['page_title'] = "Roles de usuarios";
    $data['page_name'] = "Listado de Roles de Usuario";
    $data['page_id'] = 3;
    $data['page_funtions_js'] = "funtions_roles.js";
    $this->views->getView($this, "roles", $data);
  }
  public function getRoles()
  {
    if ($_SESSION['permisosMod']['r']) {
      $arrData = $this->model->selectRoles();
      for ($i = 0; $i < count($arrData); $i++) {
        $btnView = '';
        $btnEdit = '';
        $btnDel = '';
        if ($arrData[$i]['status'] == 1) {
          $arrData[$i]['status'] = '<span class="badge badge-success badge-pill">Activo</span>';
        } else {
          $arrData[$i]['status'] = '<span class="badge badge-warning badge-pill">Inactivo</span>';
        }

        if ($_SESSION['permisosMod']['u']) {
          $btnView = '<a class="dropdown-item btnPermisosRol" href="javascript:;" onClick="fntPermisos(' . $arrData[$i]['idrol'] . ')"><i class="dw dw-key1"></i> Permisos</a>';
          $btnEdit = '<a class="dropdown-item btnEditRol" href="javascript:;" onClick="fntEditRol(' . $arrData[$i]['idrol'] . ')"><i class="dw dw-edit2"></i> Editar</a>';
        }
        if ($_SESSION['permisosMod']['d']) {
          $btnDel = '<a class="dropdown-item btnDelRol" href="javascript:;" onClick="fntDelRol(' . $arrData[$i]['idrol'] . ')"><i class="dw dw-delete-3"></i> Eliminar</a>';
        }

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
  public function getSelectRoles()
  {
    $htmlOptions = "";
    $arrData = $this->model->selectRoles();
    if (count($arrData) > 0) {
      for ($i = 0; $i < count($arrData); $i++) {
        if ($arrData[$i]['status'] == 1) {
          $htmlOptions .= '<option value ="' . $arrData[$i]['idrol'] . '">' . $arrData[$i]['nombrerol'] . '</option>';
        }
      }
    }
    echo $htmlOptions;
    die();
  }
  public function getRol(int $idrol)
  {
    if ($_SESSION['permisosMod']['r']) {
      $intIdRol = intval(strClean($idrol));
      if ($intIdRol > 0) {
        $arrData = $this->model->selectRol($intIdRol);
        if (empty($arrData)) {
          $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
        } else {
          $arrResponse = array('status' => true, 'data' => $arrData);
        }
      }

      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      die();
    }
  }

  public function setRoles()
  {
    $intIdrol = intval($_POST['idRol']);
    $strRol = strClean($_POST['txtNombre']);
    $strDescripcion = strClean($_POST['txtDescripcion']);
    $intStatus = intval($_POST['listStatus']);
    $request_rol = "";
    if ($intIdrol == 0) {
      /* Crear */
      if ($_SESSION['permisosMod']['w']) {
        $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
        $option = 1;
      }
    } else {
      if ($_SESSION['permisosMod']['u']) {
        /* Actualizar */
        $request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intStatus);
        $option = 2;
      }
    }

    if ($request_rol > 0) {
      if ($option == 1) {
        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
      } else {
        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
      }
    } else if ($request_rol == 'exist') {
      $arrResponse = array('status' => false, 'msg' => '¡Atención! El rol ya existe.');
    } else if ($request_rol == 'sqlinjection') {
      $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
    } else {
      $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
    }

    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function delRol()
  {
    if ($_SESSION['permisosMod']['d']) {
      if ($_POST) {
        $intIdrol = intval($_POST['idrol']);
        $requestDelete = $this->model->deleteRol($intIdrol);
        if ($requestDelete == 'ok') {
          $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el rol.');
        } else if ($requestDelete == 'exist') {
          $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un rol asociado a un usuario');
        } else {
          $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el rol.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }
  }
}
