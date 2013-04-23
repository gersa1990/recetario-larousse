<?php

class Glosario_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function get($nombre)
	{
		$glosario = $this->db->get_where('glosario', array('nombre' => $nombre));
		
		$i=0;
		foreach ($glosario->result() as $arreglo)
		{			
			$array['id'] = $arreglo->id;
		}

		if(isset($array))
		{
			return $array;	
		}
	}

	public function addToRecipe($idReceta, $idGlosario)
	{
		$data = array(
				'id_receta' 		=> $idReceta,
				'id_glosario' 		=> $idGlosario
			);

			$this->db->insert('receta_glosario', $data);

			$ID = $this->db->insert_id();
			
			return $ID;
	}

	public function deleteRelationRecipe($id, $idReceta)
	{
		$delete = $this->db->delete('receta_glosario', array('id' => $id));
		
		return $delete;
	}

	public function getLike($idReceta,$nombre)
	{

		$glosario 		= $this->db->query("SELECT  * FROM glosario WHERE nombre LIKE '%".$nombre."%' and id != all (select id_glosario from receta_glosario where id_receta=".$idReceta.")");
		
		$i=0;
		$j=0;
		

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

	public function edit()
	{
		$data = array(
				'nombre' 		=> $this->input->post('nombre'),
				'descripcion' 	=> $this->input->post('descripcion'),
				'imagen' 		=> $this->input->post('imagen')
			);

			$query = $this->db->update('glosario', $data, array('id' => $_POST['id']));
			return $query;
	}

	public function deleteGlosario()
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

	public function add_glosario(){

		$this->load->helper('url');
			$data = array(
				'nombre' 		=> $this->input->post('palabra'),
				'descripcion' 	=> $this->input->post('descripcion'),
				'imagen' 		=> $this->input->post('imagen')
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
		return $query;
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