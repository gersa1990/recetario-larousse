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
		$nombre = $data['name'] = $this->App_model->get_name($id_app);

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> complementarias';

		$data['recetas_complementarias'] = $this->complementarias_model->getRecetasComplementarias($id_app);

		$this->load->helper('url');

		$data['apps'] = $this->App_model->get_apps($id_app);
		
		$data['app'] = $id_app;

		$this->load->view('templates/header', $data);
		$this->load->view('pages/complementariasShow', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$update = $this->complementarias_model->update();
		if($update)
		{
			redirect(base_url()."complementarias/view/".$_POST['id_app'],"refresh");
		}	
	}

	public function delete()
	{
		$eliminar = $this->complementarias_model->delete();

		if($eliminar)
		{
			redirect(base_url()."complementarias/view/".$_POST['id_app'],"refresh");
		}
		
	}

	public function create(){

		$create = $this->complementarias_model->create();

		if($create)
		{
			redirect(base_url()."complementarias/view/".$_POST['id_app'],"refresh");
		}

	}

	public function searchByName2(){

		$nombre 		= $_POST['palabra'];
		$id_app 		= $_POST['id_app'];
		$id_receta		= $_POST['receta'];

		$complementarias = $this->complementarias_model->searchByName2($nombre, $id_app, $id_receta);

		if(count($complementarias)>0)
		{
			for ($i=0; $i <count($complementarias) ; $i++) 
			{ 
				echo "<div id='div_".$complementarias[$i]['id']."'>".$complementarias[$i]['titulo']."<button class='complementarias' id='".$complementarias[$i]['id']."'>Agregar</button></div>";
			}
		}
		else
		{
			echo "No se encontro";
		}
			
	}

	public function addToRecipe(){

		$id_receta 			= $_POST['receta'];
		$id_complementaria	= $_POST['complementaria'];
 
		//echo " Receta: ".$id_receta." Complememtaria: ".$id_complementaria;

		$complementarias = $this->complementarias_model->addToRecipe($id_receta, $id_complementaria);

		$nombre = $this->complementarias_model->getNameComplementaria($id_complementaria);

		echo "<tr id='".$id_complementaria."'><td>".$nombre[0]['titulo']."</tr></td>";

	}

	public function searchByName(){

		$nombre = $_POST['palabra'];
		$id_app = $_POST['id_app'];

		$complementarias = $this->complementarias_model->searchByName($nombre, $id_app);
		
		for ($i=0; $i <count($complementarias) ; $i++) 
		{ 
			echo "<tr>
                      <td class='txleft'>";
                       
                          echo "".$complementarias[$i]['titulo'].""; 
                        echo "
                      </td>

                      <td>";
                        echo "<a href='#editarComplementaria".$complementarias[$i]['id']."'>
                          Editar
                        </a>
                      </td>

                      <td>";
                        echo "<a href='#eliminarComplementaria".$complementarias[$i]['id']."' class='eliminarRecetas'>
                          Eliminar
                        </a>
                      </td>

                  </tr>";
		}

	}
	
}

?>