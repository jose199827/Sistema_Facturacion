var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector("#formLogin")) {
        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e) {
            e.preventDefault();
            let strEmail = document.querySelector('#txtEmail').value;
            let strPassword = document.querySelector('#txtPassword').value;
            if (strEmail == '' || strPassword == '') {
                swal("Atención", "Escribe un correo y contraseña.", "error");
                return false;
            } else {
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url + '/Login/loginUser';
                var formData = new FormData(formLogin);
                request.open("POST", ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function() {
                    if (request.readyState != 4) return;
                    if (request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            window.location = base_url + '/Dashboard';
                        } else {
                            swal("Atención", objData.msg, "error");
                            document.querySelector('#txtPassword').value = "";
                            document.querySelector('#txtEmail').value = "";
                        }
                    } else {
                        swal("Atención", "Error en el proceso.", "error");

                    }
                    divLoading.style.display = "none";
                    return false;
                }
            }
        }
    }
    if (document.querySelector("#formResetPass")) {
        let formResetPass = document.querySelector("#formResetPass");
        formResetPass.onsubmit = function(e) {
            e.preventDefault();
            let strEmailReset = document.querySelector('#txtEmailReset').value;
            if (strEmailReset == '') {
                swal("Atención", "Escribe tu correo electrónico.", "error");
                return false;
            } else {
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url + '/Login/resetPass';
                var formData = new FormData(formResetPass);
                request.open("POST", ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function() {
                    if (request.readyState != 4) return;
                    if (request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            swal({
                                title: 'Correo Enviado',
                                text: objData.msg,
                                type: 'success',
                                confirmButtonText: "Aceptar",
                                preConfirm: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location = base_url;
                                }
                            })
                        } else {
                            swal("Atención", objData.msg, "error");
                        }
                    } else {
                        swal("Atención", "Error en el proceso.", "error");
                    }
                    divLoading.style.display = "none";
                    return false;
                }
            }
        }
    }

    if (document.querySelector("#formCambiarPass")) {
        let formCambiarPass = document.querySelector("#formCambiarPass");
        formCambiarPass.onsubmit = function(e) {
            e.preventDefault();
            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
            let idUsuario = document.querySelector('#idUsuario').value;
            if (strPassword == '' || strPasswordConfirm == '') {
                swal("Atención", "Escribe la nueva contraseña y confirma.", "error");
                return false;
            } else {
                if (strPassword < 5) {
                    swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "warning");
                    return false;
                }
                if (strPassword != strPasswordConfirm) {
                    swal("Atención", "Las contraseñas no son iguales.", "info");
                    return false;
                }
                divLoading.style.display = "flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url + '/Login/setPass';
                var formData = new FormData(formCambiarPass);
                request.open("POST", ajaxUrl, true);
                request.send(formData);
                request.onreadystatechange = function() {
                    if (request.readyState != 4) return;
                    if (request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            swal({
                                title: 'Iniciar sección',
                                text: objData.msg,
                                type: 'success',
                                confirmButtonText: "Iniciar sección",
                                preConfirm: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location = base_url + '/Login';
                                }
                            })
                        } else {
                            swal("Atención", objData.msg, "error");
                        }
                    } else {
                        swal("Atención", "Error en el proceso.", "error");
                    }
                    divLoading.style.display = "none";
                }
            }
        }
    }

}, false);