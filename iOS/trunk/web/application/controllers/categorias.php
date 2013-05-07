<?php
class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('categoria_model');
		$this->load->model('App_model');
	}

	public function edit(){

		$id_app 		= $_POST['id_app'];
		$id				= $_POST['id'];
		$nombre 		= $_POST['nombre'];
		$color 			= $_POST['color'];
		
		$edit = $this->categoria_model->update_categoria($id, $nombre, $color);

		if($edit)
		{
			redirect(base_url()."categorias/view/".$id_app);
		}
	}

	public function view($id_app){

		$this->load->helper('url');

		$data['categorias'] = $this->categoria_model->get_categorias($id_app);
		
		$data['app']  	 = $id_app;

		$data['title'] = 'Aplicaciones de editorial Larousse';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/categorias', $data);
		$this->load->view('templates/footer');

	}

	public function create()
	{
		$id_app = $_POST['id_app'];
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');

		if ($this->form_validation->run() === FALSE){
			redirect(base_url().'categorias/view/'.$id_app, 'refresh');
		}
		else{
			 $this->categoria_model->set_categoria();
			 redirect(base_url().'categorias/view/'.$id_app, 'refresh');
		}
	}

	public function delete(){

		$this->load->helper('url');

		$id = $_POST['id'];

		$this->categoria_model->delete_recipe($id);

		redirect(base_url().'categorias/view/'.$_POST['id_app'], 'refresh');
	}

	public function searchByTitulo(){

		$titulo = $_POST['titulo'];
		$id_app = $_POST['id_app'];

		$categorias = $this->categoria_model->searchByTitulo($titulo, $id_app);

		for ($i=0; $i <count($categorias) ; $i++) 
		{ 
			echo "<tr>
                      <td class='txleft'>";
                        echo "<a href='".base_url().'categorias/view/'.$categorias[$i]['id']."' class='bluetext'>";
                          echo "".$categorias[$i]['nombre'].""; 
                        echo "</a>
                      </td>

                      <td>";
                        echo "<a href='#editarCategoria".$categorias[$i]['id']."'>
                          Editar
                        </a>
                      </td>

                      <td>";
                        echo "<a href='#eliminarCategoria".$categorias[$i]['id']."' class='eliminarRecetas'>
                          Eliminar
                        </a>
                      </td>

                  </tr>";
		}
	}

}
?>