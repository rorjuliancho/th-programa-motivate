<?php defined('BASEPATH') or exit('No direct script access allowed');
class Programa_motivate_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($cedula)
    {
        $this->db->select('*');
        $this->db->where('cedula', $cedula);
        $query = $this->db->get('colaborador');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function actividades()
    {
        $this->db->select('*');
        $query = $this->db->get('actividades');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function actividadesColaborador($idColaborador, $idActividad)
    {
        $this->db->select('*');
        $this->db->where('idColaborador', $idColaborador);
        $this->db->where('idActividad', $idActividad);
        $this->db->join('actividades a', 'a.idactividades = p.idActividad');
        $query = $this->db->get('puntuacion p');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function validacionActividades($idColaborador, $idActividad)
    {
        $this->db->select('*');
        $this->db->where('idColaborador', $idColaborador);
        $this->db->where('idActividad', $idActividad);
        $query = $this->db->get('puntuacion');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function nombreActividad($idActividad)
    {
        $this->db->select('*');
        $this->db->where('idactividades', $idActividad);
        $query = $this->db->get('actividades');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function top()
    {
        /* SELECT sum(puntos) as puntuacion, c.nombre, c.apellido 
        FROM puntuacion p
        join colaborador c on c.idcolaborador=p.idColaborador
        group by p.idColaborador 
        order by puntuacion desc limit 5; */
        $this->db->select('SUM(puntos) as puntuacion, c.nombre, c.apellido');
        $this->db->join('colaborador c', 'c.idcolaborador = p.idColaborador');
        $this->db->group_by('p.idColaborador');
        $this->db->order_by('puntuacion', 'desc');
        $this->db->limit(5);

        $query = $this->db->get('puntuacion p');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function puntosColaborador($idColaborador)
    {
        $this->db->select_sum('puntos', 'puntuacion');
        $this->db->where('idColaborador', $idColaborador);
        $query = $this->db->get('puntuacion');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function puntosActividadColaborador($idColaborador)
    {
        $this->db->select('a.idActividades,a.nombre,a.imagen,a.idactividades');
        $this->db->select_sum('puntos', 'puntuacion');
        $this->db->join('actividades a', 'a.idactividades = p.idActividad');
        $this->db->where('idColaborador', $idColaborador);
        $this->db->group_by('p.idActividad');
        $this->db->order_by('idActividad', 'asc');
        $query = $this->db->get('puntuacion p');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insertarActividades($id, $data)
    {
        $this->db->insert('puntuacion', $data);
        $this->db->where('idColaborador', $id);
        return true;
    }
}
