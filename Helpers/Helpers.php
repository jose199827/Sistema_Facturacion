<?php
function Base_URL()
{
  return BASE_URL;
}

function media()
{
  return BASE_URL . "/Assets";
}
function vendors()
{
  return BASE_URL . "/Vendors";
}
function cleanCadena(string $cadena)
{
  //Reemplazamos la A y a
  $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
  );

  //Reemplazamos la E y e
  $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena
  );

  //Reemplazamos la I y i
  $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena
  );

  //Reemplazamos la O y o
  $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena
  );

  //Reemplazamos la U y u
  $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena
  );

  //Reemplazamos la N, n, C y c
  $cadena = str_replace(
    array('Ñ', 'ñ', 'Ç', 'ç', ',', '.', ';', ':'),
    array('N', 'n', 'C', 'c', '', '', '', ''),
    $cadena
  );
  return $cadena;
}
function  getFile(string $url, $data)
{
  ob_start();
  require_once("Views/{$url}.php");
  $file = ob_get_clean();
  return $file;
}
function headerAdmin($data = "")
{
  $view_header = "Views/Templante/admin_header.php";
  require_once($view_header);
}
function footerAdmin($data = "")
{
  $view_footer = "Views/Templante/admin_footer.php";
  require_once($view_footer);
}
function headerTienda($data = "")
{
  $view_header = "Views/Templante/tienda_header.php";
  require_once($view_header);
}
function footerTienda($data = "")
{
  $view_footer = "Views/Templante/tienda_footer.php";
  require_once($view_footer);
}
function footer($data = "")
{
  $view_footer = "Views/Templante/footer.php";
  require_once($view_footer);
}

//Muestra los objetos de forma formateada
function dep($data)
{
  $format = print_r("<pre>");
  $format = print_r($data);
  $format = print_r("</pre>");
  return $format;
}
function getModal(string $nombreModal, $data)
{
  $view_modal = "Views/Templante/Modals/{$nombreModal}.php";
  require_once($view_modal);
}
//Envio de Correo
function sendEmail($data, $template)
{
  $asunto = $data['asunto'];
  $emailDestino = $data['email'];
  $empresa = NOMBRE_REMITENTE;
  $remitente = EMAIL_EMPRESA;
  $emailCopia = !empty($data['emailCopia']) ? $data['emailCopia'] : "";
  //ENVIO DE CORREO
  $de = "MIME-Version: 1.0\r\n";
  $de .= "Content-type: text/html; charset=UTF-8\r\n";
  $de .= "From: {$empresa} <{$remitente}>\r\n";
  $de .= "Bcc: $emailCopia\r\n";
  ob_start();
  require_once("Views/Templante/Email/{$template}.php");
  $mensaje = ob_get_clean();
  $send = mail($emailDestino, $asunto, $mensaje, $de);
  return $send;
}
function getPermisos(int $idModulo)
{
  require_once("Models/PermisosModel.php");
  $objPermisos = new PermisosModel();
  $idrol = $_SESSION['userData']['idrol'];
  $arrPermisos = $objPermisos->permisosModulo($idrol);
  $permisos = '';
  $permisosMod = '';
  if (count($arrPermisos) > 0) {
    $permisos = $arrPermisos;
    $permisosMod =  isset($arrPermisos[$idModulo]) ? $arrPermisos[$idModulo] : "";
  }
  $_SESSION['permisos'] = $permisos;
  $_SESSION['permisosMod'] = $permisosMod;
}
//Elimina el exceso de espacios entre palabras
function strClean($strCadena)
{
  $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena); //Deja un solo espacio entre palabras
  $string = trim($string); //Elimina espacios en blanco al inicio y al final
  $string = stripslashes($string); // Elimina las \ invertidas
  $string = str_ireplace("<script>", "", $string);
  $string = str_ireplace("</script>", "", $string);
  $string = str_ireplace("<script src>", "", $string);
  $string = str_ireplace("<script type=>", "", $string);
  $string = str_ireplace("SELECT * FROM", "", $string);
  $string = str_ireplace("DELETE FROM", "", $string);
  $string = str_ireplace("INSERT INTO", "", $string);
  $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
  $string = str_ireplace("DROP TABLE", "", $string);
  $string = str_ireplace("OR '1'='1", "", $string);
  $string = str_ireplace('OR "1"="1"', "", $string);
  $string = str_ireplace('OR ´1´=´1´', "", $string);
  $string = str_ireplace("is NULL; --", "", $string);
  $string = str_ireplace("is NULL; --", "", $string);
  $string = str_ireplace("LIKE '", "", $string);
  $string = str_ireplace('LIKE "', "", $string);
  $string = str_ireplace("LIKE ´", "", $string);
  $string = str_ireplace("OR 'a'='a", "", $string);
  $string = str_ireplace('OR "a"="a', "", $string);
  $string = str_ireplace("OR ´a´=´a", "", $string);
  $string = str_ireplace("OR ´a´=´a", "", $string);
  $string = str_ireplace("--", "", $string);
  $string = str_ireplace("^", "", $string);
  $string = str_ireplace("[", "", $string);
  $string = str_ireplace("]", "", $string);
  $string = str_ireplace("==", "", $string);
  return $string;
}
//Genera una contraseña de 10 caracteres
function passGenerator($length = 10)
{
  $pass = "";
  $longitudPass = $length;
  $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
  $longitudCadena = strlen($cadena);

  for ($i = 1; $i <= $longitudPass; $i++) {
    $pos = rand(0, $longitudCadena - 1);
    $pass .= substr($cadena, $pos, 1);
  }
  return $pass;
}
//Genera un token
function token()
{
  $r1 = bin2hex(random_bytes(10));
  $r2 = bin2hex(random_bytes(10));
  $r3 = bin2hex(random_bytes(10));
  $r4 = bin2hex(random_bytes(10));
  $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
  return $token;
}
//Formato para valores monetarios
function formatMoney($cantidad)
{
  $cantidad = number_format($cantidad, 2, SPD, SPM);
  return $cantidad;
}
function sessionUser($idpersona)
{
  require_once("Models/LoginModel.php");
  $objLogin = new LoginModel();
  $request = $objLogin->sessionLogin($idpersona);
  return $request;
}
function uploadImage(array $data, string $carpeta, string $name)
{
  $url_temp = $data['tmp_name'];
  $destino = 'Assets/img/imgUploads/' . $carpeta . '/' . $name;
  $mover = move_uploaded_file($url_temp, $destino);
  return $mover;
}
function deleteFile(string $carpeta, string $name)
{
  unlink('Assets/img/imgUploads/' . $carpeta . '/' . $name);
}

