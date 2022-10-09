<?php
//Se crea la clase homeModel
class SuscripcionesModel extends Mysql
{
  public function selectSuscriptores()
  {
    $sql = "SELECT idsuscripcion,nombre,email, DATE_FORMAT(datedreated, '%d/%m/%Y') as  fecha FROM suscripciones ORDER BY datedreated DESC;";
    $request = $this->selectAll($sql);
    return $request;
  }
}
