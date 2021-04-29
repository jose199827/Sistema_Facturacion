<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Productos extends Controllers
{
   public function __construct()
   { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
      parent::__construct();
      session_start();
      session_regenerate_id(true);
      if (empty($_SESSION['login'])) {
         header('location: ' . Base_URL() . '/login');
      }
      getPermisos(4);
   }
   //Se crea el método Home
   public function productos()
   {
      if (empty($_SESSION['permisosMod']['r'])) {
         header('location: ' . Base_URL() . '/Errors');
      }
      $data['page_tag'] = "Productos - Tienda Virtual";
      $data['page_title'] = "Productos";
      $data['page_name'] = "Listado de Productos";
      $data['page_funtions_js'] = "funtion_productos.js";
      $this->views->getView($this, "productos", $data);
   }
   public function setProductos()
   {
      if ($_POST) {
         if (empty($_POST['txtNombre']) || empty($_POST['txtCodigo']) || empty($_POST['txtPrecio']) || empty($_POST['listCategoria']) || empty($_POST['listStatus'])) {
            $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
         } else {
            $idProducto = intval($_POST['idProducto']);
            $strNombre = strClean($_POST['txtNombre']);
            $strDescripcion = strClean($_POST['txtDescripcion']);
            $strCodigo = strClean($_POST['txtCodigo']);
            $intCategoriaid = intval(strClean($_POST['listCategoria']));
            $strPrecio = strtolower(strClean($_POST['txtPrecio']));
            $intStock = strtolower(strClean($_POST['txtStock']));
            $intStatus = intval($_POST['listStatus']);
            $ruta = strtolower(cleanCadena($strNombre));
            $ruta = str_replace(" ", "-", $ruta);
            $request_producto = "";
            if ($idProducto == 0) {
               $option = 1;
               if ($_SESSION['permisosMod']['w']) {
                  $request_producto = $this->model->insertProducto($strNombre, $strDescripcion, $strCodigo, $intCategoriaid, $strPrecio, $intStock, $ruta, $intStatus);
               }
            } else {
               $option = 2;
               if ($_SESSION['permisosMod']['u']) {
                  $request_producto = $this->model->updateProducto($idProducto, $strNombre, $strDescripcion, $strCodigo, $intCategoriaid, $strPrecio, $intStock, $ruta, $intStatus);
               }
            }
            if ($request_producto > 0) {
               if ($option == 1) {
                  $arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
               } else {
                  $arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos actualizados correctamente.');
               }
            } else if ($request_producto == 'exist') {
               $arrResponse = array('status' => false, 'msg' => '¡Atención! Ya existe un producto con el código ingresado.');
            } else if ($request_producto == 'sqlinjection') {
               $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
            } else {
               $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }
         }
         echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
   }
   public function getProductos()
   {
      if ($_SESSION['permisosMod']['r']) {
         $arrData = $this->model->selectProductos();
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
            $arrData[$i]['precio'] = SMONEY . formatMoney(
               $arrData[$i]['precio']
            );

            if ($_SESSION['permisosMod']['r']) {
               $btnView = '<a class="dropdown-item btnViewProducto" href="javascript:;" onClick="fntViewProducto(' . $arrData[$i]['idproducto'] . ')"><i class="dw dw-eye"></i> Ver</a>';
            }
            if ($_SESSION['permisosMod']['u']) {
               $btnEdit = '<a class="dropdown-item btnEditProducto" href="javascript:;" onClick="fntEditProducto(this,' . $arrData[$i]['idproducto'] . ')"><i class="dw dw-edit2"></i> Editar</a>';
            }
            if ($_SESSION['permisosMod']['d']) {
               $btnDel = '<a class="dropdown-item btnDelProducto" href="javascript:;" onClick="fntDelProducto(' . $arrData[$i]['idproducto'] . ')"><i class="dw dw-delete-3"></i> Eliminar</a>';
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
   public function getProducto(int $idProducto)
   {
      if ($_SESSION['permisosMod']['r']) {
         $idProducto = intval($idProducto);
         if ($idProducto > 0) {
            $arrData = $this->model->selectProducto($idProducto);
            if (empty($arrData)) {
               $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
               $arrImg = $this->model->selectImagenes($idProducto);
               if (count($arrImg) > 0) {
                  for ($i = 0; $i < count($arrImg); $i++) {
                     $arrImg[$i]['url_imagen'] = media() . '/img/imgUploads/imgProductos/' . $arrImg[$i]['img'];
                  }
               }
               $arrData['imagenes'] = $arrImg;
               $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
         }
         die();
      }
   }
   public function setImage()
   {
      if ($_POST) {
         if ($_SESSION['permisosMod']['w'] || $_SESSION['permisosMod']['u']) {
            if (empty($_POST['idproducto'])) {
               $arrResponse = array('status' => false, 'msg' => 'Error de dato');
            } else {
               $idProducto = intval($_POST['idproducto']);
               $foto = $_FILES['foto'];
               $imgNombre = 'img_producto_' . md5(date('d-m-Y H:i:s')) . '.jpg';
               $carpeta = "imgProductos";
               $request_img = $this->model->insertImage($idProducto, $imgNombre);
               if ($request_img) {
                  $uploadImage =  uploadImage($foto, $carpeta, $imgNombre);
                  $arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado');
               } else {
                  $arrResponse = array('status' => false, 'msg' => 'Error de carga');
               }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
         }
      }
      die();
   }
   public function delFile()
   {
      if ($_POST) {
         if ($_SESSION['permisosMod']['w'] || $_SESSION['permisosMod']['u']) {
            if (empty($_POST['idProducto']) || empty($_POST['nameImg'])) {
               $arrResponse = array('status' => false, 'msg' => 'Error de datos');
            } else {
               $idProducto = intval($_POST['idProducto']);
               $imgNombre = strClean($_POST['nameImg']);
               $carpeta = "imgProductos";
               $request_img = $this->model->delImage($idProducto, $imgNombre);
               if ($request_img) {
                  deleteFile($carpeta, $imgNombre);
                  $arrResponse = array('status' => true, 'msg' => 'Archivo Eliminado');
               } else {
                  $arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
               }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
         }
      }
      die();
   }
   public function delProducto()
   {
      if ($_POST) {
         if ($_SESSION['permisosMod']['d']) {
            $idProducto = intval($_POST['idProducto']);
            $requestDelete = "";
            $requestDelete = $this->model->deleteProducto($idProducto);

            if ($requestDelete == 'ok') {
               $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Producto.');
            } else {
               $arrResponse = array('status' => false, 'msg' => 'Error al eliminarla Categoría.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
         }
         die();
      }
   }
}
