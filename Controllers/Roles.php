<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Roles extends Controllers
{
    public function __construct()
    { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
        parent::__construct();
    }
    //Se crea el método Home
    public function roles()
    {
        $data['page_tag'] = "Roles de usuarios - Tienda Virtual";
        $data['page_title'] = "Roles de usuarios";
        $data['page_name'] = "Rol - Usuario";
        $data['page_id'] = 3;
        $this->views->getView($this, "roles", $data);
    }
    public function getRoles()
    {
        $arrData = $this->model->selectRoles();
        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success badge-pill">Activo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-warning badge-pill">Inactivo</span>';
            }
            $arrData[$i]['options'] = '<div class="dropdown ">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="javascript:;" role="button"
                                                  data-toggle="dropdown">
                                                  <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                  <a class="dropdown-item btnPermisosRol" href="#" rl="' . $arrData[$i]['idrol'] . '"><i class="dw dw-key1"></i> Permisos</a>
                                                  <a class="dropdown-item btnEditRol" href="#" rl="' . $arrData[$i]['idrol'] . '"><i class="dw dw-edit2"></i> Editar</a>
                                                  <a class="dropdown-item btnDelRol" href="#" rl="' . $arrData[$i]['idrol'] . '"><i class="dw dw-delete-3"></i> Eliminar</a>
                                                </div>
                                              </div>';
        }
        /**/
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getRol(int $idrol)
    {
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

    public function setRoles()
    {
        $strRol = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listStatus']);
        $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);

        if ($request_rol > 0) {
            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
        } else if ($request_rol == 'exist') {
            $arrResponse = array('status' => false, 'msg' => '¡Atención! El rol ya existe.');
        } else if ($request_rol == 'sqlinjection') {
            $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos-');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
