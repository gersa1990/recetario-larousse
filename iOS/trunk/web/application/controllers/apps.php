<?php
class Apps extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('App_model');
		$this->load->model('categoria_model');
		$this->load->model('complementarias_model');
		$this->load->model('Glosario_model');
		$this->load->model('recetas_model');
		$this->load->model('video_model');
	}

	public function checkExistence(){

		$palabra = $_POST['palabra'];
		
		$existe  = $this->App_model->checkExistence($palabra);
		echo $existe;

	}

	public function index(){
		
		$data['apps'] = $this->App_model->get_apps();

		$this->load->helper('url');

		$data['title'] = 'Aplicaciones de editorial Larousse';
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/index', $data);
		$this->load->view('templates/footer');
	}

	public function updateCheckExistence(){

		$palabra 	= $_POST['palabra'];
		$id_app		= $_POST['id_app'];

		$existe = $this->App_model->updateCheckExistence($palabra, $id_app);
		echo $existe;


	}

	public function create(){
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');

		if ($this->form_validation->run() === FALSE){
			redirect(base_url());
		}
		
		else{

			$this->App_model->set_app();

		 	$this->load->helper('url');

			redirect(base_url());
		}
	}

	public function changeName(){

		$id_app = $_POST['app'];
		$nombre = $_POST['name'];
		$update = $this->App_model->changeName($id_app, $nombre);
	}

	public function nueva(){

		$nombre = $_POST['nombre'];
		$insert = $this->App_model->nueva($nombre);

		if ($insert) {

			redirect(base_url(),"refresh");
		}
	}

	public function edit()
	{
		$nombre = $_POST['nombre'];
		$idApp  = $_POST['id_app'];

		$update = $this->App_model->updateAppName($idApp, $nombre);

		if($update)
		{
			redirect(base_url(),"refresh");
		}		
	}

	public function view($id)
	{
		$data['recetas'] = $this->recetas_model->get_recetas($id);

		$data['apps'] = $this->App_model->get_apps($id);
		
		$data['app'] = $id;

		$data['categorias'] = $this->App_model->getCategoryFromAppId($id);

		$nombre = $data['name'] = $this->App_model->get_name($id);

		$this->load->helper('url');

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> recetas';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/recetas', $data);
		$this->load->view('templates/footer');
	}

	public function extendsDelete($id_app){

		$deleteGlosary = $this->Glosario_model->extendsDelete();
	}

	public function eliminar()
	{
		$id 		= $_POST['id'];

		$recetas = $this->recetas_model->getDataForExtendsDelete($id);

		$extendsDeleteGlosary 					= $this->Glosario_model->extendsDelete($recetas);
		$extendsDeleteGlosaryByIdApp 			= $this->Glosario_model->extendsDeleteByIdApp($id);
		$extendsDeleteCategoria					= $this->categoria_model->extendsDelete($id);
		$extendsDeleteVideos 					= $this->video_model->extendsDelete($recetas);
		$extendsDeleteVideosByIdApp 			= $this->video_model->extendsDeleteByIdApp($id);
		$extendsDeleteComplementarias 			= $this->complementarias_model->extendsDelete($recetas);
		$extendsDeleteComplementariasByIdApp	= $this->complementarias_model->extendsDeleteByIdApp($id);		

		$eliminar 	= $this->App_model->eliminar_app($id);
		
		redirect(base_url(), 'refresh');
		
	}
}
?>
