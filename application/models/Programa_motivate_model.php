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
        $this->db->where('estado', 1);
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
        $this->db->select('a.idActividades,a.nombre as nombre_actividad,a.imagen, c.*');
        $this->db->select_sum('puntos', 'puntuacion');
        $this->db->join('actividades a', 'a.idactividades = p.idActividad');
        $this->db->join('colaborador c', 'c.idcolaborador = p.idColaborador');
        $this->db->where('c.idcolaborador', $idColaborador);
        $this->db->group_by('p.idActividad');
        $this->db->order_by('p.idActividad', 'asc');
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

    public function traerColaboradores()
    {
        $this->db->select('e.nombre as nombreempresa, c.nombre as nombrecolab, e.*, c.*');
        $this->db->where('c.estado !=', '0');
        $this->db->join('empresa e', 'e.idempresa = c.id_empresa');
        $this->db->order_by('c.idcolaborador', 'asc');
        $query = $this->db->get('colaborador c');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function traerEmpresas()
    {
        $this->db->select('*');
        $query = $this->db->get('empresa');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insertar_colaborador($data)
    {
        $this->db->insert('colaborador', $data);
    }

    public function guardar_actividades($data)
    {
        $this->db->insert('actividades', $data);
    }

    public function detallesEditar($id)
    {
        $this->db->select('*');
        $this->db->where("idactividades", $id);
        $query = $this->db->get('actividades');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function actualizarActividad($data, $idActividad)
    {
        $this->db->where('idactividades', $idActividad);
        $this->db->update('actividades', $data);
        return true;
    }


    public function viewColaboradorId($id)
    {
        $this->db->select('*');
        $this->db->where("idactividades", $id);
        $query = $this->db->get('actividades');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function traerColaboradoresById($id)
    {
        $this->db->select('e.nombre as nombreempresa, c.nombre as nombrecolab, e.nombre as nombre_empresa,e.*, c.*');
        $this->db->where('c.idcolaborador', $id);
        $this->db->join('empresa e', 'e.idempresa = c.id_empresa');
        $this->db->order_by('c.idcolaborador', 'asc');
        $query = $this->db->get('colaborador c');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function actualizarColaborador($data, $id)
    {
        $this->db->where('idcolaborador', $id);
        $this->db->update('colaborador', $data);
        return true;
    }

    public function eliminarActividad($idActividad, $estado)
    {
        $data = array(
            'estado' => 0
        );
        $this->db->where('idactividades', $idActividad);
        $this->db->update('actividades', $data);
        return true;
    }

    public function insertPuntajeColaborador($data)
    {
        $this->db->insert('puntuacion', $data);
    }

    public function actividadColaborador($idColaborador, $idActividad)
    {
        $this->db->select('*');
        $this->db->where("idColaborador", $idColaborador);
        $this->db->where("idActividad", $idActividad);
        $this->db->join('actividades a', 'a.idactividades = p.idActividad');
        $query = $this->db->get('puntuacion p');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function updatePuntosColaborador($data, $idPuntos)
    {
        $this->db->where('idpuntuacion', $idPuntos);
        $this->db->update('puntuacion', $data);

        return true;
    }

    public function deleteColaborador($id)
    {
        $data = array(
            'estado' => 0
        );
        $this->db->where('idcolaborador', $id);
        $this->db->update('colaborador', $data);
        return true;
    }

    public function cantidadActividades()
    {
        $this->db->select('count(*) as cantidad_actividades');
        $query = $this->db->get('actividades');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function last_id()
    {
        $this->db->select('idcolaborador');
        $this->db->order_by('idcolaborador', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('colaborador');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insertarPuntosNuevoColaborador($data)
    {
        $this->db->insert('puntuacion', $data);
    }
}
