<?php
$mensajes = $data['mensajes'];
for ($i = 0; $i < count($mensajes); $i++) {
?>
  <div class="col-md-4 col-sm-12 mb-30">
    <div class="card text-white bg-info card-box">
      <div class="card-body">
        <h5 class="card-title text-white"><?= $mensajes[$i]['titulo']; ?></h5>
        <p class="card-text"><?= $mensajes[$i]['mensaje']; ?></p>
        <div class="dropdown ">
          <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-white" href="javascript:;" role="button" data-toggle="dropdown">
            <i class="dw dw-more"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item btnEditMsg" href="javascript:;"><i class="dw dw-edit2"></i> Editar</a>
            <a class="dropdown-item btnDelMsg" href="javascript:;"><i class="dw dw-delete-3"></i> Eliminar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>