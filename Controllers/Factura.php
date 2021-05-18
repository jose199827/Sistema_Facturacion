<?php
require 'Libraries/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Factura extends Controllers
{
   public function __construct()
   { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
      parent::__construct();
      session_start();
      session_regenerate_id(true);
      if (empty($_SESSION['login'])) {
         header('location: ' . Base_URL() . '/login');
      }
      getPermisos(5);
   }
   //Se crea el método Home
   public function generarFactura($idpedido)
   {
      if ($_SESSION['permisosMod']['r']) {
         if (!is_numeric($idpedido)) {
            header('location: ' . Base_URL() . '/Errors');
         }
         $idpersona = "";
         if ($_SESSION['permisosMod']['r'] && $_SESSION['userData']['idrol'] == RCLIENTES) {
            $idpersona = $_SESSION['userData']['idpersona'];
         }
         $data = $this->model->selectPedido($idpedido, $idpersona);
         if ((empty($data))) {
            header('location: ' . Base_URL() . '/Pedidos');
         }
         ob_end_clean();
         $html = getFile("Templante/Modals/comprobantePDF", $data);
         $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
         $html2pdf->writeHTML($html);
         $html2pdf->output('Factura_N_' . $idpedido . '_' . $data['cliente']['nombres'] . '_' . $data['cliente']['apellidos'] . '.pdf');
      } else {
         header('location: ' . Base_URL() . '/login');
      }
   }
}
