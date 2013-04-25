<?php

class Complementarias extends CI_Controller 
{


	public function __construct(){
		parent::__construct();
		
		$this->load->model('complementarias_model');
		$this->load->model('App_model');
	}

	public function view($id_app)
	{
		$data['title'] = 'Recetario';

		$data['recetas_complementarias'] = $this->complementarias_model->getRecetasComplementarias($id_app);

		$this->load->helper('url');

		$data['apps'] = $this->App_model->get_apps($id_app);
		
		$data['app']  	 = $id_app;

		$this->load->view('templates/header', $data);
		$this->load->view('pages/complementariasShow', $data);
		$this->load->view('templates/footer');
	}

	public function addComplementariasToRelation($id_receta, $complementaria, $app)
	{
		$relation = $this->complementarias_model->addComplementariasToRelation($id_receta,$complementaria);
		
		if($relation)
		{
			redirect(base_url()."recetas/relationships/".$app."/".$id_receta,"refresh");
		}
	}

	public function eliminarRelacion($app, $id_receta_complementaria, $id_receta)
	{
		$deleteRelation =  $this->complementarias_model->deleteRelationRecipeToRecipecomplements($id_receta, $id_receta_complementaria);
		
		if($deleteRelation)
		{
			redirect(base_url()."recetas/relationships/".$app."/".$id_receta,"refresh");
		}
	}

	public function searchToAddRelation()
	{
		$id  = $_POST['id'];
		$app = $_POST['application'];

		$complementarias = $this->complementarias_model->searchComplementsToAddRelationToRecetas($id);
		

		echo "<table>";
			echo "<thead><tr><td>Titulo</td><td>Contenido</td><td>Opciones</td></tr><thead>";
			echo "<tbody>";
				for ($i=0; $i < count($complementarias); $i++) 
				{ 
					echo "<tr><td>".$complementarias[$i]['titulo']."</td><td>".$complementarias[$i]['contenido']."</td><td><a href='".base_url()."complementarias/addComplementariasToRelation/".$id."/".$complementarias[$i]['id']."/".$app."'>Agregar</a></td></tr>";
				}
			echo "</tbody>";
		echo "</table>";

	}

	public function searchRecipesComplementsByTittle()
	{
		$relation = $this->complementarias_model->searchRecipesComplementsByTittle();

		if(count($relation)>0)
		{
			echo "Encontrado";
		}
		else
		{
			echo "Null";
		}

	}

	public function modificar()
	{
		$update = $this->complementarias_model->updateRecetasComplementarias();
		if($update)
		{
			redirect(base_url()."complementarias/show/","refresh");
		}	
	}

	public function eliminar()
	{
		$eliminar = $this->complementarias_model->deleteRecetasComplementarias();

		if($eliminar)
		{
			redirect(base_url()."complementarias/show/","refresh");
		}
		
	}
	
}

?>