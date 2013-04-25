<?php

class Recetas extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('recetas_model');
		$this->load->model('App_model');
		$this->load->model('categoria_model');
		$this->load->model('complementarias_model');
		$this->load->model('video_model');
		$this->load->library('typography');
	}

	public function searchByName()
	{
		$nombre = $_POST['palabra'];
		$id_app = $_POST['id_app'];

		$result = $this->db->query("SELECT * FROM recetas WHERE titulo like '%".$nombre."%' and id_app = ".$id_app." ");

		$i=0;
		foreach ($result->result() as $key => $value) 
		{
			$arre[$i]['id'] 			= $value->id;
			$arre[$i]['titulo'] 		= $value->titulo;
			$arre[$i]['id_categoria'] 	= $value->titulo;
			$arre[$i]['id_app'] 		= $value->id_app;
			$i++;
		}

		if(isset($arre))
		{
			foreach ($arre as $key => $value) 
			{
				$id = $value['id'];
				echo "<tr><td class='txleft'>";
					echo "<a href='".$id."' class='bluetext'>".$value['titulo']."</a>";
				echo "</td>";
				echo "<td>";
					echo "<a href='#eliminarReceta".$id."'>Eliminar</a>";
				echo "</td></tr>";
			}
		}

	}

	public function eliminar(){

		$id_receta = $_POST['id'];
		$app 	   = $_POST['app'];

		$delete    = $this->recetas_model->eliminar($id_receta); 

		if($delete)
		{
			redirect(base_url()."apps/view/".$app);
		}
	}
	

	public function  complementariaCreate()
	{
		$id = $this->recetas_model->createRecetasComplementarias();

		if($id)
		{
			redirect(base_url(),"refresh");
		}
	}

	public function index()
	{
		$data['recetas'] = $this->recetas_model->get_recetas();
		
		$data['apps'] = $this->App_model->get_apps();

		$this->load->helper('url');

		$data['title'] = 'Recetario';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/index', $data);
		$this->load->view('templates/footer');
	}

	public function modificar($id,$app)
	{

		$data['recetas_item'] = $this->recetas_model->get_recetas2($app,$id);
		$data['app']  =  $app;
		
		$data['relations'] = $this->complementarias_model->getRelationsRecetasToComplementarias($id);

		$data['glosarioByRecipe'] = $this->recetas_model->getGlosarioByRecipe($id);		

		$data['title'] = $data['recetas_item']['titulo'];

		

		$data['videoReceta'] = $this->video_model->getVideosByRecipe($id);

		$this->load->view('templates/header', $data);
		$this->load->view('pages/modificar', $data);
		$this->load->view('templates/footer');
	}

	public function agregar($app = FALSE)
	{
		$data['app'] = $app;
		$data['apps'] = $this->App_model->get_apps();
		$data['categorias'] = $this->categoria_model->get_categorias();

		$this->load->helper('url');

		$data['title'] = 'Nueva receta';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/agregar', $data);
		$this->load->view('templates/footer');
	}

	public function searchById(){

		$id = $_POST['id_receta'];
		$id_app = $_POST['id_app'];

		$data = $this->recetas_model->searchById($id);

		echo "<div class='myform'>

            <h2 class='txcenter'>Edita los datos de tu receta</h2>
            <p class='txcenter'>Informaci&oacute;n de la receta</p>
            <br><br>";

		echo "<form action='' method='' id='form_recetas2'>";           
        echo " <label for='titulo' class=fixh1 left'>T&iacute;tulo</label>";
        echo " <input type='text' name='titulo' id='titulo' class='left' value='".$data[0]['titulo']."'/>";
        echo " <div class='status left error'>Ya existe una receta con este nombre.</div>";

        echo " <div class='clear'></div> <br>";
        echo " <input type='hidden' name='app' value='".$data[0]['id_app']."''>"; 

        echo " <label for='categoria' class='fixh2'>Categoria</label>";
        echo " <select name='categoria' id='categoria'>";

        $categorias = $this->App_model->getCategoryFromAppId($id_app);

        foreach ($categorias as $c_item)
        {
        	$id 		= $c_item['id'];
        	$nombre		= $c_item['nombre'];

        	echo "<option value='.$id.'>".$nombre."</option>";
        }             
            echo "</select><br>";

            
            
        echo "<label for='dificultad'>Dificultad <span class='small'>Dificultad para realizarla</span></label>
            <select name='dificultad' id='dificultad' class='wt1'>";
              
                  for ($i=0; $i < 6; $i++) 
                  { 
                  	if($data[0]['dificultad'] == $i)
                  	{
                  		echo "<option value='".$i."' selected>".$i."</option>";
                  	}
                  	else
                  	{
                  		echo "<option value='".$i."'>".$i."</option>";
                  	}
                  }
                  
        echo "  </select><br><br>";
            
            
            
        echo "<label for='procedimiento' class='fixmargin'>Procedimiento <span class='small'>Pasos de preparaci&oacute;n</span></label>
            <textarea name='procedimiento' id='procedimiento' title='procedimiento' rows='4' cols='46' required>".$data[0]['procedimiento']."</textarea>

            <br>
            
            <label for='ingre' class='fixmargin'>Ingredientes <span class='small'>Lista de ingredientes</span></label>
            <textarea name='ingredientes' id='ingredientes' title='ingredientes' rows='4' cols='46' required>".$data[0]['ingredientes']."</textarea>

            <br>
            
            <label for='prepa'>Preparaci&oacute;n <span class='small'>Tiempo en min</span></label>
            <input type='text' value='".$data[0]['preparacion']."' name='preparacion' id='preparacion' required />

            <br>
            
            <label for='coccion'>Cocci&oacute;n <span class='small'>Tiempo en min</span></label>
            <input type='text' value='".$data[0]['coccion']."' name='coccion' id='coccion' required/>

            <br>
            
            <label for='costo'>Costo <span class='small'>Precio aproximado</span></label>
             <select name='costo' id='costo' class='wt1'>";
              for ($i=1; $i < 6; $i++) 
               {
               		if($data[0]['costo']==$i)
               		{
               			echo "<option value=".$i." selected>".$i."</option>";	
               		}
               		else
               		{
               			echo "<option value=".$i.">".$i."</option>";
               		}
               		
               } 
            echo "</select>
            <br><br>
            
            <label for='ïmg'>Imagen <span class='small'>Cargar file</span></label>
            <input type='text' value='".$data[0]['foto']."' name='img' id='foto' required />

            <br><br>
            
            <button type='submit' class='button bl2'>Guardar</button>

            </form></div>";
	}

	public function creates()
	{
		$titulo   		= $_POST['titulo'];
		$id_categoria   = $_POST['id_categoria'];
		$id_app		    = $_POST['id_app'];
		$procedimiento  = $_POST['procedimiento'];
		$ingredientes   = $_POST['ingredientes'];
		$preparacion    = $_POST['preparacion'];
		$coccion	    = $_POST['coccion'];
		$costo 		    = $_POST['costo'];
		$foto 		    = $_POST['foto'];
		$user_fav		= $_POST['user_fav'];
		$dificultad     = $_POST['dificultad'];
		$preparada		= "0";

		//echo "Titulo: ".$titulo.", Cat: ".$id_categoria.", APP: ".$id_app.", PROC: ".$procedimiento.", ING:  ".$ingredientes.", PREP: ".$preparacion.", coccion: ".$coccion.", costo: ".$costo.", FAV: ".$user_fav.", preparada: ".$preparada;
		

		$id = $this->recetas_model->set_recetas($titulo, $id_categoria, $id_app, $procedimiento, $ingredientes, $preparacion, $coccion, $costo, $foto, $user_fav, $dificultad, $preparada);

		if($id)
		{
			echo $titulo;
		}
		else
		{
			echo "Ah ocurrido un error inesperado intentalo de nuevo por favor";
		}


		//redirect(base_url().'apps/view/'.$app, 'refresh');
		
	}


	public function updateR($app = FALSE, $id)
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$id = $this->input->post('id');

		$this->form_validation->set_rules('titulo', 'Título', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			echo "No valido";
		}
		else
		{

			

		$actualizar = $this->recetas_model->update_recetas($id);
			
		if($actualizar)
		 {
                redirect(base_url()."recetas/modificar/".$id."/".$app, 'refresh');
         }
		}      
	}
}

?>