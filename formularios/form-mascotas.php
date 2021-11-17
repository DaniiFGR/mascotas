<?php
include '../navbar.php';
include '../procesar.php';
$mascotasObj = new Mascotas();
$mascotas = $mascotasObj->mostrar();
$razas = $mascotasObj->mostrar_raza();
$especies = $mascotasObj->mostrar_esp();
if (isset($_POST['submit'])) {
  $mascotasObj->insertar_mas($_POST);
}
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $editId = $_GET['id'];
  $registro = $registroObj->mostrar_uno($editId);
}
if (isset($_POST['update'])) {
  $registroObj->actualizar($_POST);
}
?>
<div class="fondo">
  <div class="form-style "><br>
    <div class="container">
      <h2>Mascotas</h2>
      <button type="button" class="btn btn-primary btn-agregar" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar
      </button>
      <br>
      <div class="datatable">
        <table id="example" class="table table-striped" style="width:100%">
          <thead>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>edad</th>
            <th>raza</th>
            <th>Más</th>
          </thead>
          <tbody>
            <?php
            foreach ($mascotas as $reg) {
            ?>
              <tr>
                <td><img src="../images/<?php echo $reg["imagen"] ?>" alt=".." class="img-datatable"></td>
                <td><span><?php echo $reg["nombre"] ?></span></td>
                <td><span><?php echo $reg["edad"] ?></span></td>
                <td><span><a style="color: black;" href="<?php echo $reg["url_raza"] ?>"><i class="bi bi-link-45deg"></i><?php echo $reg["raza"] ?></a></span></td>
                <td>
                  <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $reg['id_mas'] ?>"><i class="bi bi-align-middle"></i></button>

                  <button type="button" class="btn btn-warning btn-actualizar" data-bs-toggle="modal" data-id="<?php echo $reg['id_mas'] ?>" data-bs-target="#exampleModalA"><i class="bi bi-pencil-square"></i></button>

                  <?php
                  if ($reg["estado"] == 'Activo') {
                  ?>
                    <button type="button" class="btn btn-danger btn-eliminar" data-estado="<?php echo $reg['id_mas'] ?>"><i class="bi bi-trash"></i></button>
                  <?php
                  } else {
                  ?>
                    <button type="button" class="btn btn-secondary btn-eliminar" data-estado="<?php echo $reg['id_mas'] ?>"><i class="bi bi-check-lg"></i></button>
                  <?php
                  }
                  ?>
                </td>
              </tr>
              <div class="modal fade" id="exampleModal<?php echo $reg['id_mas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $reg['id_mas'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel<?php echo $reg['id_mas'] ?>">Comentarios</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <span><?php echo $reg["comentarios"] ?></span>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
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
            <div class="modal-body container" style="padding: 10px 50px 20px 50px;">
              <form action="" method="post">
                <div>
                  <input type="hidden" name="id_mas" id="id_mas" value="<?php echo $reg["id_mas"] ?>">
                </div>
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre">
                </div>
                <div class="mb-3">
                  <label for="edad" class="form-label">Edad</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <select class="form-select form-select-lg mb-3" name="edad-anio" id="edad-anio">
                        <option selected>Años</option>
                        <?php for ($a = 0; $a <= 20; $a++) { ?>
                          <option value="<?php echo $a ?>"><?php echo $a ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="form-select form-select-lg mb-3" name="edad-mes" id="edad-mes">
                        <option selected>Meses</option>
                        <?php for ($a = 0; $a <= 12; $a++) { ?>
                          <option value="<?php echo $a ?>" ><?php echo $a ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="imagen" class="form-label">Imagen</label>
                  <input type="file" class="form-control" name="imagen" id="imagen">
                </div>
                <div class="mb-3">
                  <label for="raza" class="form-label">Raza</label>
                  <input class="form-control" list="raza" id="exampleDataList" placeholder="Escriba la Raza">
                  <datalist id="raza" name="raza" >
                    <?php foreach ($razas as $raza) { ?>
                      <option value="<?php echo $raza["raza"] ?>"  ><span style="min-width: 500px; color: red"><?php echo $raza["raza"] ?></span></option>
                    <?php } ?>
                  </datalist>
                </div>
                <div class="mb-3">
                  <label for="especie" class="form-label">Especie</label>
                  <select class="form-select form-select-lg mb-3" name="especie" id="especie">
                    <option selected>Seleccione una Especie</option>
                    <?php foreach ($especies as $especie) { ?>
                      <option value="<?php echo $especie["id"] ?>"><?php echo $especie["especie"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="comentario" class="form-label">Comentarios</label>
                  <textarea name="comentario" id="comentario" class="form-control" cols="30" rows="10"></textarea>
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
              <h5 class="modal-title" id="exampleModalLabelA">Agregar Mascota</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div>
                  <input type="hidden" name="id_mas" id="id_mas" value="<?php echo $reg["id_mas"] ?>">
                </div>
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre">
                </div>
                <div class="mb-3">
                  <label for="edad" class="form-label">Edad</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <select class="form-select form-select-lg mb-3" name="edad-anio" id="edad-anio">
                        <option selected>Años</option>
                        <?php for ($a = 0; $a <= 20; $a++) { ?>
                          <option value="<?php echo $a ?>"><?php echo $a ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="form-select form-select-lg mb-3" name="edad-mes" id="edad-mes">
                        <option selected>Meses</option>
                        <?php for ($a = 0; $a <= 12; $a++) { ?>
                          <option value="<?php echo $a ?>"><?php echo $a ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="imagen" class="form-label">Imagen</label>
                  <input type="file" class="form-control" name="imagen" id="imagen">
                </div>
                <div class="mb-3">
                  <label for="raza" class="form-label">Raza</label>
                  <select class="form-select form-select-lg mb-3" name="raza" id="raza">
                    <option selected>Seleccione una raza</option>
                    <?php foreach ($razas as $raza) { ?>
                      <option value="<?php echo $raza["id"] ?>"><?php echo $raza["raza"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="especie" class="form-label">Especie</label>
                  <select class="form-select form-select-lg mb-3" name="especie" id="especie">
                    <option selected>Seleccione una Especie</option>
                    <?php foreach ($especies as $especie) { ?>
                      <option value="<?php echo $especie["id"] ?>"><?php echo $especie["especie"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="comentario" class="form-label">Comentarios</label>
                  <textarea name="comentario" id="comentario" class="form-control" cols="30" rows="10"></textarea>
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
      <!--  -->
    </div>
  </div>