let tablePedidos;
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




/* $(document).ready(function() {
    $('#tablePedidos').DataTable();
}); */