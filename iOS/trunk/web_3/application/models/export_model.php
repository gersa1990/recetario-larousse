<?php

class export_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	
	public function delete_app($id){
		$this->db->delete('recetas', array('id' => $id)); 
	}


	public function getRecipesFromAppId($id_app) 
	{
		$this->db->select('id, titulo, id_categoria, procedimiento,ingredientes,preparacion,coccion,costo,video,foto,user_fav');
		$query = $this->db->get_where('recetas', array('id_app' => $id_app));

		return $query->result();
	}

	public function getCategoriesFromAppId($id_app) {

	$query = $this->db->get_where('categorias', array('id_app' => $id_app));

	return $query->result();

	}

}
?>