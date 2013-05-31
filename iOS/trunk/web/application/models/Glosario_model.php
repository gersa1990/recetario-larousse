<?php

class Glosario_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('typography');
	}

	/***************************************************************
		Modelo para verificar si un glosario no existe al tratar
		de darlo de alta en el sistema
	****************************************************************/
	public function checkExistence($palabra, $id_app){

		$existe = $this->db->query("SELECT * FROM glosario WHERE nombre = '".$palabra."' and id_app = ".$id_app."  ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo "Existe";
		}
	}

	/***************************************************************
		Modelo para eliminar los glosarios correspondientes a una APP
	****************************************************************/
	public function extendsDeleteByIdApp($id_app){

		$this->db->delete("glosario", array('id_app' => $id_app ));
	}

	/***************************************************************
		Modelo para eliminar los glosarios que contenidos en 
		una determinada APP
	****************************************************************/
	public function extendsDelete($recetas){

		foreach ($recetas as $key => $value) 
		{
			$id_receta = $value['id'];
			$this->db->delete("receta_glosario", array('id_receta' => $id_receta ));
		}

	}

	/***************************************************************
		Modelo para verificar si un glosario no existe al tratar
		de editarlo en el sistema
	****************************************************************/
	public function updateCheckExistence($palabra, $id_glosario, $id_app){

		$existe = $this->db->query("SELECT * FROM glosario WHERE nombre = '".$palabra."' and id != ".$id_glosario." and id_app = ".$id_app." ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo "Existe";
		}
	}	

	/***************************************************************
		Modelo para eliminar los asteriscos de un campo obtenido de la 
		base de datos y convertirlo en código HTML
	****************************************************************/
	public function revertAsterixAlgoritm($descripcionConAsteriscos){

		$descripcionSinAsteriscos = "";
		$bandera = false;

		for ($i=0; $i <strlen($descripcionConAsteriscos) ; $i++) 
		{
			
			
			if($descripcionConAsteriscos[$i] == "*" && $bandera == false){
                $descripcionSinAsteriscos .= "<em>";	
                $bandera = true;
            	
			}
			else if($descripcionConAsteriscos[$i] == "*" && $bandera == true){
                $descripcionSinAsteriscos .= "</em>";	
                $bandera = false;	
			}
			else if($descripcionConAsteriscos[$i]=="Â"){
				$descripcionSinAsteriscos .= " ";	
                $i++;
			}
			else
			{
				$descripcionSinAsteriscos .= $descripcionConAsteriscos[$i];
			}  
		}

		return $this->typography->auto_typography($descripcionSinAsteriscos);
	}

	/***************************************************************
		Modelo para obtener el glosario contenido en una APP
	****************************************************************/
	public function get_glosario($id_app){

		$query = $this->db->query("SELECT * FROM glosario WHERE id_app = ".$id_app." ");

		$i=0;
		foreach ($query->result() as $key => $value) {

			$arreglo[$i]['id'] 			= $value->id;
			$arreglo[$i]['id_app'] 		= $value->id_app;
			$arreglo[$i]['nombre'] 		= $value->nombre;
			$arreglo[$i]['descripcion'] = $this->revertAsterixAlgoritm($value->descripcion);
			$arreglo[$i]['imagen'] 		= $value->imagen;
			$i++;
		}

		if(isset($arreglo)){

			return $arreglo;
		}
	}

	/***************************************************************
		Modelo para relacionar un glosario con una receta
	****************************************************************/
	public function addToRecipe($id_receta, $id_glosario){
		$data = array(
			'id_receta' 		=> $id_receta,
			'id_glosario'		=> $id_glosario
		);

		return $this->db->insert('receta_glosario', $data);
	}

	/***************************************************************
		Modelo para obtener las relaciones de un glosario con respecto
		a una receta
	****************************************************************/
	public function getGlosarioRelacionado($id_receta, $id_app){

		$glosario = $this->db->query("select * from glosario where id_app = ".$id_app." and id  in (select id_glosario from receta_glosario where id_receta = ".$id_receta." )");
		return $glosario->result_array();
	}

	/***************************************************************
		Modelo para obtener todos los datos de un glosario
	****************************************************************/
	public function getDataGlosary($id_glosario){

		$query = $this->db->query("SELECT nombre from glosario where id = ".$id_glosario." ");
		return $query->result_array();
	}

	/***************************************************************
		Modelo para buscar un glosario DEPRECATED por version 1
	****************************************************************/
	public function searchByName2($id_app, $id_receta, $palabra){

		$query = $this->db->query("select * from glosario where nombre like '%".$palabra."%' and id_app = ".$id_app." and id != all ( select id_glosario from receta_glosario where id_receta = ".$id_receta." );");
		return $query->result_array();
	}

	/***************************************************************
		Modelo para editar un glosario
	****************************************************************/
	public function edit($arreglado)
	{
		$data = array(
				'nombre' 		=> $this->input->post('titulo'),
				'descripcion' 	=> $arreglado,
				'imagen' 		=> $this->input->post('imagen')
			);

			$query = $this->db->update('glosario', $data, array('id' => $_POST['id']));
			return $query;
	}

	/***************************************************************
		Modelo para eliminar un glosario
	****************************************************************/
	public function delete()
	{
		$id = $_POST['id'];

		$delete = $this->db->delete('glosario',array('id' => $id));
		return $delete;
	}

	/***************************************************************
		Modelo para obtener todos los glosarios
	****************************************************************/
	public function getAll()
	{
		$glosario = $this->db->get('glosario');
		$i=0;
		foreach ($glosario->result() as $arreglo)
		{			
			$array[$i]['id'] 			= $arreglo->id;
			$array[$i]['nombre']		= $arreglo->nombre;
			$array[$i]['descripcion']	= $arreglo->descripcion;
			$array[$i]['imagen']		= $arreglo->imagen;
			$i++;
		}

		if(isset($array))
		{
			return $array;	
		}
		
	}

	/***************************************************************
		Modelo para dar de alta un glosario en la BD
	****************************************************************/
	public function create($descripcion2){

		$this->load->helper('url');
			$data = array(
				'id_app'        => $this->input->post('id_app'),
				'nombre' 		=> $this->input->post('nombre'),
				'descripcion' 	=> $descripcion2,
				'imagen' 		=> $this->input->post('imagen')
			);
			
			$this->db->insert('glosario', $data);
			$ID = $this->db->insert_id();
	
			return $ID;
	}

	/***************************************************************
		Modelo para buscar un glosario (Sistema de búsqueda)
	****************************************************************/
	public function searchByName($nombre, $id_app){
		
		$glosario = $this->db->query("SELECT * FROM glosario WHERE nombre LIKE  '%".$nombre."%' and id_app = ".$id_app."  ");
		return $glosario->result_array();
	}

	/***************************************************************
		Modelo para eliminar las relaciones de una receta con 
		respecto a un glosario
	****************************************************************/
	public function deleteToRecipe($id_receta, $id_glosario){

		$id = $this->db->query("SELECT id FROM receta_glosario WHERE id_receta = ".$id_receta." and id_glosario = ".$id_glosario."");
		$array[] = $id->row_array();
		$id_relacion = $array[0]['id'];
		$delete = $this->db->delete('receta_glosario',array('id' => $id_relacion));
		return $delete;
	}

	/***************************************************************
		Modelo para obtener los posibles glosarios que pueden ser relacionados
	****************************************************************/
	public function getComplemento($id_app, $id_receta){
		$query = $this->db->query("select * from glosario where id_app = ".$id_app." and id != all ( select id_glosario from receta_glosario where id_receta = ".$id_receta." );");
		return $query->result_array();
	}

}
?>