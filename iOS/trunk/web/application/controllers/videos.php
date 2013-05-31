<?php
class Videos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('video_model');
		$this->load->model('App_model');
	}	

	/***************************************************************
		Método para verificar que el nombre con el que estoy tratando 
		de dar de alta un video no exista en la BD
	****************************************************************/
	public function checkExistence(){

		$palabra = $_POST['palabra'];
		$id_app  = $_POST['id_app'];

		$this->video_model->checkExistence($palabra, $id_app);
	}

	/***************************************************************
		Método para verificar que el nombre con el que estoy tratando 
		de actualizar un video no exista en la BD
	****************************************************************/
	public function updateCheckExistence(){

		$palabra 		= $_POST['nombre'];
		$id_video    	= $_POST['video'];
		$id_app 		= $_POST['id_app'];

		$this->video_model->updateCheckExistence($palabra, $id_video, $id_app);
	}

	/***************************************************************
		Método para ver los videos que contiene una APP
	****************************************************************/
	public function view($id_app){

		$data['apps'] 	= $this->App_model->get_apps($id_app);
		$data['videos']	= $this->video_model->get_videos($id_app);
		
		$data['app']  	 = $id_app;	
	
		$nombre = $data['name'] = $this->App_model->get_name($id_app);

		$data['title'] = 'Larousse > '.$nombre[0]['nombre'].'> videos';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/videos', $data);
		$this->load->view('templates/footer');
	
	}
	

	/***************************************************************
		Método para filtrar los nombres que el usuario podría 
		introducir en el sistema
	****************************************************************/
	private function filtrar($video)
	{
		$tam = strlen($video);

		$texto_partido = explode('_',$video); 

		$tam = count($texto_partido);
		
		$texto = "";

		for($i=0; $i<count($texto_partido); $i++)
		{
			if(	   $texto_partido[$i]=="big" 
				|| $texto_partido[$i]=="small"
				|| $texto_partido[$i]=='medium'
				|| $texto_partido[$i]=='mini'
			  )
			{
				//Nothing to do
			}
			else
			{
				if($i==count($texto_partido)-1)
				{
					$texto .= $texto_partido[$i];
				}

				else
				{
					$texto .= $texto_partido[$i]."_";	
				}
			}	
		}

		$tam = strlen($texto);
		$extension = substr($texto, $tam-4, $tam);

		if(	   $extension == ".avi" 
			|| $extension == ".flv" 
			|| $extension == ".mp4" 
			|| $extension == ".ogg" 
			|| $extension == ".mpg" 
			|| $extension == ".mkv" 
			|| $extension == ".mov")
		{
			$aux = substr($texto, 0, $tam-4);
			return $aux;	
		}

		return $texto;
	}

	/***************************************************************
		Método para editar un video
	****************************************************************/
	public function edit()
	{
		
		$edit = $this->video_model->edit();

		if($edit)
		{
			redirect(base_url()."videos/view/".$_POST['id_app'],"refresh");
		}
	}

	/***************************************************************
		Método para eliminar un video
	****************************************************************/
	public function delete()
	{
		$id     = $_POST['id'];
		$delete = $this->video_model->delete($id);

		if($delete)
		{
			redirect(base_url()."videos/view/".$_POST['id_app'],"refresh");
		}
	}

	/***************************************************************
		Método para dar de alta un video
	****************************************************************/
	public function create()
	{
		$video  = $_POST['video'];
		$titulo = $_POST['titulo'];
		$id_app = $_POST['id_app'];

		$video2 = $this->filtrar($video);
		$insert = $this->video_model->create($video2,$titulo,$id_app);	

		if($insert)
		{
			redirect(base_url()."videos/view/".$_POST['id_app'],"refresh");
		}
	}

	/***************************************************************
		Método para agregar la relacion entre el video y la receta
	****************************************************************/
	public function addToRecipe(){

		$id_app 		= $_POST['id_app'];
		$id_receta		= $_POST['receta'];
		$id_video 		= $_POST['id_video'];
		$videos = $this->video_model->addToRecipe($id_receta, $id_video);
		$video = $this->video_model->getDataByVideo($id_video);
		echo "<tr><td>".$video[0]['titulo']."</td></tr>";

	}

	/***************************************************************
		Método para buscar los videos que concuerdan
		con una cadena de texto proporcionada (Sistema de búsqueda)
	****************************************************************/
	public function  searchByName(){

		$nombre = $_POST['nombre'];
		$id_app = $_POST['id_app'];

		$videos = $this->video_model->searchByName($nombre, $id_app);

		for ($i=0; $i <count($videos) ; $i++) 
		{
			echo "<tr>
                      <td class='txleft'>";
                          echo "".$videos[$i]['titulo'].""; 
                        echo "
                      </td>

                      <td>";
                        echo "<a href='#editarVideo".$videos[$i]['id']."'>
                          Editar
                        </a>
                      </td>

                      <td>";
                        echo "<a href='#eliminarVideo".$videos[$i]['id']."' class='eliminarRecetas'>
                          Eliminar
                        </a>
                      </td>

                  </tr>"; 
		}
	}

	/***************************************************************
		Método para eliminar las relaciones de una receta con respecto 
		a un video
	****************************************************************/
	public function deleteToRecipe(){
		$id_receta 	= $_POST['id_receta'];
		$id_video = $_POST['id_video'];
		$id_app = $_POST['id_app'];

		$delete = $this->video_model->deleteToRecipe($id_receta, $id_video);

		if($delete){
			redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);
		}

	}

	/***************************************************************
		Método para obtener las relaciones de los videos 
		y sus relaciones
	****************************************************************/
	public function addCheckVideos(){
		$id_receta = $_POST['id_receta'];
		$id_app = $_POST['id_app'];

		if(isset($_POST['videosComplemento'])){
	        $ids_videos = $_POST['videosComplemento'];

			for ($i=0; $i <count($ids_videos) ; $i++) { 
				$this->video_model->addToRecipe($id_receta, $ids_videos[$i]);
			}
	    }
	    redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);
	}
}
?>
