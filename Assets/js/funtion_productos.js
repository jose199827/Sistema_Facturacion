let tableProductos;
let rowTable;
let divLoading = document.querySelector('#divLoading');

$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

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
    tableProductos = $('#tableProductos').dataTable({
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
            "url": " " + base_url + "/Productos/getProductos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idproducto" },
            { "data": "codigo" },
            { "data": "nombre" },
            { "data": "stock" },
            { "data": "precio" },
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

    if (document.querySelector("#formProductos")) {
        let formProductos = document.querySelector("#formProductos");
        formProductos.onsubmit = function(e) {
            e.preventDefault();

            let strNombre = document.querySelector('#txtNombre').value;
            let intCodigo = document.querySelector('#txtCodigo').value;
            let strPrecio = document.querySelector('#txtPrecio').value;
            let intStock = document.querySelector('#txtStock').value;
            let intStatus = document.querySelector('#listStatus').value;
            if (strNombre == '' || intCodigo == '' || strPrecio == '' || intStock == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            if (intCodigo.length < 5) {
                swal("Atención", "El código debe se mayor de 5 dígitos.", "error");
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
            let ajaxUrl = base_url + '/Productos/setProductos';
            let formData = new FormData(formProductos);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    /* console.log(request.responseText); */
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Productos", objData.msg, "success");
                        document.querySelector("#idProducto").value = objData.idproducto;
                        document.querySelector('#containerGallery').classList.remove("notblock");
                        if (rowTable == "") {
                            tableProductos.api().ajax.reload();
                        } else {
                            let htmlStatus = intStatus == 1 ?
                                '<span class="badge badge-success badge-pill">Activo</span>' :
                                '<span class="badge badge-warning badge-pill">Inactivo</span>';
                            rowTable.cells[1].textContent = intCodigo;
                            rowTable.cells[2].textContent = strNombre;
                            rowTable.cells[3].textContent = intStock;
                            rowTable.cells[4].textContent = smony + strPrecio;
                            rowTable.cells[5].innerHTML = htmlStatus;
                            rowTable = "";
                        }
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }

    if (document.querySelector(".btnAddImage")) {
        let btnAddImage = document.querySelector(".btnAddImage");
        btnAddImage.onclick = function(e) {
            let key = Date.now();
            let newElement = document.createElement("div");
            newElement.id = "div" + key;
            newElement.innerHTML = `                  
            <div class="prevImage"></div>
            <input type="file" name="foto" id="img${key}" class="inputUploadfile">
            <label for="img${key}" class="btnUploadfile"><i class="dw dw-upload1"></i></label>
            <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="dw dw-cancel"></i></button>`;
            document.querySelector("#containerImages").appendChild(newElement);
            document.querySelector("#div" + key + " .btnUploadfile ").click();
            fntInputFile();
        }
    }
}, false);

/* $(document).ready(function() {
    $('#tableProductos').DataTable();
}); */

window.addEventListener('load', function() {
    fntInputFile();
    fntCategoria();
}, false);

if (document.querySelector("#txtCodigo")) {
    let inputCodigo = document.querySelector("#txtCodigo");
    inputCodigo.onkeyup = function() {
        if (inputCodigo.value.length >= 5) {
            document.querySelector('#divBarCode').classList.remove("notblock");
            fntBarcode();
        } else {
            document.querySelector('#divBarCode').classList.add("notblock");
        }
    };
}

tinymce.init({
    selector: '#txtDescripcion',
    width: "100%",
    height: 290,
    statubar: true,
    language: 'es',
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

function fntCategoria() {
    if (document.querySelector('#listCategoria')) {
        let ajaxUrl = base_url + '/Categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listCategoria').innerHTML = request.responseText;
                document.querySelector('#listCategoria').value = 1;
                $('#listCategoria').selectpicker('refresh');
            }
        }
    }
}

function openModal() {
    rowTable = "";
    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtDescripcion").classList.remove('form-control-danger');
    document.querySelector('#idProducto').value = "";
    document.querySelector('#titleModal').innerHTML = "Registrar un Producto";
    document.querySelector('#btnTex').innerHTML = "Registrar";
    document.querySelector('#formProductos').reset();
    document.querySelector('#divBarCode').classList.add("notblock");
    document.querySelector('#containerGallery').classList.add("notblock");
    document.querySelector('#containerImages').innerHTML = "";
    $('#listCategoria').selectpicker('refresh');
    $('#listStatus').selectpicker('refresh');
    $('#productos-modal').modal('show');
}

function fntBarcode() {
    let codigo = document.querySelector("#txtCodigo").value;
    JsBarcode("#barcode", codigo, {
        lineColor: "#6c757d",
        height: 80
    });
    document.querySelector("#divBarCode").classList.remove('notblock');
}

function fntPrintBarcode(area) {
    let elementArea = document.querySelector(area);
    let vprint = window.open(' ', ' popimpr', 'height=400, width=600');
    vprint.document.write(elementArea.innerHTML);
    vprint.document.close();
    vprint.print();
    vprint.close();
}

tinymce.init({
    selector: '#txtDescripcion',
    width: "100%",
    height: 290,
    statubar: true,
    language: 'es',
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

function fntInputFile() {
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function() {
            let idProducto = document.querySelector("#idProducto").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");
            let uploadFoto = document.querySelector("#" + idFile).value;
            let fileimg = document.querySelector("#" + idFile).files;
            let prevImg = document.querySelector("#" + parentId + " .prevImage");

            let nav = window.URL || window.webkitURL;
            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                } else {
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/img/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + '/Productos/setImage';
                    let formData = new FormData();
                    formData.append('idproducto', idProducto);
                    formData.append("foto", this.files[0]);
                    request.open("POST", ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function() {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);
                            if (objData.status) {
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#" + parentId + " .btnDeleteImage").setAttribute("imgname", objData.imgname);
                                document.querySelector("#" + parentId + " .btnUploadfile").classList.add("notblock");
                                document.querySelector("#" + parentId + " .btnDeleteImage").classList.remove("notblock");
                            } else {
                                swal("Error", objData.msg, "error");
                            }
                        }
                    }

                }
            }

        });
    });
}

