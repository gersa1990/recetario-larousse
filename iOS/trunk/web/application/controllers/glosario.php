<?php
class Glosario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Glosario_model');
		$this->load->model('App_model');
	}

	/***************************************************************
		Método para verificar que no exista un glosario llamado igual
		esta verificación se realiza al tratar de crear un nuevo glosario
	****************************************************************/
	public function checkExistence(){

		$palabra = $_POST['palabra'];
		$id_app  = $_POST['id_app'];

		$this->Glosario_model->checkExistence($palabra, $id_app);
	}

	/***************************************************************
		Método para verificar que no exista un glosario llamado igual 
		esta verificacion se realiza al tratar de editar (actualizar) un glosario 
	****************************************************************/
	public function updateCheckExistence(){

		$palabra 		= $_POST['nombre'];
		$id_glosario 	= $_POST['glosario'];
		$id_app 		= $_POST['id_app'];

		$this->Glosario_model->updateCheckExistence($palabra, $id_glosario, $id_app);
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
		Método para crear un glosario en la BD, en conjunto con el metodo
		asterixAlgorithm se complementa y obtiene un glosario que puede ser
		manejado en la aplicación
	****************************************************************/
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


	/***************************************************************
		Método para buscar un glosario mediante la busqueda de jQuery 
		en el FrontEND
	****************************************************************/
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

	/***************************************************************
		Método para relacionar un glosario con una receta
	****************************************************************/
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

	/***************************************************************
		Método para mostrar los glosarios que pueden ser relacionados
		con una receta
	****************************************************************/
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

	/***************************************************************
		Método para ver los glosarios contenidos en una aplicación
	****************************************************************/
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

	/***************************************************************
		Método para editar un glosario, tambien se complementa con el 
		algoritmo de los asteriscos asterixAlgorithm
	****************************************************************/
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

	/***************************************************************
		Método para eliminar un glosario
	****************************************************************/
	public function delete()
	{
		$delete = $this->Glosario_model->delete();
		
		if($delete)
		{
			redirect(base_url()."glosario/view/".$_POST['id_app']);
		}
	}

	/***************************************************************
		Método para buscar un glosario con una receta
	****************************************************************/
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

	/***************************************************************
		Método para eliminar una relacion de un glosario con una
		receta
	****************************************************************/
	public function deleteToRecipe(){
		$id_receta 	= $_POST['id_receta'];
		$id_glosario = $_POST['id_glosario'];
		$id_app = $_POST['id_app'];
		
		$delete = $this->Glosario_model->deleteToRecipe($id_receta, $id_glosario);

		if($delete){
			redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);
		}
	}

	public function nuevoGlosario($id_app){
		echo "
			<div id='status'>
				<div id='errorEditarApp' class='alert error'>Este nombre de aplicación ya existe</div>
			</div>

			<div id='ventana-header'>
				<h2>Nuevo término</h2>
				<a class='modal_close' href='#'></a>
			</div>

      		".form_open('glosario/create/')."
				<div class='txt-fld full'>
					<input type='hidden' name='id_app' value='".$id_app."' placeholder='' required>
					<label for=''>Nombre: </label>
					<input type='text' id='nombre' name='nombre' value='' required>
				</div>
				<div class='txt-fld full'>
					<label for=''>Descripción: </label><br><br>
					<textarea class='full' type='text' name='descripcion' placeholder=''></textarea>
				</div>
				<div class='txt-fld full'>
					<label for=''>Imagen: </label>
					<input type='text' name='imagen' id='imagen' placeholder=''>
				</div>
				<div class='btn-fld full'>
					<button type='submit' id='submitNuevaApp'>Agregar</button>
				</div>
			</form>
		";
	}


}
?>
