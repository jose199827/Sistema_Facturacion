let tableCategorias;
let rowTable;
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function() {
    let buttonCommon = {
        exportOptions: {
            columns: function(column, data, node) {
                if (column > 3) {
                    return false;
                }
                return true;
            },
        }
    };
    tableCategorias = $('#tableCategorias').dataTable({
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
            "url": " " + base_url + "/Categorias/getCategorias",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idcategoria" },
            { "data": "nombre" },
            { "data": "descripcion" },
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
    //NUEVA Categoria
    if (document.querySelector("#formCategoria")) {
        let formCategoria = document.querySelector("#formCategoria");
        formCategoria.onsubmit = function(e) {
            e.preventDefault();
            let intidCategoria = document.querySelector("#idCategoria").value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strDescripcion = document.querySelector('#txtDescripcion').value;
            let intStatus = document.querySelector('#listStatus').value;
            if (strNombre == '' || strDescripcion == '' || intStatus == '') {
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
            let ajaxUrl = base_url + '/Categorias/setCategoria';
            let formData = new FormData(formCategoria);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableCategorias.api().ajax.reload();
                        } else {
                            let htmlStatus = intStatus == 1 ?
                                '<span class="badge badge-success badge-pill">Activo</span>' :
                                '<span class="badge badge-warning badge-pill">Inactivo</span>';
                            rowTable.cells[1].textContent = strNombre;
                            rowTable.cells[2].textContent = strDescripcion;
                            rowTable.cells[3].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                        $('#categorias-modal').modal("hide");
                        formCategoria.reset();
                        swal("Categorías", objData.msg, "success");
                        removePhoto();
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);

function removePhoto() {
    document.querySelector('#foto').value = "";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if (document.querySelector('#img')) {
        document.querySelector('#img').remove();
    }
}

function openModal() {
    rowTable = "";
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtDescripcion").classList.remove('form-control-danger');
    document.querySelector('#idCategoria').value = "";
    document.querySelector('#titleModal').innerHTML = "Registrar una Categoría";
    document.querySelector('#btnTex').innerHTML = "Registrar";
    document.querySelector('#formCategoria').reset();
    $('#categorias-modal').modal('show');
    removePhoto();
}

function fntViewCategoria(idcategoria) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Categorias/getCategoria/' + idcategoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let estado = objData.data.status == 1 ? '<span class="badge badge-success badge-pill">Activo</span>' : '<span class="badge badge-warning badge-pill">Inactivo</span>';
                document.querySelector("#cellIdcategoria").innerHTML = objData.data.idcategoria;
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;
                document.querySelector("#cellUrl_portada").innerHTML = '<img src="' + objData.data.url_portada + '" alt="">';
                document.querySelector("#cellStatus").innerHTML = estado;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.datecreated;
                $('#viewcategoria-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}

function fntEditCategoria(element, idcategoria) {
    rowTable = element.parentNode.parentNode.parentNode.parentNode;
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtDescripcion").classList.remove('form-control-danger');
    document.querySelector('#formCategoria').reset();
    document.querySelector('#titleModal').innerHTML = "Actualizar Categoria";
    document.querySelector('#btnTex').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Categorias/getCategoria/' + idcategoria;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            /* console.log(request.responseText); */
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idCategoria").value = objData.data.idcategoria;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                document.querySelector("#fotoActual").value = objData.data.portada;
                document.querySelector("#fotoRemover").value = 0;
                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('refresh');

                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = objData.data.url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img'  src =" + objData.data.url_portada + ">";
                }
                if (objData.data.portada == 'portada_categoria.png') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
                $('#categorias-modal').modal("show");
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelCategoria(idcategoria) {
    swal({
        title: 'Eliminar Categoría',
        text: "¿Realmente quieres eliminar esta categoría?",
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
            let ajaxUrl = base_url + '/Categorias/delCategoria/';
            let strData = "idcategoria=" + idcategoria;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminado!", objData.msg, "success");
                        tableCategorias.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    })
}