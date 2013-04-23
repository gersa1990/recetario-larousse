<?php

class complementarias_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('typography');
	}

	public function searchRecipesComplementsByTittle()
	{
		$titulo = $_POST['titulo'];

		$query = $this->db->query("SELECT * FROM  recetas_complementarias WHERE titulo = '".$titulo."' ");
		return $query->row_array();
	}

	public function getRecetasComplementarias()
	{
		$query = $this->db->query("SELECT * FROM  recetas_complementarias");
		
		$i=0;
		foreach ($query->result() as $arreglo)
		{	
			$array[$i]['id'] = $arreglo->id;
			$array[$i]['titulo'] = $arreglo->titulo;
			$array[$i]['contenido'] = $arreglo->contenido;
			
			$i++;
		}

		if(isset($array))
		{
			return $array;	
		}
	}

	public function deleteRelationRecipeToRecipecomplements($id_receta, $id_receta_complementaria)
	{

		$delete = $this->db->query("DELETE FROM relaciones where id_receta = ".$id_receta."  and id_receta_complementaria = ".$id_receta_complementaria."  ");
		return $delete;

	}

	public function getRelationsRecetasToComplementarias($id)
	{
		$query = $this->db->query("select * from recetas_complementarias where id in (select id_receta_complementaria from relaciones where id_receta=".$id.");");

		$i=0;
		foreach ($query->result() as $arreglo)
		{	
			$array[$i]['id'] = $arreglo->id;
			$array[$i]['titulo'] = $arreglo->titulo;
			$array[$i]['contenido'] = $arreglo->contenido;
			
			
			$i++;
		}

		if(isset($array))
		{
			//var_dump($array);
			return $array;	
		}

	}

	public function addComplementariasToRelation($id_receta, $id_receta_complementaria)
	{
		$relation = $this->db->query("INSERT into relaciones values (".$id_receta.", ".$id_receta_complementaria.")");
		return $relation;
	}

	public function searchComplementsToAddRelationToRecetas($id)
	{
		$titulo = $_POST['titulo'];

		$resultados = $this->db->query("SELECT  * FROM recetas_complementarias WHERE titulo LIKE '%".$titulo."%' and  id !=  all (select id_receta_complementaria from relaciones where id_receta = ".$id.")");


		$i=0;
		foreach ($resultados->result() as $arreglo)
		{	
			$array[$i]['id'] = $arreglo->id;
			$array[$i]['titulo'] = $arreglo->titulo;
			$array[$i]['contenido'] = $arreglo->contenido;
			
			$i++;
		}

		if(isset($array))
		{
			return $array;	
		}
	}

	public function updateRecetasComplementarias()
	{
		$this->titulo 	 = $_POST['titulo'];
		$this->contenido = $_POST['contenido'];

		$update = $this->db->update('recetas_complementarias', $this, array('id' => $_POST['id']));

		return $update;
	}

	public function deleteRecetasComplementarias()
	{
		$id 	= $_POST['id'];
		$delete = $this->db->query("DELETE FROM recetas_complementarias WHERE id = ".$id."");
				  $this->db->query("DELETE FROM relaciones where id_receta_complementaria = ".$id."");
		return $delete; 
	}
}
?>