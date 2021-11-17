  <?php
    include '../navbar.php';
    include '../procesar.php';
    $usuariosObj = new Mascotas();
    $usuarios = $usuariosObj->mostrar_usu();
    if(isset($_POST['submit'])) {
      $usuariosObj->insertar_usu($_POST);
    }
    foreach ($usuarios as $reg) {}
  ?>
  <div class="fondo">
    <div class="container"> <br><br>
      <div class="row form-style">
        <div class="col-sm-6 info-mascota">
          <div class="tarjeta">
            <div class="card transparencia" style="width: 90%;">
              <img src="../images/<?php echo $_POST["img"]?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $_POST["nombre"]?></h5>
                <p class="card-text"><?php echo $_POST["cmt"]?></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item transparencia"> Edad: <?php echo $_POST["edad-m"]?> </li>
                <li class="list-group-item transparencia">Raza: <a href="<?php echo $_POST["dir"]?>"><?php echo $_POST["raza"]?></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6 fomulario">
          <h2>Formulario de Adopción</h2><br>
          <form action="form-adoptar.php" method="POST">
            <div>
              <input type="hidden" name="id" id="id" value="<?php echo $reg["id_usu"]?>">
              <input type="hidden" name="id_mas" id="id_mas" value="<?php echo $_POST["id"]?>">
            </div>
            <div class="mb-3">
              <label for="identificacion" class="form-label">Identificación</label>
              <input type="number" class="form-control" name="identificacion" id="identificacion" placeholder="Ingrese Identificación">
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre">
            </div>
            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese Apellido">
            </div>
            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Ingrese Teléfono">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">Correo Electronico</label>
              <input type="email" class="form-control" name="correo" id="correo" placeholder="ejemplo@gmail.com" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text correo-div">Ingrese un correo electronico valido</div>
            </div>
            <div class="mb-3">
              <label for="direccion" class="form-label">Dirección</label>
              <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese Dirección">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Enviar</button>
            <button type="button" class="btn btn-danger">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
