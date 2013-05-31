<?php
class Glosario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Glosario_model');
		$this->load->model('App_model');
	}

	public function checkExistence(){

		$palabra = $_POST['palabra'];
		$id_app  = $_POST['id_app'];

		$this->Glosario_model->checkExistence($palabra, $id_app);
	}

	public function updateCheckExistence(){

		$palabra 		= $_POST['nombre'];
		$id_glosario 	= $_POST['glosario'];
		$id_app 		= $_POST['id_app'];

		$this->Glosario_model->updateCheckExistence($palabra, $id_glosario, $id_app);
	}

	public function asterixAlgorithm($descripcionSinASteriscos){

		$descripcionConAsteriscos = str_replace("<em>","*",$descripcionSinASteriscos);
		$descripcionConAsteriscos = str_replace("</em>","*",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("<p>"," ",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("</p>"," ",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("<br />", " " ,$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("<br/>"," ",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("[Â]"," ",$descripcionConAsteriscos);

		return $descripcionConAsteriscos;
	}

	public function create()
	{
		$this->load->helper('form');

		$descripcion = $_POST['descripcion'];

		$descripcion2 =  $this->asterixAlgorithm($descripcion);
		//var_dump($descripcion2);

		$idGlosario = $this->Glosario_model->create($descripcion2);
		
		if($idGlosario)
		{
			redirect(base_url()."glosario/view/".$_POST['id_app'],"refresh");
		}
	}

	public function searchByName2(){

		$id_app 			= $_POST['id_app'];
		$id_receta			= $_POST['id_receta'];
		$palabra 			= $_POST['palabra'];

		$glosario 			= $this->Glosario_model->searchByName2($id_app, $id_receta, $palabra); 

		if(count($glosario)>0)
		{
			for ($i=0; $i <count($glosario) ; $i++) 
			{ 
				echo "<div id='div_".$glosario[$i]['id']."'>".$glosario[$i]['nombre']."<button class='glosario' id='".$glosario[$i]['id']."'>Agregar</button></div>";
			}
		}
		else
		{
			echo "No se encontro";
		}

		

	}

	public function addToRecipe(){

		$id_app 		= $_POST['id_app'];
		$id_receta 		= $_POST['id_receta'];
		$id_glosario 	= $_POST['id_glosario'];

		$insertar = $this->Glosario_model->addToRecipe($id_receta, $id_glosario);

		$dataGlosario = $this->Glosario_model->getDataGlosary($id_glosario);

		if(count($dataGlosario)>0)
		{
			echo "<tr><td>".$dataGlosario[0]['nombre']."</td></tr>";
		}
		else
		{
			echo "No se encontro";
		}
	}

	public function addCheckGlosario(){
		$id_receta = $_POST['id_receta'];
		$id_app = $_POST['id_app'];

		if(isset($_POST['glosarioComplemento'])){
	        $ids_glosario = $_POST['glosarioComplemento'];

			for ($i=0; $i <count($ids_glosario) ; $i++) { 
				$this->Glosario_model->addToRecipe($id_receta, $ids_glosario[$i]);
			}
	    }
	    
	    redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);

	}


	public function view($id_app){

		$this->load->helper('form');

		$data['apps'] 	  = $this->App_model->get_apps($id_app);
		$data['glosario'] = $this->Glosario_model->get_glosario($id_app);

		$glosario = $this->Glosario_model->get_glosario($id_app);
		
		$data['app']  	 = $id_app;

		$nombre = $data['name'] = $this->App_model->get_name($id_app);

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> glosario';
		
		$this->load->view('templates/header',$data);
		$this->load->view('pages/glosario',$data);
		$this->load->view('templates/footer');

	}

	public function edit(){
		
		$descripcion2 = $_POST['descripcion'];

		$arreglado = $this->asterixAlgorithm($descripcion2);

		var_dump($arreglado);

		$edit = $this->Glosario_model->edit($arreglado);

		if($edit)
		{
			redirect(base_url()."glosario/view/".$_POST['id_app']);
		}
	}

	public function delete()
	{
		$delete = $this->Glosario_model->delete();
		
		if($delete)
		{
			redirect(base_url()."glosario/view/".$_POST['id_app']);
		}
	}

	public function searchByName(){

		$nombre = $_POST['palabra'];
		$id_app = $_POST['id_app'];

		
		$glosario = $this->Glosario_model->searchByName($nombre, $id_app);

		for ($i=0; $i <count($glosario) ; $i++) 
		{ 
			echo "<tr>
                      <td class='txleft'>";
                          echo "".$glosario[$i]['nombre'].""; 
                        echo "</td>

                      <td>";
                        echo "<a href='#editarGlosario".$glosario[$i]['id']."'>
                          Editar
                        </a>
                      </td>

                      <td>";
                        echo "<a href='#eliminarGlosario".$glosario[$i]['id']."' class='eliminarRecetas'>
                          Eliminar
                        </a>
                      </td>

                  </tr>";
		}
	}

	public function deleteToRecipe(){
		$id_receta 	= $_POST['id_receta'];
		$id_glosario = $_POST['id_glosario'];
		$id_app = $_POST['id_app'];
		
		$delete = $this->Glosario_model->deleteToRecipe($id_receta, $id_glosario);

		if($delete){
			redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);
		}
	}

}
?>
