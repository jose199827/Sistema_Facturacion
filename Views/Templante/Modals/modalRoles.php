<!-- Apartado de modales -->
<!-- Modal de Roles -->
<div class="modal fade" id="roles-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Registrar un Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form id="formRol" name="formRol">
          <input type="hidden" name="idRol" id="idRol">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label>Rol: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombre del Rol" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Descripción: <span class="text-red-50">*</span> </label>
                <textarea name="txtDescripcion" id="txtDescripcion" rows="2" placeholder="Descripción del Rol" class="form-control" required></textarea>
              </div>
              <div class="form-group">
                <label>Estatus: <span class="text-red-50">*</span> </label>
                <select class="custom-select col-12" name="listStatus" id="listStatus" required>
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

<!-- Modal de Permisos -->
<div class="modal fade" id="permisos-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Permisos de Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form id="formPermisos" name="formPermisos">
          <div class="row">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Módulos</th>
                    <th scope="col" class="text-center">Leer</th>
                    <th scope="col" class="text-center">Escribir</th>
                    <th scope="col" class="text-center">Actualizar</th>
                    <th scope="col" class="text-center">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <th scope="row">Usuario</th>
                    <th scope="row">
                      <div class="text-center custom-control custom-checkbox mb-5">
                        <input type="checkbox" class="custom-control-input" id="Leer">
                        <label class="custom-control-label" for="Leer"></label>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="text-center custom-control custom-checkbox mb-5">
                        <input type="checkbox" class="custom-control-input" id="Escribir">
                        <label class="custom-control-label" for="Escribir"></label>
                      </div>
                    </th>
                    <th scope="row">
                      <div class=" text-center custom-control custom-checkbox mb-5">
                        <input type="checkbox" class="custom-control-input" id="Actualizar">
                        <label class="custom-control-label" for="Actualizar"></label>
                      </div>
                    </th>
                    <th scope="row">
                      <div class="text-center custom-control custom-checkbox mb-5">
                        <input type="checkbox" class="custom-control-input" id="Eliminar">
                        <label class="custom-control-label" for="Eliminar"></label>
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
          <div class="text-right">
            <button id="" type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>