let tablePaginas;
let rowTable;
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function() {
    tablePaginas = $('#tablePaginas').dataTable({
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
            "url": " " + base_url + "/paginas/getPaginas",
            "dataSrc": ""
        },
        "columns": [
            { "data": "Id" },
            { "data": "Titulo" },
            { "data": "status" },
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

tinymce.init({
    selector: '#txtContenido',
    width: "100%",
    height: 400,
    statubar: true,
    language: 'es',
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});
if (document.querySelector("#foto")) {
    let foto = document.querySelector("#foto");
    foto.onchange = function(e) {
        let uploadFoto = document.querySelector("#foto").value;
        let fileimg = document.querySelector("#foto").files;
        let nav = window.URL || window.webkitURL;
        let contactAlert = document.querySelector('#form_alert');
        if (uploadFoto != '') {
            let type = fileimg[0].type;
            let name = fileimg[0].name;
            if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.add("notBlock");
                foto.value = "";
                return false;
            } else {
                contactAlert.innerHTML = '';
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.remove("notBlock");
                let objeto_url = nav.createObjectURL(this.files[0]);
                document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + ">";
            }
        } else {
            alert("No selecciono foto");
            if (document.querySelector('#img')) {
                document.querySelector('#img').remove();
            }
        }
    }
}

if (document.querySelector(".delPhoto")) {
    let delPhoto = document.querySelector(".delPhoto");
    delPhoto.onclick = function(e) {
        document.querySelector("#fotoRemover").value = 1;
        removePhoto();
    }
}

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

if (document.querySelector("#formPagina")) {
    let formPagina = document.querySelector("#formPagina");
    formPagina.onsubmit = function(e) {
        e.preventDefault();
        let strTitulo = document.querySelector('#txtTitulo').value;
        let intStatus = document.querySelector('#listStatus').value;
        if (strTitulo == '' || intStatus == '') {
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
        tinyMCE.triggerSave();
        /* tinymce */
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/paginas/setPagina';
        let formData = new FormData(formPagina);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                /* console.log(request.responseText); */
                let objData = JSON.parse(request.responseText);
                if (objData.status) {
                    swal({
                        title: 'Actualizar página',
                        text: objData.msg,
                        type: 'success',
                        confirmButtonText: "Aceptar",
                        preConfirm: true
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })

                } else {
                    swal("Error", objData.msg, "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }
}