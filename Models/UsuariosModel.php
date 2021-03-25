<?php
//Se crea la clase homeModel
class UsuariosModel extends Mysql
{
  private $intIdUsuario;
  private $strIdentificacion;
  private $strNombre;
  private $strApellido;
  private $strTelefono;
  private $strEmail;
  private $strPassword;
  private $strToken;
  private $intTipoId;
  private $intStatus;
  public function __construct()
  {
    parent::__construct();
  }
  public function insertUsuario(string $identificacion, string $nombre, string $apellido, string $telefono, string $email, int $tipoid, int $status, string $password)
  {
    $this->strIdentificacion = $identificacion;
    $this->strNombre = $nombre;
    $this->strApellido = $apellido;
    $this->strTelefono = $telefono;
    $this->strEmail = $email;
    $this->strPassword = $password;
    $this->intTipoId = $tipoid;
    $this->intStatus = $status;
    $return = 0;
    $sql = "SELECT * FROM `persona` WHERE `email_user`= '{$this->strEmail}' OR `indentificacion`='{$this->strIdentificacion}'";
    $request = $this->selectAll($sql);
    if ($this->strIdentificacion == "" || $this->strNombre == "" || $this->strApellido == "" || $this->strTelefono == "" || $this->strEmail == "" || $this->strPassword == "" || $this->intTipoId == "" || $this->intStatus == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      $query_insert = "INSERT INTO `persona` (`indentificacion`,`nombres`,`apellidos`,`telefono`, `email_user`, `password`, `rolid`, `status`) VALUES (?,?,?,?,?,?,?,?)";
      $arrData = array($this->strIdentificacion, $this->strNombre, $this->strApellido, $this->strTelefono, $this->strEmail, $this->strPassword, $this->intTipoId, $this->intStatus);
      $request_insert = $this->insert($query_insert, $arrData);
      $return = $request_insert;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, string $telefono, string $email, int $tipoid, int $status, string $password)
  {
    $this->intIdUsuario = $idUsuario;
    $this->strIdentificacion = $identificacion;
    $this->strNombre = $nombre;
    $this->strApellido = $apellido;
    $this->strTelefono = $telefono;
    $this->strEmail = $email;
    $this->strPassword = $password;
    $this->intTipoId = $tipoid;
    $this->intStatus = $status;
    $sql = "SELECT * FROM `persona` WHERE (`email_user`= '{$this->strEmail}' AND `idpersona`!=$this->intIdUsuario) OR (`indentificacion`= '{$this->strIdentificacion}' AND `idpersona`!=$this->intIdUsuario)";
    $request = $this->selectAll($sql);
    if ($this->intIdUsuario == "" || $this->strIdentificacion == "" || $this->strNombre == "" || $this->strApellido == "" || $this->strTelefono == "" || $this->strEmail == "" ||  $this->intTipoId == "" || $this->intStatus == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      if ($this->strPassword != "") {
        $sql = "UPDATE `persona` SET`indentificacion`=?,`nombres`=?,`apellidos`=?,`telefono`=?,`email_user`=?,              `password`=?,`rolid`=?,`status`=? WHERE `idpersona`=$this->intIdUsuario";
        $arrData = array($this->strIdentificacion, $this->strNombre, $this->strApellido, $this->strTelefono, $this->strEmail, $this->strPassword, $this->intTipoId, $this->intStatus);
      } else {
        $sql = "UPDATE `persona` SET`indentificacion`=?,`nombres`=?,`apellidos`=?,`telefono`=?,`email_user`=?,`rolid`=?,`status`=? WHERE `idpersona`=$this->intIdUsuario";
        $arrData = array($this->strIdentificacion, $this->strNombre, $this->strApellido, $this->strTelefono, $this->strEmail, $this->intTipoId, $this->intStatus);
      }
      $request = $this->update($sql, $arrData);
      $return = $request;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function selectUsuarios()
  {
    $sql = "SELECT p.idpersona,p.indentificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.status, r.nombrerol FROM persona p INNER JOIN rol r ON p.rolid= r.idrol WHERE p.status!=0";
    $request = $this->selectAll($sql);
    return $request;
  }
  public function selectUsuario(int $idpersona)
  {
    $this->intIdUsuario = $idpersona;
    $sql = "SELECT p.idpersona,p.indentificacion,p.nombres,p.apellidos,p.telefono,p.email_user, p.nit, p.nombrefical, p.direccionfiscal, r.idrol,r.nombrerol, p.status, DATE_FORMAT(p.datecreated, '%d/%m/%y') AS fechaRegistro  FROM persona p INNER JOIN rol r ON p.rolid= r.idrol WHERE p.idpersona =$this->intIdUsuario";
    $request = $this->select($sql);
    return $request;
  }
  public function deleteUsuario(int $idpersona)
  {
    $this->intIdUsuario = $idpersona;
    $sql = "UPDATE `persona` SET `status` = ? WHERE `persona`.`idpersona` = $this->intIdUsuario;";
    $arrData = array(0);
    $request = $this->update($sql, $arrData);
    return $request;
  }
}
