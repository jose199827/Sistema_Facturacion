<!-- Apartado de modales -->
<!-- Modal de Roles -->
<div class="modal fade" id="categorias-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Registrar una Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCategoria" name="formCategoria">
          <input type="hidden" name="idCategoria" id="idCategoria">
          <input type="hidden" name="fotoActual" id="fotoActual">
          <input type="hidden" name="fotoRemover" id="fotoRemover" value="0">
          <p class="text-primary">Los campos con asterisco (<span class="text-red-50">*</span>) son obligatorios.</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Categoría: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombre de la Categoría" class="form-control valid validText" required>
              </div>
              <div class="form-group">
                <label>Descripción: <span class="text-red-50">*</span> </label>
                <textarea name="txtDescripcion" id="txtDescripcion" rows="2" placeholder="Descripción de de la Categoría" class="form-control valid validText" required></textarea>
              </div>
              <div class="form-group">
                <label>Estatus: <span class="text-red-50">*</span> </label>
                <select class="form-control selectpicker" name="listStatus" id="listStatus" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="photo">
                <div class="form-group">
                  <label for="foto">Foto (570x380)</label>
                  <div class="prevPhoto">
                    <span class="delPhoto notBlock"><i class="icon-copy dw dw-cancel"></i></span>
                    <label for="foto"></label>
                    <div>
                      <img id="img" src="<?= media(); ?>/img/imgUploads/imgCategorias/portada_categoria.png">
                    </div>
                  </div>
                  <div class="upimg">
                    <input type="file" name="foto" id="foto">
                  </div>
                  <div id="form_alert"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-right">
            <button id="btnActionForm" type="submit" class="btn btn-success"><span id="btnTex">Registrar</span></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Ver Usuarios -->
<div class="modal fade" id="viewcategoria-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Datos de la Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>Id</th>
                  <td id="cellIdcategoria">123456789</td>
                </tr>
                <tr>
                  <td>Nombre</th>
                  <td id="celNombre">Jodfse</td>
                </tr>
                <tr>
                  <td>Descripción</th>
                  <td id="celDescripcion">gfgdfgdfg</td>
                </tr>
                <tr>
                  <td>Portada</th>
                  <td id="cellUrl_portada">98789884</td>
                </tr>
                <tr>
                  <td>Estatus</th>
                  <td id="cellStatus">23/03/2021</td>
                </tr>
                <tr>
                  <td>Fecha registro</th>
                  <td id="celFechaRegistro">23/03/2021</td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <div class="text-right">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>