<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Paginas extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    session_regenerate_id(true);
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
    getPermisos(MPAGINAS);
  }
  //Se crea el método Suscripciones
  public function Paginas()
  {
    if (empty($_SESSION['permisosMod']['r'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $data['page_tag'] = "Páginas - Tienda Virtual";
    $data['page_title'] = "Páginas";
    $data['page_name'] = "Listado de Páginas";
    $data['page_funtions_js'] = "funtion_paginas.js";
    $this->views->getView($this, "paginas", $data);
  }
  public function editar($idPost)
  {
    if (empty($_SESSION['permisosMod']['u'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $idPost = intval($idPost);
    if ($idPost > 0) {
      $data['page_tag'] = "Editar página- Tienda Virtual";
      $data['page_title'] = "Editar página";
      $data['page_name'] = "Editar";
      $data['page_funtions_js'] = "funtion_paginas.js";
      $infoPage = getInfoPagina($idPost);
      if (empty($infoPage)) {
        header('location: ' . Base_URL() . '/paginas');
      } else {
        $data['infoPage'] = $infoPage;
      }
      /* dep($data);
      die(); */
      $this->views->getView($this, "editarPagina", $data);
    } else {
      header('location: ' . Base_URL() . '/paginas');
    }
    die();
  }
  public function crear()
  {
    if (empty($_SESSION['permisosMod']['u'])) {
      header('location: ' . Base_URL() . '/Errors');
    }
    $data['page_tag'] = "Crear página- Tienda Virtual";
    $data['page_title'] = "Crear página";
    $data['page_name'] = "Crear";
    $data['page_funtions_js'] = "funtion_paginas.js";
    /* dep($data);
      die(); */
    $this->views->getView($this, "crearPagina", $data);
    die();
  }
  public function getPaginas()
  {
    if ($_SESSION['permisosMod']['r']) {
      $arrData = $this->model->selectPaginas();
      /* dep($arrData); */
      for ($i = 0; $i < count($arrData); $i++) {
        $btnView = '';
        $btnEdit = '';
        $btnDel = '';
        $urlPage = Base_URL() . "/" . $arrData[$i]['ruta'];
        /* dep($urlPage); */
        if ($arrData[$i]['status'] == 1) {
          $arrData[$i]['status'] = '<span class="badge badge-success badge-pill">Activo</span>';
        } else {
          $arrData[$i]['status'] = '<span class="badge badge-warning badge-pill">Inactivo</span>';
        }

        if ($_SESSION['permisosMod']['r']) {
          $btnView = '<a class="dropdown-item btnViewInfo" href="' . $urlPage . '" target="_blank"><i class="dw dw-eye"></i> Ver Página</a>';
        }
        if ($_SESSION['permisosMod']['u']) {
          $btnEdit = '<a class="dropdown-item btnEditInfo" href="' . Base_URL() . '/paginas/editar/' . $arrData[$i]['Id'] . '" ><i class="dw dw-edit2"></i> Editar página</a>';
        }
        if ($_SESSION['permisosMod']['d']) {
          $btnDel = '<a class="dropdown-item btnDelInfo" href="javascript:;" onClick="fntDelInfo(' . $arrData[$i]['Id'] . ')"><i class="dw dw-delete-3"></i> Eliminar página</a>';
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
      echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    die();
  }

  public function setPagina()
  {
    if ($_POST) {
      /* dep($_POST);
      dep($_FILES); */
      if (empty($_POST['txtTitulo']) || empty($_POST['txtContenido']) || empty($_POST['listStatus'])) {
        $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
      } else {
        $intIdPost = intval($_POST['idPost']);
        $strTitulo = strClean($_POST['txtTitulo']);
        $strContenido = strClean($_POST['txtContenido']);
        $intStatus = intval($_POST['listStatus']);

        $ruta = strtolower(cleanCadena($strTitulo));
        $ruta = str_replace(" ", "-", $ruta);

        $foto = $_FILES['foto'];
        $nombreFoto = $foto['name'];
        $type = $foto['type'];
        $urlTemp = $foto['tmp_name'];
        $imgPortada = "";
        $carpeta = "imgPaginas"; //Carpeta donde Guardara las imagenes este Controlador
        $request = "";
        if ($nombreFoto != "") {
          $imgPortada = 'img_pagina_' . md5(date('d-m-Y H:i:s')) . '.jpg';
        }
        /* echo  $imgPortada;
        die(); */
        if ($intIdPost == 0) {
          /* Crear */
          if ($_SESSION['permisosMod']['w']) {
            /* $request = $this->model->insertCategoria($strCategoria, $strDescripcion, $intStatus, $imgPortada, $ruta);
            $option = 1; */
          }
        } else {
          if ($_SESSION['permisosMod']['u']) {
            /* Actualizar */
            if ($nombreFoto == "") {
              if ($_POST['fotoActual'] != '' && $_POST['fotoRemover'] == 0) {
                $imgPortada = $_POST['fotoActual'];
              }
            }
            $request = $this->model->updatePagina($intIdPost, $strTitulo, $strContenido, $imgPortada, $intStatus);
            $option = 2;
          }
        }
        if ($request > 0) {
          if ($option == 1) {
            /*  $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            if ($nombreFoto != '') {
              uploadImage($foto, $carpeta, $imgPortada);
            } */
          } else {
            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
            if ($nombreFoto != '') {
              uploadImage($foto, $carpeta, $imgPortada);
            }
            if (($nombreFoto == "" && $_POST['fotoRemover'] == 1 && $_POST['fotoActual'] != '')
              || ($nombreFoto != "" && $_POST['fotoActual'] != '')
            ) {
              deleteFile($carpeta, $_POST['fotoActual']);
            }
          }
        } else {
          $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
        }
      }
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
}
