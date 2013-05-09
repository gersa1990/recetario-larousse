<?php

class video_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->model('recetas_model');
	}

	public function delete($id)
	{

		$delete = $this->db->delete('video', array('id' => $id));
		return $delete;
	}

	public function getVideosRelacionados($id_receta, $id_app){
		$videos = $this->db->query("select * from video where id in  (select id_video from videos_x_receta where id_receta = ".$id_receta.")");
		return $videos->result_array();
	}

	public function addToRecipe($id_receta, $id_video){

		$data = array(
			'id_video' 	=> $id_video,
			'id_receta' => $id_receta
		);
		
		return $this->db->insert('videos_x_receta', $data);

	}

	public function searchByName2($id_app, $id_receta, $palabra){

		$query = $this->db->query("select * from video where id_app = ".$id_app." and titulo like '%".$palabra."%' and id !=  all (select distinct id_video from videos_x_receta where id_receta = ".$id_receta.")");
		return $query->result_array();
	}

	public function edit(){

		$data = array(
			'id_app' => $this->input->post('id_app'),
			'video'  => $this->input->post('video'),
			'titulo' => $this->input->post('titulo'),
		);

		return $this->db->update('video', $data, array('id' => $_POST['id']));
	}
	
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

	public function create($video,$titulo,$id_app)
	{

		$data = array(
			'id_app' => $id_app,
			'video'  => $video,
			'titulo' => $titulo
		);

		return $this->db->insert('video', $data);
	}

	public function searchByName($nombre, $id_app){
		
		$videos = $this->db->query("SELECT * FROM video WHERE titulo LIKE '%".$nombre."%'  and id_app = ".$id_app." ");
		return $videos->result_array();
	}
}
?>