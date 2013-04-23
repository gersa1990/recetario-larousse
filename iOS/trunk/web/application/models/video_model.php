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

	public function appendVideoToRecipe($idReceta, $idVideo)
	{
		$data = array(
			'id' 		=> "",
			'id_video'  => $idVideo,
			'id_receta' => $idReceta
		);

		return $this->db->insert('videos_x_receta', $data);

	}

	public function searchVideoWithoutRelationByRecipe($video)
	{
		$videos = $this->db->query("select * from video where video = '".$video."' and id != all (select id_video from videos_x_receta where id_receta = 57)");
		
		$i=0;
		foreach ($videos->result() as $key => $value) 
		{
			$arreglo[$i]['id']    = $value->id;
			$arreglo[$i]['video'] = $value->video;
			$i++;
		}

		if(isset($arreglo))
		{
			return $arreglo;	
		}

		
	}

	public function getVideosByRecipe($id)
	{
		$videos = $this->db->query("SELECT * FROM video WHERE id IN (SELECT id_video FROM videos_x_receta WHERE id_receta = ".$id.")");
		
		
		
		foreach ($videos->result() as $key => $value)
		{
			$arreglo[$key]["id"]    = $value->id;
			$arreglo[$key]["video"] = $value->video;
		}

		if(isset($arreglo))
		{
			return $arreglo;
		}
		
	}	

	public function addVideo($video,$titulo)
	{

		$data = array(
			'video'  => $video,
			'titulo' => $titulo
		);

		return $this->db->insert('video', $data);
	}

	public function checkExistence($video)
	{
		$existe = $this->db->query("SELECT * FROM video WHERE video = '".$video."' ");
		return $existe->row_array();
	}

}
?>