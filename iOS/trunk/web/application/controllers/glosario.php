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


	public function view($id_app){

		$this->load->helper('form');

		$data['apps'] 	  = $this->App_model->get_apps($id_app);
		$data['glosario'] = $this->Glosario_model->get_glosario($id_app);
		
		$data['app']  	 = $id_app;

		$data['title'] = 'Glosario';
		
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
                        echo "<a href='".base_url().'glosario/view/'.$glosario[$i]['id']."' class='bluetext'>";
                          echo "".$glosario[$i]['nombre'].""; 
                        echo "</a>
                      </td>

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

}
?>
