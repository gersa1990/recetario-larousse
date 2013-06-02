<?php

class Recetas extends CI_Controller {


	public function __construct(){
		
		parent::__construct();
		$this->load->model('recetas_model');
		$this->load->model('App_model');
		$this->load->model('categoria_model');
		$this->load->model('complementarias_model');
		$this->load->model('video_model');
		$this->load->model('glosario_model');
		$this->load->library('typography');
	}

	/***************************************************************
		Método para ver si el nombre de una receta no existe al tratar de 
		crearla en el sistema
	****************************************************************/
	public function checkExistence(){
		
		$palabra = $_POST['titulo'];
		$id_app  = $_POST['id_app'];
		$this->recetas_model->checkExistence($palabra, $id_app);
	}

	/***************************************************************
		Método para verificar si existe una receta con el nombre 
		seleccionado al tratar de editarla
	****************************************************************/
	public function updateCheckExistence(){
		
		$palabra 	= $_POST['titulo'];
		$id_app  	= $_POST['id_app'];
		$id_receta  = $_POST['id_receta'];

		$this->recetas_model->updateCheckExistence($palabra, $id_receta, $id_app);

	}

	/***************************************************************
		Método para obtener los datos de una receta
	****************************************************************/
	public function getData($id_receta){

		$data = $this->recetas_model->getData($id_receta);
		return $data;
	}

	/***************************************************************
		Método para relaionar una receta y mostrar sus datos
		en otra ventana
	****************************************************************/
	public function addComplementarias(){

		$data = array(
			'id_app' 		=> $_POST['id_app'],
			'titulo' 		=> $_POST['titulo'],
			'id_categoria'	=> $_POST['categoria'],
			'procedimiento'	=> $_POST['procedimiento'],
			'ingredientes'	=> $_POST['ingredientes'],
			'preparacion'	=> $_POST['preparacion'],
			'coccion' 		=> $_POST['coccion'],
			'costo' 		=> $_POST['costo'],
			'dificultad'	=> $_POST['dificultad'],
			'foto' 			=> $_POST['foto']
		);

		$id_receta = $this->recetas_model->createAndReturnId($data);
		redirect(base_url()."recetas/relations/".$id_receta."/".$_POST['id_app']);
	}

	/***************************************************************
		Método para obtener los datos de las recetas y las posibilidades
		de relacionarlas con videos, complementarias y glosario
	****************************************************************/
	public function relations($id_receta,$id_app){

		$data['app']   =  $id_app;

		$nombre = $data['name'] = $this->recetas_model->get_name($id_receta);

		$data['title'] = "Nueva Receta > ".$nombre[0]['titulo'] ;

		$data['recetas'] = $this->getData($id_receta);
	
		$data['complementarias'] = $this->complementarias_model->getRecetasComplementarias($id_app);
		$data['videos'] = $this->video_model->get_videos( $id_app);
		$data['glosario'] = $this->glosario_model->get_glosario($id_app);
		

		$this->load->view('templates/header', $data);
		$this->load->view('pages/relaciones', $data);
		$this->load->view('templates/footer');
	}

	/***************************************************************
		Método mostrar las opciones para dar de alta una nueva receta
	****************************************************************/
	public function nueva($id_app){

		$data['title'] = "Nueva Receta";

		$data['app']   =  $id_app;
		$data['categorias'] = $this->App_model->getCategoryFromAppId($id_app);

		$this->load->view('templates/header', $data);
		$this->load->view('pages/nuevaReceta', $data);
		$this->load->view('templates/footer');
	}

