<?php
class Apps extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('app_model');
		$this->load->model('categoria_model');
		$this->load->model('complementarias_model');
		$this->load->model('glosario_model');
		$this->load->model('recetas_model');
		$this->load->model('video_model');
	}

	//Metodo que verifica que no exista una aplicación con el mismo nombre que la que intentas crear
	public function checkExistence(){

		$palabra = $_POST['palabra'];
		$this->app_model->checkExistence($palabra);
	}

	//Metodo principal para mostrar las aplicaciones actuales y las opciones de cada una de ellas
	public function index(){
		
		$data['apps'] = $this->app_model->get_apps(); //Método que obtiene todas las apps.
		$this->load->helper('url');
		$data['title'] = 'Aplicaciones de editorial Larousse';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/index', $data);
		$this->load->view('templates/footer');
	}

	//Método que verifica que no exista una aplicación con el mismo nombre, que la que intentas editar
	public function updateCheckExistence(){

		$palabra 	= $_POST['palabra'];
		$id_app		= $_POST['id_app'];
		$this->app_model->updateCheckExistence($palabra, $id_app);
	}

	//Método que crea la Aplicación en la base de datos.
	public function create(){
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');

		if ($this->form_validation->run() === FALSE){
			redirect(base_url());
		}
		
		else{
			$this->app_model->set_app(); //Dar de alta en la BD
		 	$this->load->helper('url');
			redirect(base_url());
		}
	}

	//Método que crea la aplicación en la BD
	public function nueva(){

		$nombre = $_POST['nombre'];
		$insert = $this->app_model->nueva($nombre); //Dar de alta en la BD

		if ($insert) {

			redirect(base_url(),"refresh");
		}
	}

	//Método que edita la aplicación en la BD
	public function edit()
	{
		$nombre = $_POST['nombre'];
		$idApp  = $_POST['id_app'];

		$update = $this->app_model->updateAppName($idApp, $nombre); //Editar el nombre de la APP

		if($update){

			redirect(base_url(),"refresh");
		}		
	}

	//Método para ver las carácteristicas de una APP en especifico
	public function view($id)
	{
		$data['recetas'] = $this->recetas_model->get_recetas($id); //Obtiene las recetas por id de APP
		$data['apps'] = $this->app_model->get_apps($id); //Obtiene los datos del APP seleccionada
		$data['app'] = $id; // Crea una variable llamada app
		$data['categorias'] = $this->app_model->getCategoryFromAppId($id); //Obtienes las categorias de la APP seleccionada
		$nombre = $data['name'] = $this->app_model->get_name($id); //Obtienes el nombre de la APP

		$this->load->helper('url');

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> recetas';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/recetas', $data);
		$this->load->view('templates/footer');
	}

	//Método para garantizar la eliminación en cascada
	public function extendsDelete($id_app){

		$deleteGlosary = $this->glosario_model->extendsDelete();
	}


	// Método para eliminar la APP seleccionada y todos los datos referentes a está
	public function eliminar(){

		$id = $_POST['id'];

		$recetas = $this->recetas_model->getDataForExtendsDelete($id);
		$this->glosario_model->extendsDelete($recetas);    		//Eliminar las relaciones de glosario correspondientes a la APP
		$this->glosario_model->extendsDeleteByIdApp($id);  		//Eliminar los glosarios de la APP  
		$this->categoria_model->extendsDelete($id);		   		//Eliminar las categorias de la APP
		$this->video_model->extendsDelete($recetas);	   		//Eliminar los videos de la APP
		$this->video_model->extendsDeleteByIdApp($id);			//Eliminar las relaciones de videos correspondientes a la APP
		$this->complementarias_model->extendsDelete($recetas);  //Eliminar las recetas complementarias de la APP
		$this->complementarias_model->extendsDeleteByIdApp($id);//Eliminar las relaciones de complementarias correspondientes a la APP		
		$eliminar 	= $this->app_model->eliminar_app($id);      //Eliminar la APP
		
		redirect(base_url(), 'refresh');
	}

	public function nuevaApp(){
		echo "
			<div id='status'>
				<div id='' class='alert error'>Este nombre de aplicación ya existe</div>
			</div>
			<div id='ventana-header'>
				<h2>Nueva aplicación</h2>
				<a class='modal_close' href='#'></a>
			</div>
			".validation_errors()."
      		".form_open('apps/nueva/')."
				<div class='txt-fld'>
					<label for=''>Nombre: </label>
					<input type='text' id='nombre' name='nombre' value='' required>
				</div>
				<div class='btn-fld'>
					<button type='submit' id='submitNuevaApp'>Agregar</button>
				</div>
			</form>";
	}

	public function getApp($id_app){

		$resultado = $this->app_model->get_apps($id_app);

	echo "<div id='status'>
				<div id='errorEditarApp' class='alert error'>Este nombre de aplicación ya existe</div>
			</div>

			<div id='ventana-header'>
				<h2>Editar</h2>
				<a class='modal_close' href='#'></a>
			</div>".form_open('apps/edit/')."
				<input type='hidden' name='id_app' id='id_app' value='".$resultado['id']."'>
				<div class='txt-fld'>
					<label for=''>Nombre: </label>
					<input type='text' id='nombre2' name='nombre' value='".$resultado['nombre']."' required>
				</div>
				<div class='btn-fld'>
					<button type='submit' id='submitEditarApp'>Guardar</button>
				</div>
			</form>";
	}

	public function getAppDelete($id_app){
		$resultado = $this->app_model->get_apps($id_app);

		echo "<div id='ventana-header'>
				<h2>Eliminar</h2>
				<p>Toda la información relacionada sera borrara</p>
				<a class='modal_close' href='#'></a>
			</div>".validation_errors()."".form_open('apps/eliminar')."
				<input type='hidden' name='id' id='id' value='".$resultado['id']."'>
				<div class='txt-fld'>
					<h2>".$resultado['nombre']."</h2>
				</div>
				<div class='btn-fld'>
					<button type='submit' id='submitEditarApp'>Eliminar</button>
				</div>
			</form>";
	}
}
?>