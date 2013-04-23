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

	public function eliminarRelacion($app, $id1 , $id2)
	{
		$delete = $this->recetas_model->deleteRelation($id1,$id2);
		redirect(base_url().'recetas/relationships/'.$app."/".$id2.'', 'refresh');
	}

	public function view($id, $app=FALSE)
	{

		$this->load->helper('url');

		$data['glosarioByRecipe'] = $this->recetas_model->getGlosarioByRecipe($id);

		if(isset($app))
		{
			$data['recetas_item'] = $this->recetas_model->get_recetas2($app,$id);	
		}
		else
		{
			$data['recetas_item'] = $this->recetas_model->get_recetas($id);
		}
		
		$data['app'] = $app;
		$data['relations'] = $this->complementarias_model->getRelationsRecetasToComplementarias($id);

		if (empty($data['recetas_item'])){
			show_404();
		}

		$recetas = $data['videoReceta'] = $this->video_model->getVideosByRecipe($id);

		$data['title'] = $data['recetas_item']['titulo'];
		$this->load->view('templates/headerView', $data);
		$this->load->view('pages/view', $data);
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

			redirect(base_url().'recetas/relationships/'.$app."/".$id.'', 'refresh');
		}
	}

	public function getRecipeToRelation($id,$app)
	{
		$titulo = $_POST['text'];
		$recetas = $this->recetas_model->get_recetasBySearch($titulo,$id,$app);

		if(count($recetas)>0)
		{	
			for ($i=0; $i < count($recetas) ; $i++) 
			{
				echo "<h3 class='idRecipe' id='id_".$recetas[$i]['id']."'>".$recetas[$i]['titulo'].",
						<input class='RecipeRelation' type='button' id='".$recetas[$i]['id']."' value='Relacionar'>
					  </h3>";
			}
		}
		else
		{
			echo "No se encontro";
		}
	}

	public function addRelationShip()
	{
		$id1 = $_POST['ID1'];
		$id2 = $_POST['ID2'];

		$relation = $this->recetas_model->updateRelationRecipe($id1,$id2);
		$data = $this->recetas_model->getDataByRelation($id1);
		
		echo "<tr>
					<td> ".$data['titulo']." </td>
					<td> ".$data['costo']." </td>
					<td> ".$data['preparacion']." </td>
					<td> ".$data['ingredientes']." </td>
					<td> ".$data['coccion']." </td>
				</tr>";
	}

	public function complementarias()
	{
		$data['title'] = 'Agregar Relaciones de Recetas';
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/complementarias', $data);
		$this->load->view('templates/footer');	
	}

	public function relationships($app,$id)
	{

		$data['app'] = $app;

		$this->load->library('javascript');
		$data['recetas']   = $this->recetas_model->get_recetasById($id);

		$data['title'] = 'Agregar Relaciones de Recetas';

		$data['relations'] = $this->complementarias_model->getRelationsRecetasToComplementarias($id);

		$this->load->view('templates/header', $data);
		$this->load->view('pages/relaciones', $data);
		$this->load->view('templates/footer');
	}

	public function eliminar($id, $app = FALSE){
		$this->load->helper('url');

		$this->recetas_model->delete_recipe($id);

		redirect(base_url()."apps/view/".$app, 'refresh');
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