	/***************************************************************
		Método para buscar los datos de una receta con respecto a una palabra
		(Sistema de busqueda)
	****************************************************************/
	public function searchByName()
	{
		$nombre = $_POST['palabra'];
		$id_app = $_POST['id_app'];

		$result = $this->db->query("SELECT * FROM recetas WHERE titulo like '%".$nombre."%' and id_app = ".$id_app." ");

		$i=0;
		foreach ($result->result() as $key => $value) 
		{
			$arre[$i]['id'] 			= $value->id;
			$arre[$i]['titulo'] 		= $value->titulo;
			$arre[$i]['id_categoria'] 	= $value->titulo;
			$arre[$i]['id_app'] 		= $value->id_app;
			$i++;
		}

		if(isset($arre))
		{
			foreach ($arre as $key => $value) 
			{
				$id = $value['id'];

				echo "<tr><td class='txleft'>";
					echo "<a href='".base_url().'recetas/ver/'.$value['id']."/".$id_app."' class='bluetext'>".$value['titulo']."</a>";
				echo "</td>";
				echo "<td>";
					echo "<a href='#eliminarReceta".$id."'>Eliminar</a>";
				echo "</td></tr>";


			}
		}

	}


	/***************************************************************
		Método para crear una receta DEPRECATED
	****************************************************************/
	public function create()
	{
		$app = $_POST['id_app'];

		$insert = $this->recetas_model->create();

		if($insert)
		{
			redirect(base_url()."apps/view/".$app,"refresh");
		}
	}

	/***************************************************************
		Método para eliminar una receta y todas sus relaciones
	****************************************************************/
	public function delete(){

		$id 	= $_POST['id'];
		$app 	= $_POST['id_app'];

		$delete = $this->recetas_model->delete($id);

		$recetas = $this->recetas_model->getDataForExtendsDelete($id);

		//Eliminar las relaciones de glosario con las recetas
		$this->glosario_model->extendsDelete($recetas);
		//Eliminar las relaciones de videos con las recetas
		$this->video_model->extendsDelete($recetas);
		//Eliminar las relaciones de recetas complementarias con las recetas
		$this->complementarias_model->extendsDelete($recetas);

		if($delete)
		{
			redirect(base_url()."apps/view/".$app);
		}
	}
	
	/***************************************************************
		Método para editar una receta
	****************************************************************/
	public function edit()
	{
		$id 		   	= $_POST['id'];

		@$data->titulo			= @$_POST['titulo'];
		$data->id_app 			= $_POST['id_app'];
		$data->id_categoria 	= $_POST['categoria'];
		$data->dificultad  		= $_POST['dificultad'];
		$data->procedimiento 	= $_POST['procedimiento'];
		$data->ingredientes 	= $_POST['ingredientes'];
		$data->preparacion  	= $_POST['preparacion'];
		$data->coccion 			= $_POST['coccion'];
		$data->costo 			= $_POST['costo'];
		$data->foto 			= $_POST['foto'];

		$update = $this->recetas_model->update($data, $id);

		if($update)
		{
			redirect(base_url()."apps/view/".$_POST['id_app'],"refresh");
		}
	}

	/***************************************************************
		Método para ver todo acerca de une receta
	****************************************************************/
	public function ver($id, $id_app)
	{

		$receta = $data['receta'] = $this->recetas_model->get_receta($id);
	
		$data['app'] = $id_app;

		$data['categorias'] = $this->App_model->getCategoryFromAppId($id_app);

		$nombre = $data['name'] 				= $this->App_model->get_name($id_app);
		$data['glosarioRelacionado']			= $this->glosario_model->getGlosarioRelacionado($id,$id_app);
		$data['videosRelacionados']				= $this->video_model->getVideosRelacionados($id,$id_app);
		$data['complementariasRelacionadas']	= $this->complementarias_model->getcomplementariasRelacionadas($id, $id_app);

		$data['glosarioComplemento'] = $this->glosario_model->getComplemento($id_app, $id);
  		$data['recetasComplemento'] = $this->complementarias_model->getComplemento($id_app, $id);
  		$data['videosComplemento'] = $this->video_model->getComplemento($id_app, $id);

		$this->load->helper('url');

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> recetas > '.$receta[0]['titulo'];
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/ver', $data);
		$this->load->view('templates/footer');
	}
}
?>