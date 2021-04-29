<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Categorias extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    session_regenerate_id(true);
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
    //Identificación del modulo donde se encuentra
    getPermisos(6);
  }
  //Se crea el método Home
  public function categorias()
  {
    if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $data['page_tag'] = "Categorías - Tienda Virtual";
    $data['page_title'] = "Categorías";
    $data['page_name'] = "Listado de Categorías";
    $data['page_id'] = 1;
    $data['page_funtions_js'] = "funtions_categorias.js";
    $this->views->getView($this, "categorias", $data);
  }
  public function setCategoria()
  {
    if ($_POST) {
      if (empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
        $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
      } else {
        $intidCategoria = intval($_POST['idCategoria']);
        $strCategoria = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listStatus']);
        $ruta = strtolower(cleanCadena($strCategoria));
        $ruta = str_replace(" ", "-", $ruta);
        $request_categoria = "";
        $foto = $_FILES['foto'];
        $nombreFoto = $foto['name'];
        $type = $foto['type'];
        $urlTemp = $foto['tmp_name'];
        $imgPortada = 'portada_categoria.png';
        $carpeta = "imgCategorias"; //Carpeta donde Guardara las imagenes este Controlador
        if ($nombreFoto != "") {
          $imgPortada = 'img_categoria_' . md5(date('d-m-Y H:i:s')) . '.jpg';
        }
        if ($intidCategoria == 0) {
          /* Crear */
          if ($_SESSION['permisosMod']['w']) {
            $request_categoria = $this->model->insertCategoria($strCategoria, $strDescripcion, $intStatus, $imgPortada, $ruta);
            $option = 1;
          }
        } else {
          if ($_SESSION['permisosMod']['u']) {
            /* Actualizar */
            if ($nombreFoto == "") {
              if ($_POST['fotoActual'] != 'portada_categoria.png' && $_POST['fotoRemover'] == 0) {
                $imgPortada = $_POST['fotoActual'];
              }
            }
            $request_categoria = $this->model->updateCategoria($intidCategoria, $strCategoria, $strDescripcion, $intStatus, $imgPortada, $ruta);
            $option = 2;
          }
        }
        if ($request_categoria > 0) {
          if ($option == 1) {
            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            if ($nombreFoto != '') {
              uploadImage($foto, $carpeta, $imgPortada);
            }
          } else {
            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
            if ($nombreFoto != '') {
              uploadImage($foto, $carpeta, $imgPortada);
            }
            if (($nombreFoto == "" && $_POST['fotoRemover'] == 1 && $_POST['fotoActual'] != 'portada_categoria.png')
              || ($nombreFoto != "" && $_POST['fotoActual'] != 'portada_categoria.png')
            ) {
              deleteFile($carpeta, $_POST['fotoActual']);
            }
          }
        } else if ($request_categoria == 'exist') {
          $arrResponse = array('status' => false, 'msg' => '¡Atención! La Categoría ya existe.');
        } else if ($request_categoria == 'sqlinjection') {
          $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
        } else {
          $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
        }
      }
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
  public function getCategorias()
  {
    if ($_SESSION['permisosMod']['r']) {
      $arrData = $this->model->selectCategorias();
      /*       dep($arrData);
      exit(); */
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
          $btnView = '<a class="dropdown-item btnViewCategoria" href="javascript:;" onClick="fntViewCategoria(' . $arrData[$i]['idcategoria'] . ')"><i class="dw dw-eye"></i> Ver</a>';
        }
        if ($_SESSION['permisosMod']['u']) {
          $btnEdit = '<a class="dropdown-item btnEditCategoria" href="javascript:;" onClick="fntEditCategoria(this,' . $arrData[$i]['idcategoria'] . ')"><i class="dw dw-edit2"></i> Editar</a>';
        }
        if ($_SESSION['permisosMod']['d']) {
          $btnDel = '<a class="dropdown-item btnDelCategoria" href="javascript:;" onClick="fntDelCategoria(' . $arrData[$i]['idcategoria'] . ')"><i class="dw dw-delete-3"></i> Eliminar</a>';
        }
        /*         $arrData[$i]['portada'] = '<img  src="' . media() . '/img/imgUploads/imgCategorias/' . $arrData[$i]['portada'] . '">'; */
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
  public function getCategoria($idcategoria)
  {
    if ($_SESSION['permisosMod']['r']) {
      $idcategoria = intval($idcategoria);
      if ($idcategoria > 0) {
        $arrData = $this->model->selectCategoria($idcategoria);
        if (empty($arrData)) {
          $arrResponse = array("status" => false, "msg" => 'Datos no encontrados.');
        } else {
          $arrData['url_portada'] = media() . '/img/imgUploads/imgCategorias/' . $arrData['portada'];
          $arrResponse = array("status" => true, "data" => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }
  }
  public function delCategoria()
  {
    if ($_POST) {
      if ($_SESSION['permisosMod']['d']) {
        $idcategoria = intval($_POST['idcategoria']);
        $requestDelete = "";
        $requestDelete = $this->model->deleteCategoria($idcategoria);

        if ($requestDelete == 'ok') {
          $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Categoría.');
        } else if ($requestDelete == 'exist') {
          $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría asociada a un producto');
        } else {
          $arrResponse = array('status' => false, 'msg' => 'Error al eliminarla Categoría.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
    }
  }
  public function getSelectCategorias()
  {
    $htmlOptions = "";
    $arrData = $this->model->selectCategorias();
    if (count($arrData) > 0) {
      for ($i = 0; $i < count($arrData); $i++) {
        if ($arrData[$i]['status'] == 1) {
          $htmlOptions .= '<option value ="' . $arrData[$i]['idcategoria'] . '">' . $arrData[$i]['nombre'] . '</option>';
        }
      }
    }
    echo $htmlOptions;
    die();
  }
}
