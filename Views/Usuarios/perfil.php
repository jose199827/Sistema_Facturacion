<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
/* dep($_SESSION['userData']); */
?>

<div class="mobile-menu-overlay"></div>

<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="title">
              <h4><?= $data['page_title']; ?></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= Base_URL(); ?>/dashboard">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data['page_name']; ?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
          <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
              <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
              <img src="<?= media(); ?>/img/avatar.png" alt="" class="avatar-photo">
              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body pd-5">
                      <div class="img-container">
                        <img id="image" src="<?= media(); ?>/img/avatar.png" alt="Picture">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" value="Actualizar" class="btn btn-success">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h5 class="text-center h5 mb-0"><?= $_SESSION['userData']['nombres']  . "  " . $_SESSION['userData']['apellidos'] ?></h5>
            <p class="text-center text-muted font-14"><?= $_SESSION['userData']['nombrerol'] ?></p>
            <div class="profile-info">
              <h5 class="mb-20 h5 text-blue">Información del contacto</h5>
              <ul>
                <li>
                  <span>Correo Electronico:</span>
                  <?= $_SESSION['userData']['email_user'] ?>
                </li>
                <li>
                  <span>Numero de Telefono:</span>
                  <?= $_SESSION['userData']['telefono'] ?>
                </li>
                <li>
                  <span>Nombre Empresa:</span>
                  <?= $_SESSION['userData']['nombrefical'] ?>
                </li>
                <li>
                  <span>Direccion Empresa:</span>
                  <?= $_SESSION['userData']['direccionfiscal'] ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
          <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
              <div class="tab height-100-p">
                <ul class="nav nav-tabs customtab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#datosPersonales" role="tab">Datos Personales</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#datosFiscales" role="tab">Datos Fiscales</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pagos" role="tab">Pagos</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <!-- Datos Personales -->
                  <div class="tab-pane fade show active" id="datosPersonales" role="tabpanel">
                    <div class="pd-20">

                      <form id="formPerfil" name="formPerfil" class="form-horizontal">
                        <p class="text-primary">Los campos con asterisco (<span class="text-red-50">*</span>) son obligatorios.</p>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                              <label>Identificación: <span class="text-red-50">*</span> </label>
                              <input type="text" id="txtIdentificacion" name="txtIdentificacion" placeholder="Identificación" class="form-control " value="<?= $_SESSION['userData']['indentificacion'] ?>" required>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                              <label>Nombres: <span class="text-red-50">*</span> </label>
                              <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombres del Usuario" class="form-control valid validText" value="<?= $_SESSION['userData']['nombres'] ?>" required>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                              <label>Apellidos: <span class="text-red-50">*</span> </label>
                              <input type="text" id="txtApellido" name="txtApellido" placeholder="Apellidos del Usuario" class="form-control valid validText" value="<?= $_SESSION['userData']['apellidos'] ?>" required>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                              <label>Email: <span class="text-red-50">*</span> </label>
                              <input type="email" id="txtEmail" name="txtEmail" placeholder="Email del Usuario" class="form-control valid validEmail" value="<?= $_SESSION['userData']['email_user'] ?>" required readonly disabled>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                              <label>Teléfono: <span class="text-red-50">*</span> </label>
                              <input type="text" id="txtTelefono" name="txtTelefono" placeholder="Teléfono del Usuario" class="form-control valid validNumber" value="<?= $_SESSION['userData']['telefono'] ?>" required onkeypress="return controlTag(event);">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                              <label>Password:</label>
                              <input type="password" id="txtPassword" name="txtPassword" placeholder="Password" class=" form-control">
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                              <label>Confirmar Password:</label>
                              <input type="password" id="txtPasswordConfirm" name="txtPasswordConfirm" placeholder="Confirmar Password" class=" form-control">
                            </div>
                          </div>
                        </div>
                        <div class="text-right">
                          <button id="btnActionForm" type="submit" class="btn btn-success"><span id="btnTex">Actualizar</span></button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- Datos Personales -->
                  <!-- Datos Fiscales -->
                  <div class="tab-pane fade height-100-p" id="datosFiscales" role="tabpanel">
                    <div class="pd-20">
                      <form id="formDatosFiscales" name="formDatosFiscales" class="form-horizontal">
                        <p class="text-primary">Los campos con asterisco (<span class="text-red-50">*</span>) son obligatorios.</p>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                              <label>Identificación Fiscal: <span class="text-red-50">*</span> </label>
                              <input type="text" id="txtIdentificacionFiscal" name="txtIdentificacionFiscal" placeholder="Identificación Fiscal" class="form-control " value="<?= $_SESSION['userData']['nit'] ?>" required>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                              <label>Nombre Fiscal: <span class="text-red-50">*</span> </label>
                              <input type="text" id="txtNombreFiscal" name="txtNombreFiscal" placeholder="Nombre Fiscal" class="form-control valid validText" value="<?= $_SESSION['userData']['nombrefical'] ?>" required>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                              <label>Dirección Fiscal: <span class="text-red-50">*</span> </label>
                              <textarea name="texDireccionFiscal" id="texDireccionFiscal" cols="30" rows="10" placeholder="Dirección Fiscal" class="form-control valid validText"><?= $_SESSION['userData']['direccionfiscal'] ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="text-right">
                          <button id="btnActionForm" type="submit" class="btn btn-success"><span id="btnTex">Actualizar</span></button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- Datos Fiscales -->
                  <!-- Datos Pagos -->
                  <div class="tab-pane fade height-100-p" id="pagos" role="tabpanel">
                    <div class="pd-20">
                      pagos
                    </div>
                  </div>
                  <!-- Datos Pagos -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-wrap pd-20 mb-20 card-box">
      DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
    </div>
  </div>
</div>
<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>