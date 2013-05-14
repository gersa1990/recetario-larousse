<?php
class Glosario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Glosario_model');
		$this->load->model('App_model');
	}

	public function create()
	{
		$this->load->helper('form');
		$idGlosario = $this->Glosario_model->create();
		
		if($idGlosario)
		{
			redirect(base_url()."glosario/view/".$_POST['id_app'],"refresh");
		}
	}

	public function searchByName2(){

		$id_app 			= $_POST['id_app'];
		$id_receta			= $_POST['id_receta'];
		$palabra 			= $_POST['palabra'];

		//echo "APP: ".$id_app." RECETA: ".$id_receta." PALABRA: ".$palabra;

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
		
		$data['app']  	 = $id_app;

		$nombre = $data['name'] = $this->App_model->get_name($id_app);

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> glosario';
		
		$this->load->view('templates/header',$data);
		$this->load->view('pages/glosarioShow',$data);
		$this->load->view('templates/footer');

	}

	public function edit()
	{
		$edit = $this->Glosario_model->edit();

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
