<?php

class Complementarias extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		
		$this->load->model('complementarias_model');
		$this->load->model('App_model');
		$this->load->model('glosario_model');
		$this->load->model('video_model');
	}

	/***************************************************************
		Método para verificar que no exista una complementaria
		llamada de la misma manera en la APP al tratar de darla de alta
		en el sistema
	****************************************************************/
	public function checkExistence(){

		$palabra = $_POST['palabra'];
		$id_app  = $_POST['id_app'];

		$this->complementarias_model->checkExistence($palabra, $id_app);
	}

	/***************************************************************
		Método para crear la estructura para dar de alta una nueva 
		receta complementaria, este método se llama mediante AJAX
	****************************************************************/
	public function nuevaReceta(){

		$id_app = $_POST['id_app'];

		echo "
			<div id='status'>
				<div class='alert error'>Este nombre de receta ya existe</div>
			</div>
			<div id='ventana-header'>
				<h2>Nueva receta</h2>
				<a class='modal_close' href='#'></a>
			</div>
      		".form_open('complementarias/create/')."
				<div class='txt-fld full'>
					<input type='hidden' name='id_app' value='".$id_app."' placeholder='' required>
					<label for=''>Nombre: </label>
					<input type='text' id='nombre' name='titulo' value='' required>
				</div>
				<div class='txt-fld full'>
					<label for=''>Descripción: </label><br><br>
					<textarea class='full' type='text' id='contenido' name='contenido' placeholder=''></textarea>
				</div>
				<div class='btn-fld full'>
					<button type='submit' id='submitComplementariaNueva'>Agregar</button>
				</div>
			</form>";
	}

	public function editarRecetas(){
		
		$id_receta = $_POST['id_receta'];
	
		$receta = $this->complementarias_model->getDataComplementarias($id_receta);

		echo "
			<div id='status'>
				<div class='alert error'>Este nombre de receta ya existe</div>
			</div>
			<div id='ventana-header'>
				<h2>Editar receta</h2>
				<a class='modal_close' href='#'></a>
			</div>
      		".form_open('complementarias/edit/')."
				<div class='txt-fld full'>
					<input type='hidden' name='id_app' value='".$receta['id_app']."' placeholder='' required>
					<input type='hidden' name='id' value='".$receta['id']."' placeholder='' required>
					<label for=''>Nombre: </label>
					<input type='text' id='nombre' name='titulo' value='".$receta['titulo']."' required>
				</div>
				<div class='txt-fld full'>
					<label for=''>Descripción: </label><br><br>
					<textarea class='full' type='text' id='contenido' name='contenido' placeholder=''>".$receta['contenido']."</textarea>
				</div>
				<div class='btn-fld full'>
					<button type='submit' id='submitEditarComplementaria'>Editar</button>
				</div>
			</form>";
	}

	public function eliminarRecetas(){

		$id_receta = $_POST['id_receta'];

		$complementaria = $this->complementarias_model->getDataComplementarias($id_receta);

		echo "
			<div id='status'>
				<div class='alert error'>Este nombre de receta ya existe</div>
			</div>
			<div id='ventana-header'>
				<h2>Editar receta</h2>
				<a class='modal_close' href='#'></a>
			</div>
      		".form_open('complementarias/delete/')."
				<div class='txt-fld'>
					<input type='hidden' name='id_app' value='".$complementaria['id_app']."' placeholder='' required>
					<input type='hidden' name='id' value='".$complementaria['id']."' placeholder='' required>
					<label for=''>Nombre: </label>
					<h2>".$complementaria['titulo']."</h2>
				</div>
				<div class='btn-fld'>
					<button type='submit' id='submitEliminarComplementaria'>Eliminar</button>
				</div>
			</form>";
	}

	/***************************************************************
		Algoritmo para convertir los <em> de italic en asteriscos necesarios
		para el funcionamiento de la APP.
		Además elimina los parrafos (<p>), las etiquetas (<br>) y los caracteres 
		generados por la BD como Â y los convierte en espacios en blanco.
	****************************************************************/
	public function asterixAlgorithm($descripcionSinASteriscos){

		$descripcionConAsteriscos = str_replace("<em>","*",$descripcionSinASteriscos);
		$descripcionConAsteriscos = str_replace("</em>","*",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("<p>"," ",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("</p>"," ",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("<br />", " " ,$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("<br/>"," ",$descripcionConAsteriscos);
		$descripcionConAsteriscos = str_replace("[Â]","",$descripcionConAsteriscos);

		return $descripcionConAsteriscos;
	}

		/***************************************************************
		Método para verificar que no exista una complementaria
		llamada de la misma manera en la APP al tratar de editarla (actualizarla)
		en el sistema
		****************************************************************/
	public function updateCheckExistence(){

		$palabra 			= $_POST['nombre'];
		$id_complementaria 	= $_POST['complementaria'];
		$id_app 			= $_POST['id_app'];

		//echo "Palabra: ".$palabra." Complementaria: ".$id_complementaria." App: ".$id_app;

		$this->complementarias_model->updateCheckExistence($palabra, $id_complementaria, $id_app);
	}

	/***************************************************************
		Método para ver las recetas complementarias correspondientes 
		a la aplicación seleccionada
		****************************************************************/
	public function view($id_app)
	{
		$nombre = $data['name'] = $this->App_model->get_name($id_app);

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> complementarias';

		$data['recetas_complementarias'] = $this->complementarias_model->getRecetasComplementarias($id_app);

		$this->load->helper('url');

		$data['apps'] = $this->App_model->get_apps($id_app);
		
		$data['app'] = $id_app;

		$this->load->view('templates/header', $data);
		$this->load->view('pages/complementarias', $data);
		$this->load->view('templates/footer');
	}

	/***************************************************************
		Método para editar las recetas complementarias correspondientes 
		a la aplicación seleccionada
		****************************************************************/
	public function edit()
	{
		$update = $this->complementarias_model->update();
		if($update)
		{
			redirect(base_url()."complementarias/view/".$_POST['id_app'],"refresh");
		}	
	}

	/*********************************************************************
		Método para eliminar las recetas complementarias correspondientes 
		a la aplicación seleccionada
	********************************************************************/
	public function delete()
	{
		$eliminar = $this->complementarias_model->delete();

		if($eliminar)
		{
			redirect(base_url()."complementarias/view/".$_POST['id_app'],"refresh");
		}
		
	}

	/***************************************************************
		Método para crear las recetas complementarias correspondientes 
		a la aplicación seleccionada
	****************************************************************/
	public function create(){

		$descripcion2 = $this->asterixAlgorithm($_POST['contenido']);

		$create = $this->complementarias_model->create($descripcion2);

		if($create)
		{
			redirect(base_url()."complementarias/view/".$_POST['id_app'],"refresh");
		}

	}

	

	/***************************************************************
		Método para relacionar las recetas complementarias 
		con una receta correspondiente
	****************************************************************/
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
			echo "  
				<tr>
                    <td class='txleft'>".$complementarias[$i]['titulo']."
                      </td>
                      <td>
                      	<a class='ventana' rel='leanModal' name='#ventana' href='#ventana' onclick='editarRecetas(".$complementarias[$i]['id'].");'>
                          Editar
                        </a>
                      </td>
                      <td>
                      	<a class='ventana2' rel='leanModal' name='#ventana2' href='#ventana2' onclick='eliminarRecetas(".$complementarias[$i]['id'].");'>
                          Eliminar
                        </a>
                      </td>
                </tr>";
		}
	}

	/***************************************************************
		Método para agregar las relaciones de las recetas: 
		-Con glosario
		-Con recetas complementarias
		-Con videos
	****************************************************************/
	public function addCheck(){
		$id_receta = $_POST['id_receta'];
		$id_app = $_POST['id_app'];

		if(isset($_POST['complementarias']) || isset($_POST['videos']) || isset($_POST['glosario'])){
			if(isset($_POST['complementarias'])){
		        $ids_recetas = $_POST['complementarias'];

				for ($i=0; $i <count($ids_recetas) ; $i++) { 
					$this->complementarias_model->addToRecipe($id_receta, $ids_recetas[$i]);
				}
		    }

		    if(isset($_POST['videos'])){
		        $ids_videos = $_POST['videos'];

				for ($i=0; $i <count($ids_videos) ; $i++) { 
					$this->video_model->addToRecipe($id_receta, $ids_videos[$i]);
				}
		    }

		    if(isset($_POST['glosario'])){
		        $ids_glosario = $_POST['glosario'];

				for ($i=0; $i <count($ids_glosario) ; $i++) { 
					$this->Glosario_model->addToRecipe($id_receta, $ids_glosario[$i]);
				}
		    }
			
			redirect(base_url()."apps/view/".$id_app,"refresh");
		}else{
			$data['title'] = "Nueva Receta - Relaciones";
			$data['app'] = $_POST['id_app'];

			$this->load->view('templates/header', $data);
			$this->load->view('pages/mensaje', $data);
			$this->load->view('templates/footer');
		}
		
	}

	/***************************************************************
		Método para buscar las recetas complementarias, glosario y video 
		que pueden ser relacionadas.
	****************************************************************/
	public function addCheckComplemento(){
		$id_receta = $_POST['id_receta'];
		$id_app = $_POST['id_app'];

		if(isset($_POST['recetasComplemento'])){
	        $ids_recetas = $_POST['recetasComplemento'];

			for ($i=0; $i <count($ids_recetas) ; $i++) { 
				$this->complementarias_model->addToRecipe($id_receta, $ids_recetas[$i]);
			}
	    }

	    redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);

	}

	/***************************************************************
		Método para eliminar las relaciones de una receta complementaria 
		con respecto a una receta.
	****************************************************************/
	public function deleteToRecipe(){
		$id_receta 	= $_POST['id_receta'];
		$id_comp = $_POST['id_comp'];
		$id_app = $_POST['id_app'];

		$delete = $this->complementarias_model->deleteToRecipe($id_receta, $id_comp);

		if($delete){
			redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);
		}
	}
}
?>