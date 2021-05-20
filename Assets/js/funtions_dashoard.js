var divLoading = document.querySelector('#divLoading');
window.addEventListener('load', function() {
    fntViewMsg();
}, false);

function fntViewMsg() {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Msg/getMsg/';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#txtMsg").innerHTML = objData.data.mensaje;
            } else {
                swal("Error", objData.msj, "error");
            }
        }
    }
}

function fntSearchPagos() {
    let fecha = document.querySelector(".pagosMes").value;
    if (fecha == "") {
        swal("Datos", "Seleccione una fecha", "error");
        return false;
    } else {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Dashboard/tipoPagoMes';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('fecha', fecha);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                $("#pagosMesAnio").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}

function fntSearchVentasMes() {
    let fecha = document.querySelector(".ventasMes").value;
    if (fecha == "") {
        swal("Datos", "Seleccione una fecha", "error");
        return false;
    } else {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Dashboard/ventasMes';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('fecha', fecha);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                $("#VentaMes").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}

function fntSearchVentasAnio() {
    let anio = document.querySelector(".ventasAnio").value;
    if (anio == "") {
        swal("Datos", "Seleccione un Año", "error");
        return false;
    } else {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Dashboard/ventasAnio';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('anio', anio);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                $("#VentaAnio").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}