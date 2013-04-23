<?php

class export extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('export_model');
		$this->load->helper('url');
	}

	public function index()
	{
 		$db = new PDO('sqlite:./resources/larousse.sqlite');

		$array_recipes=$this->export_model->getRecipesFromAppId(1); //id_app=1;

		foreach ($array_recipes as $recipe) 
		{
			$recipe_array=(array)$recipe;
			$recipe_array=array_map("clean", $recipe_array);
			extract($recipe_array);
			$sql="INSERT INTO receta VALUES ('$id', '$titulo', '$id_categoria', '$procedimiento', '$ingredientes', '$preparacion', '$coccion', '$costo', '$video', '$foto', '', '$dificultad' );";
			$count=$db->exec($sql);
		}    
	}
}

function clean($str) 
{
	return utf8_decode(trim ($str));
}


?>