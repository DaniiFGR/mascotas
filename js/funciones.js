$(document).ready(() => {
  $(".btn-adop").click(function () {
    let form = document.createElement("form");
    form.action = "./formularios/form-adoptar.php";
    form.method = "POST";

    let iid = document.createElement("input");
    iid.type = "text";
    iid.name = "id";
    iid.value = this.dataset.id;
    form.appendChild(iid);

    let inombre = document.createElement("input");
    inombre.type = "text";
    inombre.name = "nombre";
    inombre.value = this.dataset.nombre;
    form.appendChild(inombre);

    let iedad = document.createElement("input");
    iedad.type = "text";
    iedad.name = "edad-m";
    iedad.value = this.dataset.edad;
    form.appendChild(iedad);

    let iraza = document.createElement("input");
    iraza.type = "text";
    iraza.name = "raza";
    iraza.value = this.dataset.raza;
    form.appendChild(iraza);

    let icmt = document.createElement("input");
    icmt.type = "text";
    icmt.name = "cmt";
    icmt.value = this.dataset.cmt;
    form.appendChild(icmt);

    let iimg = document.createElement("input");
    iimg.type = "text";
    iimg.name = "img";
    iimg.value = this.dataset.img;
    form.appendChild(iimg);

    let idir = document.createElement("input");
    idir.type = "text";
    idir.name = "dir";
    idir.value = this.dataset.direc;
    form.appendChild(idir);

    document.body.appendChild(form);

    form.submit();
  });

  $(".btn-informacion").click(() => {
    let direccion = document.getElementById("btn-info").dataset.direc;
    document.location.href = direccion;
  });

  $('body').on('click', '.btn-eliminar', function () {
    let id = this.dataset.estado;
    console.log("siiii: ", id);
    var esperar = 200;
    var valor= this;
    console.log(valor);
    $.ajax({
      type: "POST",
      data: { "elim": id },
      url: "../procesar.php",
      success: function (datos) {
        setTimeout(function () {
          if (datos == 1) {
            Swal.fire(
              'Correcto',
              'Se desactivo de forma correcta',
              'success'
            );
            valor.classList.remove("btn-danger");
            valor.classList.add("btn-secondary");
            valor.innerHTML = '<i class="bi bi-check-lg"></i>';
          } else {
            if (datos == 2) {
              Swal.fire(
                'Correcto',
                'Se Activo de forma correcta',
                'success'
              );
              valor.classList.remove("btn-secondary");
              valor.classList.add("btn-danger");
              valor.innerHTML = '<i class="bi bi-trash"></i>';
            }else{
              Swal.fire(
                'Error',
                'No se desactivo',
                'error'
              )
            }
          }
        }, esperar);
      },
    });
  });

  $('body').on('click', '.btn-actualizar', function () {
    let act = this.dataset.id;

    var esperar = 200;
    console.log("actualizar: ", act);
    $.ajax({
      type: "POST",
      data: { "actu": act },
      url: "../procesar.php",
      success: function (datos) {
        setTimeout(function () {
          console.log("datos");
        }, esperar);
      },
    });
  });
});
