<?php

class video_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->model('recetas_model');
	}

	/***************************************************************
		Modelo para verificar si existe un video con ese nombre cuando
		se trata de dar de alta en el sistema
	****************************************************************/
	public function checkExistence($palabra, $id_app){

		$existe = $this->db->query("SELECT * FROM video WHERE titulo = '".$palabra."' and id_app = ".$id_app."  ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo "Existe";
		}
	}

	/***************************************************************
		Modelo para eliminar los videos conteidas en la APP
	****************************************************************/
	public function extendsDeleteByIdApp($id_app){

		$this->db->delete("video", array('id_app' => $id_app ));

	}

	/***************************************************************
		Modelo para eliminar los videos relacionados con las recetas
		de la APP
	****************************************************************/
	public function extendsDelete($recetas){

		foreach ($recetas as $key => $value) 
		{
			$id_receta = $value['id'];
			$this->db->delete("videos_x_receta", array('id_receta' => $id_receta ));
		}
	}

	/***************************************************************
		Modelo para verificar si existe un video con ese nombre cuando
		se trata de actualizar en el sistema
	****************************************************************/
	public function updateCheckExistence($palabra, $id_glosario, $id_app){

		$existe = $this->db->query("SELECT * FROM video WHERE titulo = '".$palabra."' and id != ".$id_glosario." and id_app = ".$id_app." ");
		$array = $existe->row_array();

		if(count($array)>0)
		{
			echo "Existe";
		}
	}

	/***************************************************************
		Modelo para eliminar un video
	****************************************************************/
	public function delete($id){

		$delete = $this->db->delete('video', array('id' => $id));
		 		  $this->db->delete("videos_x_receta", array('id_video' => $id ));
		return $delete;
	}

	/***************************************************************
		Modelo para obtener la información de un video
	****************************************************************/
	public function getDataByVideo($id_video){
		$video = $this->db->query("SELECT * from video WHERE id = ".$id_video." ");
		return $video->result_array();
	}

	/***************************************************************
		Modelo para obtener los videos relacionados con una receta
	****************************************************************/
	public function getVideosRelacionados($id_receta, $id_app){

		$videos = $this->db->query("select * from video where id in  (select id_video from videos_x_receta where id_receta = ".$id_receta.")");
		return $videos->result_array();
	}

	/***************************************************************
		Modelo para relacionar un video con una receta
	****************************************************************/
	public function addToRecipe($id_receta, $id_video){

		$data = array(
			'id_video' 	=> $id_video,
			'id_receta' => $id_receta
		);
		
		return $this->db->insert('videos_x_receta', $data);
	}

	/***************************************************************
		Modelo para buscar un video con respecto a una receta, 
		mediante la busqueda de una palabra
	****************************************************************/
	public function searchByName2($id_app, $id_receta, $palabra){

		$query = $this->db->query("select * from video where id_app = ".$id_app." and titulo like '%".$palabra."%' and id !=  all (select distinct id_video from videos_x_receta where id_receta = ".$id_receta.")");
		return $query->result_array();
	}

	/***************************************************************
		Modelo para editar un video
	****************************************************************/
	public function edit(){

		$data = array(
			'id_app' => $this->input->post('id_app'),
			'video'  => $this->input->post('video'),
			'titulo' => $this->input->post('titulo'),
		);
		return $this->db->update('video', $data, array('id' => $_POST['id']));
	}
		
	/***************************************************************
		Modelo para obtener los videos de una APP
	****************************************************************/
	public function get_videos($id_app){

		$query = $this->db->query("SELECT * FROM video WHERE id_app = ".$id_app."");

		$i=0;
		foreach ($query->result() as $key => $value) 
		{
			$arreglo[$i]['id']		= $value->id;
			$arreglo[$i]['id_app']	= $value->id_app;
			$arreglo[$i]['video']	= $value->video;
			$arreglo[$i]['titulo']	= $value->titulo;
			$i++;
		}

		if(isset($arreglo))
		{
			return $arreglo;
		}

	}

	/***************************************************************
		Modelo para dar de alta un video
	****************************************************************/
	public function create($video,$titulo,$id_app){

		$data = array(
			'id_app' => $id_app,
			'video'  => $video,
			'titulo' => $titulo
		);

		return $this->db->insert('video', $data);
	}

	/***************************************************************
		Modelo para buscar un video por su nombre (Sistema de búsqueda)
	****************************************************************/
	public function searchByName($nombre, $id_app){
		
		$videos = $this->db->query("SELECT * FROM video WHERE titulo LIKE '%".$nombre."%'  and id_app = ".$id_app." ");
		return $videos->result_array();
	}

	/***************************************************************
		Modelo para eliminar la relación entre una receta y un video
	****************************************************************/
	public function deleteToRecipe($id_receta, $id_video){

		$delete = $this->db->query("DELETE FROM videos_x_receta WHERE id_receta = ".$id_receta." and id_video = ".$id_video."");
		return $delete;
	}

	/***************************************************************
		Modelo para obtener los videos que se pueden relacionar con una receta
		obtienes recetas comlemento de videos
	****************************************************************/
	public function getComplemento($id_app, $id_receta){
		$query = $this->db->query("select * from video where id_app = ".$id_app." and id !=  all (select distinct id_video from videos_x_receta where id_receta = ".$id_receta.")");
		return $query->result_array();
	}
}
?>