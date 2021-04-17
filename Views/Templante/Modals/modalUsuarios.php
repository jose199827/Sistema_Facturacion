<!-- Apartado de modales -->
<!-- Modal de Usuarios -->
<div class="modal fade" id="usuarios-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Registrar un Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario" class="form-horizontal">
          <input type="hidden" name="idUsuario" id="idUsuario">
          <p class="text-red-50">Todos los campos con son obligatorios *.</p>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label>Identificación: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtIdentificacion" name="txtIdentificacion" placeholder="Identificación" class="form-control " required>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Nombres: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombres del Usuario" class="form-control valid validText" required>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Apellidos: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtApellido" name="txtApellido" placeholder="Apellidos del Usuario" class="form-control valid validText" required>
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label>Email: <span class="text-red-50">*</span> </label>
                <input type="email" id="txtEmail" name="txtEmail" placeholder="Email del Usuario" class="form-control valid validEmail" required>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Teléfono: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtTelefono" name="txtTelefono" placeholder="Teléfono del Usuario" class="form-control valid validNumber" required onkeypress="return controlTag(event);">
              </div>
            </div>

            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="listRolid">Tipo de Usuario: <span class="text-red-50">*</span> </label>
                <select class="form-control" data-live-search="true" name="listRolid" id="listRolid" required>
                </select>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label>Password:</label>
                <input type="password" id="txtPassword" name="txtPassword" placeholder="Password del Usuario" class=" form-control">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="form-control">Estatus: <span class="text-red-50">*</span> </label>
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

<!-- Modal de Ver Usuarios -->
<div class="modal fade" id="viewusuarios-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
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
                  <td>Identificación</th>
                  <td id="celIdentificacon">123456789</td>
                </tr>
                <tr>
                  <td>Nombre</th>
                  <td id="celNombre">Jose</td>
                </tr>
                <tr>
                  <td>Email</th>
                  <td id="celEmail">josemanuel@gmail.com</td>
                </tr>
                <tr>
                  <td>Teléfono</th>
                  <td id="celTelefono">98789884</td>
                </tr>
                <tr>
                  <td>Rol</th>
                  <td id="celRol">98789884</td>
                </tr>
                <tr>
                  <td>Estatus</th>
                  <td id="celEstatus">Activo</td>
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