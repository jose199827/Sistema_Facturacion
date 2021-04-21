<?php
class ClientesModel extends Mysql
{
  private $intIdUsuario;
  private $strIdentificacion;
  private $strNombre;
  private $strApellido;
  private $strTelefono;
  private $strEmail;
  private $strPassword;
  private $strIdentificacionFiscal;
  private $strNombreFiscal;
  private $strDireccionFiscal;
  private $strToken;
  private $intTipoId;
  private $intStatus;
  public function __construct()
  {
    parent::__construct();
  }
  public function insertCliente($strIdentificacion, $strNombre, $strApellido, $strTelefono, $strEmail, $strPassword, $intIdentificacionFiscal, $strNombreFiscal, $strDireccionFiscal,  $intTipoId)
  {
    $this->strIdentificacion = $strIdentificacion;
    $this->strNombre = $strNombre;
    $this->strApellido = $strApellido;
    $this->strTelefono = $strTelefono;
    $this->strEmail = $strEmail;
    $this->strPassword = $strPassword;
    $this->strIdentificacionFiscal = $intIdentificacionFiscal;
    $this->strNombreFiscal = $strNombreFiscal;
    $this->strDireccionFiscal = $strDireccionFiscal;
    $this->intTipoId = $intTipoId;
    $return = "";
    $sql = "SELECT * FROM `persona` WHERE `email_user`= '{$this->strEmail}' OR `indentificacion`='{$this->strIdentificacion}'";
    $request = $this->selectAll($sql);
    if ($this->strIdentificacion == "" || $this->strNombre == "" || $this->strApellido == "" || $this->strTelefono == "" || $this->strEmail == "" || $this->strPassword == "" || $this->strDireccionFiscal == "" || $this->strIdentificacionFiscal == "" || $this->strNombreFiscal == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      $sql = "INSERT INTO `persona` (`indentificacion`,`nombres`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefical`, `direccionfiscal`, `rolid`) VALUES (?,?,?,?,?,?,?,?,?,?)";
      $arrData = array(
        $this->strIdentificacion,
        $this->strNombre,
        $this->strApellido,
        $this->strTelefono,
        $this->strEmail,
        $this->strPassword,
        $this->strIdentificacionFiscal,
        $this->strNombreFiscal,
        $this->strDireccionFiscal,
        $this->intTipoId
      );
      $request_insert = $this->insert($sql, $arrData);
      $return = $request_insert;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function updateCliente($intIdCliente, $strIdentificacion, $strNombre, $strApellido, $strTelefono, $strEmail, $strPassword, $intIdentificacionFiscal, $strNombreFiscal, $strDireccionFiscal)
  {
    $this->intIdUsuario = $intIdCliente;
    $this->strIdentificacion = $strIdentificacion;
    $this->strNombre = $strNombre;
    $this->strApellido = $strApellido;
    $this->strTelefono = $strTelefono;
    $this->strEmail = $strEmail;
    $this->strPassword = $strPassword;
    $this->strIdentificacionFiscal = $intIdentificacionFiscal;
    $this->strNombreFiscal = $strNombreFiscal;
    $this->strDireccionFiscal = $strDireccionFiscal;
    $sql = "SELECT * FROM `persona` WHERE (`email_user`= '{$this->strEmail}' AND `idpersona`!=$this->intIdUsuario) OR (`indentificacion`= '{$this->strIdentificacion}' AND `idpersona`!=$this->intIdUsuario)";
    $request = $this->selectAll($sql);

    if ($this->intIdUsuario == "" || $this->strIdentificacion == "" || $this->strNombre == "" || $this->strApellido == "" || $this->strTelefono == "" || $this->strEmail == "" ||  $this->strIdentificacionFiscal == "" || $this->strNombreFiscal == "" || $this->strDireccionFiscal == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      if ($this->strPassword != "") {
        $sql = "UPDATE `persona` SET `indentificacion`=?,
        `nombres`=?,
        `apellidos`=?,
        `telefono`=?,
        `email_user`=?,
        `password`=?,
        `nit`=?,
        `nombrefical`=?,
        `direccionfiscal`=? 
        WHERE `idpersona`=$this->intIdUsuario AND `rolid`=2";
        $arrData = array(
          $this->strIdentificacion,
          $this->strNombre,
          $this->strApellido,
          $this->strTelefono,
          $this->strEmail,
          $this->strPassword,
          $this->strIdentificacionFiscal,
          $this->strNombreFiscal,
          $this->strDireccionFiscal
        );
      } else {
        $sql = "UPDATE `persona` SET`indentificacion`=?,`nombres`=?,`apellidos`=?,`telefono`=?,`email_user`=?,`nit`=?,`nombrefical`=?  ,`direccionfiscal`=? WHERE `idpersona`=$this->intIdUsuario AND `rolid`=2";
        $arrData = array(
          $this->strIdentificacion,
          $this->strNombre,
          $this->strApellido,
          $this->strTelefono,
          $this->strEmail,
          $this->strIdentificacionFiscal,
          $this->strNombreFiscal,
          $this->strDireccionFiscal
        );
      }
      $request = $this->update($sql, $arrData);
      $return = $request;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function deleteCliente(int $idpersona)
  {
    $this->intIdUsuario = $idpersona;
    $sql = "UPDATE `persona` SET `status` = ? WHERE `persona`.`idpersona` = $this->intIdUsuario AND `rolid`=2;";
    $arrData = array(0);
    $request = $this->update($sql, $arrData);
    return $request;
  }

  public function selectClientes()
  {
    $sql = "SELECT `idpersona`,`indentificacion`,`nombres`,`apellidos`,`telefono`,`email_user`,`status` FROM `persona` WHERE `rolid`=2 AND `status`!=0;";
    $request = $this->selectAll($sql);
    return $request;
  }
  public function selectCliente(int $idpersona)
  {
    $this->intIdUsuario = $idpersona;

    $sql = "SELECT `idpersona`,`indentificacion`,`nombres`,`apellidos`,`telefono`,`email_user`,`nit`,`nombrefical`,`direccionfiscal`, DATE_FORMAT( `datecreated`, '%d/%m/%y') AS fechaRegistro FROM `persona` WHERE `idpersona`= $this->intIdUsuario AND `rolid`=2;";
    $request = $this->select($sql);
    return $request;
  }
}
