<?php
include '../navbar.php';
include '../procesar.php';
$mascotasObj = new Mascotas();
$razas = $mascotasObj->mostrar_raza();
if (isset($_POST['submit'])) {
  $mascotasObj->insertar_raza($_POST);
}

?>
<div class="fondo">
  <div class="form-style "><br>
    <div class="container">
      <h2>Razas</h2>
      <button type="button" class="btn btn-primary btn-agregar" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar
      </button>
      <br>
      <div class="datatable">
        <table id="example" class="table table-striped" style="width:100%">
          <thead>
            <th>Id</th>
            <th>Raza</th>
            <th>URL</th>
            <th>Estado</th>
            <th>Más</th>
          </thead>
          <tbody>
            <?php
            foreach ($razas as $reg) {
            ?>
              <tr>
                <td><span><?php echo $reg["id"] ?></span></td>
                <td><span id="pos_r_n<?php echo $reg['id'] ?>"><?php echo $reg["raza"] ?></span></td>
                <td style="width: 250px;"><span id="pos_r_u<?php echo $reg['id'] ?>"><a href="<?php echo $reg["url_raza"] ?>"><?php echo $reg["url_raza"] ?></a></span></td>
                <td><span id="pos_e<?php echo $reg['id'] ?>"><?php echo $reg["estado"] ?></span></td>
                <td>
                  <button type="button" class="btn btn-warning btn-actualizar_raza" data-bs-toggle="modal" data-id="<?php echo $reg['id'] ?>" data-bs-target="#exampleModalA"><i class="bi bi-pencil-square"></i></button>

                  <?php
                  if ($reg["estado"] == 'Activo') {
                  ?>
                    <button type="button" class="btn btn-danger btn-eliminar_raza" data-estado="<?php echo $reg['id'] ?>"><i class="bi bi-trash"></i></button>
                  <?php
                  } else {
                  ?>
                    <button type="button" class="btn btn-secondary btn-eliminar_raza" data-estado="<?php echo $reg['id'] ?>"><i class="bi bi-check-lg"></i></button>
                  <?php
                  }
                  ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar Raza</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container" style="padding: 10px 50px 20px 50px;">
              <form action="" method="post">
                <div>
                  <input type="hidden" name="id_raza" id="id_raza" value="<?php echo $reg["id"] ?>">
                </div>
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre Raza</label>
                  <input type="text" class="form-control" name="nombre_raza" id="nombre_raza" placeholder="Ingrese Nombre" required>
                </div>
                <div class="mb-3">
                  <label for="comentario" class="form-label">URL</label>
                  <textarea name="url_raza" id="url_raza" class="form-control" cols="30" rows="10" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-success">Enviar</button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModalA" tabindex="-1" aria-labelledby="exampleModalLabelA" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelA">Actualizar Mascota</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" id="form_actualizar_mas">
                <div class="mb-3">
                  <label for="id_mas" class="form-label">Id</label>
                  <input type="text" class="form-control id_raza" disabled>
                  <input type="hidden" class="form-control id_raza" name="id_raza_act" id="id_raza_act">
                </div>

                <div class="mb-3">
                  <label for="nombre_mas_act" class="form-label">Nombre</label>
                  <input type="text" class="form-control nom_raza" name="nombre_raza_act" id="nombre_raza_act">
                </div>
                <div class="mb-3">
                  <label for="url_raza_act" class="form-label">URL</label>
                  <textarea name="url_raza_act" id="url_raza_act" class="url_raza form-control" cols="20" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button"  class="btn btn-success btn-update_raza">Enviar</button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
    </div>
  </div>