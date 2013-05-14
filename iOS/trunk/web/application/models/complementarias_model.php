<?php

class complementarias_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('typography');
	}

	public function searchByName($nombre , $id_app){

		$complementarias =  $this->db->query("SELECT * FROM recetas_complementarias WHERE titulo LIKE '%".$nombre."%'  and  id_app = ".$id_app."  ");
		return $complementarias->result_array();
	}	

	public function searchByName2($nombre , $id_app, $id_receta){

		$complementarias =  $this->db->query("select * from recetas_complementarias where id_app = ".$id_app." and titulo like '%".$nombre."%' and id != all (select distinct id_receta_complementaria from relaciones where id_receta = ".$id_receta.")");
		return $complementarias->result_array();

	}

	public function getcomplementariasRelacionadas($id_receta, $id_app){

		$query = $this->db->query("select * from recetas_complementarias where id in (select  id_receta_complementaria from relaciones where id_receta = ".$id_receta." )");
		$recetasRelacionadas = $query->result_array();
		return $recetasRelacionadas;

	}

	public function getRecetasComplementarias($id_app)
	{
		$query = $this->db->query("SELECT * FROM  recetas_complementarias WHERE id_app =  ".$id_app." ");
		
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

	public function create(){

		$data->titulo 	 = $_POST['titulo'];
		$data->contenido = $_POST['contenido'];
		$data->id_app	 = $_POST['id_app'];

		$insert = $this->db->insert('recetas_complementarias', $data);

		return $insert;
	}

	public function update()
	{
		$this->titulo 	 = $_POST['titulo'];
		$this->contenido = $_POST['contenido'];

		$update = $this->db->update('recetas_complementarias', $this, array('id' => $_POST['id']));

		return $update;
	}

	public function delete()
	{
		$id 	= $_POST['id'];
		$delete = $this->db->query("DELETE FROM recetas_complementarias WHERE id = ".$id."");
				  $this->db->query("DELETE FROM relaciones where id_receta_complementaria = ".$id."");
		return $delete; 
	}

	public function getNameComplementaria($id_complementaria){
			$data = $this->db->query("SELECT titulo FROM recetas_complementarias WHERE id = ".$id_complementaria." ");
			return $data->result_array();
	}

	public function addToRecipe($id_receta, $id_complementaria){

		$data = array(
			'id_receta' 				=> $id_receta,
			'id_receta_complementaria'	=> $id_complementaria
		);

		$insert = $this->db->insert('relaciones', $data);

		return $id_complementaria; 

	}

	public function deleteToRecipe($id_receta, $id_comp){

		$detele = $this->db->query("DELETE FROM relaciones WHERE id_receta = ".$id_receta." and id_receta_complementaria = ".$id_comp."");
		return $detele;
	}

	public function getComplemento($id_app, $id_receta){
		$query = $this->db->query("select * from recetas_complementarias where id_app = ".$id_app." and id != all (select distinct id_receta_complementaria from relaciones where id_receta = ".$id_receta.")");
		return $query->result_array();

	}
}
?>