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

}
?>
