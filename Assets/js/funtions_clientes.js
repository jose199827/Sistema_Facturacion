/* Area de Variables*/
/*############# */
let tableClientes;
let rowTable;
let divLoading = document.querySelector('#divLoading');
/*############# */
/* Area de Variables Fin*/



/* Cuando el documento ya este cargado*/
/*############################# */
document.addEventListener('DOMContentLoaded', function() {
    let buttonCommon = {
        exportOptions: {
            columns: function(column, data, node) {
                if (column > 4) {
                    return false;
                }
                return true;
            },
        }
    };
    tableClientes = $('#tableClientes').dataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [
            [5, 10, 15, -1],
            [5, 10, 15, "Todos"]
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
            "url": " " + base_url + "/Clientes/getClientes",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idpersona" },
            { "data": "indentificacion" },
            { "data": "nombres" },
            { "data": "email_user" },
            { "data": "telefono" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        /* 'iDisplayLength': 2, */

        'buttons': [
            $.extend(true, {}, buttonCommon, {
                extend: 'copyHtml5'
            }),
            $.extend(true, {}, buttonCommon, {
                extend: 'excelHtml5'
            }),
            $.extend(true, {}, buttonCommon, {
                extend: 'csvHtml5',
            }),
            $.extend(true, {}, buttonCommon, {
                extend: 'pdfHtml5'
            })
        ]

    });
    /* Ingresar un nuevo cliente */
    if (document.querySelector("#formCliente")) {
        let formCliente = document.querySelector("#formCliente");
        formCliente.onsubmit = function(e) {
            e.preventDefault();

            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let strIdentificacionFiscal = document.querySelector('#txtIdentificacionFiscal').value;
            let strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
            let strDireccionFiscal = document.querySelector('#texDireccionFiscal').value;

            if (strIdentificacion == '' || strNombre == '' || strApellido == '' || strEmail == '' || intTelefono == '' || strIdentificacionFiscal == '' || strNombreFiscal == '' || strDireccionFiscal == '') {
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

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Clientes/setClientes';
            let formData = new FormData(formCliente);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableClientes.api().ajax.reload();
                        } else {
                            rowTable.cells[1].textContent = strIdentificacion;
                            rowTable.cells[2].textContent = strNombre + " " + strApellido;
                            rowTable.cells[3].textContent = strEmail;
                            rowTable.cells[4].textContent = intTelefono;
                            rowTable = "";
                        }
                        $('#clientes-modal').modal('hide');
                        formCliente.reset();
                        swal("Clientes", objData.msg, "success");
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    /* Ingresar un nuevo cliente Fin*/
}, false);
/*############################# */
/* Cuando el documento ya este cargado Fin*/

/* Funcion para abrir el modal de registrar Clientes */
/*################################### */
function openModal() {
    rowTable = "";
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtApellido").classList.remove('form-control-danger');
    document.querySelector("#txtEmail").classList.remove('form-control-danger');
    document.querySelector("#txtTelefono").classList.remove('form-control-danger');
    document.querySelector('#idCliente').value = "";
    document.querySelector('#titleModal').innerHTML = "Registrar un Cliente";
    document.querySelector('#btnTex').innerHTML = "Registrar";
    document.querySelector('#formCliente').reset();
    $('#clientes-modal').modal('show');
}
/*################################### */
/* Funcion para abrir el modal de registrar Clientes Fin*/

$(document).ready(function() {
    $('#tableClientes').DataTable();
});

function fntViewCliente(idpersona) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Clientes/getCliente/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#celIdentificacon").innerHTML = objData.data.indentificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres + " " + objData.data.apellidos;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celIdentificacionFiscal").innerHTML = objData.data.nit;
                document.querySelector("#celNombreFiscal").innerHTML = objData.data.nombrefical;
                document.querySelector("#celDireccionFiscal").innerHTML = objData.data.direccionfiscal;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                $('#viewcliente-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}

function fntEditCliente(element, idpersona) {
    rowTable = element.parentNode.parentNode.parentNode.parentNode;
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtApellido").classList.remove('form-control-danger');
    document.querySelector("#txtEmail").classList.remove('form-control-danger');
    document.querySelector("#txtTelefono").classList.remove('form-control-danger');
    document.querySelector('#titleModal').innerHTML = "Actualizar  Cliente";
    document.querySelector('#btnTex').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Clientes/getCliente/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idCliente").value = objData.data.idpersona;
                document.querySelector("#txtIdentificacion").value = objData.data.indentificacion;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtEmail").value = objData.data.email_user;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtIdentificacionFiscal").value = objData.data.nit;
                document.querySelector("#txtNombreFiscal").value = objData.data.nombrefical;
                document.querySelector("#texDireccionFiscal").value = objData.data.direccionfiscal;
                $('#clientes-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }

    }
}

function fntDelCliente(idpersona) {
    swal({
        title: 'Eliminar Cliente',
        text: "¿Realmente quieres eliminar este cliente?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        preConfirm: false
    }).then((result) => {
        if (result.value) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Clientes/delCliente/';
            let strData = "idUsuario=" + idpersona;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminado!", objData.msg, "success");
                        tableClientes.api().ajax.reload(function() {});
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    })
}