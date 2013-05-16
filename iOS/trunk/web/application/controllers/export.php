
<?php

class export extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('export_model');
		$this->load->model('complementarias_model');
	}

	public function createTablesSQlite($BD)
	{
		$codigo_sqlRecetas 				= "CREATE TABLE IF NOT EXISTS recetas('id' int primary key, 'titulo' text , 'id_categoria' int , 'procedimiento' text , 'ingredientes' text , 'preparacion' int , 'coccion' int , 'costo' int , 'foto' text , 'user_fav' int , 'dificultad' int, 'preparada' int);";                                    
		$consultaRecetas				= $BD->prepare($codigo_sqlRecetas);                      
		$consultaRecetas 				-> execute(); 

		$codigo_sqlVideos   			= "CREATE TABLE IF NOT EXISTS videos ('id' int primary key, 'video' text, 'titulo' text)";
		$consultaVideos     			= $BD->prepare($codigo_sqlVideos);
		$consultaVideos 				-> execute();

		$codido_sqlVideosreceta 		= "CREATE TABLE IF NOT EXISTS videos_x_receta ('id' int primary key, 'id_video' int, 'id_receta' int)";
		$consultaRelacionVideosRecetas  = $BD->prepare($codido_sqlVideosreceta);
		$consultaRelacionVideosRecetas  -> execute();

		$codigo_sqlGlosario 			= "CREATE TABLE IF NOT EXISTS definiciones('id' int primary key, 'nombre' text, 'descripcion' text, 'imagen' text);";
		$consultaGlosario 				= $BD->prepare($codigo_sqlGlosario);                      
		$consultaGlosario 				-> execute(); 


		$codigo_sqlCategorias 			= "CREATE TABLE IF NOT EXISTS categorias('id' int primary key, 'nombre' text, 'color' text, 'orden' int);";
		$consultaCategorias 			= $BD->prepare($codigo_sqlCategorias);
		$consultaCategorias 			-> execute();

		$codigo_sqlConf = "CREATE TABLE IF NOT EXISTS configuracion('id' int primary key, 'nombre' text, 'valor' text);";
		$consultaConf = $BD->prepare($codigo_sqlConf);
		$consultaConf -> execute();

		$codigo_sqlRecetasRelacion = "CREATE TABLE IF NOT EXISTS complementarias_x_receta('id_receta' int , 'id_receta_complementaria' int);";
		$consultaRecetasRelacion = $BD->prepare($codigo_sqlRecetasRelacion);
		$consultaRecetasRelacion -> execute();


		$codigo_sqlRecetasComplementarias = "CREATE TABLE IF NOT EXISTS recetas_complementarias('id' int primary key, 'titulo' text, 'contenido' text);";
		$consultaRecetasComplementarias = $BD->prepare($codigo_sqlRecetasComplementarias);
		$consultaRecetasComplementarias -> execute();


		$codigo_sqlRecetasGlosario = "CREATE TABLE IF NOT EXISTS definiciones_x_receta('id' int primary key, 'id_receta' int, 'id_glosario' int);";
		$consultaRecetasGlosario = $BD->prepare($codigo_sqlRecetasGlosario);
		$consultaRecetasGlosario -> execute();

		$codigo_sqlApp = "CREATE TABLE IF NOT EXISTS app( 'nombre' text);";
		$consultaApp = $BD->prepare($codigo_sqlApp);
		$consultaApp -> execute();

	}

	public function insert($string ,$table, $BD)
	{
		$codigo_sqlMain = "INSERT INTO ".$table." VALUES(".$string.");";
		$consulta = $BD->prepare($codigo_sqlMain);
		//var_dump($BD);
		$consulta -> execute();
	}

	public function insertIntoTableSQlite($data,$table,$BD)
	{
		//var_dump($data);

		foreach ($data as $field=>$value) 
		{
			$x=0;
			$aux = "";

			$tamanio = count($value);

			foreach ($value as $campo => $val) 
			{
				$x++;

				if($x == $tamanio)
				{
					
					if(getType($val) == "string")
					{
						$aux .= "  '".$val."' ";
					}
					else
					{
						$aux .= "  ".$val;
					}
					
				}
				else
				{
					if(getType($val) == "string")
					{						
						$aux .= "  '".$val."' , "; 
					}
					else
					{
						$aux .= "  ".$val;
					}	 	
				}				
			}
			//var_dump($BD);
			$codigo_sqlMain = "INSERT INTO ".$table." VALUES(".$aux.")";
			//var_dump($codigo_sqlMain);
			$consulta = $BD-> prepare($codigo_sqlMain);
			//var_dump($consulta);
			$consulta -> execute();
			//$this->insert($aux, $table, $BD);
		}    
	}

	public function deleteBDIfExists($BD)
	{
		@unlink("resources/".$BD.".sqlite");
		@unlink("resources/".$BD.".db");
	}

	public function createDBSqlite($app)
	{
		$db = new PDO('sqlite:./resources/'.$app.'.sqlite');
		return $db;
	}

	public function create($app)
	{
		$recetas 			= $data['recetasByApp'] 		= $this->export_model->getRecipesFromAppId($app);
		$glosario 			= $data['glosarioByApp']		= $this->export_model->getGlosaryFromAppId($app);
		$application		= $data['application']    		= $this->export_model->getDataAppByAppId($app);
		$categoria 			= $data['categoria']      		= $this->export_model->getCategoryByAppId($app);
		$relaciones 		= $data['relacionesRecetas']    = $this->export_model->getRelationsRecetasToComplementarias($recetas);
		$recetasGlosario 	= $data['recetaGlosario']		= $this->export_model->getRelationRecipesAndGlosarioByAppId($app);
		$complementarias 	= $data['complementarias']		= $this->export_model->getRecipesComplements($recetas);
		$conf 				= $data['conf'] 				= $this->export_model->getConfByAppId($app);
		$videoByRecipe		= $data['videoRecipes']			= $this->export_model->getVideosByRecipe($recetas);
		$video 				= $data['video']    			= $this->export_model->getVideos($recetas);
		

		$this->deleteBDIfExists($app);

		$BD = $this->createDBSqlite($app);

		$this->createTablesSQlite($BD);
		
		if(isset($glosario)) 			{ $this->insertIntoTableSQlite($glosario,"definiciones",$BD);						}	
		if(isset($application)) 		{ $this->insertIntoTableSQlite($application,"app",$BD);								}
		if(isset($categoria))   		{ $this->insertIntoTableSQlite($categoria,"categorias",$BD); 						}
		if(isset($relaciones))   		{ $this->insertIntoTableSQlite($relaciones,"complementarias_x_receta",$BD);			}
		if(isset($recetasGlosario)) 	{ $this->insertIntoTableSQlite($recetasGlosario,"definiciones_x_receta",$BD);		}
		if(isset($recetas)) 			{ $this->insertIntoTableSQlite($recetas,"recetas",$BD); 							}
		if(isset($complementarias)) 	{ $this->insertIntoTableSQlite($complementarias,"recetas_complementarias",$BD);		}
		if(isset($conf))   				{ $this->insertIntoTableSQlite($conf,"configuracion",$BD);							}
		if(isset($videoByRecipe))		{ $this->insertIntoTableSQlite($videoByRecipe,"videos_x_receta",$BD);				}
		if(isset($video))				{ $this->insertIntoTableSQlite($video,"videos",$BD);								}
		

		$data['app'] = $app;

		

		$data['title'] = 'Recetario';
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/exportar', $data);
		$this->load->view('templates/footer');
	}
}

function clean($str) 
{
	return utf8_decode(trim ($str));
}


?>