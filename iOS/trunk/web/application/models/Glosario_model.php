<?php

class Glosario_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('typography');
	}

	public function checkExistence($palabra, $id_app){

		$existe = $this->db->query("SELECT * FROM glosario WHERE nombre = '".$palabra."' and id_app = ".$id_app."  ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo "Existe";
		}
	}

	public function updateCheckExistence($palabra, $id_glosario, $id_app){

		$existe = $this->db->query("SELECT * FROM glosario WHERE nombre = '".$palabra."' and id != ".$id_glosario." and id_app = ".$id_app." ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo "Existe";
		}
	}	


	public function get_glosario($id_app){

		$query = $this->db->query("SELECT * FROM glosario WHERE id_app = ".$id_app." ");

		$i=0;
		foreach ($query->result() as $key => $value) {
			$arreglo[$i]['id'] 			= $value->id;
			$arreglo[$i]['id_app'] 		= $value->id_app;
			$arreglo[$i]['nombre'] 		= $value->nombre;
			$arreglo[$i]['descripcion'] = $value->descripcion;
			$arreglo[$i]['imagen'] 	= $value->imagen;
			$i++;
		}

		if(isset($arreglo))
		{
			return $arreglo;
		}
	}

	public function addToRecipe($id_receta, $id_glosario){
		$data = array(
			'id_receta' 		=> $id_receta,
			'id_glosario'		=> $id_glosario
		);

		return $this->db->insert('receta_glosario', $data);
	}

	public function getGlosarioRelacionado($id_receta, $id_app){

		$glosario = $this->db->query("select * from glosario where id_app = ".$id_app." and id  in (select id_glosario from receta_glosario where id_receta = ".$id_receta." )");
		return $glosario->result_array();
	}

	public function getDataGlosary($id_glosario){

		$query = $this->db->query("SELECT nombre from glosario where id = ".$id_glosario." ");
		return $query->result_array();
	}

	public function searchByName2($id_app, $id_receta, $palabra){

		$query = $this->db->query("select * from glosario where nombre like '%".$palabra."%' and id_app = ".$id_app." and id != all ( select id_glosario from receta_glosario where id_receta = ".$id_receta." );");
		return $query->result_array();
	}

	
	public function edit()
	{
		$data = array(
				'nombre' 		=> $this->input->post('titulo'),
				'descripcion' 	=> $this->input->post('descripcion'),
				'imagen' 		=> $this->input->post('imagen')
			);

			$query = $this->db->update('glosario', $data, array('id' => $_POST['id']));
			return $query;
	}

	public function delete()
	{
		$id = $_POST['id'];

		$delete = $this->db->delete('glosario',array('id' => $id));
		return $delete;
	}

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

	public function create(){

		$this->load->helper('url');
			$data = array(
				'id_app'        => $this->input->post('id_app'),
				'nombre' 		=> $this->input->post('nombre'),
				'descripcion' 	=> $this->input->post('descripcion'),
				'imagen' 		=> $this->input->post('imagen')
			);

			$this->db->insert('glosario', $data);

			$ID = $this->db->insert_id();
			
			return $ID;
	}

	public function searchByName($nombre, $id_app){
		
		$glosario = $this->db->query("SELECT * FROM glosario WHERE nombre LIKE  '%".$nombre."%' and id_app = ".$id_app."  ");
		return $glosario->result_array();
	}

	public function deleteToRecipe($id_receta, $id_glosario){

		$id = $this->db->query("SELECT id FROM receta_glosario WHERE id_receta = ".$id_receta." and id_glosario = ".$id_glosario."");
		$array[] = $id->row_array();
		$id_relacion = $array[0]['id'];
		$delete = $this->db->delete('receta_glosario',array('id' => $id_relacion));
		return $delete;
	}

	public function getComplemento($id_app, $id_receta){
		$query = $this->db->query("select * from glosario where id_app = ".$id_app." and id != all ( select id_glosario from receta_glosario where id_receta = ".$id_receta." );");
		return $query->result_array();
	}

}
?>