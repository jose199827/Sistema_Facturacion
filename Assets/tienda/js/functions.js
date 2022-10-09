  $(".js-select2").each(function() {
      $(this).select2({
          minimumResultsForSearch: 20,
          dropdownParent: $(this).next('.dropDownSelect2')
      });
  })

  $('.parallax100').parallax100();

  $('.gallery-lb').each(function() { // the containers for all your galleries
      $(this).magnificPopup({
          delegate: 'a', // the selector for gallery item
          type: 'image',
          gallery: {
              enabled: true
          },
          mainClass: 'mfp-fade'
      });
  });

  $('.js-addwish-b2').on('click', function(e) {
      e.preventDefault();
  });

  $('.js-addwish-b2').each(function() {
      var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
      $(this).on('click', function() {
          swal(nameProduct, "¡Se ha agregado al carrito!", "success");

          /* $(this).addClass('js-addedwish-b2');
          $(this).off('click'); */
      });
  });

  $('.js-addwish-detail').each(function() {
      var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

      $(this).on('click', function() {
          swal(nameProduct, "is added to wishlist !", "success");

          $(this).addClass('js-addedwish-detail');
          $(this).off('click');
      });
  });

  /*---------------------------------------------*/

  $('.js-addcart-detail').each(function() {
      var nameProduct = $(this).parent().parent().parent().parent().parent().find('.js-name-detail').html();
      let cant = 1;
      $(this).on('click', function() {
          let id = this.getAttribute('id');
          if (document.querySelector('#cant-product')) {
              cant = document.querySelector('#cant-product').value;
          }
          if (this.getAttribute('pr')) {
              cant = this.getAttribute('pr');
          }
          if (isNaN(cant) || cant < 1) {
              swal("Error", "La cantidad debe ser mayor a 0", "error");
              return;
          }
          let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          let ajaxUrl = base_url + '/Tienda/addCarrito';
          let forData = new FormData();
          forData.append('id', id);
          forData.append('cant', cant);
          request.open("POST", ajaxUrl, true);
          request.send(forData);
          request.onreadystatechange = function() {
              if (request.readyState != 4) return;
              if (request.status == 200) {
                  /* console.log(request.responseText); */
                  let objData = JSON.parse(request.responseText);
                  if (objData.status) {
                      document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;
                      /* document.querySelector("#cantCarrito").setAttribute("data-notify", objData.cantCarrito);
                      document.querySelector("#cantCarritoMovil").setAttribute("data-notify", objData.cantCarrito); */
                      const cants = document.querySelectorAll(".cantCarrito");
                      cants.forEach(element => {
                          element.setAttribute("data-notify", objData.cantCarrito);
                      });
                      swal(nameProduct, objData.msg, "success");
                  } else {
                      swal("Error", objData.msg, "error");
                  }
              }
              return false;
          };

      });
  });

  $('.js-pscroll').each(function() {
      $(this).css('position', 'relative');
      $(this).css('overflow', 'hidden');
      var ps = new PerfectScrollbar(this, {
          wheelSpeed: 1,
          scrollingThreshold: 1000,
          wheelPropagation: false,
      });

      $(window).on('resize', function() {
          ps.update();
      })
  });

  $('.btn-num-product-down').on('click', function() {
      let numProduct = Number($(this).next().val());
      let idpr = this.getAttribute("idpr");
      if (numProduct > 1) $(this).next().val(numProduct - 1);
      let cant = $(this).next().val();
      if (idpr != null) {
          fntUpdateCant(idpr, cant);
      }
  });

  $('.btn-num-product-up').on('click', function() {
      let numProduct = Number($(this).prev().val());
      let idpr = this.getAttribute("idpr");
      $(this).prev().val(numProduct + 1);
      let cant = $(this).prev().val();
      if (idpr != null) {
          fntUpdateCant(idpr, cant);
      }
  });

  if (document.querySelector(".num-product")) {
      let inputCant = document.querySelectorAll(".num-product");
      inputCant.forEach(function(inputCant) {
          inputCant.addEventListener('keyup', function() {
              let idpr = this.getAttribute("idpr");
              let cant = this.value;
              if (idpr != null) {
                  fntUpdateCant(idpr, cant);
              }
          });
      });
  }

  function fntUpdateCant(idpr, cant) {
      if (cant <= 0) {
          document.querySelector("#btnComprar").classList.add("notBlock");
      } else {
          document.querySelector("#btnComprar").classList.remove("notBlock");
      }
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      let ajaxUrl = base_url + '/Tienda/updCarrito';
      let forData = new FormData();
      forData.append('id', idpr);
      forData.append('cantidad', cant);
      request.open("POST", ajaxUrl, true);
      request.send(forData);
      request.onreadystatechange = function() {
          if (request.readyState != 4) return;
          if (request.status == 200) {
              /* console.log(request.responseText); */
              let objData = JSON.parse(request.responseText);
              if (objData.status) {
                  let colSubtotal = document.getElementsByClassName(idpr)[0];
                  colSubtotal.cells[4].textContent = objData.totalProducto;
                  document.querySelector("#subTotalCompra").innerHTML = objData.subtotal;
                  document.querySelector("#totalCompra").innerHTML = objData.total;
                  /* swal("Producto", objData.msg, "success"); */
              } else {
                  swal("Error", objData.msg, "error");
              }
          }
          return false;
      };
  }

  function fntDelItem(element) {
      /* console.log(element); */
      //Option 1= Eliminar item desde el modal
      //Option 2= Eliminar item desde el carrito
      let option = element.getAttribute("op");
      let idpr = element.getAttribute("idpr");
      if (option == 1 || option == 2) {
          let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          let ajaxUrl = base_url + '/Tienda/delCarrito';
          let forData = new FormData();
          forData.append('id', idpr);
          forData.append('option', option);
          request.open("POST", ajaxUrl, true);
          request.send(forData);
          request.onreadystatechange = function() {
              if (request.readyState != 4) return;
              if (request.status == 200) {
                  /* console.log(request.responseText); */
                  let objData = JSON.parse(request.responseText);
                  if (objData.status) {
                      if (option == 1) {
                          document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;
                          const cants = document.querySelectorAll(".cantCarrito");
                          cants.forEach(element => {
                              element.setAttribute("data-notify", objData.cantCarrito);
                          });
                          if (objData.cantCarrito == 0) {
                              $('.js-panel-cart').removeClass('show-header-cart');
                          }
                      } else {
                          element.parentNode.parentNode.remove();
                          document.querySelector("#subTotalCompra").innerHTML = objData.subtotal;
                          document.querySelector("#totalCompra").innerHTML = objData.total;
                          if (document.querySelectorAll("#tblCarrito tr").length == 1) {
                              window.location.href = base_url + '/Tienda';
                          }
                      }
                      swal("Eliminado", objData.msg, "success");
                  } else {
                      swal("Error", objData.msg, "error");
                  }
              }
              return false;
          };
      }
  }

  if (document.querySelector("#formRegister")) {
      let formRegister = document.querySelector("#formRegister");
      formRegister.onsubmit = function(e) {
          e.preventDefault();

          let strNombre = document.querySelector('#txtNombre').value;
          let strApellido = document.querySelector('#txtApellido').value;
          let strEmail = document.querySelector('#txtEmailCliente').value;
          let intTelefono = document.querySelector('#txtTelefono').value;


          if (strNombre == '' || strApellido == '' || strEmail == '' || intTelefono == '') {
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
          let ajaxUrl = base_url + '/Tienda/registro';
          let formData = new FormData(formRegister);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          request.onreadystatechange = function() {
              if (request.readyState == 4 && request.status == 200) {
                  /* console.log(request.responseText); */
                  let objData = JSON.parse(request.responseText);
                  if (objData.status) {
                      swal("Clientes", objData.msg, "success");
                      window.location.reload(false);
                  } else {
                      swal("Error", objData.msg, "error");
                  }
              }
              divLoading.style.display = "none";
              return false;
          }
      }
  }

  if (document.querySelector(".methodpago")) {
      let optmetodo = document.querySelectorAll(".methodpago");
      optmetodo.forEach(function(optmetodo) {
          optmetodo.addEventListener('click', function() {
              if (this.value == "Paypal") {
                  document.querySelector("#divpaypal").classList.remove("notblock");
                  document.querySelector("#divtipopago").classList.add("notblock");
              } else {
                  document.querySelector("#divpaypal").classList.add("notblock");
                  document.querySelector("#divtipopago").classList.remove("notblock");
              }
          });
      });
  }

  if (document.querySelector("#txtCiudad")) {
      let ciudad = document.querySelector("#txtCiudad");
      ciudad.addEventListener('keyup', function() {
          let ciud = this.value;
          fntViewPago();
      });
  }

  if (document.querySelector("#txtDireccion")) {
      let direccion = document.querySelector("#txtDireccion");
      direccion.addEventListener('keyup', function() {
          let dir = this.value;
          fntViewPago();
      });
  }

  function fntViewPago() {
      let direccion = document.querySelector("#txtDireccion").value;
      let ciudad = document.querySelector("#txtCiudad").value;
      if (direccion == "" || ciudad == "") {
          document.querySelector("#divmetodpago").classList.add("notblock");
      } else {
          document.querySelector("#divmetodpago").classList.remove("notblock");
      }
  }

  if (document.querySelector("#btnComprar")) {
      let btnPago = document.querySelector("#btnComprar");
      btnPago.addEventListener('click', function() {
          let direccion = document.querySelector("#txtDireccion").value;
          let ciudad = document.querySelector("#txtCiudad").value;
          let inttipopago = document.querySelector("#listtipopago").value;
          if (direccion == "" || ciudad == "" || inttipopago == "") {
              swal("Error de Datos", "Complete los datos de envío o tipo de pago", "error");
              return;
          }
          divLoading.style.display = "flex";
          let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          let ajaxUrl = base_url + '/Tienda/procesarVenta';
          let formData = new FormData();
          formData.append('direccion', direccion);
          formData.append('ciudad', ciudad);
          formData.append('inttipopago', inttipopago);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          request.onreadystatechange = function() {
              if (request.readyState != 4) return;
              if (request.status == 200) {
                  let objData = JSON.parse(request.responseText);
                  if (objData.status) {
                      window.location = base_url + "/Tienda/confirmarPedido"
                          /* swal("Proceso", objData.msg, "success"); */
                  } else {
                      swal("Error", objData.msg, "error");
                  }
              }
              divLoading.style.display = "none";

          }
      }, false);
  }

  if (document.querySelector("#condiciones")) {
      let condiciones = document.querySelector("#condiciones");
      condiciones.addEventListener('click', function() {
          let condiciones = this.checked;
          if (condiciones) {
              document.querySelector('#optMetodoPago').classList.remove("notblock");
          } else {
              document.querySelector('#optMetodoPago').classList.add("notblock");
          }
      });
  }
  if (document.querySelector("#frmSubscripcion")) {
      let frmSubscribcion = document.querySelector("#frmSubscripcion");
      frmSubscribcion.addEventListener('submit', function(e) {
          e.preventDefault();
          let nombreSubcripcion = document.querySelector("#nombreSubcripcion").value;
          let emailSubcripcion = document.querySelector("#emailSubcripcion").value;
          if (nombreSubcripcion == "") {
              swal("Error de Datos", "El nombre es obligatorio", "error");
              return;
          }
          if (!fntEmailValidate(emailSubcripcion)) {
              swal("Error de Datos", "El email no es válido", "error");
              return;
          }
          divLoading.style.display = "flex";
          let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          let ajaxUrl = base_url + '/Tienda/suscripcion';
          let formData = new FormData(frmSubscribcion);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          request.onreadystatechange = function() {
              if (request.readyState != 4) return;
              if (request.status == 200) {
                  /* console.log(request.responseText); */
                  let objData = JSON.parse(request.responseText);
                  if (objData.status) {
                      swal("Suscripción", objData.msg, "success");
                      document.querySelector("#frmSubscripcion").reset();
                  } else {
                      swal("Suscripción", objData.msg, "error");
                  }
              }
              divLoading.style.display = "none";
              return false
          }
      }, false);
  }

  if (document.querySelector("#frmContacto")) {
      let frmContacto = document.querySelector("#frmContacto");
      frmContacto.addEventListener('submit', function(e) {
          e.preventDefault();
          let nombrecontancto = document.querySelector("#nombrecontancto").value;
          let emailcontancto = document.querySelector("#emailcontancto").value;
          let msgcontancto = document.querySelector("#msgcontancto").value;
          if (nombrecontancto == "") {
              swal("Error de Datos", "El nombre es obligatorio", "error");
              return;
          }
          if (!fntEmailValidate(emailcontancto)) {
              swal("Error de Datos", "El email no es válido", "error");
              return;
          }
          if (msgcontancto == "") {
              swal("Error de Datos", "El mensaje es obligatorio", "error");
              return;
          }
          divLoading.style.display = "flex";
          let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          let ajaxUrl = base_url + '/Tienda/contancto';
          let formData = new FormData(frmContacto);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          request.onreadystatechange = function() {
              if (request.readyState != 4) return;
              if (request.status == 200) {
                  /* console.log(request.responseText); */
                  let objData = JSON.parse(request.responseText);
                  if (objData.status) {
                      swal("Suscripción", objData.msg, "success");
                      document.querySelector("#frmSubscripcion").reset();
                  } else {
                      swal("Suscripción", objData.msg, "error");
                  }
              }
              divLoading.style.display = "none";
              return false
          }
      }, false);
  }