function getTokenPaypal()
{
  $payLogin = curl_init(URLPAYPAL . "/v1/oauth2/token");
  curl_setopt($payLogin, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($payLogin, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($payLogin, CURLOPT_USERPWD, PAYPALCLIENTE . ":" . SECRET);
  curl_setopt($payLogin, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
  $result = curl_exec($payLogin);
  $err = curl_error($payLogin);
  curl_close($payLogin);
  if ($err) {
    $request = "CURL Error #:" . $err;
  } else {
    $objData = json_decode($result);
    $request = $objData->access_token;
  }
  return $request;
}

function curlConnectionGet(string $ruta, string $contentType = null, string $token)
{
  $content_Type = ($contentType != null) ? $contentType : "application/x-www-form-urlencoded";
  if ($token != null) {
    $arrHeader = array(
      'Content-Type: ' . $content_Type,
      'Authorization: Bearer ' . $token
    );
  } else {
    $arrHeader = array(
      'Content-Type: ' . $content_Type
    );
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,  $ruta);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
  $result = curl_exec($ch);
  $err = curl_error($ch);
  curl_close($ch);
  if ($err) {
    $request = "CURL Error #:" . $err;
  } else {
    $objData = json_decode($result);
    $request =  $objData;
  }
  return $request;
}

function curlConnectionPost(string $ruta, string $contentType = null, string $token)
{
  $content_Type = ($contentType != null) ? $contentType : "application/x-www-form-urlencoded";
  if ($token != null) {
    $arrHeader = array(
      'Content-Type: ' . $content_Type,
      'Authorization: Bearer ' . $token
    );
  } else {
    $arrHeader = array(
      'Content-Type: ' . $content_Type
    );
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,  $ruta);
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
  $result = curl_exec($ch);
  $err = curl_error($ch);
  curl_close($ch);
  if ($err) {
    $request = "CURL Error #:" . $err;
  } else {
    $objData = json_decode($result);
    $request =  $objData;
  }
  return $request;
}
