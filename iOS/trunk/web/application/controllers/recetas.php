<?php

class Recetas extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('recetas_model');
		$this->load->model('App_model');
		$this->load->model('categoria_model');
		$this->load->model('complementarias_model');
		$this->load->model('video_model');
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
				echo "<tr><td>";
					echo $value['titulo'];
				echo "</td>";
				echo "<td>";
					echo "<a href='eliminarReceta".$id."'>Eliminar</a>";
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
	

	public function  complementariaCreate()
	{
		$id = $this->recetas_model->createRecetasComplementarias();

		if($id)
		{
			redirect(base_url(),"refresh");
		}
	}

	public function index()
	{
		$data['recetas'] = $this->recetas_model->get_recetas();
		
		$data['apps'] = $this->App_model->get_apps();

		$this->load->helper('url');

		$data['title'] = 'Recetario';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/index', $data);
		$this->load->view('templates/footer');
	}

	public function modificar($id,$app)
	{

		$data['recetas_item'] = $this->recetas_model->get_recetas2($app,$id);
		$data['app']  =  $app;
		
		$data['relations'] = $this->complementarias_model->getRelationsRecetasToComplementarias($id);

		$data['glosarioByRecipe'] = $this->recetas_model->getGlosarioByRecipe($id);		

		$data['title'] = $data['recetas_item']['titulo'];

		

		$data['videoReceta'] = $this->video_model->getVideosByRecipe($id);

		$this->load->view('templates/header', $data);
		$this->load->view('pages/modificar', $data);
		$this->load->view('templates/footer');
	}

	public function agregar($app = FALSE)
	{
		$data['app'] = $app;
		$data['apps'] = $this->App_model->get_apps();
		$data['categorias'] = $this->categoria_model->get_categorias();

		$this->load->helper('url');

		$data['title'] = 'Nueva receta';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/agregar', $data);
		$this->load->view('templates/footer');
	}

	public function create($app){

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$data['title'] = 'Nueva Receta';

		$this->form_validation->set_rules('titulo', 'Título', 'required');

		if ($this->form_validation->run() === FALSE){
			redirect(base_url()."agregar");
		}else{
			$id = $this->recetas_model->set_recetas();

			redirect(base_url().'apps/view/'.$app, 'refresh');
		}
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