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

    console.log("actualizar: ", act);
    var esperar = 200;
    $.ajax({
      type: "POST",
      data: { "actu": act },
      url: "../procesar.php",
      dataType: "json",
      success: function (datos) {
        setTimeout(function () {
          var items = [];
          $.each( datos, function( key, val ) {
            items[key]=val;
          });
          console.log(items)
          $(".id_mas").val(items['id_mas']);
          $(".nom_mas").val(items['nombre']);
          $(".raza_mas").val(items['raza']);
          $(".especie_mas").text(items['especie']);
          $(".especie_mas").val(items['especie_id']);
          $(".cmt_mas").val(items['comentarios']);
          $(".estado_id_mas").val(items['estado_elemento_id']);
          let edad = items['edad'];
          let anio = edad / 12;
          let mes = edad % 12
          $(".e_anio_mas").text(Math.trunc(anio));
          $(".e_mes_mas").text(Math.trunc(mes));
        }, esperar);
      },
      error: function () {
        setTimeout(function () {
          console.log("Error")
        }, esperar);
      },
    });
  });

  $('body').on('click', '.btn-update', function () {
    var esperar = 200;
    var pos = (($("#id_mas_act").val()));
    var img = $("#imagen_mas_act").val()
    fic = img.split('\\');
    fic = fic[fic.length-1];
    console.log("imagen", img)
    console.log("posicionnn: ",pos);
    var cadena = $('#form_actualizar_mas').serializeArray();
    console.log('cadena:', cadena);
    $.ajax({
      type: "POST",
      // data: {"updt": 1, "id_mas": $("#id_mas_act").val(),"nombre": $("#nombre_mas_act").val(),"anio": $("#edad_anio_mas_act").val(),"mes": $("#edad_mes_mas_act").val(), "imagen": fic, "raza": $("#raza_mas_act").val(), "especie": $("#especie_mas_act").val(),"comentarios": $("#comentario_mas_act").val(), "estado": $("#estado_id").val()},
      data: {'cadena': cadena},
      url: "../procesar.php",
      dataType: 'json',
      success: function (datos) {
        setTimeout(function () {
            console.log(datos);
        }, esperar);
      },
      error: function () {
        setTimeout(function () {
          Swal.fire(
            'Error',
            'No se Actualizo',
            'error'
          )
        }, esperar);
      },
    });
  });

  $('body').on('click', '.btn-eliminar_raza', function () {
    let id = this.dataset.estado;
    console.log("siiii: ", id);
    var esperar = 200;
    var valor= this;
    console.log(valor);
    $.ajax({
      type: "POST",
      data: { "elim_raza": id },
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

  $('body').on('click', '.btn-actualizar_raza', function () {
    let act = this.dataset.id;

    console.log("actualizar: ", act);
    var esperar = 200;
    $.ajax({
      type: "POST",
      data: { "actu_raza": act },
      url: "../procesar.php",
      dataType: "json",
      success: function (datos) {
        setTimeout(function () {
          var items = [];
          $.each( datos, function( key, val ) {
            items[key]=val;
          });
          console.log(items)
          $(".id_raza").val(items['id']);
          $(".nom_raza").val(items['raza']);
          $(".url_raza").val(items['url_raza']);
        }, esperar);
      },
      error: function () {
        setTimeout(function () {
          console.log("Error")
        }, esperar);
      },
    });
  });

  $('body').on('click', '.btn-update_raza', function () {
    var esperar = 200;
    var pos = (($("#id_raza_act").val()));
    console.log("posicion: ",pos);
    $.ajax({
      type: "POST",
      data: {"updt_raza": 1, "id_raza": $("#id_raza_act").val(),"nombre_raza": $("#nombre_raza_act").val(),"url_raza": $("#url_raza_act").val()},
      // data: $("#form_actualizar_mas").serialize(),
      url: "../procesar.php",
      dataType: "json",
      success: function (datos) {
        setTimeout(function () {
          var items = [];
          $.each( (datos), function( key, val ) {
            items[key]=val;
          });
          console.log(items)
          Swal.fire(
            'Correcto',
            'Se Actualizo correctamente',
            'success'
          );
          document.getElementById("pos_r_n"+pos).innerHTML = items['raza'];
          document.getElementById("pos_r_u"+pos).innerHTML = "<a href='"+items['url']+"'>"+items['url']+"</a>";
        }, esperar);
      },
      error: function () {
        setTimeout(function () {
          Swal.fire(
            'Error',
            'No se Actualizo',
            'error'
          )
        }, esperar);
      },
    });
  });
});


function nombre(fic) {
  
}