<?php
require_once("Models/TCategoria.php");
require_once("Models/TProducto.php");
require_once("Models/TTiposPagos.php");
require_once("Models/TCliente.php");
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Carrito extends Controllers
{
   use TCategoria, TProducto, TTiposPagos, TCliente;
   public function __construct()
   { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
      parent::__construct();
      session_start();
   }
   public function carrito()
   {
      $data['page_tag'] = NOMBRE_EMPRESA . ' - Carrito';
      $data['page_title'] = 'Carrito de Comprad';
      $data['page_name'] = "carrito";
      $this->views->getView($this, "carrito", $data);
   }
   public function Procesarpago()
   {
      if (empty($_SESSION['arrCarrito'])) {
         header('location: ' . Base_URL() . '/Tienda');
         die();
      }
      /*     if (isset($_SESSION['login'])) {
         $this->setDetalleTemp();
      } */
      $data['page_tag'] = NOMBRE_EMPRESA . ' - Procesar Pago';
      $data['page_title'] = 'Procesar Pago';
      $data['page_name'] = "Procesar Pago";
      $data['tiposPago'] = $this->getTiposPagoT();
      $this->views->getView($this, "Procesarpago", $data);
   }
   /*    public function setDetalleTemp()
   {
      $sid = session_id();
      $arrPedido = array(
         'idcliente' => $_SESSION['idUser'],
         'idtransaccion' => $sid,
         'productos' => $_SESSION['arrCarrito']
      );
      $this->insertDetalleTemp($arrPedido);
   } */
}
