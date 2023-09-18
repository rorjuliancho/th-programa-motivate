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
			$userLogin = array(
				'logueado' => TRUE,
				'idUser' => $login[0]->idcolaborador,
				'nombre' => $login[0]->nombre,
				'apellido' => $login[0]->apellido,
				'cargo' => $login[0]->cargo,
			);
			$this->session->set_userdata($userLogin);
			redirect('Welcome/main');
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
}
