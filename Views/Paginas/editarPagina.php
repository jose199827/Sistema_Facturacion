<!-- Se manda a llamar el encabezado -->
<?php headerAdmin($data);
$options = $data['infoPage']['status'];
$fotoActual = $data['infoPage']['portada'];
$fotoRemove = 0;
$imgPortada = ($fotoActual != "") ? '<img id="img" src="' . media() . '/img/imgUploads/imgPaginas/' . $fotoActual . '">' : "";
?>
<div class="mobile-menu-overlay"></div>
<div class="main-container">

  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="page-header">
        <div class="row">
          <div class="col-6">
            <div class="title">
              <!-- Para el encabezado  de la pagina-->
              <h4><?= $data['page_title']; ?></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= Base_URL(); ?>/dashboard">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?= Base_URL(); ?>/paginas">Páginas</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data['page_name']; ?></li>
              </ol>
            </nav>
          </div>
          <?php if ($_SESSION['permisosMod']['w']) { ?>
            <div class="col-6 text-right">
              <a href="<?= Base_URL(); ?>/paginas/crear" class=" btn btn-primary">Agregar</a>
            </div>
          <?php } ?>
        </div>
      </div>
      <!-- Contenido de la pagina -->
      <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <!--  <?php dep($data['infoPage']) ?> -->
        <form id="formPagina" name="formPagina">
          <input type="hidden" name="idPost" id="idPost" value="<?= $data['infoPage']['Id'] ?>">
          <input type="hidden" name="fotoActual" id="fotoActual" value="<?= $fotoActual ?>">
          <input type="hidden" name="fotoRemover" id="fotoRemover" value="<?= $fotoRemove ?>">
          <p class="text-primary">Los campos con asterisco (<span class="text-red-50">*</span>) son obligatorios.</p>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Nombre de la Págian: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Nombre de la Página" class="form-control valid validText" value="<?= $data['infoPage']['Titulo'] ?>" required>
              </div>
            </div>
            <!-- **************************************************************************************** -->
            <div class="col-md-4">
              <div class="form-group">
                <label>Estatus: <span class="text-red-50">*</span> </label>
                <select class="form-control selectpicker" name="listStatus" id="listStatus" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Descripción Producto: <span class="text-red-50">*</span> </label>
                <textarea name="txtContenido" id="txtContenido" class="form-control valid validText"><?= $data['infoPage']['contenindo'] ?>
                </textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-12">
              <div id="containerGallery">
                <div class="photo">
                  <div class="form-group">
                    <label for="foto">Portada:</label>
                    <div class="prevPhoto">
                      <span class="delPhoto notBlock"><i class="icon-copy dw dw-cancel"></i></span>
                      <label for="foto"></label>
                      <div>
                        <?= $imgPortada ?>
                      </div>
                    </div>
                    <div class="upimg">
                      <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                  </div>
                </div>
              </div>
              <hr>
            </div>
          </div>
          <div></div>
          <div class="text-right">
            <button id="btnActionForm" type="submit" class="btn btn-success"><span id="btnTex">Actualizar</span></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
      <!-- Fin contenido de la pagina -->
    </div>
    <?php footer($data); ?>
  </div>
  <!-- Se cierra la llave del IF  -->

</div>

<!-- Se manda a llamar el footer  -->
<?php footerAdmin($data); ?>

<script>
  document.querySelector("#listStatus").value = <?= $options ?>;
</script>