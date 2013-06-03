<?php

class Recetas_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
		$this->load->library('typography');
	}

	/***************************************************************
		Modelo para verificar si una receta no existe al tratar
		de darlo de alta en el sistema
	****************************************************************/
	public function checkExistence($palabra, $id_app){

		$existe = $this->db->query("SELECT * FROM recetas where id_app = ".$id_app." and titulo = '".$palabra."' ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo "Existe";
		}
	}

	/***************************************************************
		Modelo para verificar si una receta no existe al tratar
		de actualizarlo en el sistema
	****************************************************************/
	public function updateCheckExistence($palabra, $id_receta, $id_app){

		$existe = $this->db->query("SELECT * FROM recetas WHERE titulo = '".$palabra."' and id != ".$id_receta." and id_app = ".$id_app." ");
		
		$array = $existe->row_array();

		if(count($array)>0){

			echo 1;
		}
	}

	/***************************************************************
		Modelo para obtener todas las recetas para iniciar una eliminación
		en cascada
	****************************************************************/
	public function getDataForExtendsDelete($id_app){
		$recetas = $this->db->query("SELECT * FROM recetas where id_app = ".$id_app." ");
		return $recetas->result_array();
	}

	/***************************************************************
		Modelo para obtener todas las recetas de una APP
	****************************************************************/
	public function get_recetas($id_app){

		$recetas = $this->db->query("SELECT * FROM recetas where id_app = ".$id_app." ");

		$i=0;
		foreach ($recetas->result() as $key => $value) 
		{
			$arreglo[$i]['id'] 				= $value->id;
			$arreglo[$i]['titulo']			= $value->titulo;
			$arreglo[$i]['id_categoria']	= $value->id_categoria;
			$arreglo[$i]['id_app'] 			= $value->id_app;
			$arreglo[$i]['procedimiento'] 	= $value->procedimiento;
			$arreglo[$i]['ingredientes']	= $value->ingredientes;
			$arreglo[$i]['preparacion']		= $value->preparacion;
			$arreglo[$i]['coccion']			= $value->coccion;
			$arreglo[$i]['costo'] 			= $value->costo;
			$arreglo[$i]['foto'] 			= $value->foto;
			$arreglo[$i]['user_fav'] 		= $value->user_fav;
			$arreglo[$i]['dificultad'] 		= $value->dificultad;
			$arreglo[$i]['preparada'] 		= $value->preparada;
			$i++;
		}

		if(isset($arreglo)){ return $arreglo; }
	}

	/***************************************************************
		Modelo para obtener los datos de una receta
	****************************************************************/
	public function get_receta($id){
		$query = $this->db->get_where('recetas', array('id' => $id));
		return $query->row_array();
	}

	/***************************************************************
		Modelo para eliminar una receta y todas sus relaciones
	****************************************************************/
	public function delete($id){

		$delete = $this->db->delete('recetas', array('id' => $id));
				  $this->db->delete("relaciones", array('id_receta' => $id ));
				  $this->db->delete("videos_x_receta", array('id_receta' => $id ));
				  $this->db->delete("receta_glosario", array('id_receta' => $id ));
		
		return $delete;
	}

	/***************************************************************
		Modelo para crear una receta y obtener su id
	****************************************************************/
	public function createAndReturnId($data){
			
			$this->db->insert('recetas', $data);
			$ID = $this->db->insert_id();
			
		return $ID;
	}

	/***************************************************************
		Modelo para obtener los datos de una receta
	****************************************************************/
	public function getData($id_receta){

		$data = $this->db->query("SELECT * FROM recetas where id = ".$id_receta." ");
		return $data->result_array();
	}

	/***************************************************************
		Modelo para crear una receta DEPRECATED por que ya existe 
		una nueva versión
	****************************************************************/
	public function create(){					

		$data = array(
				'titulo' 			=> $this->input->post('titulo'),
				'id_categoria' 		=> $this->input->post('categoria'),
				'id_app' 			=> $this->input->post('id_app'),
				'procedimiento' 	=> $this->typography->auto_typography($this->input->post('procedimiento')),
				'ingredientes' 		=> $this->typography->auto_typography($this->input->post('ingredientes')),
				'preparacion' 		=> $this->input->post('preparacion'),
				'coccion' 			=> $this->input->post('coccion'),
				'costo' 			=> $this->input->post('costo'),
				'foto' 				=> $this->input->post('costo'),
				'dificultad' 		=> $this->input->post('dificultad')

		);

		$this->db->insert('recetas', $data);
		$ID = $this->db->insert_id();
			
		return $ID;
	}

	/***************************************************************
		Modelo para actualizar los datos de una receta
	****************************************************************/
	public function update($data, $id){

		return $this->db->update('recetas', $data, array('id' => $id));
	}

	/***************************************************************
		Modelo para obtener el nombre de una receta
	****************************************************************/
	public function get_name($id){
		$name = $this->db->query("SELECT titulo FROM recetas WHERE id = ".$id." ");
		return $name->result_array();
	}
}
?>