<div class="wrapper">
	
	<a href="<?php echo base_url() ?>" class="home">Home</a>    
    <br/>

	<h2 class="centrado">Recetas complementarias</h2>


	<div class="centrar">
		
			<?php   
				  if(isset($recetas_complementarias))
				  {?>

				<table>
					<thead>
						<tr>
							<td>Titulo</td>
							<td>Contenido</td>
							<td colspan="2">Opciones</td>
						</tr>
					</thead>



				<?php

				  for ($i=0; $i <count($recetas_complementarias) ; $i++) 
				  { ?>

				
					<tbody>
						<tr>
							<td><?php echo $recetas_complementarias[$i]['titulo']; ?></td>
							<td><textarea><?php echo $recetas_complementarias[$i]['contenido']; ?></textarea></td>
							<td><a href="#EditarComplementaria<?php echo $recetas_complementarias[$i]['id'] ?>">Editar</a></td>
							<td><a href="#EliminarComplementaria<?php echo $recetas_complementarias[$i]['id'] ?>">Eliminar</a></td>
						</tr>
					</tbody>

					<div id="EditarComplementaria<?php echo $recetas_complementarias[$i]['id'] ?>" class="modalDialog">
        				<div>
          					<a href="#" title="Close" class="close">X</a>
          					<?php echo validation_errors(); ?>
          					<?php echo form_open('complementarias/modificar') ?>
			            
            					<h2>Editar Receta complementaria.</h2>
            
            					<input type="hidden" name="id" id="id"  value="<?php echo $recetas_complementarias[$i]['id'] ?>"/>

				            	<label class="dialogL">Titulo: </label>
            					<input type="text" name="titulo" id="titulo" value="<?php echo $recetas_complementarias[$i]['titulo'] ?>"/>

            					<br/><br/>

            					<label class="dialogL">Contenido: </label>
            					<textarea name="contenido" id="contenido" style="width:300px;"><?php echo $recetas_complementarias[$i]['contenido'] ?></textarea>

			            		<button type="submit" class="eliminarBoton">Guardar</button>
          					</form>
        				</div>
      				</div>

      				<div id="EliminarComplementaria<?php echo $recetas_complementarias[$i]['id'] ?>" class="modalDialog">
        				<div>
          					<a href="#" title="Close" class="close">X</a>
          					<?php echo validation_errors(); ?>
          					<?php echo form_open('complementarias/eliminar') ?>
            
            					<h2>Eliminar Subreceta: <?php echo $recetas_complementarias[$i]['titulo'] ?>. <br/></h2>
            					<p>Si la eliminas eliminaras las relaciones que esta contenga.</p>
		            
        					    <input type="hidden" name="id" id="id"  value="<?php echo $recetas_complementarias[$i]['id'] ?>"/>

            					<button type="submit" class="eliminarBoton">Eliminar</button>
         				 	</form>
        				</div>
     			 	</div>

				<?php
				  }

				  echo "</table>";
				}
       		?>

		
	</div>
	<br/><br/>
</div>