<?php
class DashboardModel extends Mysql
{
   public function __construct()
   {
      parent::__construct();
   }
   public function cantidadUsuarios()
   {
      $sql = "SELECT COUNT(*) AS total FROM `persona` WHERE `status` !=0 ";
      $result = $this->select($sql);
      $total = $result['total'];
      return $total;
   }
   public function cantidadClientes()
   {
      $sql = "SELECT COUNT(*) AS total FROM `persona` WHERE `status` !=0 AND `rolid`= " . RCLIENTES;
      $result = $this->select($sql);
      $total = $result['total'];
      return $total;
   }
   public function cantidadPedidos()
   {
      $sql = "SELECT COUNT(*) AS total FROM `pedido`";
      $result = $this->select($sql);
      $total = $result['total'];
      return $total;
   }
   public function cantidadProductos()
   {
      $sql = "SELECT COUNT(*) AS total FROM `producto` WHERE `status` !=0 ";
      $result = $this->select($sql);
      $total = $result['total'];
      return $total;
   }
   public function ultimosPedidos()
   {
      $sql = "SELECT p.idpedido, CONCAT(pr.nombres,' ',pr.apellidos) AS nombre, p.monto,p.status FROM pedido p INNER JOIN persona pr ON p.personaid = pr.idpersona ORDER BY p.idpedido DESC LIMIT 5";
      $result = $this->selectAll($sql);
      return $result;
   }
   public function selectPagosMes($anio, $mes)
   {
      $sql = "SELECT p.tipopagoid,tp.tipopago, COUNT(p.tipopagoid) AS cantidad, SUM(p.monto) AS total FROM pedido p INNER JOIN tipopago tp ON p.tipopagoid= tp.idtipopago WHERE MONTH(p.fecha)=$mes AND YEAR(p.fecha)=$anio GROUP by p.tipopagoid";
      $tipospagos = $this->selectAll($sql);
      $meses = meses();
      $arrData = array('anio' => $anio, 'mes' => $meses[intval($mes - 1)], 'tipospagos' => $tipospagos);
      return $arrData;
   }
   public function selectventasMesDia($anio, $mes)
   {
      $totalVentasMes = 0;
      $arrVentasDias = array();
      $dias = cal_days_in_month(CAL_GREGORIAN, $mes,  $anio);
      $nDia = 1;
      for ($i = 0; $i < $dias; $i++) {
         $date = date_create($anio . '-' . $mes . '-' . $nDia);
         $fechaVenta = date_format($date, "Y-m-d");
         $sql = "SELECT DAY(fecha) AS dia, COUNT(idpedido) AS cantidad, SUM(monto) AS total FROM `pedido` WHERE DATE(fecha)='{$fechaVenta}' AND status= 'Completo'";
         $ventaDia = $this->select($sql);
         $ventaDia['dia'] = $nDia;
         $ventaDia['total'] = ($ventaDia['total'] == "") ? 0 : $ventaDia['total'];
         $totalVentasMes += $ventaDia['total'];
         array_push($arrVentasDias, $ventaDia);
         $nDia++;
      }
      $meses = meses();
      $arrData = array('anio' => $anio, 'mes' => $meses[intval($mes - 1)], 'total' => $totalVentasMes, 'ventas' => $arrVentasDias);
      return $arrData;
   }
   public function  selectventasAnio($anio)
   {
      $arrMesVenta = array();
      $arrMeses = meses();
      for ($i = 1; $i <= 12; $i++) {
         $arrData = array('anio' => '', 'nMes' => '', 'mes' => '', 'venta' => '');
         $sql = "SELECT $anio AS anio, $i  AS mes, SUM(monto) AS venta FROM pedido WHERE MONTH(fecha)= $i  AND YEAR(fecha)=$anio AND status='Completo' GROUP BY MONTH(fecha)";
         $ventaMes = $this->select($sql);
         $arrData['mes'] = $arrMeses[$i - 1];
         if (empty($ventaMes)) {
            $arrData['anio'] = $anio;
            $arrData['nMes'] = $i;
            $arrData['venta'] = 0;
         } else {
            $arrData['anio'] = $ventaMes['anio'];
            $arrData['nMes'] = $ventaMes['mes'];
            $arrData['venta'] = $ventaMes['venta'];
         }
         array_push($arrMesVenta, $arrData);
      }
      $arrVentas = array('anio' => $anio, 'mesesVenta' => $arrMesVenta);
      return $arrVentas;
   }
}
