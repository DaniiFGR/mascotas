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
if (isset($_POST['update'])) {
  $mascotasObj->actualizar_mas($_POST);
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
            <th>No.</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>edad</th>
            <th>raza</th>
            <th>Más</th>
          </thead>
          <tbody>
            <?php
            $pos = 1;
            foreach ($mascotas as $reg) {
            ?>
              <tr>
                <td><span><?php echo $pos; $pos++; ?></span></td>
                <td id="pos_img<?php echo $reg['id_mas'] ?>"><img src="../images/<?php echo $reg["imagen"] ?>" alt=".." class="img-datatable"></td>
                <td><span id="pos_n<?php echo $reg['id_mas'] ?>"><?php echo $reg["nombre"] ?></span></td>
                <td><span id="pos_e<?php echo $reg['id_mas'] ?>">
                  <?php echo floor(($reg['edad'] / 12))." Años y ".($reg['edad'] % 12)." meses"; ?>
                </span></td>
                <td><span id="pos_r<?php echo $reg['id_mas'] ?>"><a style="color: black;" href="<?php echo $reg["url_raza"] ?>"><i class="bi bi-link-45deg"></i><?php echo $reg["raza"] ?></a></span></td>
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
                    <div class="modal-body" >
                      <span id="pos<?php echo $reg['id_mas'] ?>"><?php echo $reg["comentarios"] ?></span>
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
                  <input class="form-control" list="raza" id="exampleDataList" name="raza" placeholder="Escriba la Raza">
                  <datalist id="raza" name="raza" >
                    <?php foreach ($razas as $raza) { 
                      if($raza['estado_id'] == 1){
                      ?>
                      <option value="<?php echo $raza['raza'] ?>" >
                    <?php }} ?>
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
              <h5 class="modal-title" id="exampleModalLabelA">Actualizar Mascota</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" id="form_actualizar_mas">
                <div class="mb-3">
                  <label for="id_mas" class="form-label">Id</label>
                  <input type="text" class="form-control id_mas" disabled>
                  <input type="hidden" class="form-control id_mas" name="id_mas_act" id="id_mas_act">
                  <input type="hidden" class="form-control estado_id_mas" name="estado_id" id="estado_id">
                </div>

                <div class="mb-3">
                  <label for="nombre_mas_act" class="form-label">Nombre</label>
                  <input type="text" class="form-control nom_mas" name="nombre_mas_act" id="nombre_mas_act" placeholder="Ingrese Nombre">
                </div>
                <div class="mb-3">
                  <label for="edad" class="form-label">Edad</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <label for="edad_anio_mas_act" class="form-label">Años</label>
                      <select class="form-select form-select-lg mb-3" name="edad_anio_mas_act" id="edad_anio_mas_act">
                        <option selected class="e_anio_mas"></option>
                        <?php for ($a = 0; $a <= 20; $a++) { ?>
                          <option value="<?php echo $a ?>"><?php echo $a ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <label for="edad_mes_mas_act" class="form-label">Meses</label>
                      <select class="form-select form-select-lg mb-3" name="edad_mes_mas_act" id="edad_mes_mas_act">
                        <option selected class="e_mes_mas"></option>
                        <?php for ($a = 0; $a <= 12; $a++) { ?>
                          <option value="<?php echo $a ?>"><?php echo $a ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="imagen_mas_act" class="form-label">Imagen</label>
                  <input type="file" class="form-control"  name="imagen_mas_act" id="imagen_mas_act">
                </div>
                
                <div class="mb-3">
                  <label for="raza" class="form-label">Raza</label>
                  <input class="form-control raza_mas" list="raza1" id="raza_mas_act"  name="raza_mas_act" placeholder="Escriba la Raza">
                  <datalist id="raza1" name="raza_mas_act">
                    <?php foreach ($razas as $raza) { 
                      if($raza['estado_id'] == 1){
                    ?>
                      <option value="<?php echo $raza['raza'] ?>" >
                    <?php }} ?>
                  </datalist>
                </div>
                <div class="mb-3">
                  <label for="especie_mas_act" class="form-label">Especie</label>
                  <select class="form-select form-select-lg mb-3" name="especie_mas_act" id="especie_mas_act">
                    <option selected class="especie_mas"></option>
                    <?php foreach ($especies as $especie) { ?>
                      <option value="<?php echo $especie["id"] ?>"><?php echo $especie["especie"] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="comentario_mas_act" class="form-label">Comentarios</label>
                  <textarea name="comentario_mas_act" id="comentario_mas_act" class="cmt_mas form-control" cols="10" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button"  class="btn btn-success btn-update">Enviar</button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
    </div>
  </div>