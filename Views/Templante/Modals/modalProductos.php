<!-- Apartado de modales -->
<!-- Modal de Roles -->
<div class="modal fade" id="productos-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Registrar un Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProductos" name="formProductos">
          <input type="hidden" name="idProducto" id="idProducto">
          <p class="text-primary">Los campos con asterisco (<span class="text-red-50">*</span>) son obligatorios.</p>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Nombre Producto: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtNombre" name="txtNombre" placeholder="Nombre del Producto" class="form-control valid validText" required>
              </div>
              <div class="form-group">
                <label>Descripción Producto: </label>
                <textarea name="txtDescripcion" id="txtDescripcion" class="form-control valid validText"></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Código Producto: <span class="text-red-50">*</span> </label>
                <input type="text" id="txtCodigo" name="txtCodigo" placeholder="Código del Producto" class="form-control valid validNumber" required>
                <div id="divBarCode" class="notblock textcenter">
                  <div id="printCode">
                    <svg id="barcode"></svg>
                  </div>
                  <button class="btn btn-success btn-sm" type="button" onclick="fntPrintBarcode('#printCode')">Imprimir</button>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Precio: <span class="text-red-50">*</span> </label>
                  <input type="text" id="txtPrecio" name="txtPrecio" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Stock: <span class="text-red-50">*</span> </label>
                  <input type="text" id="txtStock" name="txtStock" class="form-control " required>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Categoria: <span class="text-red-50">*</span> </label>
                  <select class="form-control selectpicker" data-live-search="true" name="listCategoria" id="listCategoria" required>
                    <!--                     <option value="1">Activo</option>
                    <option value="2">Inactivo</option> -->
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Estatus: <span class="text-red-50">*</span> </label>
                  <select class="form-control selectpicker" name="listStatus" id="listStatus" required>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                </div>
              </div>
              <!-- <div class="row">
                <div class="form-group col-md-12">
                  <button id="btnActionForm" type="submit" class="btn btn-success btn-block"><span id="btnTex">Registrar</span></button>
                </div>
                <div class="form-group col-md-12">
                  <button type="button" class="btn btn-danger  btn-block" data-dismiss="modal">Cancelar</button>
                </div>
              </div> -->
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <div id="containerGallery">
                <span>Fotos (440*540)</span>
                <a class="btnAddImage btn btn-info btn-sm" id=""><i class="dw dw-edit2"></i></a>
              </div>
              <hr>
              <div id="containerImages">
                <!-- <div id="div24">
                  <div class="prevImage">
                    <img class="loading" src="<?= media(); ?>/img/loading.svg">
                  </div>
                  <input type="file" name="foto" id="img1" class="inputUploadfile">
                  <label for="img1" class="btnUploadfile"><i class="dw dw-upload1"></i></label>
                  <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="dw dw-cancel"></i></button>
                </div> -->
              </div>
            </div>
          </div>
          <div></div>
          <div class="text-right">
            <button id="btnActionForm" type="submit" class="btn btn-success"><span id="btnTex">Registrar</span></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Ver Datos del Producto -->
<div class="modal fade" id="viewproductos-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Datos del Producto</h5>
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
                  <td>Código</th>
                  <td id="cellcodProducto">123456789</td>
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
                  <td>Fotos</th>
                  <td id="cellFotos">23/03/2021</td>
                </tr>
                <tr>
                <tr>
                  <td>Precio</th>
                  <td id="cellPrecio">98789884</td>
                </tr>
                <tr>
                  <td>Stock</th>
                  <td id="cellStock">23/03/2021</td>
                </tr>
                <tr>
                  <td>Categoría</th>
                  <td id="cellCategoria">23/03/2021</td>
                </tr>
                <tr>
                  <td>Estado</th>
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