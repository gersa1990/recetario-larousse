<?php

class categoria_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	
	public function get_categorias($id = FALSE){
		
		if ($id === FALSE){
			$query = $this->db->get('categoria');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('categoria', array('id' => $id));
		return $query->row_array();
	}

	public function set_categoria(){
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'color' => $this->input->post('color')
			);
			return $this->db->insert('categoria', $data);
	}

	public function delete_recipe($id){
		$this->db->delete('categoria', array('id' => $id)); 
	}

	public function update_categoria($id, $nombre, $color){

		$data = array(
				'nombre' => $this->input->post('nombre'),
				'color' => $this->input->post('color')
			);

		$this->db->where('id', $id);
        return $this->db->update('categoria', $data);

	}

}
?>