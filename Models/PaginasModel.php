<?php
//Se crea la clase homeModel
class PaginasModel extends Mysql
{
  private $idPagina;
  private $strTitulo;
  private $strContenido;
  private $intStatus;
  private $strPortada;
  private $srtRuta;
  public function __construct()
  {
    parent::__construct();
  }
  public function selectPaginas()
  {
    $sql = "SELECT Id, Titulo,DATE_FORMAT(datecreate,'%d/%m/%Y') as fecha,ruta, status FROM post WHERE status !=0;";
    $request = $this->selectAll($sql);
    return $request;
  }
  public function insertPagina(string $strTitulo, string $strContenido, string $imgPortada, string $ruta, int $intStatus)
  {
    $this->strTitulo = $strTitulo;
    $this->strContenido = $strContenido;
    $this->strPortada = $imgPortada;
    $this->srtRuta = $ruta;
    $this->intStatus = $intStatus;
    $sql = "SELECT * FROM ";
    return $request;
  }
  public function updatePagina(int $intIdPost, string $strTitulo, string $strContenido, string $imgPortada, int $intStatus)
  {
    $this->idPagina = $intIdPost;
    $this->strTitulo = $strTitulo;
    $this->strContenido = $strContenido;
    $this->strPortada = $imgPortada;
    $this->intStatus = $intStatus;
    $sql = "UPDATE `post` SET `Titulo`=?,`contenindo`=?,`portada`=?,`status`=? WHERE `Id`=$this->idPagina";
    $arrData = array(
      $this->strTitulo,
      $this->strContenido,
      $this->strPortada,
      $this->intStatus,
    );
    $request = $this->update($sql, $arrData);
    return $request;
  }
}
