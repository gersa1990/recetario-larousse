<?php
class Glosario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Glosario_model');
	}

	public function create()
	{

		$id = $this->input->post('id');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$idGlosario = $this->Glosario_model->add_glosario();

		$this->relationWordGlosario($id,$idGlosario);

		redirect(base_url()."view/".$id);	
	}

	public function creates()
	{

		$id = $_POST['identificador'];

		

		$idGlosario = $this->Glosario_model->add_glosario2();
		

		$this->relationWordGlosario($id,$idGlosario);

		//redirect(base_url()."view/".$id);	
		
	}

	public function delete($id)
	{
		$this->Glosario_model->deleteGlosario($id);
	}

	public function getRecipes()
	{
		$titulo = $_POST['text'];

		$recetas = $this->Glosario_model->get_recetasBySearch($titulo);

		if(count($recetas)>0)
		{	
			for ($i=0; $i < count($recetas) ; $i++) 
			{
				echo "<h3 class='idRecipe' id='recipe_".$recetas[$i]['id']."'>".$recetas[$i]['titulo']."
						<input class='buttonRecipe' type='button' id='".$recetas[$i]['id']."' value='Ver Glosario'>
					  </h3>";
			}
		}
		else
		{
			echo "No se encontro";
		}
	}

	public function getGlosarioByRecipe()
	{
		$id = $_POST['identificador'];

		$glosarioByRecipe 	= $this->Glosario_model->getGlosarioByRecipe($id);
		
		$i=0;
		foreach ($glosarioByRecipe->result() as $row2)
		{
			
				$Array[$i]['id'] = $row2->id;	
				$Array[$i]['nombre'] = $row2->nombre;
				$Array[$i]['descripcion'] = $row2->descripcion;	
				$Array[$i]['imagen'] = $row2->imagen;
				$i++;				
			
		}

		if(isset($Array))
		{
			echo "<table class='lista' align='center'>";
				echo "<thead>";
					echo "<tr>";
						echo "<td>Nombre</td>";
						echo "<td>Descripcion</td>";
						echo "<td>Imagen</td>";
						echo "<td>Opciones</td>";
					echo "<tr>";
				echo "</thead>";

				echo "<tbody>";
			for ($i=0; $i < count($Array) ; $i++) 
			{
				echo "<tr id='".$Array[$i]['id']."'>";
					echo "<td>".$Array[$i]['nombre']."</td>";
					echo "<td>".$Array[$i]['descripcion']."</td>";
					echo "<td>".$Array[$i]['imagen']."</td>";
					echo "<td><button class='EliminarGlosario' id='".$Array[$i]['id']."''>Eliminar</button></td>";
				echo "</tr>";
			}	
				echo "</tbody>";
			echo "</table><br/><br/>";

			echo "<form class='newWordToGlosary' id='newWordToGlosary' method='post' action='".base_url()."glosario/creates'>
					<fieldset>
						<legend>Agrega su glosario</legend>
							<center>Nombre</br><input type='text' class='input' name='palabra' id='palabra' placeholder='Nombre' required>
							<input type='hidden' name='id' id='id' placeholder='id' value='".$id."'></center>
							<center>Descripción</br><input type='text' class='input' name='definicion' id='definicion' placeholder='Descripcion' value='' required></center>
							<center>Imagen</br><input type='text' class='input' name='imgGlosario' id='imgGlosario' placeholder='Imagen' value='' required></center>
							<center><input type='submit' name='submitWordToGlosary' id='submitWordToGlosary' value='Agregar'></center>
					</fieldset>
				   </form>";

							
		}
		else
		{
			echo "Null";
		}

		

	}

	public function getGlosarioByRecipe2()
	{
		$id = $_POST['identificador'];

		$glosarioByRecipe 	= $this->Glosario_model->getGlosarioByRecipe2($id);
		
		$i=0;
		foreach ($glosarioByRecipe->result() as $row2)
		{
			
				$Array[$i]['id'] = $row2->id;	
				$Array[$i]['nombre'] = $row2->nombre;
				$Array[$i]['descripcion'] = $row2->descripcion;	
				$Array[$i]['imagen'] = $row2->imagen;
				$i++;				
			
		}

		if(isset($Array))
		{
		
			echo "<table class='lista' align='center'>";
				echo "<thead>";
					echo "<tr>";
						echo "<td>Nombre</td>";
						echo "<td>Descripcion</td>";
						echo "<td>Imagen</td>";
						echo "<td>Opciones</td>";
					echo "<tr>";
				echo "</thead>";

				echo "<tbody>";
			for ($i=0; $i < count($Array) ; $i++) 
			{
				echo "<tr>";
					echo "<td>".$Array[$i]['nombre']."</td>";
					echo "<td>".$Array[$i]['descripcion']."</td>";
					echo "<td>".$Array[$i]['imagen']."</td>";
					echo "<td><a href='glosario/delete/".$Array[$i]['id']."'>Eliminar</a></td>";
				echo "</tr>";
			}	
				echo "</tbody>";
			echo "</table><br/><br/>";

			echo "<form class='newWordToGlosary' id='newWordToGlosary' method='post' action='".base_url()."glosario/creates'>
					<fieldset>
						<legend>Agrega su glosario</legend>
							<center>Nombre</br><input type='text' class='input' name='palabra' id='palabra' placeholder='Nombre' required>
							<input type='hidden' name='id' id='id' placeholder='id' value='".$id."'></center>
							<center>Descripción</br><input type='text' class='input' name='definicion' id='definicion' placeholder='Descripcion' value='' required></center>
							<center>Imagen</br><input type='text' class='input' name='imgGlosario' id='imgGlosario' placeholder='Imagen' value='' required></center>
							<center><input type='submit' name='submitWordToGlosary' id='submitWordToGlosary' value='Agregar'></center>
					</fieldset>
				   </form>";
				}
				else
				{
					echo "Null";
				}
	

	}

	public function index()
	{
		$data['title'] = 'Glosario';
		$this->load->view('templates/header',$data);
		$this->load->view('pages/glosario');
		$this->load->view('templates/footer');
	}

	public function relationWordGlosario($idReceta,$idGlosario)
	{
		$id = $this->Glosario_model->addRelationWordGlosario($idReceta,$idGlosario);
		echo $id;
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
                redirect('recetas/index', 'refresh');
        }
	}

}
?>
