<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8">
  <meta name="desciption" content="Tienda Virtual">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="Jose Pineda">
  <title><?= $data['page_tag']; ?></title>

  <!-- Site favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= media(); ?>/img/favicon.ico">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="<?= vendors(); ?>/styles/core.css">
  <link rel="stylesheet" type="text/css" href="<?= vendors(); ?>/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="<?= vendors(); ?>/styles/style.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/estilos.css">

</head>

<body>
  <div id="divLoading">
    <div>
      <img src="<?= media(); ?>/img/loading.svg" alt="Cargador de Tienda Virtual">
    </div>
  </div>
  <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="<?= vendors(); ?>/images/forgot-password.png" alt="">
        </div>
        <div class="col-md-6">
          <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
              <h2 class="text-center text-primary">Restablecer la contraseña</h2>
            </div>
            <h6 class="mb-20">Ingrese tu nueva contraseña, confirma y envía</h6>
            <form id="formCambiarPass" name="formCambiarPass" action="">
              <input type="hidden" name="idUsuario" id="idUsuario" value="<?= $data['idpersona']; ?>">
              <input type="hidden" name="txtEmail" id="txtEmail" value="<?= $data['email']; ?>">
              <input type="hidden" name="txtToken" id="txtToken" value="<?= $data['token']; ?>">
              <div class="input-group custom">
                <input type="password" class="form-control form-control-lg" placeholder="Nueva Password" id="txtPassword" name="txtPassword" required>
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
              </div>
              <div class="input-group custom">
                <input type="password" class="form-control form-control-lg" placeholder="Confirmar Nueva Password" id="txtPasswordConfirm" name="txtPasswordConfirm">
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col-5">
                  <div class="input-group mb-0">
                    <!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
										-->
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Enviar">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- js -->
  <script>
    const base_url = "<?= Base_URL(); ?>"
  </script>
  <script src="<?= vendors(); ?>/scripts/core.js"></script>
  <script src="<?= vendors(); ?>/scripts/script.min.js"></script>
  <script src="<?= vendors(); ?>/scripts/process.js"></script>
  <script src="<?= vendors(); ?>/scripts/layout-settings.js"></script>
  <!-- add sweet alert js & css in footer -->
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/plugins/sweetalert2/sweetalert2.css">
  <script src="<?= media(); ?>/plugins/sweetalert2/sweetalert2.all.js"></script>
  <script src="<?= media(); ?>/plugins/sweetalert2/sweet-alert.init.js"></script>
  <script src="<?= media(); ?>/js/<?= $data['page_funtions_js']; ?>"></script>
</body>

</html>