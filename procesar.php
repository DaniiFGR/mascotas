<?php
class Mascotas
{
	public $con;

	public function __construct()
	{
		$this->con = new mysqli("127.0.0.1", "root", "1234", "adopcion");
		if (mysqli_connect_error()) {
			echo ("Existe un error: ".$this->conn->connect_error);
		} else {
			return $this->con;
		}
	}
	##================================================================================================Mostrar mascotas
	public function mostrar()
	{
		$SQL = "SELECT mascota.id as id_mas,nombre,edad,imagen,comentarios,raza,raza.url as url_raza,especie,estado_mas,estado
				  FROM mascota
					JOIN raza on mascota.raza_id = raza.id
					JOIN especie ON mascota.especie_id = especie.id
					JOIN estado_mascota ON mascota.estado_mascota_id = estado_mascota.id
					JOIN estado_elemento ON mascota.estado_elemento_id = estado_elemento.id";
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
		$query = "INSERT INTO usuario(id, identificacion, nombre, apellido, telefono, correo, direccion, rol_id, estado_elemento_id) VALUES('$id','$identificacion','$nombre','$apellido','$telefono','$correo','$direccion','$rol','$estado')";
		$sql = $this->con->query($query);
		if ($sql == true) {
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
									icon: 'warning',
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
		} else {
			echo "Registro fallo";
		}
	}
	public function mostrar_raza()
	{
		$SQL = "SELECT id, raza FROM raza";
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
		$imagen = $this->con->real_escape_string($_POST['imagen']);
		$raza = $this->con->real_escape_string($_POST['raza']);
		$especie = $this->con->real_escape_string($_POST['especie']);
		$comentario = $this->con->real_escape_string($_POST['comentario']);
		$estado_mas = 1;
		$estado_ele = 1;
		$edad = (($_POST['edad-anio']) * 12) + ($_POST['edad-mes']);


		$query = "INSERT INTO mascota(id, nombre, edad, imagen, raza_id, especie_id, estado_mascota_id, Comentarios, estado_elemento_id) VALUES('$id','$nombre','$edad','$imagen','$raza','$especie','$estado_mas','$comentario','$estado_ele')";
		$sql = $this->con->query($query);
		if ($sql == true) {
			echo "<script type='text/javascript'>
						Swal.fire({
							title: 'Correcto',
							text: 'Su solicitud se agrego con exito',
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Correcto'
						}).then((result) => {
								document.location.href = './form-mascotas.php';
						})
						</script>";
		} else {
			echo "Registro fallo";
		}
	}
	public function mostrar_uno($id)
	{
		$SQL = "SELECT mascota.id as id_mas,nombre,edad,imagen,comentarios,raza,raza.url as url_raza,especie,estado_mas,estado
				  FROM mascota
					JOIN raza on mascota.raza_id = raza.id
					JOIN especie ON mascota.especie_id = especie.id
					JOIN estado_mascota ON mascota.estado_mascota_id = estado_mascota.id
					JOIN estado_elemento ON mascota.estado_elemento_id = estado_elemento.id 
					WHERE mascotas.id = $id";
		$result = $this->con->query($SQL);
		if ($result->num_rows >= 0) {
			$row = $result->fetch_assoc();
			echo 1;
		} else {
			echo "Error al realizar consulta:";
		}
	}

	public function actualizar($id)
	{
		$nombre = $this->con->real_escape_string($_POST['nombre']);
		$imagen = $this->con->real_escape_string($_POST['imagen']);
		$raza = $this->con->real_escape_string($_POST['raza']);
		$especie = $this->con->real_escape_string($_POST['especie']);
		$comentario = $this->con->real_escape_string($_POST['comentario']);
		$estado_mas = 1;
		$estado_ele = 1;
		$edad = (($_POST['edad-anio']) * 12) + ($_POST['edad-mes']);
		if (!empty($id) && !empty($postData)) {
			$query = "UPDATE mascotas SET nombre = '$nombre', edad = '$edad', raza = '$raza', especie = '$especie', Comentarios = '$comentario' WHERE id = '$id'";
			$sql = $this->con->query($query);
			if ($sql == true) {
				echo "<script type='text/javascript'>
				Swal.fire(
					'Correcto!',
					'Se actualizo con exito',
					'success'
				)
				</script>";
			} else {
				echo "<script type='text/javascript'>
				Swal.fire(
					'Error!',
					'No se pudo realizar la actualización',
					'error'
				)
				</script>";
			}
		}
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
