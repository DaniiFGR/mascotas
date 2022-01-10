<?php
class Mascotas
{
	public $con;

	public function __construct()
	{
		$this->con = new mysqli("127.0.0.1", "root", "", "adopcion");
		if (mysqli_connect_error()) {
			echo ("Existe un error: " . $this->conn->connect_error);
		} else {
			return $this->con;
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////Imagenes
	public function sub_imagenes()
	{
		if (isset($_FILES['foto']['name'])) {
			$tipoArchivo = $_FILES['foto']['type'];
			$nombreArchivo = $_FILES['foto']['name'];
			$tamanoArchivo = $_FILES['foto']['size'];
			$imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
			$binariosImagen = fread($imagenSubida, $tamanoArchivo);
			// $binariosImagen = $this->con->escape_string($binariosImagen);
			$binariosImagen = mysqli_escape_string($this->con, $binariosImagen);

			$query = "INSERT INTO imagenes (nombre, imagen, tipo) VALUES('$nombreArchivo','$binariosImagen','$tipoArchivo')";
			$result = $this->con->query($query);
			if ($result) {
				echo "Correcto";
			} else {
				echo mysqli_error($this->con);
			}
		}
	}
	//////////////////////////////////////////////////////////////////////////
	public function mostrar_img()
	{
		$SQL = "SELECT nombre, imagen, tipo FROM imagenes";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Error al realizar consulta:";
		}
	}
	public function mostrar_una_img($id)
	{
		$query = "SELECT imagen, tipo FROM imagenes WHERE id = '$id'";
		$result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		} else {
			echo "error: " . mysqli_error($this->con);;
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////Contador
	public function contar()
	{
		$SQL = "SELECT count(solicitud.id) as num, mascota_id FROM adopcion.solicitud GROUP BY mascota_id;";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Error al realizar consulta:";
		}
	}

	##================================================================================================Mostrar mascotas
	public function mostrar()
	{
		$SQL = "SELECT mascota.id as id_mas,mascota.nombre,edad,imagen,imagen_id,tipo,comentarios,raza,raza.url as url_raza,especie,estado_mas,estado
				  FROM mascota
					JOIN raza on mascota.raza_id = raza.id
					JOIN especie ON mascota.especie_id = especie.id
					JOIN estado_mascota ON mascota.estado_mascota_id = estado_mascota.id
					JOIN estado_elemento ON mascota.estado_elemento_id = estado_elemento.id
					JOIN imagenes ON mascota.imagen_id = imagenes.id
					ORDER BY id_mas";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Error al realizar consulta:";
		}
	}
	##==================================================================================================Mostrar Usuarios
	public function mostrar_usu()
	{
		$SQL = "SELECT usuario.id as id_usu,identificacion,nombre,apellido,telefono,correo,direccion,rol,estado
				  FROM usuario
					JOIN rol on usuario.rol_id = rol.id
					JOIN estado_elemento ON usuario.estado_elemento_id = estado_elemento.id";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Error al realizar consulta:";
		}
	}
	##======================================================================================================Insertar Usuarios
	public function insertar_usu()
	{
		$id = $this->con->real_escape_string($_POST['id']);
		if ($id == '') {
			$id = 1;
		} else {
			$id += 1;
		}
		$id_soli = 0;
		$fecha = date('Y-m-d');
		$estado_sol = 0;
		$id_mas = $this->con->real_escape_string($_POST['id_mas']);
		$identificacion = $this->con->real_escape_string($_POST['identificacion']);
		$nombre = $this->con->real_escape_string($_POST['nombre']);
		$apellido = $this->con->real_escape_string($_POST['apellido']);
		$telefono = $this->con->real_escape_string($_POST['telefono']);
		$correo = $this->con->real_escape_string($_POST['correo']);
		$direccion = $this->con->real_escape_string($_POST['direccion']);
		$rol = 1;
		$estado = 1;

		$bandera = 0;
		$verdad = 0;
		$SQL = "SELECT identificacion, id FROM usuario";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			while ($row = $result->fetch_assoc()) {
				if ($identificacion == $row['identificacion']) {
					$bandera = 1;
					$data = $row['id'];
				}
			}
		} else {
			echo "Error al realizar consulta:";
		}
		echo $data;
		if ($bandera == 0) {
			$query = "INSERT INTO usuario(id, identificacion, nombre, apellido, telefono, correo, direccion, rol_id, estado_elemento_id) VALUES('$id','$identificacion','$nombre','$apellido','$telefono','$correo','$direccion','$rol','$estado')";
			$sql = $this->con->query($query);
			if ($sql == true) {
				$verdad = 1;
			} else {
				echo "Registro fallo";
			}
		} else {
			$id = $data;
		}
		$query = "SELECT id as id_sol FROM solicitud order by id_sol desc limit 1";
		$result = $this->con->query($query);
		if ($result->num_rows >= 0) {
			$row = $result->fetch_assoc();
			if ($row['id_sol'] == '') {
				$id_soli = 1;
			} else {
				$id_soli = $row['id_sol'] + 1;
			}
			$query = "INSERT INTO solicitud(id, fecha, estado_solicitud_id, mascota_id, usuario_id) VALUES ('$id_soli','$fecha','$estado_sol','$id_mas','$id')";
			$sql = $this->con->query($query);
			if ($sql == true) {
				echo "<script type='text/javascript'>
							Swal.fire({
								title: 'Correcto',
								text: 'Su solicitud se agrego con exito',
								icon: 'success',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Correcto'
							}).then((result) => {
									document.location.href = '../index.php';
							})
							</script>";
			} else {
				echo "Registro fallo solicitud";
			}
		} else {
			echo "No encontrado";
		}
	}
	public function mostrar_raza()
	{
		$SQL = "SELECT raza.id, raza, raza.url as url_raza, estado_id, estado FROM raza
		JOIN estado_elemento ON estado_id = estado_elemento.id";

		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Error al realizar consulta:";
		}
	}
	public function insertar_raza()
	{
		$id = $this->con->real_escape_string($_POST['id_raza']);
		if ($id == '') {
			$id = 1;
		} else {
			$id += 1;
		}
		$nombre = $this->con->real_escape_string($_POST['nombre_raza']);
		$url = $this->con->real_escape_string($_POST['url_raza']);
		$estado = 1;
		$bandera = 0;
		$SQL = "SELECT raza FROM raza where raza like '$nombre'";
		$result = $this->con->query($SQL);
		if ($result->num_rows > 0) {
			$bandera = 1;
		} else {
			echo "Error al realizar consulta:";
		}
		if ($bandera == 0) {
			$query = "INSERT INTO raza(id, raza, url, estado_id) VALUES('$id','$nombre','$url','$estado')";
			$sql = $this->con->query($query);
			if ($sql == true) {
				echo "<script type='text/javascript'>
							Swal.fire({
								title: 'Correcto',
								text: 'Su solicitud se agrego con exito',
								icon: 'success',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Correcto'
							}).then((result) => {
									document.location.href = './form-raza.php';
							})
							</script>";
			} else {
				echo "<script type='text/javascript'>
				Swal.fire({
					title: 'Error',
					text: 'Su solicitud falló',
					icon: 'error',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Correcto'
				}).then((result) => {
						document.location.href = './form-raza.php';
				})
				</script>";
			}
		} else {
			echo "<script type='text/javascript'>
				Swal.fire({
					title: 'Error',
					text: 'La raza ya se encuentra registrada',
					icon: 'error',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Correcto'
				}).then((result) => {
						document.location.href = './form-raza.php';
				})
				</script>";
		}
	}
	/////////////////////////////////////////////////////////////////////Eliminar Raza
	public function eliminar_raza($id)
	{
		$query = "SELECT * FROM raza WHERE id = $id";
		$result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$estado = $row['estado_id'];
			if ($estado == 1) {
				$actualizar = "UPDATE raza SET estado_id=0 WHERE id = $id";
				$sql = $this->con->query($actualizar);
				if ($sql == true) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				$actualizar = "UPDATE raza SET estado_id=1 WHERE id = $id";
				$sql = $this->con->query($actualizar);
				if ($sql == true) {
					echo 2;
				} else {
					echo 0;
				}
			}
		} else {
			echo 0;
		}
	}
	////////////////////////////////////////////////////////////////////////Mostra una raza
	public function mostrar_uno_raza($id)
	{
		$SQL = "SELECT id, raza, raza.url as url_raza
				  	FROM raza WHERE id = $id";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$row = $result->fetch_assoc();
			echo json_encode($row);
		} else {
			echo "Error al realizar consulta:";
		}
	}
	////////////////////////////////////////////////////////////////////////Actualizar raza
	public function actualizar_raza($postData)
	{
		$id = $this->con->real_escape_string($postData['id_raza']);
		$nombre = $this->con->real_escape_string($postData['nombre_raza']);
		$url = $this->con->real_escape_string($postData['url_raza']);

		$band = 0;
		$SQL = "SELECT raza FROM raza where raza like '$nombre'";
		$result = $this->con->query($SQL);
		if ($result->num_rows > 0) {
			$band = 1;
		}
		if ($band == 0) {
			if (!empty($id) && !empty($postData)) {
				$query = "UPDATE raza SET raza = '$nombre', url = '$url' WHERE id = '$id'";
				$sql = $this->con->query($query);
				if ($sql == true) {
					$SQL = "SELECT raza, url FROM raza WHERE id = $id";
					$result = $this->con->query($SQL);
					if ($result->num_rows >= 0) {
						$row = $result->fetch_assoc();
						echo json_encode($row);
					} else {
						echo "Error al realizar consulta:";
					}
				} else {
					echo "no";
				}
			}
		} else {
			echo "error";
		}
	}
	////////////////////////////////////////////////////////////////////////Mostrar especie
	public function mostrar_esp()
	{
		$SQL = "SELECT id, especie FROM especie";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "Error al realizar consulta:";
		}
	}
	public function insertar_mas()
	{
		$id = $this->con->real_escape_string($_POST['id_mas']);
		if ($id == '') {
			$id = 1;
		} else {
			$id += 1;
		}
		$nombre = $this->con->real_escape_string($_POST['nombre']);
		$raza = $this->con->real_escape_string($_POST['raza']);
		$especie = $this->con->real_escape_string($_POST['especie']);
		$comentario = $this->con->real_escape_string($_POST['comentario']);
		$estado_mas = 1;
		$estado_ele = 1;
		$edad = (($_POST['edad-anio']) * 12) + ($_POST['edad-mes']);
		$imagen = 0;
		////////////////////////////////////////////////////////////
		$SQL = "SELECT id, raza FROM raza";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				if ($row['raza'] == $raza) {
					$raza_mas = $row['id'];
				}
			}
		} else {
			echo "Error al realizar consulta:";
		}
		////////////////////////////////////////////////////////////
		if (isset($_FILES['foto']['name'])) {
			$tipoArchivo = $_FILES['foto']['type'];
			$nombreArchivo = $_FILES['foto']['name'];
			$tamanoArchivo = $_FILES['foto']['size'];
			$imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
			$binariosImagen = fread($imagenSubida, $tamanoArchivo);
			// $binariosImagen = $this->con->escape_string($binariosImagen);
			$binariosImagen = mysqli_escape_string($this->con, $binariosImagen);
			$nombreArchivo = "img_" . $id;
			$query = "INSERT INTO imagenes (nombre, imagen, tipo) VALUES('$nombreArchivo','$binariosImagen','$tipoArchivo')";
			$result = $this->con->query($query);
			if ($result) {
				$val = 'Correcto imagen';
				$query = "SELECT id FROM imagenes WHERE nombre = '$nombreArchivo'";
				$result = $this->con->query($query);
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$imagen = $row['id'];
					////////////////////////////////////////////////////////////
					$query = "INSERT INTO mascota(id, nombre, edad, imagen_id, raza_id, especie_id, estado_mascota_id, Comentarios, estado_elemento_id) VALUES('$id','$nombre','$edad','$imagen','$raza_mas','$especie','$estado_mas','$comentario','$estado_ele')";
					$sql = $this->con->query($query);
					if ($sql == true) {
						echo "<script type='text/javascript'>
									Swal.fire({
										title: 'Correcto',
										text: 'Su solicitud se agrego con exito',
										icon: 'Success',
										showCancelButton: true,
										confirmButtonColor: '#3085d6',
										cancelButtonColor: '#d33',
										confirmButtonText: 'Correcto'
									}).then((result) => {
											document.location.href = './form-mascotas.php';
									})
									</script>";
					} else {
						echo "Registro fallo: " . $imagen . ' Error:' . mysqli_error($this->con);
					}
				} else {
					echo "error: " . mysqli_error($this->con);;
				}
			} else {
				echo mysqli_error($this->con);
			}
		}
	}
	public function mostrar_uno($id)
	{
		$SQL = "SELECT mascota.id as id_mas,mascota.nombre,edad,imagen_id,comentarios,raza,raza.url as url_raza,especie,estado_mas,estado_mascota_id,mascota.estado_elemento_id,estado,especie_id,raza_id
				  FROM mascota
					JOIN raza on mascota.raza_id = raza.id
					JOIN especie ON mascota.especie_id = especie.id
					JOIN estado_mascota ON mascota.estado_mascota_id = estado_mascota.id
					JOIN estado_elemento ON mascota.estado_elemento_id = estado_elemento.id
					JOIN imagenes ON mascota.imagen_id = imagenes.id
					WHERE mascota.id = $id";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$row = $result->fetch_assoc();
			echo json_encode($row);
		} else {
			echo "Error al realizar consulta:";
		}
	}

	public function actualizar_mas($postData)
	{
		$id = $this->con->real_escape_string($_POST['id_mas_act']);
		$nombre = $this->con->real_escape_string($_POST['nombre_mas_act']);
		$imagen = $this->con->real_escape_string($_POST['imagen_mas_act']);
		$raza = $this->con->real_escape_string($_POST['raza_mas_act']);
		$especie = $this->con->real_escape_string($_POST['especie_mas_act']);
		$comentario = $this->con->real_escape_string($_POST['comentario_mas_act']);
		$estado_mas = 1;
		$estado_ele = $this->con->real_escape_string($_POST['estado_id']);
		////////////////////////////////////////////////////////////
		$SQL = "SELECT imagen_id FROM mascota WHERE mascota.id = $id";
		$result = $this->con->query($SQL);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
		}else{
			echo "no encontro imagen: ".mysqli_error($this->con);
		}
		$id_img = $row['imagen_id'];
		if (($_FILES['imagen_mas_act']['name']) == '') {
			$imagen = $id_img;
		} else {
			if (isset($_FILES['imagen_mas_act']['name'])) {
				$tipoArchivo = $_FILES['imagen_mas_act']['type'];
				$nombreArchivo = $_FILES['imagen_mas_act']['name'];
				$tamanoArchivo = $_FILES['imagen_mas_act']['size'];
				$imagenSubida = fopen($_FILES['imagen_mas_act']['tmp_name'], 'r');
				$binariosImagen = fread($imagenSubida, $tamanoArchivo);
				// $binariosImagen = $this->con->escape_string($binariosImagen);
				$binariosImagen = mysqli_escape_string($this->con, $binariosImagen);
				$nombreArchivo = "img_act" . $id;
				$query = "INSERT INTO imagenes (nombre, imagen, tipo) VALUES('$nombreArchivo','$binariosImagen','$tipoArchivo')";
				$result = $this->con->query($query);
				if ($result) {
					$SQL = "SELECT id FROM imagenes WHERE nombre = '$nombreArchivo' ORDER BY id DESC LIMIT 1";
					$result = $this->con->query($SQL);
					if ($result->num_rows > 0) {
						$img = $result->fetch_assoc();
						$imagen = $img['id'];
					}else{
						echo "no encontro id de img: ".mysqli_error($this->con);
					}
				}else{
					echo "No Actualizo imagen: ".mysqli_error($this->con);
				}
			}
		}
		$SQL = "SELECT id, raza FROM raza";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$data = array();
			while ($row = $result->fetch_assoc()) {
				if ($row['raza'] == $raza) {
					$raza_mas = $row['id'];
				}
			}
		} else {
			echo "Error al realizar consulta:";
		}
		$edad = (($_POST['edad_anio_mas_act']) * 12) + ($_POST['edad_mes_mas_act']);
		if (!empty($id) && !empty($postData)) {
			$query = "UPDATE mascota SET nombre = '$nombre', edad = '$edad', imagen_id = '$imagen', raza_id = '$raza_mas', especie_id = '$especie', Comentarios = '$comentario' WHERE id = '$id'";
			$sql = $this->con->query($query);
			if ($sql == true) {
				echo "<script type='text/javascript'>
									Swal.fire({
										title: 'Correcto',
										text: 'Se actualizo con exito',
										icon: 'Success',
										showCancelButton: true,
										confirmButtonColor: '#3085d6',
										cancelButtonColor: '#d33',
										confirmButtonText: 'Correcto'
									}).then((result) => {
											document.location.href = './form-mascotas.php';
									})
									</script>";
			} else {
				echo "no se actualizo mascota: ".mysqli_error($this->con);;
			}
		}
		echo "finalizo";
	}

	public function eliminar($id)
	{
		$query = "SELECT * FROM mascota WHERE id = $id";
		$result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$estado = $row['estado_elemento_id'];
			if ($estado == 1) {
				$actualizar = "UPDATE mascota SET estado_elemento_id=0 WHERE id = $id";
				$sql = $this->con->query($actualizar);
				if ($sql == true) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				$actualizar = "UPDATE mascota SET estado_elemento_id=1 WHERE id = $id";
				$sql = $this->con->query($actualizar);
				if ($sql == true) {
					echo 2;
				} else {
					echo 0;
				}
			}
		} else {
			echo 0;
		}
	}
}
$mascotasObj = new Mascotas();
if (isset($_POST['elim'])) {
	$mascotasObj->eliminar($_POST['elim']);
}

if (isset($_POST['actu'])) {
	$mascotasObj->mostrar_uno($_POST['actu']);
}
if (isset($_POST['cadena'])) {
	$mascotasObj->actualizar_mas($_POST);
}
//////////////////////////////////Raza
if (isset($_POST['elim_raza'])) {
	$mascotasObj->eliminar_raza($_POST['elim_raza']);
}
if (isset($_POST['actu_raza'])) {
	$mascotasObj->mostrar_uno_raza($_POST['actu_raza']);
}
if (isset($_POST['updt_raza'])) {
	$mascotasObj->actualizar_raza($_POST);
}
