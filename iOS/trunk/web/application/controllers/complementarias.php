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
		$data['title'] = 'Aplicaciones editorial Larousse';

		$data['recetas_complementarias'] = $this->complementarias_model->getRecetasComplementarias($id_app);

		$this->load->helper('url');

		$data['apps'] = $this->App_model->get_apps($id_app);
		
		$data['app']  	 = $id_app;

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

	public function searchByName(){

		$nombre = $_POST['palabra'];
		$id_app = $_POST['id_app'];

		$complementarias = $this->complementarias_model->searchByName($nombre, $id_app);
		
		for ($i=0; $i <count($complementarias) ; $i++) 
		{ 
			echo "<tr>
                      <td class='txleft'>";
                        echo "<a href='".base_url().'complementarias/view/'.$complementarias[$i]['id']."' class='bluetext'>";
                          echo "".$complementarias[$i]['titulo'].""; 
                        echo "</a>
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