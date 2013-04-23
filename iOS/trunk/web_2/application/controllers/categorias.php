<?php
class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('categoria_model');
	}

	public function index(){
		$data['categorias'] = $this->categoria_model->get_categorias();

		$this->load->helper('url');

		$data['title'] = 'Categorias';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/categorias', $data);
		$this->load->view('templates/footer');
	}

	public function create(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');

		if ($this->form_validation->run() === FALSE){
			redirect(base_url().'categorias/index', 'refresh');
		}
		else{
			 $this->categoria_model->set_categoria();
			 redirect(base_url().'categorias/index', 'refresh');
		}
	}

	public function eliminar($id){
		$this->load->helper('url');

		$this->categoria_model->delete_recipe($id);

		redirect(base_url().'categorias/index', 'refresh');
	}

	public function modificar(){

		$this->load->helper('url');

		$id = $this->input->post('id');

		$data['c_item'] = $this->categoria_model->get_categorias($id);

		if (empty($data['c_item'])){
			show_404();
		}
		
		$nombre = $this->input->post('nombre');
		$color = $this->input->post('color');

		$actualizar = $this->categoria_model->update_categoria($id, $nombre, $color);

		if($actualizar){
               redirect(base_url().'categorias/index', 'refresh');
        }
	}

}
?>