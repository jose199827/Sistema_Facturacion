let tableContactos;
let rowTable;
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function() {
    tableContactos = $('#tableContactos').dataTable({
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
            "url": " " + base_url + "/contactos/getContactos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "email" },
            { "data": "fecha" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
        ],

    });
}, false);

function fntViewMensaje(idMensaje) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/contactos/getMensaje/' + idMensaje;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            /* console.log(request.responseText); */
            if (objData.status) {
                let objMensaje = objData.data;
                document.querySelector("#cellcodID").innerHTML = objMensaje.id;
                document.querySelector("#celNombre").innerHTML = objMensaje.nombre;
                document.querySelector("#celEmail").innerHTML = objMensaje.email;
                document.querySelector("#cellFecha").innerHTML = objMensaje.fecha;
                document.querySelector("#cellMensaje").innerHTML = objMensaje.mensaje;
                $('#viewmesaje-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}