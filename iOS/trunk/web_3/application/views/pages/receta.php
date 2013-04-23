
<div class="wrapper">

  <div id="receta">

  	 <h2><?php echo $recetas_item['titulo']	?></h2>

  	<img src="../src/img-ejemplo.jpg" alt="imagen">

  	<div id="receta-info">
		<p> Listo en <strong> <?php echo $recetas_item['preparacion'] ?> min.</strong><p>
		
		<h3>Ingredientes</h3>
		
		<p>
			<?php echo $recetas_item['ingredientes'] ?>
		<p>
		
		<h3>Modo de preparación</h3>
		
		<p>
			Preparación:  <?php echo $recetas_item['coccion'] ?>  |
		
			Tiempo de cocción: <?php echo $recetas_item['coccion'] ?>
		</p> 
		
		<p> <?php echo $recetas_item['procedimiento'] ?><p>
		
		<p> Precio: <?php  echo $recetas_item['costo'] ?><p>
		
		<p>Usuarios a quienes les a gustado: <?php echo $recetas_item['user_fav'] ?><p>

  	</div>

  </div>
  

</div>