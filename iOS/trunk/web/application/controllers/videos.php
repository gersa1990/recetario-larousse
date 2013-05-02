<?php
class Videos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('video_model');
		$this->load->model('App_model');
	}	

	public function view($id_app){

		$data['apps'] 	= $this->App_model->get_apps($id_app);
		$data['videos']	= $this->video_model->get_videos($id_app);
		
		$data['app']  	 = $id_app;	
	
		$data['title'] = 'Recetario';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/videosAdd', $data);
		$this->load->view('templates/footer');
	
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
			|| $estension ==".mkv" 
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

	public function  searchByName(){

		$nombre = $_POST['nombre'];
		$id_app = $_POST['id_app'];

		$videos = $this->video_model->searchByName($nombre, $id_app);

		for ($i=0; $i <count($videos) ; $i++) 
		{
			echo "<tr>
                      <td class='txleft'>";
                        echo "<a href='".base_url().'videos/view/'.$videos[$i]['id']."' class='bluetext'>";
                          echo "".$videos[$i]['titulo'].""; 
                        echo "</a>
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

}
?>
