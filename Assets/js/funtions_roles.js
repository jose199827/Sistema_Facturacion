var tableRoles;

document.addEventListener('DOMContentLoaded', function() {
    tableRoles = $('#tableRoles').dataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todos"]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "_START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": '<i class="ion-chevron-right"></i>',
                "sPrevious": '<i class="ion-chevron-left"></i>'
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
        "ajax": {
            "url": " " + base_url + "/roles/getRoles ",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idrol" },
            { "data": "nombrerol" },
            { "data": "descripcion" },
            { "data": "status" },
            { "data": "options" }
        ],
    });
    //NUEVO ROL

    var formRol = document.querySelector("#formRol");
    formRol.onsubmit = function(e) {
        e.preventDefault();
        var intIdRol = document.querySelector("#idRol").value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var intStatus = document.querySelector('#listStatus').value;
        if (strNombre == '' || strDescripcion == '' || intStatus == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Roles/setRoles';
        var formData = new FormData(formRol);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#roles-modal').modal("hide");
                    formRol.reset();
                    swal("Roles de usuario", objData.msg, "success");
                    tableRoles.api().ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            } /* Un final */
        }
    }
});

$(document).ready(function() {
    $('#tableRoles').DataTable();
});

function openModal() {
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtDescripcion").classList.remove('form-control-danger');
    document.querySelector('#idRol').value = "";
    document.querySelector('#titleModal').innerHTML = "Registrar un Rol";
    document.querySelector('#btnTex').innerHTML = "Registrar";
    document.querySelector('#formRol').reset();
}

window.addEventListener('load', function() {
    /* fntEditRol();
    fntDelRol();
    fntPermisos(); */
}, false);

function fntEditRol(idRol) {
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtDescripcion").classList.remove('form-control-danger');
    document.querySelector('#formRol').reset();
    document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
    document.querySelector('#btnTex').innerHTML = "Actualizar";
    var idrol = idRol;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Roles/getRol/' + idrol;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            /* console.log(request.responseText); */
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idRol").value = objData.data.idrol;
                document.querySelector("#txtNombre").value = objData.data.nombrerol;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('refresh');
                $('#roles-modal').modal("show");
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelRol(idRol) {
    var idrol = idRol;
    /* alert(idrol); */
    swal({
        title: 'Eliminar rol ',
        text: "¿Realmente quiere eliminar este rol?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        preConfirm: false
    }).then((result) => {
        if (result.value) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Roles/delRol/';
            var strData = "idrol=" + idrol;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminado!", objData.msg, "success");
                        tableRoles.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    })
}

function fntPermisos(idRol) {
    var idrol = idRol;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Permisos/getPermisosRol/' + idrol;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#contentAjax').innerHTML = request.responseText;
            $('#permisos-modal').modal('show');
            document.querySelector('#formPermisos').addEventListener('submit', fntSavePermisos, false);
        }
    }
}

function fntSavePermisos(evnet) {
    evnet.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Permisos/setPermisos';
    var formElement = document.querySelector("#formPermisos");
    var formData = new FormData(formElement);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                swal("Permisos de usuario", objData.msg, "success");
                $('#permisos-modal').modal("hide");
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }


}