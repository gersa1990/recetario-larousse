<?php

class Recetas extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('recetas_model');
		$this->load->model('App_model');
		$this->load->model('categoria_model');
		$this->load->model('complementarias_model');
		$this->load->model('video_model');
		$this->load->library('typography');
		$this->load->model('glosario_model');
	}

	public function getData($id_receta){

		$data = $this->recetas_model->getData($id_receta);
		return $data;

	}

	public function addComplementarias(){

		$data = array(
			'id_app' 		=> $_POST['id_app'],
			'titulo' 		=> $_POST['titulo'],
			'id_categoria'	=> $_POST['categoria'],
			'procedimiento'	=> $this->typography->auto_typography($_POST['procedimiento']),
			'ingredientes'	=> $this->typography->auto_typography($_POST['ingredientes']),
			'preparacion'	=> $_POST['preparacion'],
			'coccion' 		=> $_POST['coccion'],
			'costo' 		=> $_POST['costo'],
			'dificultad'	=> $_POST['dificultad'],
			'foto' 		=> $_POST['foto']
		);

		$id_receta = $this->recetas_model->createAndReturnId($data);

		redirect(base_url()."recetas/relations/".$id_receta."/".$_POST['id_app']);

	}

	public function relations($id_receta,$id_app){

		$data['categorias'] = $this->App_model->getCategoryFromAppId($id_app);

		$data['title'] = "Nueva Receta";

		$data['app']   =  $id_app;
		$data['recetas'] = $this->getData($id_receta);

		$data['complementariasRelacionadas'] 		 = $this->complementarias_model->getcomplementariasRelacionadas($id_receta, $id_app);
		$videos = $data['videosRelacionados'] 		 = $this->video_model->getVideosRelacionados($id_receta, $id_app);
		$data['glosarioRelacionado'] 	 			 = $this->glosario_model->getGlosarioRelacionado($id_receta, $id_app);

		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/recetasComplementariasAdd', $data);
		$this->load->view('templates/footer');
	}

	public function nueva($id_app){

		$data['title'] = "Nueva Receta";

		$data['app']   =  $id_app;
		$data['categorias'] = $this->App_model->getCategoryFromAppId($id_app);

		$this->load->view('templates/header', $data);
		$this->load->view('pages/recetasShow', $data);
		$this->load->view('templates/footer');
	}

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
					echo "<a href='".base_url().'recetas/view/'.$value['id']."' class='bluetext'>".$value['titulo']."</a>";
				echo "</td><td><a href='".base_url().'recetas/edit/'.$value['id']."'>Editar</a></td>";
				echo "<td>";
					echo "<a href='#eliminarReceta".$id."'>Eliminar</a>";
				echo "</td></tr>";


			}
		}

	}



	public function eliminar(){

		$id_receta = $_POST['id'];
		$app 	   = $_POST['app'];

		$delete    = $this->recetas_model->eliminar($id_receta); 

		if($delete)
		{
			redirect(base_url()."apps/view/".$app);
		}
	}
	

	public function index()
	{
		//$data['recetas'] = $this->recetas_model->get_recetas();
		
		$data['apps'] = $this->App_model->get_apps();

		$this->load->helper('url');

		$data['title'] = 'Aplicaciones de editorial Larousse';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/index', $data);
		$this->load->view('templates/footer');
	}



	public function create()
	{
		$app = $_POST['id_app'];

		$insert = $this->recetas_model->create();

		if($insert)
		{
			redirect(base_url()."apps/view/".$app,"refresh");
		}
	}

	public function delete(){

		$id 	= $_POST['id'];
		$app 	= $_POST['id_app'];

		$delete = $this->recetas_model->delete($id);

		if($delete)
		{
			redirect(base_url()."apps/view/".$app);
		}
	}
	

	public function edit()
	{

		$id 		   	= $_POST['id'];

		$data->titulo			= $_POST['titulo'];
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
			redirect(base_url()."recetas/ver/".$id."/".$_POST['id_app'],"refresh");
		}
	}

	public function ver($id, $id_app)
	{
		$receta = $data['receta'] = $this->recetas_model->get_receta($id);
	
		$data['app'] = $id_app;

		$data['categorias'] = $this->App_model->getCategoryFromAppId($id_app);

		$nombre = $data['name'] = $this->App_model->get_name($id_app);

		$this->load->helper('url');

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> recetas > '.$receta[0]['titulo'];
		$this->load->view('templates/header', $data);
		$this->load->view('pages/ver', $data);
		$this->load->view('templates/footer');
	}


	public function updateR($app = FALSE, $id)
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$id = $this->input->post('id');

		$this->form_validation->set_rules('titulo', 'Título', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			echo "No valido";
		}
		else
		{			
			$actualizar = $this->recetas_model->update_recetas($id);
			
			if($actualizar)
		 	{
                redirect(base_url()."recetas/modificar/".$id."/".$app, 'refresh');
         	}
		}      
	}
}

?>