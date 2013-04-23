<?php

$nombre_archivo = $_FILES['newFoto']['name']; 
$tipo_archivo = $_FILES['newFoto']['type']; 
$tamano_archivo = $_FILES['newFoto']['size']; 
//compruebo si las características del archivo son las que deseo 


 
   		$destino = './src' ; 
		copy($_FILES['newFoto']['tmp_name'],$destino.'/'. $_FILES['newFoto']['name']); 
		move_uploaded_file($_FILES['newFoto']['tmp_name'],$destino.'/'. $_FILES['newFoto']['name']);
?>