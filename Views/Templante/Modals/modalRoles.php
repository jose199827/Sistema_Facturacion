<!-- Apartado de modales -->
<!-- Modal de Roles -->
<div class="modal fade" id="roles-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Registrar un Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formRol" name="formRol">
          <input type="hidden" name="idRol" id="idRol">
          <p class="text-primary">Los campos con asterisco (<span class="text-red-50">*</span>) son obligatorios.</p>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label>Rol: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombre del Rol" class="form-control valid validText" required>
              </div>
              <div class="form-group">
                <label>Descripción: <span class="text-red-50">*</span> </label>
                <textarea name="txtDescripcion" id="txtDescripcion" rows="2" placeholder="Descripción del Rol" class="form-control valid validText" required></textarea>
              </div>
              <div class="form-group">
                <label>Estatus: <span class="text-red-50">*</span> </label>
                <select class="form-control selectpicker" name="listStatus" id="listStatus" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
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