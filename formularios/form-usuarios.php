<?php
  include '../navbar.php';
  include '../procesar.php';
  $usuariosObj = new Mascotas();
  $usuarios = $usuariosObj->mostrar_usu();
?>
<div class="fondo">
<div class="form-style "><br>
  <div class="container">
    <h2>Usuarios</h2>
    <button type="button" class="btn btn-primary btn-agregar" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Agregar
    </button>
        <br>
    <div class="datatable">
      <table id="example" class="table table-striped" style="width:100%">
        <thead>
          <th>Identificacion</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Telefono</th>
          <th>correo</th>
          <th>Direción</th>
          <th>Rol</th>
          <th>Estado</th>
        </thead>
        <tbody>
        <?php
            foreach ($usuarios as $reg) {
          ?>
            <tr>
              <td><span><?php echo $reg["identificacion"]?></span></td>
              <td><span><?php echo $reg["nombre"]?></span></td>
              <td><span><?php echo $reg["apellido"]?></span></td>
              <td><span><?php echo $reg["telefono"]?></span></td>
              <td><span><?php echo $reg["correo"]?></span></td>
              <td><span><?php echo $reg["direccion"]?></span></td>
              <td><span><?php echo $reg["rol"]?></span></td>
              <td><span><?php echo $reg["estado"]?></span></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Mascota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre">
              </div>
              <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control" name="edad" id="edad" placeholder="Ingrese Edad">
              </div>
              <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagen">
              </div>
              <div class="mb-3">
                <label for="raza" class="form-label">Raza</label>
                <input type="text" class="form-control" name="raza" id="raza" placeholder="Ingrese Raza">
              </div>
              <div class="mb-3">
                <label for="especie" class="form-label">Especie</label>
                <input type="text" class="form-control" name="especie" id="especie" placeholder="Ingrese Especie">
              </div>
              <div class="mb-3">
                <label for="comentario" class="form-label">Comentarios</label>
                <textarea name="comentario" id="comentario" class="form-control" cols="30" rows="10"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Enviar</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
  </div>
</div>
