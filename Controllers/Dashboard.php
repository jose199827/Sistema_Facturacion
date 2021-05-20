<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Dashboard extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
    session_regenerate_id(true);
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    }
    getPermisos(1);
  }
  //Se crea el método Home
  public function dashboard()
  {
    $data['page_tag'] = "Dashboard - Tienda Virtual";
    $data['page_title'] = "Dashboard";
    $data['page_name'] = "dashboard";
    $data['page_id'] = 2;
    $data['usuarios'] = $this->model->cantidadUsuarios();
    $data['clientes'] = $this->model->cantidadClientes();
    $data['pedidos'] = $this->model->cantidadPedidos();
    $data['productos'] = $this->model->cantidadProductos();
    $data['ultimosPedidos'] = $this->model->ultimosPedidos();
    $data['ultimosProductos'] = $this->model->ultimosProductos();
    $anio = date('Y');
    $mes = date('m');
    $data['pagosMes'] = $this->model->selectPagosMes($anio, $mes);
    $data['ventasMesDia'] = $this->model->selectventasMesDia($anio, $mes);
    $data['ventasAnio'] = $this->model->selectventasAnio($anio);
    /* dep($data['ventasAnio']);
    exit(); */
    $data['page_funtions_js'] = "funtions_dashoard.js";
    if ($_SESSION['userData']['idrol'] == RCLIENTES) {
      $this->views->getView($this, "dashboardCliente", $data);
    } else {
      $this->views->getView($this, "dashboard", $data);
    }
  }
  public function tipoPagoMes()
  {
    if (($_POST)) {
      $grafica = "pagosMesAnio";
      $arraFecha = explode(" ", $_POST["fecha"]);
      $months = months();
      for ($i = 0; $i < 12; $i++) {
        if ($arraFecha[0] == $months[$i]) {
          $arraFecha[0] = $i + 1;
        }
      }
      $anio = $arraFecha[1];
      $mes = $arraFecha[0];
      $pagos = $this->model->selectPagosMes($anio, $mes);
      $script = getFile("Templante/Modals/graficas", $pagos);
      echo $script;
    }
    die();
  }
  public function ventasMes()
  {
    if (($_POST)) {
      $grafica = "VentaMes";
      $arraFecha = explode(" ", $_POST["fecha"]);
      $months = months();
      for ($i = 0; $i < 12; $i++) {
        if ($arraFecha[0] == $months[$i]) {
          $arraFecha[0] = $i + 1;
        }
      }
      $anio = $arraFecha[1];
      $mes = $arraFecha[0];
      $pagos = $this->model->selectventasMesDia($anio, $mes);
      $script = getFile("Templante/Modals/graficas", $pagos);
      echo $script;
    }
    die();
  }
  public function ventasAnio()
  {
    if (($_POST)) {
      $grafica = "VentaAnio";
      $anio = intval($_POST["anio"]);
      $pagos = $this->model->selectventasAnio($anio);
      $script = getFile("Templante/Modals/graficas", $pagos);
      echo $script;
    }
    die();
  }
}
