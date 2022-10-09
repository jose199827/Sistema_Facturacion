<!-- Modal de Ver Datos del Contacto-->
<div class="modal fade" id="viewmesaje-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-l  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Datos del Contacto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="font-16 icon-copy dw dw-cancel"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Es una idea para mostrar el mensaje en estilo de tarjetas -->
          <!-- <div class="card card-box">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div> -->
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>Id</th>
                  <td id="cellcodID">123456789</td>
                </tr>
                <tr>
                  <td>Nombre</th>
                  <td id="celNombre">Jose</td>
                </tr>
                <tr>
                  <td>Email</th>
                  <td id="celEmail">gfgdfgdfg</td>
                </tr>
                <tr>
                  <td>Fecha</th>
                  <td id="cellFecha">23/03/2021</td>
                </tr>
                <tr>
                <tr>
                  <td>Mensaje</th>
                  <td id="cellMensaje">Hola Mundo</td>
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