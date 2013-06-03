<?php
class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('categoria_model');
		$this->load->model('App_model');
	}

	/***************************************************************
		Método para crear la estructura para una nueva categoria
		este metodo se llama de manera dinámica mediante (AJAX)
	****************************************************************/
	public function nuevaCategoria(){
		
		$id_app = $_POST['id_app'];

	echo "	
			<div id='status'>
        		<div id='' class='alert error'>Este nombre de categoria ya existe</div>
      		</div>
      		<div id='ventana-header'>
        		<h2>Nueva categoria</h2>
        		<a class='modal_close' href=''></a>
      		</div>
         	".form_open("categorias/create/")."
        		<div class='txt-fld'>
          			<input type='hidden' name='id_app' value='".$id_app."' required>
          			<label for=''>Nombre: </label>
          			<input type='text' id='nombre' name='nombre' value='' required>
        		</div>
        		<div class='txt-fld'>
        			<label for=''>Color: </label>
        			<input type='text' id='color' name='color' value='' placeholder='rgb(r,g,b)' required>
        		</div>
        		<div class='btn-fld'>
          			<button type='submit' id='submitNuevaCategoria'>Agregar</button>
        		</div>
      		</form>";
	}

	/***************************************************************
		Método para crear la estructura para editar una categoria
		este metodo se llama de manera dinámica mediante (AJAX)
	****************************************************************/
	public function editarCategoria(){
		$id_categoria = $_POST['id_categoria'];

		$categorias = $this->categoria_model->getDataCategorias($id_categoria);

		//var_dump($categorias);

		echo "	
			<div id='status'>
        		<div id='' class='alert error'>Este nombre de categoria ya existe</div>
      		</div>
      		<div id='ventana-header'>
        		<h2>Editar categoria</h2>
        		<a class='modal_close' href=''></a>
      		</div>
         	".form_open("categorias/edit/")."
        		<div class='txt-fld'>
          			<input type='hidden' name='id_app' value='".$categorias['id_app']."' required>
          			<input type='hidden' name='id' value='".$categorias['id']."' required>
          			<label for=''>Nombre: </label>
          			<input type='text' id='nombre' name='nombre' value='".$categorias['nombre']."' required>
        		</div>
        		<div class='txt-fld'>
        			<label for=''>Color: </label>
        			<input type='text' id='color' name='color' value='".$categorias['color']."' placeholder='rgb(r,g,b)' required>
        		</div>
        		<div class='btn-fld'>
          			<button type='submit' id='submitEditarCategoria'>Agregar</button>
        		</div>
      		</form>";
	}

	/***************************************************************
		Método para crear la estructura para eliminar una categoria
		este metodo se llama de manera dinámica mediante (AJAX)
	****************************************************************/
	public function eliminarCategoria(){

		$id_categoria = $_POST['id_categoria'];
		$categorias = $this->categoria_model->getDataCategorias($id_categoria);

		echo "	
      		<div id='ventana-header'>
        		<h2>Eliminar categoria</h2>
        		<p>Toda la información referente se borrará</p>
        		<a class='modal_close' href=''></a>
      		</div>
         	".form_open("categorias/delete/")."
        		<div class='txt-fld'>
          			<input type='hidden' name='id_app' value='".$categorias['id_app']."' required>
          			<input type='hidden' name='id' value='".$categorias['id']."' required>
          			
          			<h2>".$categorias['nombre']."</h2>
        		</div>
        		<div class='btn-fld'>
          			<button type='submit' id='submitEliminarCategoria'>Eliminar</button>
        		</div>
      		</form>";
	}

	//Método que actualiza el orden por el cual se muestran las categorias
	public function updateOrden(){
		$id_categoria = $_POST['id_categoria'];
		$orden 		  = $_POST['orden_categoria'];

		$update = $this->categoria_model->updateOrden($id_categoria, $orden);
	}

	//Método que verifica no exista el nombre de esta categoria al tratar de actualizarla
	public function updateCheckExistence(){
		
		$titulo 	= $_POST['titulo'];
		$id_app 	= $_POST['id_app'];
		$categoria 	= $_POST['id_cat'];

		$this->categoria_model->updateCheckExistence($titulo, $id_app, $categoria);
	}

	//Método que verifica que no exista el nombre de categoria al tratar de crearla
	public function checkExistence(){

		$palabra = $_POST['titulo'];
		$id_app  = $_POST['id_app'];

		$this->categoria_model->checkExistence($palabra, $id_app);	
	}

	//Metodo que sirve para eliminar las relaciones correspondientes a esta categoria
	public function extendsSimpleDelete($id_categoria){
		$deleteCategoria = $this->categoria_model->extendsSimpleDelete($id_categoria);
	}

	//Metodo que sirve para eliminar todas las relaciones correspondientes al arreglo de recetas proporcionadas
	public function extendsDelete($arrayRecetas){

		$deleteArray = $this->categoria_model->extendsDelete($arrayRecetas);
	}

	//Método que sirve para editar la categoria en la BD
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

	//Método que sirve para ver las categorias de una APP en especifico
	public function view($id_app){

		$this->load->helper('url');

		//Obtiene las categorias de la APP ($id_app)
		$data['categorias'] = $this->categoria_model->get_categorias($id_app);
		
		$data['app']  	 = $id_app;

		$nombre = $data['name'] = $this->App_model->get_name($id_app);

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> categorias';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/categorias', $data);
		$this->load->view('templates/footer');

	}

	//Método que sirve para crear una categoria en la BD
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
			 $this->categoria_model->set_categoria(); //Modelo para dar de alta una categoria dentro de la Base de datos.
			 redirect(base_url().'categorias/view/'.$id_app, 'refresh');
		}
	}

	//Método que sirve para eliminar una categoria
	public function delete(){

		$this->load->helper('url');

		$id = $_POST['id'];

		$this->categoria_model->delete_categoria($id); //Eliminar las categorias seleccionadas

		redirect(base_url().'categorias/view/'.$_POST['id_app'], 'refresh');
	}
	
	//Método para buscar categorias actualmente es deprecated 
	//por que se ordenan mediante sortable
	public function searchByTitulo(){

		$titulo = $_POST['titulo'];
		$id_app = $_POST['id_app'];

		$categorias = $this->categoria_model->searchByTitulo($titulo, $id_app);

		for ($i=0; $i <count($categorias) ; $i++) 
		{ 
			echo "<tr>
                      <td class='txleft'>";
                        
                          echo "".$categorias[$i]['nombre'].""; 
                        
                      echo "</td>

                      <td>";
                        echo "<a class='ventana' rel='leanModal' name='#ventana' href='#ventana' onclick='editarCategoria(".$categorias[$i]['id'].");'>
                          Editar
                        </a>
                      </td>

                      <td>";
                        echo "<a class='ventana' rel='leanModal' name='#ventana' href='#ventana' onclick='eliminarCategoria(".$categorias[$i]['id'].");'>
                          Eliminar
                        </a>
                      </td>
                  </tr>";
		}
	}

}
?>