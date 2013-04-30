<?php

class Recetas_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
		$this->load->library('typography');
	}

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

		if(isset($arreglo))
		{
			return $arreglo;
		}

	}

	public function delete($id){

		$delete = $this->db->delete('recetas', array('id' => $id));
		return $delete;
	}

	public function create()
	{					


		$data = array(
				'titulo' 			=> $this->input->post('titulo'),
				'id_categoria' 		=> $this->input->post('categoria'),
				'id_app' 				=> $this->input->post('id_app'),
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

	public function update($data, $id){

		return $this->db->update('recetas', $data, array('id' => $id));

	}

	public function update_recetas($id)
	{
		
		$ingre 	= $this->typography->auto_typography($_POST['ingre']);
		$proced = $this->typography->auto_typography($_POST['proce']);

		$data = array(
				'titulo' => $this->input->post('titulo'),
				'id_categoria' => $this->input->post('categoria'),
				'id_app' => $this->input->post('app'),
				'procedimiento' => $proced,
				'ingredientes' => $ingre,
				'preparacion' => $this->input->post('prepa'),
				'coccion' => $this->input->post('coccion'),
				'costo' => $this->input->post('costo'),
				'foto' => $this->input->post('foto'),
				'user_fav' => $this->input->post('user_fav'),
				'dificultad' => $this->input->post('dificultad')

			);

		$this->db->where('id', $id);
        return $this->db->update('recetas', $data);

	}
}
?>