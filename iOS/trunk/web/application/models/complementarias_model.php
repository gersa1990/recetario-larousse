<?php

class complementarias_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('typography');
	}

	/***************************************************************
		Modelo para verificar si existe una complementaria con ese nombre
		cuando se trata de crear
	****************************************************************/
	public function checkExistence($palabra, $id_app){

		$existe = $this->db->query("SELECT * FROM recetas_complementarias WHERE titulo = '".$palabra."' and id_app = ".$id_app."  ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo 1;
		}
	}

	/***************************************************************
		Modelo para eliminar los asteriscos de un campo obtenido de la 
		base de datos y convertirlo en código HTML
	****************************************************************/
	public function revertAsterixAlgoritm($descripcionConAsteriscos){

		$descripcionSinAsteriscos = "";
		$bandera = false;

		for ($i=0; $i <strlen($descripcionConAsteriscos) ; $i++) {
			
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
			else{

				$descripcionSinAsteriscos .= $descripcionConAsteriscos[$i];
			}  
		}
		return $this->typography->auto_typography($descripcionSinAsteriscos);
	}

	/***************************************************************
		Modelo para eliminar todas las recetas complementarias 
		contenidas en una APP 
	****************************************************************/
	public function extendsDeleteByIdApp($id_app){

		$this->db->delete("recetas_complementarias", array('id_app' => $id_app ));
	}

	/***************************************************************
		Modelo para eliminar todas las relaciones de complementarias 
		con respecto a las recetas proporcionadas
	****************************************************************/
	public function extendsDelete($recetas){

		foreach ($recetas as $key => $value) 
		{
			$id_receta = $value['id'];
			$this->db->delete("relaciones", array('id_receta' => $id_receta ));
		}
	}

	public function getDataComplementarias($id_receta){

		$complementarias = $this->db->get_where('recetas_complementarias', array('id' => $id_receta));


		$complementarias2 = $complementarias->row_array();

		$arreglo['id'] 			= $complementarias2['id'];
		$arreglo['id_app'] 		= $complementarias2['id_app'];
		$arreglo['titulo']		= $complementarias2['titulo'];
		$arreglo['contenido']	= $this->revertAsterixAlgoritm($complementarias2['contenido']);

		return $arreglo;

	}

	/***************************************************************
		Modelo para verificar que no exista el nombre de la receta 
		complementaria al tratar de actualizarla
	****************************************************************/
	public function updateCheckExistence($palabra, $id_complementaria, $id_app){

		$existe = $this->db->query("SELECT * FROM recetas_complementarias WHERE titulo = '".$palabra."' and id != ".$id_complementaria." and id_app = ".$id_app." ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo 1;
		}
	}

	/***************************************************************
		Modelo para buscar las recetas complementarias
	****************************************************************/
	public function searchByName($nombre , $id_app){

		$complementarias =  $this->db->query("SELECT * FROM recetas_complementarias WHERE titulo LIKE '%".$nombre."%'  and  id_app = ".$id_app."  ");
		return $complementarias->result_array();
	}	

	/***************************************************************
		Modelo para buscar las recetas complementarias que se pueden 
		relacionar DEPRECATED por que existe otro método que ya lo hace
	****************************************************************/
	public function searchByName2($nombre , $id_app, $id_receta){

		$complementarias =  $this->db->query("select * from recetas_complementarias where id_app = ".$id_app." and titulo like '%".$nombre."%' and id != all (select distinct id_receta_complementaria from relaciones where id_receta = ".$id_receta.")");
		return $complementarias->result_array();

	}

	/***************************************************************
		Modelo para obtener las recetas complementarias relacionadas
		con una determinada receta
	****************************************************************/
	public function getcomplementariasRelacionadas($id_receta, $id_app){

		$query = $this->db->query("select * from recetas_complementarias where id in (select  id_receta_complementaria from relaciones where id_receta = ".$id_receta." )");
		$recetasRelacionadas = $query->result_array();
		return $recetasRelacionadas;
	}

	/***************************************************************
		Modelo para obtener las recetas complementarias
	****************************************************************/
	public function getRecetasComplementarias($id_app)
	{
		$query = $this->db->query("SELECT * FROM  recetas_complementarias WHERE id_app =  ".$id_app." ");
		
		$i=0;
		foreach ($query->result() as $arreglo){

			$array[$i]['id'] = $arreglo->id;
			$array[$i]['titulo'] = $arreglo->titulo;
			$array[$i]['contenido'] = $arreglo->contenido;
			$i++;
		}

		if(isset($array)){

			return $array;	
		}
	}

	public function dataGlosario($id){

		$data = $this->db->get_where('recetas_complementarias', array('id' => $id));
		
		$recetas_complementarias = $data->row_array();

		$arreglo['id'] 			= $recetas_complementarias['id'];
		$arreglo['id_app'] 		= $recetas_complementarias['id_app'];
		$arreglo['titulo']		= $recetas_complementarias['titulo'];
		$arreglo['contenido']	= $this->revertAsterixAlgoritm($recetas_complementarias['contenido']);
		
		return $arreglo;

	}

	/***************************************************************
		Modelo para crear las recetas complementarias
	****************************************************************/
	public function create($contenido){

		$data = array(3);

		$data->titulo 	 = @$_POST['titulo'];
		$data->contenido = $contenido;
		$data->id_app	 = $_POST['id_app'];

		$insert = $this->db->insert('recetas_complementarias', $data);

		return $insert;
	}

	/***************************************************************
		Modelo para actualizar
	****************************************************************/
	public function update()
	{
		$this->titulo 	 = $_POST['titulo'];
		$this->contenido = $_POST['contenido'];

		$update = $this->db->update('recetas_complementarias', $this, array('id' => $_POST['id']));

		return $update;
	}

	/***************************************************************
		Modelo para eliminar
	****************************************************************/
	public function delete()
	{
		$id 	= $_POST['id'];
		$delete = $this->db->query("DELETE FROM recetas_complementarias WHERE id = ".$id."");
				  $this->db->query("DELETE FROM relaciones where id_receta_complementaria = ".$id."");
		return $delete; 
	}

	/***************************************************************
		Modelo para obtener el nombre de una receta complementaria
	****************************************************************/
	public function getNameComplementaria($id_complementaria){
			$data = $this->db->query("SELECT titulo FROM recetas_complementarias WHERE id = ".$id_complementaria." ");
			return $data->result_array();
	}

	/***************************************************************
		Modelo para relacionar una receta complementaria con una receta
	****************************************************************/
	public function addToRecipe($id_receta, $id_complementaria){

		$data = array(
			'id_receta' 				=> $id_receta,
			'id_receta_complementaria'	=> $id_complementaria
		);

		$insert = $this->db->insert('relaciones', $data);

		return $id_complementaria; 

	}

	/***************************************************************
		Modelo para eliminar la relacion entre una receta complementaria
		y una determinada receta
	****************************************************************/
	public function deleteToRecipe($id_receta, $id_comp){

		$detele = $this->db->query("DELETE FROM relaciones WHERE id_receta = ".$id_receta." and id_receta_complementaria = ".$id_comp."");
		return $detele;
	}

	/***************************************************************
		Modelo para eliminar todas las posibilidades para relacionar
		una receta con una receta complementaria
	****************************************************************/
	public function getComplemento($id_app, $id_receta){
		$query = $this->db->query("select * from recetas_complementarias where id_app = ".$id_app." and id != all (select distinct id_receta_complementaria from relaciones where id_receta = ".$id_receta.")");
		return $query->result_array();
	}
}
?>