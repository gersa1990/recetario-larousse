<?php

class categoria_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	public function searchByTitulo($nombre, $id_app){

		$categorias = $this->db->query("SELECT * FROM categoria WHERE nombre LIKE '%".$nombre."%' and id_app = ".$id_app." ");
		return $categorias->result_array();

	}

	
	public function get_categorias($id_app){
		
		$query = $this->db->get_where('categoria', array('id_app' => $id_app));
		
		$i=0;
		foreach ($query->result() as $key => $value) 
		{
			$arreglo[$i]['id']			= $value->id;
			$arreglo[$i]['id_app']		= $value->id_app;
			$arreglo[$i]['nombre']		= $value->nombre;
			$arreglo[$i]['color']		= $value->color;
			$arreglo[$i]['orden']		= $value->orden;
			$i++;
		}

		if(isset($arreglo))
		{
			return $arreglo;
		}
	}

	public function set_categoria(){
			$data = array(
				'id_app' 	=> $this->input->post('id_app'),
				'nombre' 	=> $this->input->post('nombre'),
				'color' 	=> $this->input->post('color')
			);
			return $this->db->insert('categoria', $data);
	}

	public function delete_recipe($id){
		
		$this->db->delete('categoria', array('id' => $id)); 
	}

	public function update_categoria($id, $nombre, $color){

		$data = array(
				'nombre' => $this->input->post('nombre'),
				'color' => $this->input->post('color')
			);

		$this->db->where('id', $id);
        return $this->db->update('categoria', $data);

	}

}
?>