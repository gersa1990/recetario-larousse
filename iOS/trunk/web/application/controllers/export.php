
<?php

class export extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('export_model');
		//$this->load->model('complementarias_model');
	}

	/***************************************************************
		Método para crear las tablas que contendran las tablas necesarias
		para poder guardar los datos de la exportación
	****************************************************************/
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

	/***************************************************************
		Método para recorrer los arreglos y formar cadenas de valores
		que serán insertados en una tabla especificada
	****************************************************************/
	public function insertIntoTableSQlite($data,$table,$BD)
	{

		foreach ($data as $field=>$value) 
		{
			$x=0;
			$aux = "";

			$tamanio = count($value);

			foreach ($value as $campo => $val) 
			{
				$x++;

				if($x == $tamanio) //Evalua si ya se llego al final del arreglo para cerrar la cadena de valores
				{
					
					if(getType($val) == "string")  //Si es una cadena el dato se crea con tipografía de String
					{
						$aux .= "  '".$val."' ";
					}
					else //Si no es una cadena es un numero y simplemente se agrega a la cadena de valores
					{
						$aux .= "  ".$val;
					}
					
				}
				else //Mientras no llegue al final del arreglo entra en esta opción
				{
					if(getType($val) == "string") //Si es un String el dato entra aqui
					{						
						$aux .= "  '".$val."' , "; 
					}
					else
					{
						$aux .= "  ".$val; //Si no es un String es un numero
					}	 	
				}				
			}

			$codigo_sqlMain = "INSERT INTO ".$table." VALUES(".$aux.")";  //Se crea la cadena de datos para insertarse
			$consulta = $BD-> prepare($codigo_sqlMain); //Se convierte la consulta a un objeto capaz de ser ingresado en un objeto PDO
			$consulta -> execute(); //Se ejecuta la consulta y se ingresan los datos en la tabla seleccionada
		}    
	}

	/***************************************************************
		Método para eliminar la base de datos en caso de que exista
	****************************************************************/
	public function deleteBDIfExists($BD)
	{
		@unlink("resources/DB/larousse.db");
	}

	/***************************************************************
		Método para crear una base de datos de tipo sqlite3
		siempre se llamará larousse.db
	****************************************************************/
	public function createDBSqlite($app)
	{
		$db = new PDO('sqlite:./resources/DB/larousse.db');
		return $db;
	}

	/***************************************************************
		Método para crear toda la estructura y los arreglos correspondientes
		para que se llenen los datos de las tablas
	****************************************************************/
	public function create($app)
	{
		//Se obtienen las recetas de la APP
		$recetas 			= $data['recetasByApp'] 		= $this->export_model->getRecipesFromAppId($app);
		//Se obtiene el glosario de la APP
		$glosario 			= $data['glosarioByApp']		= $this->export_model->getGlosaryFromAppId($app);
		//Se obtienen los datos de la aplicación
		$application		= $data['application']    		= $this->export_model->getDataAppByAppId($app);
		//Se obtienen las categorias de la APP
		$categoria 			= $data['categoria']      		= $this->export_model->getCategoryByAppId($app);
		//Se obtienen las relaciones de las recetas que tenemos en nuestra APP
		$relaciones 		= $data['relacionesRecetas']    = $this->export_model->getRelationsRecetasToComplementarias($recetas);
		//Se obtienen las relaciones del glosario con respecto a nuestra APP
		$recetasGlosario 	= $data['recetaGlosario']		= $this->export_model->getRelationRecipesAndGlosarioByAppId($app);
		//Se obtienen las recetas complementarias de nuestra APP
		$complementarias 	= $data['complementarias']		= $this->export_model->getRecipesComplements($recetas);
		//Se obtienen los datos de configuración de nuestra APP
		$conf 				= $data['conf'] 				= $this->export_model->getConfByAppId($app);
		//Se obtienen las relaciones de videos con respecto a las recetas de nuestra APP
		$videoByRecipe		= $data['videoRecipes']			= $this->export_model->getVideosByRecipe($recetas);
		//Se obtienen los videos de nuestra receta
		$video 				= $data['video']    			= $this->export_model->getVideos($recetas);
		

		$this->deleteBDIfExists($app); //Se llama al método para eliminar la BD existente

		$BD = $this->createDBSqlite($app); //Se crea una nueva BD

		$this->createTablesSQlite($BD); //Se crean todas las tablas contenedoras de la información obtenida
		
		/***************************************************************
			Método para llenar las tablas con los datos recopilados
		****************************************************************/
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
?>