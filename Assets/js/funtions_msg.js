var contentAjax;

function openModal() {
    document.querySelector("#txtMensaje").classList.remove('form-control-danger');
    document.querySelector("#txtTitulo").classList.remove('form-control-danger');
    document.querySelector('#idMsg').value = "";
    document.querySelector('#titleModal').innerHTML = "Registrar un Mensaje";
    document.querySelector('#btnTex').innerHTML = "Registrar";
    document.querySelector('#formMsg').reset();
}
document.addEventListener('DOMContentLoaded', function() {
    var idMsg = idMsg;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/msg/getMsg';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#contentAjax').innerHTML = request.responseText;

            }
        }
        //NUEVO ROL
    var formMsg = document.querySelector("#formMsg");
    formMsg.onsubmit = function(e) {
        e.preventDefault();
        var idMsg = document.querySelector("#idMsg").value;
        var strMensaje = document.querySelector('#txtMensaje').value;
        var strTitulo = document.querySelector('#txtTitulo').value;
        if (strMensaje == '') {
            swal("Atención", "El mensaje es obligatorio.", "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Msg/setMsg';
        var formData = new FormData(formMsg);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#msg-modal').modal("hide");
                    formMsg.reset();
                    swal("Mensajes de Bienvenida", objData.msg, "success");
                    $("#contentAjax").load(" #contentAjax");
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }
});