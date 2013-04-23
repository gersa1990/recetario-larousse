<?php

class Glosario_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function get($nombre)
	{
		$query  = $this->db->query("SELECT * FROM glosario ");
		return $query;	
	}

	public function deleteGlosario($id)
	{
		echo $id;
	}

	public function add_glosario(){

		$this->load->helper('url');
			$data = array(
				'nombre' 		=> $this->input->post('palabra'),
				'descripcion' 	=> $this->input->post('definicion'),
				'imagen' 		=> $this->input->post('imgGlosario')
			);

			$this->db->insert('glosario', $data);

			$ID = $this->db->insert_id();
			
			return $ID;
	}

	

	public function add_glosario2()
	{

		$palabra 		= $_POST['palabra'];
		$definicion		= $_POST['definicion'];
		$img 			= $_POST['imgGlosario'];
	
			$this->db->query("INSERT INTO glosario values('','".$palabra."', '".$definicion."', '".$img."')");

			$ID = $this->db->insert_id();

			
			return $ID;
	}

	public function get_recetasBySearch($titulo)
	{
		$query  = $this->db->query("SELECT * FROM recetas WHERE titulo LIKE '%".$titulo."%'");

		$i=0;
		foreach ($query->result() as $arreglo)
		{			
			$array[$i]['id'] = $arreglo->id;
			$array[$i]['titulo'] = $arreglo->titulo;
			$i++;
		}

		if(isset($array))
		{
			return $array;	
		}

		
	}

	public function getGlosarioByRecipe($id)
	{
		$query = $this->db->query("SELECT * FROM glosario join receta_glosario on glosario.id = receta_glosario.id_glosario and id_receta = ".$id."");
		return $query->row_array();
	}

	public function getGlosarioByRecipe2($id)
	{
		$query = $this->db->query("SELECT * FROM glosario join receta_glosario on glosario.id = receta_glosario.id_glosario and id_receta = ".$id."");
		return $query;
	}

	public function addRelationWordGlosario($idReceta, $idGlosario)
	{
		$data = array(
			'id_receta' 	=> $idReceta ,
			'id_glosario' 	=> $idGlosario
			);

		$this->db->insert('receta_glosario', $data);

		$ID = $this->db->insert_id();
			
		return $ID;
	}
}
?>