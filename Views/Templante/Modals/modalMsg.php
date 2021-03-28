<!-- Apartado de modales -->
<!-- Modal de Msg -->
<div class="modal fade" id="msg-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Registrar un Mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formMsg" name="formMsg">
          <input type="hidden" name="idMsg" id="idMsg">
          <p class="text-red-50">Todos los campos con son obligatorios *.</p>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label>Titulo:</label>
                <input type="text" id="txtTitulo" name="txtTitulo" placeholder="Titulo de Mensaje" class="form-control ">
              </div>
              <div class="form-group">
                <label>Mensaje: <span class="text-red-50">*</span> </label>
                <textarea name="txtMensaje" id="txtMensaje" rows="2" placeholder="Mensaje" class="form-control valid validText" required></textarea>
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