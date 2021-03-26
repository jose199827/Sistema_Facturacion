var tableUsuarios;
document.addEventListener('DOMContentLoaded', function() {
    tableUsuarios = $('#tableUsuarios').dataTable({
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
            "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0",
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
            "url": " " + base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idpersona" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "email_user" },
            { "data": "telefono" },
            { "data": "nombrerol" },
            { "data": "status" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ]

    });


    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function(e) {
        e.preventDefault();
        var strIdentificacion = document.querySelector('#txtIdentificacion').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strApellido = document.querySelector('#txtApellido').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intTelefono = document.querySelector('#txtTelefono').value;
        var intTipousuario = document.querySelector('#listRolid').value;
        var strPassword = document.querySelector('#txtPassword').value;

        if (strNombre == '' || strNombre == '' || strApellido == '' || strEmail == '' || intTelefono == '' || intTipousuario == '' || intTipousuario == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        let elemtedValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elemtedValid.length; i++) {
            if (elemtedValid[i].classList.contains('form-control-danger')) {
                swal("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }

        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Usuarios/setUsuario';
        var formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#usuarios-modal').modal('hide');
                    formUsuario.reset();
                    swal("Usuarios", objData.msg, "success");
                    tableUsuarios.api().ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
}, false)
$(document).ready(function() {
    $('#tableUsuarios').DataTable();
});
window.addEventListener('load', function() {
    fntRolesUsurios();
}, false);

function fntRolesUsurios() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Roles/getSelectRoles';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listRolid').innerHTML = request.responseText;
            document.querySelector('#listRolid').value = 1;
            $('#listRolid').selectpicker('refresh');
        }
    }
}

function fntViewUsuario(idpersona) {
    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                var estadoUsuario = objData.data.status == 1 ? '<span class="badge badge-success badge-pill">Activo</span>' : '<span class="badge badge-warning badge-pill">Inactivo</span>';
                document.querySelector("#celIdentificacon").innerHTML = objData.data.indentificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celRol").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstatus").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                $('#viewusuarios-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}

function fntEditUsuario(idpersona) {
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtApellido").classList.remove('form-control-danger');
    document.querySelector("#txtEmail").classList.remove('form-control-danger');
    document.querySelector("#txtTelefono").classList.remove('form-control-danger');
    document.querySelector('#titleModal').innerHTML = "Actualizar  Usuario";
    document.querySelector('#btnTex').innerHTML = "Actualizar";
    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idUsuario").value = objData.data.idpersona;
                document.querySelector("#txtIdentificacion").value = objData.data.indentificacion;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtEmail").value = objData.data.email_user;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#listRolid").value = objData.data.idrol;
                $('#listRolid').selectpicker('refresh');
                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('refresh');
                $('#usuarios-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }

    }
}

function fntDelUsuario(idpersona) {
    var idUsuario = idpersona;
    swal({
        title: 'Eliminar Usuario',
        text: "¿Realmente quiere eliminar este usuario?",
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
            var ajaxUrl = base_url + '/Usuarios/delUsuario/';
            var strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminado!", objData.msg, "success");
                        tableUsuarios.api().ajax.reload(function() {
                            fntRolesUsurios();
                        });
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    })
}

function openModal() {
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtApellido").classList.remove('form-control-danger');
    document.querySelector("#txtEmail").classList.remove('form-control-danger');
    document.querySelector("#txtTelefono").classList.remove('form-control-danger');
    document.querySelector('#idUsuario').value = "";
    document.querySelector('#titleModal').innerHTML = "Registrar un Usuario";
    document.querySelector('#btnTex').innerHTML = "Registrar";
    document.querySelector('#formUsuario').reset();
    $('#usuarios-modal').modal('show');
}