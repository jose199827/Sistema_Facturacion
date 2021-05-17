let tablePedidos;
let rowTable;
let divLoading = document.querySelector('#divLoading');
let buttonCommon = {
    exportOptions: {
        columns: function(column, data, node) {
            if (column > 5) {
                return false;
            }
            return true;
        },
    }
};
tablePedidos = $('#tablePedidos').dataTable({
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
        "url": " " + base_url + "/Pedidos/getPedidos",
        "dataSrc": ""
    },
    "columns": [
        { "data": "idpedido" },
        { "data": "transaccion" },
        { "data": "fecha" },
        { "data": "monto" },
        { "data": "tipopago" },
        { "data": "status" },
        { "data": "options" }
    ],
    'dom': 'lBfrtip',
    /*       'iDisplayLength': 2, */
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

function fntTransaccion(idTransaccion) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pedidos/getTransaccion/' + idTransaccion;
    divLoading.style.display = "flex";
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector('#divModal').innerHTML = objData.html;
                $('#reembolso-modal').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
            divLoading.style.display = "none";
            return false;
        }
    }
}

function fntReembolsar() {
    let idtransaccion = document.querySelector('#idtransaccion').value;
    let observacion = document.querySelector('#txtObservacion').value;
    if (idtransaccion == '' || observacion == "") {
        swal("Reembolso", "Complete los datos para continuar.", "error");
        return false;
    }
    swal({
        title: 'Hacer Reembolso',
        text: "¿Realmente quieres realizar el Reembolso?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Si, Reembolsar!",
        cancelButtonText: "No, cancelar!",
        preConfirm: false
    }).then((result) => {
        if (result.value) {
            $('#reembolso-modal').modal('hide');
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Pedidos/setReembolso';
            let formData = new FormData();
            formData.append('idtransaccion', idtransaccion);
            formData.append('observacion', observacion);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    /* console.log(request.responseText); */
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        window.location.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                    divLoading.style.display = "none";
                    return false;
                }
            }
        }
    })
}

function fntEditPedido(element, idpedido) {
    rowTable = element.parentNode.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Pedidos/getPedido/' + idpedido;
    divLoading.style.display = "flex";
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector('#divModal').innerHTML = objData.html;
                $('#pedido-modal').modal('show');
                $('select').selectpicker();
                fntUpdateInfo();
            } else {
                swal("Error", objData.msg, "error");
            }
            divLoading.style.display = "none";
            return false;

        }
    }
}

function fntUpdateInfo() {
    let formPedido = document.querySelector('#formPedido');
    formPedido.onsubmit = function(e) {
        e.preventDefault();
        let transaccion;
        if (document.querySelector('#txttrans')) {
            transaccion = document.querySelector('#txttrans').value;
            if (transaccion == "") {
                swal("Datos", "Complete los datos para continuar.", "error");
                return false;
            }
        }
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Pedidos/setPedido/';
        divLoading.style.display = "flex";
        let formData = new FormData(formPedido);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    if (document.querySelector('#txttrans')) {
                        rowTable.cells[1].textContent = document.querySelector('#txttrans').value;
                        rowTable.cells[4].textContent = document.querySelector('#listTipoPago').selectedOptions[0].innerHTML;
                        rowTable.cells[5].textContent = document.querySelector('#listStatus').value;
                    } else {
                        rowTable.cells[5].textContent = document.querySelector('#listStatus').value;
                    }
                    swal("Pedidos", objData.msg, "success");
                    $('#pedido-modal').modal('hide');
                } else {
                    swal("Error", objData.msg, "error");
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}



/* $(document).ready(function() {
    $('#tablePedidos').DataTable();
}); */