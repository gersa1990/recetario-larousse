<?php
class Apps extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('App_model');
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

	public function nueva(){

		$nombre = $_POST['nombre'];
		$insert = $this->App_model->nueva($nombre);

		if ($insert) {
			redirect(base_url(),"refresh");
		}

	}

	public function newapp()
	{
		$data['title'] = 'Recetario Larousse';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/nuevaApp', $data);
		$this->load->view('templates/footer');
	}

	public function updateNombre()
	{
		$nombre = $_POST['nombre'];
		$idApp  = $_POST['id_app'];

		$update = $this->App_model->updateAppName($idApp, $nombre);

		if($update)
		{
			redirect(base_url()."apps/view/".$idApp,"refresh");
		}		
	}

	public function view($id)
	{
		$data['recetas'] = $this->recetas_model->get_recetas($id);

		$data['apps'] = $this->App_model->get_apps($id);
		
		$data['app']  	 = $id;

		$data['categorias'] = $this->App_model->getCategoryFromAppId($id);

		$this->load->helper('url');

		$data['title'] = 'Recetario';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/recetas', $data);
		$this->load->view('templates/footer');
	}

	public function modificar(){

		$this->load->helper('url');

		$id = $this->input->post('id');

		$data['apps_item'] = $this->App_model->get_apps($id);

		if (empty($data['apps_item'])){
			show_404();
		}
		
		$nombre = $this->input->post('nombre');

		$actualizar = $this->App_model->update_categoria($id, $nombre);

		if($actualizar){
                redirect(base_url(), 'refresh');
        }
	}

	public function eliminar()
	{
		$id 		= $_POST['id'];
		$eliminar 	= $this->App_model->eliminar_app($id);

		redirect(base_url(), 'refresh');
		
	}

}
?>
