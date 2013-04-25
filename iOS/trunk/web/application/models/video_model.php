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

	public function addVideo($video,$titulo)
	{

		$data = array(
			'video'  => $video,
			'titulo' => $titulo
		);

		return $this->db->insert('video', $data);
	}

	public function checkExistence()
	{
		$existe = $this->db->query("SELECT * FROM video WHERE video = '".$video."' ");
		return $existe->row_array();
	}

}
?>