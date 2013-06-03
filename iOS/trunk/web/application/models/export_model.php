<?php

class export_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/***************************************************************
		Modelo para obtener todos los videos pertenecientes a una APP
	****************************************************************/
	public function getVideos($recetas)
	{
		$j=0;
		for ($i=0; $i < count($recetas); $i++) 
		{ 
			$id = $recetas[$i]['id'];
			$query = $this->db->query("SELECT * FROM videos_x_receta WHERE id_receta =  ".$id." ");

			$aux = $query->result();

			foreach ($query->result() as $key => $value){

				if(count($aux)>0)
				{
					$arreglo[$j]	= $value->id_video;
					$j++;
				}
			}

		}

		if(isset($arreglo))
		{
			$arreglado = array_unique($arreglo);

			$j=0;

			for ($i=0; $i <count($arreglado) ; $i++) 
			{ 

				$query = $this->db->query("SELECT * FROM video WHERE id = ".$arreglado[$i]." ");

				foreach ($query->result() as $key => $value) 
				{
					$videos[$j]['id'] 		= $value->id;
					$videos[$j]['video'] 	= $value->video;
					$videos[$j]['titulo'] 	= $value->titulo;

					$j++;
				}
			}

			if(isset($videos))
			{
				return $videos;
			}
		}
	}

	/***************************************************************
		Modelo para obtener los videos relacionados con las recetas
	****************************************************************/
	public function getVideosByRecipe($recetas)
	{
		$j=0;
		for ($i=0; $i < count($recetas); $i++) 
		{ 
			$id = $recetas[$i]['id'];
			$query = $this->db->query("SELECT * FROM videos_x_receta WHERE id_receta =  ".$id." ");

			$aux = $query->result();

			foreach ($query->result() as $key => $value) {

				if(count($aux)>0)
				{
					$arreglo[$j]['id'] 			= $value->id;
					$arreglo[$j]['id_video']	= $value->id_video;
					$arreglo[$j]['id_receta']	= $value->id_receta;
					$j++;
				}
			}
		}

		if(isset($arreglo)){ return $arreglo; }
	}

	/***************************************************************
		Modelo para obtener las recetas complementarias relacionadas 
		con las recetas
	****************************************************************/
	public function getRelationsRecetasToComplementarias($recetas){

		$j=0;

		for ($i=0; $i <count($recetas) ; $i++) 
		{ 
			$id = $recetas[$i]['id'];

			$query = $this->db->query("SELECT * FROM relaciones WHERE id_receta = ".$id." ");

			$relations = $query->result();

			if(count($relations)>0){
				
				foreach ($relations as $key => $value) {

					$arreglo[$j]['id_receta'] 						= $value->id_receta;
					$arreglo[$j]['id_receta_complementaria'] 		= $value->id_receta_complementaria;
					$j++;
				}
			}			
		}
		
		if(isset($arreglo)){ return $arreglo; }
	}

	/***************************************************************
		Modelo para obtener la configuracion de la APP
	****************************************************************/
	public function getConfByAppId($id_app){

		$query = $this->db->query("SELECT * FROM conf where id = ".$id_app."");
		$conf = $query->result();

		$j=0;
		foreach ($conf as $key => $value) 
		{
			$arreglo[$j]['id'] 			= $value->id;
			$arreglo[$j]['nombre'] 		= $value->nombre;
			$arreglo[$j]['valor'] 		= $value->valor;
			$j++;
		}

		if(isset($arreglo)){ return $arreglo; }
	}

	public function getIdToRecipesFromAppId($id_app){

		$recetas = $this->db->query("SELECT id FROM recetas WHERE id_app = ".$id_app." ");
		return $recetas->result_array();

	}

	/***************************************************************
		Modelo para obtener la relacion entre el glosario y las recetas
	****************************************************************/
	public function getRelationRecipesAndGlosarioByAppId($id_app)
	{
		$recetas = $this->getIdToRecipesFromAppId($id_app);	
		
		$j=0;
		for ($i=0; $i <count($recetas) ; $i++) 
		{ 
			$query = $this->db->query("SELECT * FROM receta_glosario where id_receta = ".$recetas[$i]['id']."");
			
			$relations = $query->result();

			foreach ($relations as $key => $value) 
			{
				$arreglo[$j]['id'] 			= $value->id;
				$arreglo[$j]['id_receta'] 	= $value->id_receta;
				$arreglo[$j]['id_glosario'] = $value->id_glosario;
				$j++;
			}

		}

		if(isset($arreglo)){ return $arreglo; }


	}

	/***************************************************************
		Modelo para obtener las relaciones de la tabla relaciones
		con respecto de la APP
	****************************************************************/
	public function getRelationsRecipesByAppId($id_app)
	{
		$recetas = $this->getIdToRecipesFromAppId($id_app);	
		for ($i=0; $i <count($recetas) ; $i++) 
		{ 
			$query = $this->db->query("SELECT * FROM recetas_relacion where id_receta1 = ".$recetas[$i]['id']." or id_receta2 = ".$recetas[$i]['id']."  ");
			$relations[$i] = $query->row_array();
		}

		if(isset($relations))
		{
			for ($i=0; $i <count($relations) ; $i++) 
			{

				if(count($relations[$i])<=0)
				{
					array_splice($relations, $i, $i);
				}
			}
		
			if(count($relations[0])>0)
			{
				return $relations;
			}
		}

	}

	/***************************************************************
		Modelo para obtener la tabla de categorias
	****************************************************************/
	public function getCategoryByAppId($id_app)
	{
		$recetas = $this->getRecipesFromAppId($id_app);

		for ($i=0; $i <count($recetas) ; $i++) 
		{ 
			$categoriaAux[$i] = $recetas[$i]['id_categoria'];
		}

		if(isset($categoriaAux))
		{
			$categoria2 = array_unique($categoriaAux);

			foreach ($categoria2 as $key => $value) {

				$query 		= $this->db->query("SELECT id,nombre,color,orden FROM categoria WHERE id = ".$value." ");

				if(count($query->result())>0)
				{
					$categorias[] = $query->row_array();
				}	
			}
			return $categorias;
		}
	}

	/***************************************************************
		Modelo para obtener los datos de la APP
	****************************************************************/
	public function getDataAppByAppId($id_app)
	{
		$query = $this->db->query("SELECT * FROM app WHERE id= ".$id_app." ");

		$aux = $query->row_array();

		for ($i=0; $i <count($aux['id']) ; $i++) {

			$arreglo[$i]['nombre'] = $aux['nombre'];
		}

		return $arreglo;
	}

	/***************************************************************
		Modelo para obtener el glosario que se relaciona con una APP
	****************************************************************/
	public function getGlosaryFromAppId($id_app)
	{
		$recetas = $this->getRecipesFromAppId($id_app);

		$j=0;
		$total = count($recetas);

		for ($i=0; $i < $total; $i++) { 

			$query = $this->db->query("SELECT  id_receta,id_glosario FROM receta_glosario WHERE id_receta = ".$recetas[$i]['id']." ");
			
			$receta_glosario = $query->result();

			foreach ($receta_glosario as $key => $value) {

				$arreglo[$j] = $value->id_glosario;
				$j++;
			}
		}

		if(isset($arreglo))
		{
			$recetasId = array_unique($arreglo);

			$j=0;
			foreach ($recetasId as $key => $value) 
			{
				$idGlosario = $value;
				$query 	   = $this->db->query("SELECT id,nombre,descripcion,imagen FROM glosario WHERE id = ".$idGlosario."");
				$glosario[]  = $query->row_array();
			}	
		return $glosario;
		}
	}


	/***************************************************************
		Modelo para obtener las recetas contenidas en una APP
	
	****************************************************************/
	public function getRecipesFromAppId($id_app)
	{
		$query = $this->db->query('select * from recetas where id_app = '.$id_app.'');

		$i=0;
		foreach ($query->result()  as $value) 
		{
			$array[$i]['id'] 	       	= $value->id;
			$array[$i]['titulo'] 	  	= $value->titulo;
			$array[$i]['id_categoria'] 	= $value->id_categoria;
			$array[$i]['procedimiento'] = $value->procedimiento;
			$array[$i]['ingredientes'] 	= $value->ingredientes;
			$array[$i]['preparacion'] 	= $value->preparacion;
			$array[$i]['coccion'] 	  	= $value->coccion;
			$array[$i]['costo'] 		= $value->costo;
			$array[$i]['foto'] 			= $value->foto;
			$array[$i]['user_fav'] 		= $value->user_fav;
			$array[$i]['dificultad']	= $value->dificultad;
			$array[$i]['preparada']		= $value->preparada;

			$i++;
		}

		if(isset($array))
		{
			return $array;
		}

	}

	/***************************************************************
		Modelo para obtener las recetas  complementarias contenidas en
		una APP
	****************************************************************/
	public function getRecipesComplements($recetas)
	{
		for ($i=0; $i <count($recetas) ; $i++) 
		{ 
			$id = $recetas[$i]['id'];

			$query = $this->db->query("SELECT id_receta_complementaria FROM relaciones WHERE id_receta = ".$id." ");

			$relations = $query->result();

			foreach ($relations as $key => $value) 
			{
				
				$comple[] 		= $value->id_receta_complementaria;
			}

		}
		if(isset($comple))
		{
			$ordenado = array_unique($comple);

			$j=0;
			foreach ($ordenado as $key => $id_receta_complementaria) 
			{
				$query = $this->db->query("SELECT * FROM recetas_complementarias WHERE id = ".$id_receta_complementaria." ");

				$datos = $query->result();

				foreach ($datos as $key => $value) 
				{
					$correcto[$j]['id'] 		= $value->id;
					$correcto[$j]['titulo'] 	= $value->titulo;
					$correcto[$j]['contenido']	= $value->contenido;
					$j++;					
				}

			}

			if(isset($correcto)){ return $correcto; }
		}
	}
}
?>