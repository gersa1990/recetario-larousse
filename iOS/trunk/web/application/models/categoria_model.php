<?php

class categoria_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	/***************************************************************
		Modelo para verificar si existe una categoria con ese nombre
		cuando se trata de crear en la BD
	****************************************************************/
	public function checkExistence($palabra, $id_app){

		$existe = $this->db->query("SELECT * FROM categoria WHERE nombre = '".$palabra."' and id_app = ".$id_app." ");
		$array  = $existe->row_array(); 

		if(count($array)>0)
		{
			echo 1;
		}
	}

	public function getDataCategorias($id){
		$glosario = $this->db->get_where("categoria", array("id" => $id));

		return $glosario->row_array();
	}

	/***************************************************************
		Modelo para actualizar el orden en que se mestran
		las categorias en el sistema
	****************************************************************/
	public function updateOrden($id_categoria, $orden){

		$this->orden = $orden;

		$this->db->update('categoria', $this, array('id' => $id_categoria));
	}

	/***************************************************************
		Modelo para eliminar todas las categorias contenidas en esa APP
	****************************************************************/
	public function extendsDelete($id_app){

		$this->db->delete("categoria", array('id_app' => $id_app ));
	}

	/***************************************************************
		Modelo para verificar si existe una categoria con ese nombre
		cuando se trata de actualizar
	****************************************************************/
	public function updateCheckExistence($palabra, $id_app, $id_categoria){

		$existe = $this->db->query("SELECT * FROM categoria WHERE nombre = '".$palabra."' and id_app = ".$id_app." and id != ".$id_categoria."   ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo 1;
		}		
	}

	/***************************************************************
		Modelo para buscar una categoria con respecto a su título
	****************************************************************/
	public function searchByTitulo($nombre, $id_app){

		$categorias = $this->db->query("SELECT * FROM categoria WHERE nombre LIKE '%".$nombre."%' and id_app = ".$id_app." ");
		return $categorias->result_array();
	}

	/******************************************************************
		Modelo para obtener todas las categorias contenidas en una APP 
	*******************************************************************/
	public function get_categorias($id_app){
		
		$query = $this->db->query("SELECT * FROM categoria WHERE id_app = ".$id_app." ORDER BY orden asc ");
		
		$i=0;
		foreach ($query->result() as $key => $value) {

			$arreglo[$i]['id']			= $value->id;
			$arreglo[$i]['id_app']		= $value->id_app;
			$arreglo[$i]['nombre']		= $value->nombre;
			$arreglo[$i]['color']		= $value->color;
			$arreglo[$i]['orden']		= $value->orden;
			$i++;
		}

		if(isset($arreglo)){

			return $arreglo;
		}
	}

	/***************************************************************
		Modelo para agregar una categoría con sus datos
	****************************************************************/
	public function set_categoria(){
			$data = array(
				'id_app' 	=> $this->input->post('id_app'),
				'nombre' 	=> $this->input->post('nombre'),
				'color' 	=> $this->input->post('color')
			);
			return $this->db->insert('categoria', $data);
	}

	/***************************************************************
		Modelo para eliminar una categoria
	****************************************************************/
	public function delete_categoria($id){
		
		$this->db->delete('categoria', array('id' => $id)); 
	}

	/***************************************************************
		Modelo para actualizar una categoria
	****************************************************************/
	public function update_categoria($id, $nombre, $color){

		$data = array(
				'nombre' => $nombre,
				'color' => $color
			);

		$this->db->where('id', $id);
        return $this->db->update('categoria', $data);
	}
}
?>