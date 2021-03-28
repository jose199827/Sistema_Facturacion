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