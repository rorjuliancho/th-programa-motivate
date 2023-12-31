<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Programa_motivate_model');
	}


	public function index()
	{
		$this->load->view('main/header');
		$this->load->view('welcome_message');
		$this->load->view('main/footer');
	}

	public function login()
	{
		$cedula = $this->input->post('cedula');
		$login = $this->Programa_motivate_model->login($cedula);

		if ($login) {
			if ($login[0]->tipoUsuario == "Colaborador") {
				$userLogin = array(
					'logueado' => TRUE,
					'idUser' => $login[0]->idcolaborador,
					'nombre' => $login[0]->nombre,
					'apellido' => $login[0]->apellido,
					'cargo' => $login[0]->cargo,
					'tipoUsuario' => $login[0]->tipoUsuario
				);
				$this->session->set_userdata($userLogin);
				redirect('Welcome/main');
			} else {
				$userLogin = array(
					'logueado' => TRUE,
					'idUser' => $login[0]->idcolaborador,
					'nombre' => $login[0]->nombre,
					'apellido' => $login[0]->apellido,
					'cargo' => $login[0]->cargo,
					'tipoUsuario' => $login[0]->tipoUsuario
				);
				$this->session->set_userdata($userLogin);
				redirect('Welcome/admin');
			}
		}
	}

	public function logout()
	{
		$userLogin = array(
			'logueado' => FALSE,
		);

		$this->session->set_userdata($userLogin);
		redirect('/');
	}

	public function main()
	{

		date_default_timezone_set("America/Bogota");
		$date = date('H');
		$mensajeBienvenida = "";

		$nombres = $this->session->userdata('nombre');
		$primerNombre = explode(" ", $nombres);
		$nombre = $primerNombre[0];

		if ($date >= "00" && $date <= "11") {
			$mensajeBienvenida = "Buenos días";
		} elseif ($date >= "12" && $date <= "18") {
			$mensajeBienvenida = "Buenas tardes";
		} else {
			$mensajeBienvenida = "Buenas noches";
		}

		$result['mensajeBienvenida'] = $mensajeBienvenida;
		$result['nombre'] = $nombre;


		$userID = $this->session->userdata('idUser');
		$result['actividades'] = $this->Programa_motivate_model->actividades();
		$result['top'] = $this->Programa_motivate_model->top();

		$result['puntuacion'] = $this->Programa_motivate_model->puntosColaborador($userID);
		$result['puntosColaborador'] = $this->Programa_motivate_model->puntosActividadColaborador($userID);

		$this->load->view('main/header', $result);
		$this->load->view('main', $result);
		$this->load->view('main/footer');
	}

	public function activity($id)
	{
		date_default_timezone_set("America/Bogota");
		$date = date('H');
		$mensajeBienvenida = "";

		$nombres = $this->session->userdata('nombre');
		$primerNombre = explode(" ", $nombres);
		$nombre = $primerNombre[0];

		if ($date >= "00" && $date <= "11") {
			$mensajeBienvenida = "Buenos días";
		} elseif ($date >= "12" && $date <= "18") {
			$mensajeBienvenida = "Buenas tardes";
		} else {
			$mensajeBienvenida = "Buenas noches";
		}

		$result['mensajeBienvenida'] = $mensajeBienvenida;
		$result['nombre'] = $nombre;
		$userID = $this->session->userdata('idUser');
		$result['detalleActividad'] = $this->Programa_motivate_model->actividadesColaborador($userID, $id);
		$result['nombreActividad'] = $this->Programa_motivate_model->nombreActividad($id);

		$this->load->view('main/header', $result);
		$this->load->view('activity', $result);
		$this->load->view('main/footer');
	}

	public function insertarActividadesUsuario()
	{
		for ($id = 120; $id <= 121; $id++) {
			for ($i = 1; $i <= 12; $i++) {
				$search = $this->Programa_motivate_model->validacionActividades($id, $i);
				if ($search == false) {
					$data = array(
						'puntos' => 0,
						'fechaCreacion' => '0000-00-00 00:00:00',
						'idColaborador' => $id,
						'idActividad' => $i
					);
					$this->Programa_motivate_model->insertarActividades($id, $data);
				}
			}
			echo ("vamos en el: " . $id);
		}
	}

	public function admin()
	{
		date_default_timezone_set("America/Bogota");
		$date = date('H');
		$mensajeBienvenida = "";

		$nombres = $this->session->userdata('nombre');
		$primerNombre = explode(" ", $nombres);
		$nombre = $primerNombre[0];

		if ($date >= "00" && $date <= "11") {
			$mensajeBienvenida = "Buenos días";
		} elseif ($date >= "12" && $date <= "18") {
			$mensajeBienvenida = "Buenas tardes";
		} else {
			$mensajeBienvenida = "Buenas noches";
		}
		$result['mensajeBienvenida'] = $mensajeBienvenida;
		$result['nombre'] = $nombre;

		$result['todosColaboradores'] = $this->Programa_motivate_model->traerColaboradores();
		$result['todasEmpresas'] = $this->Programa_motivate_model->traerEmpresas();



		$this->load->view("main/header", $result);
		$this->load->view("admin", $result);
		$this->load->view("main/footer");
	}

	public function guardar_colaborador()
	{
		date_default_timezone_set("America/Bogota");
		$date = date('Y-m-d H:i:s');
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'apellido' => $this->input->post('apellido'),
			'cedula' => $this->input->post('cedula'),
			'fechaIngreso' => $this->input->post('fechaIngreso'),
			'correoElectronico' => $this->input->post('correoElectronico'),
			'id_empresa' => $this->input->post('id_empresa'),
			'cargo' => $this->input->post('cargo'),
			'tipoUsuario' => $this->input->post('tipoUsuario'),
			'estado' => 1
		);

		$this->Programa_motivate_model->insertar_colaborador($data);

		$last_id = $this->Programa_motivate_model->last_id();
		$cantActividades = $this->Programa_motivate_model->cantidadActividades();

		for ($i = 1; $i <= $cantActividades[0]->cantidad_actividades; $i++) {
			$dataPuntos = array(
				'puntos' => 0,
				'fechaCreacion' => $date,
				'idColaborador' => $last_id[0]->idcolaborador,
				'idActividad' => $i,
				'estado' => 0
			);
			$this->Programa_motivate_model->insertarPuntosNuevoColaborador($dataPuntos);
		}




		$this->admin();
	}

	public function Actividades()
	{
		date_default_timezone_set("America/Bogota");
		$date = date('H');
		$mensajeBienvenida = "";

		$nombres = $this->session->userdata('nombre');
		$primerNombre = explode(" ", $nombres);
		$nombre = $primerNombre[0];

		if ($date >= "00" && $date <= "11") {
			$mensajeBienvenida = "Buenos días";
		} elseif ($date >= "12" && $date <= "18") {
			$mensajeBienvenida = "Buenas tardes";
		} else {
			$mensajeBienvenida = "Buenas noches";
		}
		$result['mensajeBienvenida'] = $mensajeBienvenida;
		$result['nombre'] = $nombre;
		$result['todasActividades'] = $this->Programa_motivate_model->actividades();
		// $result['detalleActividad'] = $this->Programa_motivate_model->detallesEditar($id);


		$this->load->view("main/header", $result);
		$this->load->view('actividades', $result);
		$this->load->view('main/footer');
	}

	public function guardar_actividad()
	{
		$a = $_FILES['imagen']['name'];
		$config['upload_path'] = './public/images/actividades/';
		$config['allowed_types'] = 'png'; // Tipos de archivos permitidos
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('imagen')) {
			$error = $this->upload->display_errors();
			echo "Error al cargar la imagen: $error";
		} else {
			$imagen_data = $this->upload->data();
			$imagen_nombre = $imagen_data['file_name'];
			// $this->redimensionarImagen($a);

			$config['upload_path'] = './public/images/qr/';
			$config['allowed_types'] = 'png'; // Tipos de archivos permitidos

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('qr')) {
				$error = $this->upload->display_errors();
				echo "Error al cargar el código QR: $error";
			} else {
				$qr_data = $this->upload->data();
				$qr_nombre = $qr_data['file_name'];
				// $this->redimensionarQR($qr_nombre);
				$data = array(
					'nombre' => $this->input->post('nombre'),
					'imagen' => $imagen_nombre,
					'descripcion' => $this->input->post('descripcion'),
					'qr' => $qr_nombre,
					'mensajeQr' => $this->input->post('mensajeQr'),
				);
				$this->Programa_motivate_model->guardar_actividades($data);
				redirect('welcome/actividades');
			}
		}
	}

	public function redimensionarImagen($nombre_imagen)
	{

		// Ruta al archivo de imagen original
		$imagenOriginal = './public/images/actividades/' . $nombre_imagen;
		var_dump($imagenOriginal);
		exit;

		// Cargar la imagen original
		$imagen = imagecreatefrompng($imagenOriginal);

		// Nuevas dimensiones deseadas
		$nuevoAncho = 65; // Nuevo ancho en píxeles
		$nuevoAlto = 65;  // Nuevo alto en píxeles

		// Crear una nueva imagen con las dimensiones deseadas
		$nuevaImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
		imagecopyresampled($nuevaImagen, $imagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, imagesx($imagen), imagesy($imagen));

		// Ruta donde se guardará la nueva imagen redimensionada
		$rutaNuevaImagen = './public/images/actividades/' . $nombre_imagen;

		// Guardar la nueva imagen en el servidor
		imagejpeg($nuevaImagen, $rutaNuevaImagen);

		// Liberar la memoria
		imagedestroy($imagen);
		imagedestroy($nuevaImagen);

		echo 'La imagen se ha redimensionado con éxito.';
	}

	public function redimensionarQR($nombre_imagen)
	{

		// Ruta al archivo de imagen original
		$imagenOriginal = './public/images/qr/' . $nombre_imagen;

		// Cargar la imagen original
		$imagen = imagecreatefrompng($imagenOriginal);

		// Nuevas dimensiones deseadas
		$nuevoAncho = 200; // Nuevo ancho en píxeles
		$nuevoAlto = 200;  // Nuevo alto en píxeles

		// Crear una nueva imagen con las dimensiones deseadas
		$nuevaImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
		imagecopyresampled($nuevaImagen, $imagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, imagesx($imagen), imagesy($imagen));

		// Ruta donde se guardará la nueva imagen redimensionada
		$rutaNuevaImagen = './public/images/qr/' . $nombre_imagen;

		// Guardar la nueva imagen en el servidor
		imagejpeg($nuevaImagen, $rutaNuevaImagen);

		// Liberar la memoria
		imagedestroy($imagen);
		imagedestroy($nuevaImagen);

		echo 'La imagen se ha redimensionado con éxito.';
	}

	public function editarActividades($id)
	{
		$result['mensajeBienvenida'] = $this->horarioUsuario();
		$result['nombre'] = $this->informacionUsuario();
		$result['detalleActividad'] = $this->Programa_motivate_model->detallesEditar($id);

		$this->load->view("main/header", $result);
		$this->load->view('editarActividades', $result);
		$this->load->view('main/footer');
	}

	public function horarioUsuario()
	{
		date_default_timezone_set("America/Bogota");
		$date = date('H');

		if ($date >= "00" && $date <= "11") {
			$mensajeBienvenida = "Buenos días";
		} elseif ($date >= "12" && $date <= "18") {
			$mensajeBienvenida = "Buenas tardes";
		} else {
			$mensajeBienvenida = "Buenas noches";
		}
		return $mensajeBienvenida;
	}

	public function informacionUsuario()
	{
		$nombres = $this->session->userdata('nombre');
		$primerNombre = explode(" ", $nombres);
		$nombre = $primerNombre[0];

		return $nombre;
	}

	public function cambiosActividad()
	{
		date_default_timezone_set("America/Bogota");
		$date = date('Y-m-d H:i:s');
		$idActividad = $this->input->post('idActividad');
		$nombreActividad = $this->input->post('nombreActividad');
		$iconoActividad = $_FILES['imagen']['name'];
		$descripcion = $this->input->post('descripcion');
		$qr = $_FILES['qr']['name'];
		$mensajeQr = $this->input->post('mensajeQr');

		if (empty($iconoActividad) || empty($qr)) {
			$data = array(
				'nombre' => $nombreActividad,
				'fechaCreacion' => $date,
				'descripcion' => $descripcion,
				'mensajeQr' => $mensajeQr,
			);
			$this->Programa_motivate_model->actualizarActividad($data, $idActividad);
			redirect('welcome/actividades');
		} else {
			$a = $_FILES['imagen']['name'];
			$config['upload_path'] = './public/images/actividades/';
			$config['allowed_types'] = 'png'; // Tipos de archivos permitidos
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('imagen')) {

				$error = $this->upload->display_errors();
				echo "Error al cargar la imagen: $error";
			} else {

				$imagen_data = $this->upload->data();
				$imagen_nombre = $imagen_data['file_name'];
				// $this->redimensionarImagen($a);
				// exit;

				$config['upload_path'] = './public/images/qr/';
				$config['allowed_types'] = 'png'; // Tipos de archivos permitidos

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('qr')) {
					$error = $this->upload->display_errors();
					echo "Error al cargar el código QR: $error";
				} else {
					$qr_data = $this->upload->data();
					$qr_nombre = $qr_data['file_name'];
					// $this->redimensionarQR($qr_nombre);
					$data = array(
						'nombre' => $this->input->post('nombreActividad'),
						'imagen' => $imagen_nombre,
						'descripcion' => $this->input->post('descripcion'),
						'qr' => $qr_nombre,
						'mensajeQr' => $this->input->post('mensajeQr'),
					);
					$this->Programa_motivate_model->actualizarActividad($data, $idActividad);
				}
			}

			redirect('welcome/actividades');
		}
	}

	public function viewColaborador($id)
	{

		$result['mensajeBienvenida'] = $this->horarioUsuario();
		$result['nombre'] = $this->informacionUsuario();
		$result['traerColaboradores'] = $this->Programa_motivate_model->traerColaboradoresById($id);
		$result['puntajeColaborador'] = $this->Programa_motivate_model->puntosActividadColaborador($id);

		$this->load->view('main/header', $result);
		$this->load->view('viewColaborador', $result);
		$this->load->view('main/footer');
	}

	public function editColaborador($id)
	{
		$result['mensajeBienvenida'] = $this->horarioUsuario();
		$result['nombre'] = $this->informacionUsuario();
		$result['empresa'] = $this->Programa_motivate_model->traerEmpresas();
		$result['traerColaboradores'] = $this->Programa_motivate_model->traerColaboradoresById($id);
		$result['puntajeColaborador'] = $this->Programa_motivate_model->puntosActividadColaborador($id);

		$this->load->view('main/header', $result);
		$this->load->view('editColaborador', $result);
		$this->load->view('main/footer');
	}

	public function actualizarColaborador()
	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido');
		$cedula = $this->input->post('cedula');
		$fechaIngreso = $this->input->post('fechaIngreso');
		$email = $this->input->post('email');
		$cargo = $this->input->post('cargo');
		$empresa = $this->input->post('empresa');

		$data = array(
			'nombre' => $nombre,
			'apellido' => $apellido,
			'cedula' => $cedula,
			'fechaIngreso' => $fechaIngreso,
			'correoElectronico' => $email,
			'cargo' => $cargo,
			'id_empresa' => $empresa,
		);

		$this->Programa_motivate_model->actualizarColaborador($data, $id);
		return ('Welcome/editColaborador/' . $id);
	}

	public function deleteColaborador($id)
	{
		$this->Programa_motivate_model->deleteColaborador($id);
		redirect('Welcome/admin');
	}

	public function cambiarEstadoActividad($estado)
	{
		$this->Programa_motivate_model->eliminarActividad($estado, 0);
		redirect('Welcome/actividades');
	}

	public function guardar_datos()
	{
		if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
			$config['upload_path'] = './public/images/actividades/';
			$config['allowed_types'] = 'xls|xlsx';
			$fecha_actual = time();
			$config['file_name'] = $fecha_actual . '.xlsx';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file')) {
				$excelFile = './public/images/actividades/' . $fecha_actual . '.xlsx';
				$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFile);

				$worksheet = $spreadsheet->getActiveSheet();
				$data = $worksheet->toArray();
				$datos_json = json_encode($data);
				$dataD = json_decode($datos_json, true);

				try {
					for ($i = 0; $i < count($dataD); $i++) {

						if ($dataD[$i][1] != "nombre" || $dataD[$i][2] != "apellido" || $dataD[$i][3] != "cedula" || $dataD[$i][4] != "fechaIngreso" || $dataD[$i][5] != "correoElectronico" || $dataD[$i][6] != "cargo" || $dataD[$i][7] != "id_empresa" || $dataD[$i][8] != "tipoUsuario") {
							$data = array(
								'nombre' => $dataD[$i][1],
								'apellido' => $dataD[$i][2],
								'cedula' => $dataD[$i][3],
								'fechaIngreso' => $dataD[$i][4],
								'correoElectronico' => $dataD[$i][5],
								'cargo' => $dataD[$i][6],
								'id_empresa' => $dataD[$i][7],
								'tipoUsuario' => $dataD[$i][8],
							);
							$this->Programa_motivate_model->insertar_colaborador($data);
						}
					}
					unset($spreadsheet);
					if (file_exists($excelFile)) {
						unlink($excelFile);
					} else echo 'Error eliminado el archivo.';
				} catch (\Throwable $th) {
					echo 'Error al subir las datos.';
				}
			} else {
				echo 'Error al subir el archivo.';
			}
		} else {
			echo 'Por favor, seleccione un archivo Excel.';
		}

		redirect('welcome/admin');
	}

	public function agregarPuntajeColaborador()
	{
		date_default_timezone_set("America/Bogota");
		$date = date('Y-m-d H:i:s');

		$idColaborador = $this->input->post('idColaborador');
		$idActividad = $this->input->post('idCActividad');

		$nombreActividad = $this->input->post('nombraActividad');
		$puntaje = $this->input->post('puntajeActividad');
		$Observaciones = $this->input->post('observacionesActividad');

		$data = array(
			'puntos' => $puntaje,
			'fechaCreacion' => $date,
			'idColaborador' => $idColaborador,
			'idActividad' => $idActividad,
			'observaciones' => $Observaciones,
			'nombreActividad' => $nombreActividad
		);

		$this->Programa_motivate_model->insertPuntajeColaborador($data);

		redirect('Welcome/editColaborador/' . $idColaborador);
	}

	public function editarActividad($idColaborador, $idActividad)
	{
		$result['mensajeBienvenida'] = $this->horarioUsuario();
		$result['nombre'] = $this->informacionUsuario();

		$result['actividadColaborador'] = $this->Programa_motivate_model->actividadColaborador($idColaborador, $idActividad);

		$this->load->view('main/header', $result);
		$this->load->view('editarActividad');
		$this->load->view('main/footer');
	}

	public function updateActividadColaborador()
	{
		$idPuntos = $this->input->post('idPuntuacion');

		$nombraActividad = $this->input->post('nombraActividad');
		$puntajeActividad = $this->input->post('puntajeActividad');
		$observacionesActividad = $this->input->post('observacionesActividad');


		$data = array(
			'puntos' => $puntajeActividad,
			'nombreActividad' => $nombraActividad,
			'observaciones' => $observacionesActividad,
		);

		$this->Programa_motivate_model->updatePuntosColaborador($data, $idPuntos);

		redirect('');
	}
}
