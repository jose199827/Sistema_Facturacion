<!-- Apartado de modales -->

<div class="modal fade" id="pedido-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Editar el Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPedido" name="formPedido">
          <input type="hidden" name="idPedido" id="idPedido" value="<?= $data['orden']['idpedido'] ?>">
          <p class="text-primary">Los campos con asterisco (<span class="text-red-50">*</span>) son obligatorios.</p>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Nº. Pedido:</label>
                    <p><?= $data['orden']['idpedido'] ?></p>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Cliente:</label>
                    <p><?= $data['cliente']['nombres'] . " " . $data['cliente']['apellidos'] ?></p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Importe Total:</label>
                    <p><?= SMONEY . formatMoney($data['orden']['monto']); ?></p>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Transacción: <span class="text-red-50">*</span></label>
                    <?php if ($data['orden']['tipopagoid'] == 1) {
                      echo "<p>" . $data['orden']['idtransaccionpaypal'] . "</p>";
                    } else { ?>
                      <input type="text" name="txttrans" id="txttrans" class="form-control" value="<?= $data['orden']['referenciacobro'] ?>" required>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Tipo de Pago: <span class="text-red-50">*</span></label>
                    <?php if ($data['orden']['tipopagoid'] == 1) {
                      echo "<p>" . $data['orden']['tipopago'] . "</p>";
                    } else { ?>
                      <select class="form-control selectpicker" data-live-search="true" name="listTipoPago" id="listTipoPago" required>
                        <?php
                        for ($i = 0; $i < count($data['tiposPago']); $i++) {
                          $select = "";
                          if ($data['tiposPago'][$i]['idtipopago'] == $data['orden']['tipopagoid']) {
                            $select = "selected";
                          }
                        ?>
                          <option value="<?= $data['tiposPago'][$i]['idtipopago']; ?>" <?= $select ?>><?= $data['tiposPago'][$i]['tipopago']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Estado:<span class="text-red-50">*</span></label>
                    <select class="form-control selectpicker" data-live-search="true" name="listStatus" id="listStatus" required>
                      <?php
                      for ($i = 0; $i < count(STATUS); $i++) {
                        $select = "";
                        if (STATUS[$i] == $data['orden']['status']) {
                          $select = "selected";
                        }
                      ?>
                        <option value="<?= STATUS[$i]; ?>" <?= $select ?>><?= STATUS[$i]; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-right">
            <button id="btnActionForm" type="submit" class="btn btn-success"><span id="btnTex">Actualizar</span></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>