function fntDelItem(element) {
    let nameImg = document.querySelector(element + ' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector('#idProducto').value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Productos/delFile';

    let formData = new FormData();
    formData.append('idProducto', idProducto);
    formData.append('nameImg', nameImg);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}

function fntViewProducto(idProducto) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Productos/getProducto/' + idProducto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImagen = "";
                let objProducto = objData.data;
                let estado = objData.data.status == 1 ? '<span class="badge badge-success badge-pill">Activo</span>' : '<span class="badge badge-warning badge-pill">Inactivo</span>';
                document.querySelector("#cellcodProducto").innerHTML = objProducto.idproducto;
                document.querySelector("#celNombre").innerHTML = objProducto.nombre;
                document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;
                document.querySelector("#cellPrecio").innerHTML = objProducto.precio;
                document.querySelector("#cellStock").innerHTML = objProducto.stock;
                document.querySelector("#cellCategoria").innerHTML = objProducto.categoria;
                /*                 document.querySelector("#cellFotos").innerHTML = '<img src="' + objData.data.url_portada + '" alt="">'; */
                document.querySelector("#cellStatus").innerHTML = estado;

                if (objProducto.imagenes.length > 0) {
                    let objProductos = objProducto.imagenes;
                    for (let p = 0; p < objProductos.length; p++) {
                        htmlImagen += `<img src="${objProductos[p].url_imagen}">`;
                    }
                }
                document.querySelector("#cellFotos").innerHTML = htmlImagen;
                $('#viewproductos-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}

function fntEditProducto(element, idProducto) {
    rowTable = element.parentNode.parentNode.parentNode.parentNode;

    document.querySelector("#txtNombre").classList.remove('form-control-danger');
    document.querySelector("#txtDescripcion").classList.remove('form-control-danger');
    /*     document.querySelector('#formProductos').reset(); */
    document.querySelector('#titleModal').innerHTML = "Actualizar Producto";
    document.querySelector('#btnTex').innerHTML = "Actualizar";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Productos/getProducto/' + idProducto;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let htmlImagen = "";
                let objProducto = objData.data;
                document.querySelector("#idProducto").value = objProducto.idproducto;
                document.querySelector("#txtNombre").value = objProducto.nombre;
                document.querySelector("#txtDescripcion").value = objProducto.descripcion;
                tinymce.activeEditor.setContent(objProducto.descripcion);
                document.querySelector("#txtCodigo").value = objProducto.codigo;
                document.querySelector("#txtPrecio").value = objProducto.precio;
                document.querySelector("#txtStock").value = objProducto.stock;
                document.querySelector("#listCategoria").value = objProducto.categoriaid;
                document.querySelector("#listStatus").value = objProducto.status;
                $('#listCategoria').selectpicker('refresh');
                $('#listStatus').selectpicker('refresh');
                fntBarcode();
                if (objProducto.imagenes.length > 0) {
                    let objProductos = objProducto.imagenes;
                    for (let p = 0; p < objProductos.length; p++) {
                        let key = Date.now() + p;
                        htmlImagen += ` <div id="div${key}">
                                                        <div class="prevImage">
                                                            <img src="${objProductos[p].url_imagen}">
                                                        </div>
                                                        <button class="btnDeleteImage " type="button" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}"><i class="dw dw-cancel"></i></button>
                                                    </div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImagen;
                document.querySelector('#containerGallery').classList.remove("notblock");
                document.querySelector("#divBarCode").classList.remove("notblock");
                $('#productos-modal').modal('show');
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}

function fntDelProducto(idProducto) {
    swal({
        title: 'Eliminar Producto',
        text: "¿Realmente quieres eliminar este Producto?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1b00ff',
        cancelButtonColor: '#dc3545',
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        preConfirm: false
    }).then((result) => {
        if (result.value) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Productos/delProducto/';
            let strData = "idProducto=" + idProducto;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminado!", objData.msg, "success");
                        tableProductos.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    })
}