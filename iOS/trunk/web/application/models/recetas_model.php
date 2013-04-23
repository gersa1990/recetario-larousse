<?php

class Recetas_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
		$this->load->library('typography');
	}

	public function getGlosarioByRecipe($id)
	{
		$query = $this->db->query("SELECT * FROM glosario JOIN receta_glosario on  glosario.id = receta_glosario.id_glosario and receta_glosario.id_receta = ".$id."");

		$i=0;
		foreach ($query->result() as $arreglo)
		{	
			$array[$i]['id'] = $arreglo->id;
			$array[$i]['nombre'] = $arreglo->nombre;
			$array[$i]['descripcion'] = $arreglo->descripcion;
			$array[$i]['imagen'] = $arreglo->imagen;
			
			$i++;
		}

		if(isset($array))
		{
			return $array;	
		}
	}

	public function searchRecetasComplementariasByTitulo()
	{
		$titulo = $_POST['palabra'];
		$query = $this->db->query("SELECT * FROM recetas_complementarias WHERE titulo = '".$titulo."' ");

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

	public function createRecetasComplementarias()
	{
		$data = array(
				'titulo' 	=> $this->input->post('titulo'),
				'contenido' => $this->input->post('contenido')
			);

			$this->db->insert('recetas_complementarias', $data);
			$ID = $this->db->insert_id();
			
			return $ID;
	}

	public function get_recetasById($id)
	{
		
		$query = $this->db->get_where('recetas', array('id' => $id));
		return $query->row_array();
	}

	public function get_recetas($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('recetas');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('recetas', array('id_app' => $id));
		
		$i=0;
		foreach ($query->result() as $arreglo)
		{			
			$array[$i]['id'] = $arreglo->id;
			$array[$i]['titulo'] = $arreglo->titulo;
			$array[$i]['procedimiento'] = $arreglo->procedimiento;
			$array[$i]['ingredientes'] = $arreglo->ingredientes;
			$array[$i]['preparacion'] = $arreglo->preparacion;
			$array[$i]['foto'] = $arreglo->foto;
			$i++;
		}

		if(isset($array))
		{
			//var_dump($array);
			return $array;	
		}
	}

	public function get_recetas2($app, $id)
	{		
		$query = $this->db->get_where('recetas', array('id_app' => $app, 'id' => $id));
		return $query->row_array();
	}

	public function updateRelationRecipe($id1,$id2)
	{
		@$data->id_receta1 = $id1;
		@$data->id_receta2 = $id2;

		return $this->db->insert('recetas_relacion', $data);
	}

	public function getDataByRelation($id)
	{
		$query = $this->db->get_where('recetas', array('id' => $id));
		return $query->row_array();
	}

	public function deleteRelation($id1, $id2)
	{
		$query1 = $this->db->delete('recetas_relacion', array('id_receta1' => $id1, 'id_receta2' => $id2));
		$query2 = $this->db->delete('recetas_relacion', array('id_receta1' => $id2, 'id_receta2' => $id1));

		return $query1.$query2;
	}

	public function getRelations($id)
	{
		$query2 = $this->db->query("SELECT * FROM recetas_relacion WHERE id_receta1 = ".$id." OR id_receta2 = ".$id."");

		$i=0;
		foreach ($query2->result() as $row2)
		{
			if($id!=$row2->id_receta1)
			{
				$encontrado[$i]['id'] = $row2->id_receta1;
				$i++;	
			}

			if($id!=$row2->id_receta2)
			{
				$encontrado[$i]['id'] = $row2->id_receta2;
				$i++;				
			}
		}

		if(isset($encontrado))
		{


		for ($i=0; $i <count($encontrado) ; $i++) 
		{ 
			$querys = $this->db->query("SELECT * FROM recetas WHERE id = ".$encontrado[$i]['id']."");
			foreach ($querys->result() as $columna)
			{
				$data[$i]['id'] 			= $columna->id;
				$data[$i]['titulo']			= $columna->titulo;
				$data[$i]['costo'] 			= $columna->costo;
				$data[$i]['preparacion']	= $columna->preparacion;
				$data[$i]['ingredientes'] 	= $columna->ingredientes;
				$data[$i]['coccion']		= $columna->coccion;
				

			}
		}
	}

	if(isset($data))
	{
		return $data;
	}

	}

	public function get_recetasBySearch($titulo,$id,$app)
	{
		$query  = $this->db->query("SELECT * FROM recetas WHERE titulo LIKE '%".$titulo."%' and id != ".$id." and id_app = ".$app." ");
		$query2 = $this->db->query("SELECT * FROM recetas_relacion WHERE id_receta1 = ".$id." OR id_receta2 = ".$id."");
 	
		$i=0;
		foreach ($query2->result() as $row2)
		{
			if($id!=$row2->id_receta1)
			{
				$encontrado[$i]['id_receta'] = $row2->id_receta1;
				$i++;	
			}

			if($id!=$row2->id_receta2)
			{
				$encontrado[$i]['id_receta'] = $row2->id_receta2;
				$i++;				
			}
		}

		$i=0;
		foreach ($query->result() as $arreglo)
		{			
			$array[$i]['id'] = $arreglo->id;
			$array[$i]['titulo'] = $arreglo->titulo;
			$i++;
		}

		
		if(isset($array))
		{

		foreach ($array as $i => $arreglo) 
		{
			if(isset($encontrado))
			{
				foreach ($encontrado as $j => $value) 
				{
					if(@$encontrado[$j]['id_receta']==@$array[$i]['id'])
					{
						array_splice($array,$i,$i+1);
					}
				}	
			}
		}

		
			return $array;
		}
	}

	
	public function delete_recipe($id){
		$this->db->delete('recetas', array('id' => $id)); 
	}


	public function set_recetas()
	{
		$ingredientes 	= $this->typography->auto_typography($_POST['ingre']);
		$procedimiento  = $this->typography->auto_typography($_POST['proce']);
		

		$this->load->helper('url');
			$data = array(
				'titulo'	 		=> $this->input->post('titulo'),
				'id_categoria' 		=> $this->input->post('categoria'),
				'id_app' 			=> $this->input->post('app'),
				'procedimiento' 	=> $procedimiento,
				'ingredientes' 		=> $ingredientes,
				'preparacion' 		=> $this->input->post('prepa'),
				'coccion' 			=> $this->input->post('coccion'),
				'costo' 			=> $this->input->post('costo'),
				'foto' 				=> $this->input->post('img'),
				'user_fav' 			=> $this->input->post('user'),
				'dificultad' 		=> $this->input->post('dificultad'),
				'preparada'			=> 0
			);

			$this->db->insert('recetas', $data);
			$ID = $this->db->insert_id();
			
			return $ID;
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