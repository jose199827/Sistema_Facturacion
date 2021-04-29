<?php
require_once("Libraries/Core/Mysql.php");
trait TCategoria
{
  private $con;
  public function getCategoriasT(string $categorias)
  {
    $this->con = new Mysql();
    $sql = "SELECT `idcategoria`,`nombre`,`descripcion`,`portada`, `ruta` FROM `categoria` WHERE `status` != 0 AND idcategoria IN ($categorias)";
    $request = $this->con->selectAll($sql);
    if (count($request) > 0) {
      for ($c = 0; $c < count($request); $c++) {
        $request[$c]['portada'] = media() . '/img/imgUploads/imgCategorias/'
          . $request[$c]['portada'];
      }
    }
    return $request;
  }
}
