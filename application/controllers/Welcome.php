<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
			}
			else {
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
			echo("vamos en el: ". $id);
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

		$result['todosColaboradores']=$this->Programa_motivate_model->traerColaboradores();
		$result['todasEmpresas']=$this->Programa_motivate_model->traerEmpresas();


		
		$this->load->view("main/header",$result);
		$this->load->view("admin",$result);
		$this->load->view("main/footer");

	}

	public function guardar_colaborador()
	{
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'cedula' => $this->input->post('cedula'),
            'fechaIngreso' => $this->input->post('fechaIngreso'),
            'correoElectronico' => $this->input->post('correoElectronico'),
            'id_empresa' => $this->input->post('id_empresa'),
            'tipoUsuario' => $this->input->post('tipoUsuario'),
        );

        // Llama al método del modelo para realizar la inserción
        $this->Programa_motivate_model->insertar_colaborador($data);
		
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
		$result['todasActividades']=$this->Programa_motivate_model->actividades();

		$this->load->view("main/header",$result);
		$this->load->view('actividades',$result);
		$this->load->view('main/footer');
	}

	public function guardar_actividad()
	{
		$config['upload_path'] = './public/images/actividades/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png'; // Tipos de archivos permitidos
		$config['max_size'] = 2048; // Tamaño máximo en kilobytes (2MB)
	
		$this->load->library('upload', $config);
	
		if (!$this->upload->do_upload('imagen')) {

			$error = $this->upload->display_errors();
			echo "Error al cargar la imagen: $error";
		} else {

			$imagen_data = $this->upload->data();
			$imagen_nombre = $imagen_data['file_name'];
	
			$config['upload_path'] = './public/images/qr/';
	
			$this->upload->initialize($config);
	
			if (!$this->upload->do_upload('qr')) {
				$error = $this->upload->display_errors();
				echo "Error al cargar el código QR: $error";
			} else {
				$qr_data = $this->upload->data();
				$qr_nombre = $qr_data['file_name'];
	
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
	
}
