<!-- Modal de Permisos -->
<div class="modal fade" id="permisos-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Permisos de Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formPermisos" name="formPermisos">
          <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required>
          <div class="row">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Módulos</th>
                    <th scope="col" class="text-center">Ver</th>
                    <th scope="col" class="text-center">Crear</th>
                    <th scope="col" class="text-center">Actualizar</th>
                    <th scope="col" class="text-center">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $modulos = $data['modulos'];
                  for ($i = 0; $i < count($modulos); $i++) {

                    $permisos = $modulos[$i]['permisos'];
                    $rCheck = $permisos['r'] == 1 ? " checked " : "";
                    $wCheck = $permisos['w'] == 1 ? " checked " : "";
                    $uCheck = $permisos['u'] == 1 ? " checked " : "";
                    $dCheck = $permisos['d'] == 1 ? " checked " : "";

                    $idmod = $modulos[$i]['idmodulo'];
                  ?>
                    <tr>
                      <th scope="row">
                        <?= $no ?>
                        <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>
                      </th>
                      <th scope="row">
                        <?= $modulos[$i]['titulo']; ?>
                      </th>
                      <th scope="row">
                        <div class="text-center custom-control custom-checkbox mb-5">
                          <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> class="custom-control-input" id="modulos[<?= $i; ?>][r]">
                          <label class="custom-control-label" for="modulos[<?= $i; ?>][r]"></label>

                        </div>
                      </th>
                      <th scope="row">
                        <div class="text-center custom-control custom-checkbox mb-5">
                          <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?> class="custom-control-input" id="modulos[<?= $i; ?>][w]">
                          <label class="custom-control-label" for="modulos[<?= $i; ?>][w]"></label>
                        </div>
                      </th>
                      <th scope="row">
                        <div class=" text-center custom-control custom-checkbox mb-5">
                          <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?> class="custom-control-input" id="modulos[<?= $i; ?>][u]">
                          <label class="custom-control-label" for="modulos[<?= $i; ?>][u]"></label>
                        </div>
                      </th>
                      <th scope="row">
                        <div class="text-center custom-control custom-checkbox mb-5">
                          <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?> class="custom-control-input" id="modulos[<?= $i; ?>][d]">
                          <label class="custom-control-label" for="modulos[<?= $i; ?>][d]"></label>
                        </div>
                      </th>
                    </tr>
                  <?php
                    $no++;
                  }
                  ?>
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