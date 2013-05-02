<?php

class Glosario_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('typography');
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

}
?>