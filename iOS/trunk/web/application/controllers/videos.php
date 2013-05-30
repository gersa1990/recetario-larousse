<?php
class Videos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('video_model');
		$this->load->model('App_model');
	}	

	public function checkExistence(){

		$palabra = $_POST['palabra'];
		$id_app  = $_POST['id_app'];

		$this->video_model->checkExistence($palabra, $id_app);
	}

	public function updateCheckExistence(){

		$palabra 		= $_POST['nombre'];
		$id_video    	= $_POST['video'];
		$id_app 		= $_POST['id_app'];

		$this->video_model->updateCheckExistence($palabra, $id_video, $id_app);
	}


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

	public function searchByName2(){

		$id_receta 	= $_POST['id_receta'];
		$id_app 	= $_POST['id_app'];
		$palabra 	= $_POST['palabra'];

		//echo "Receta: ".$id_receta." APP: ".$id_app." PALABRA: ".$palabra; 

		$videos = $this->video_model->searchByName2($id_app, $id_receta, $palabra);

		if(count($videos)>0)
		{
			for ($i=0; $i <count($videos) ; $i++) 
			{ 
				echo "<div id='div_".$videos[$i]['id']."'>".$videos[$i]['titulo']."<button class='videos' id='".$videos[$i]['id']."'>agregar</button></div>";
			}
		}
		else
		{
			echo "No se encontro";
		}
	}

	

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

		if($extension==".avi" 
			|| $extension ==".flv" 
			|| $extension==".mp4" 
			|| $extension ==".ogg" 
			|| $extension ==".mpg" 
			|| $extension ==".mkv" 
			|| $extension == ".mov")
		{
			$aux = substr($texto, 0, $tam-4);
			return $aux;	
		}

		return $texto;
	}

	public function edit()
	{
		
		$edit = $this->video_model->edit();

		if($edit)
		{
			redirect(base_url()."videos/view/".$_POST['id_app'],"refresh");
		}
	}

	public function delete()
	{
		$id     = $_POST['id'];
		$delete = $this->video_model->delete($id);

		if($delete)
		{
			redirect(base_url()."videos/view/".$_POST['id_app'],"refresh");
		}
	}


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

	public function addToRecipe(){

		$id_app 		= $_POST['id_app'];
		$id_receta		= $_POST['receta'];
		$id_video 		= $_POST['id_video'];

		//echo "APP: ".$id_app." RECETA: ".$id_receta." VIDEO: ".$id_video;

		$videos = $this->video_model->addToRecipe($id_receta, $id_video);

		$video = $this->video_model->getDataByVideo($id_video);

		

		echo "<tr><td>".$video[0]['titulo']."</td></tr>";

	}

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

	public function deleteToRecipe(){
		$id_receta 	= $_POST['id_receta'];
		$id_video = $_POST['id_video'];
		$id_app = $_POST['id_app'];

		$delete = $this->video_model->deleteToRecipe($id_receta, $id_video);

		if($delete){
			redirect(base_url()."recetas/ver/".$_POST['id_receta']."/".$_POST['id_app']);
		}

	}

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
