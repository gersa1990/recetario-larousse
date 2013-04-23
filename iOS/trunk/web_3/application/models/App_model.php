<?php

class App_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->model('recetas_model');
	}

	
	public function delete_app($id){
		$this->db->delete('recetas', array('id' => $id)); 
	}

	public function eliminar_app($id)
	{
		$this->db->delete('app', array('id' => $id));	
	}


	public function set_app(){
		$this->load->helper('url');
			$data = array(
				'nombre' => $this->input->post('nombre')
			);
			return $this->db->insert('app', $data);
	}

	public function get_apps($id = FALSE){
		
		if ($id === FALSE){
			$query = $this->db->get('app');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('app', array('id' => $id));
		return $query->row_array();
	}

	public function update_categoria($id, $nombre){

		$data = array(
				'nombre' => $this->input->post('nombre')
			);

		$this->db->where('id', $id);
        return $this->db->update('app', $data);

	}






}
?>