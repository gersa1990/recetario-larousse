<?php

class app_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->model('recetas_model');
	}

	/***************************************************************
		Modelo para crear una APP
	****************************************************************/
	public function nueva(){

		$data = array(
			'nombre' => $this->input->post('nombre')
		);

		return $this->db->insert('app', $data);
	}

	/***************************************************************
		Modelo para verificar si existe una app con ese nombre
		cuando se trata de actualizar
	****************************************************************/
	public function updateCheckExistence($palabra, $id_app){

		$existe = $this->db->query("SELECT * FROM app WHERE id != ".$id_app." and nombre = '".$palabra."' ");
		$array = $existe->row_array();

		if(count($array)>0){
			
			echo 1;
		}

	}

	/***************************************************************
		Modelo para verificar si existe una app con ese nombre
		cuando se trata de crear
	****************************************************************/
	public function checkExistence($palabra){
		$existe = $this->db->query("SELECT * FROM app where nombre = '".$palabra."' ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo 1;
		}
	}

	/***************************************************************
		Modelo para verificar si existe una app con ese nombre
		cuando se trata de crear
	****************************************************************/
	public function delete_app($id){
		$this->db->delete('recetas', array('id' => $id)); 
	}

	/***************************************************************
		Modelo para actualizar el nombre de la aplicación
	****************************************************************/
	public function updateAppName($idApp, $nombreApp){

		$this->id 	  = $idApp;
		$this->nombre = $nombreApp;
		$update = $this->db->update('app', $this, array('id' => $idApp));

		return $update;

	}

	/***************************************************************
		Modelo para obtener las categorias pertenecientes al APP
	****************************************************************/
	public function getCategoryFromAppId($id)
	{
		$recetas = $this->db->query("SELECT * FROM categoria WHERE id_app = ".$id." ");
		
		$i=0;
		foreach ($recetas->result() as $key => $value) {

			$arreglo[$i]['id'] 			= $value->id;
			$arreglo[$i]['id_app']		= $value->id_app;
			$arreglo[$i]['nombre'] 		= $value->nombre;
			$arreglo[$i]['color']		= $value->color;
			$arreglo[$i]['orden'] 		= $value->orden;
			$i++;
		}

		if(isset($arreglo)){

			return $arreglo;
		}
	}

	/***************************************************************
		Modelo para eliminar una APP
	****************************************************************/
	public function eliminar_app($id)
	{
		$this->db->delete('app', array('id' => $id));	
	}


	/***************************************************************
		Modelo para registrar un APP
	****************************************************************/
	public function set_app(){
		$this->load->helper('url');
			$data = array(
				'nombre' => $this->input->post('nombre')
			);
			return $this->db->insert('app', $data);
	}

	/***************************************************************
		Modelo para obtener todas las APPS o solo una
	****************************************************************/
	public function get_apps($id = FALSE){
		
		if ($id === FALSE){
			$query = $this->db->get('app');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('app', array('id' => $id));
		return $query->row_array();
	}

	/***************************************************************
		Modelo para obtener el nombre de una APP
	****************************************************************/
	public function get_name($id){
		$name = $this->db->query("SELECT nombre FROM app WHERE id = ".$id." ");
		return $name->result_array();
	}
}
?>