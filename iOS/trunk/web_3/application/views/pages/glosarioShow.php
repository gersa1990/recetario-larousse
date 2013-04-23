<div class="wrapper">
	<a href="<?php echo base_url() ?>" class="home">Home</a>    
    <br/><br/>
	<div class="lista">
		<table align="center">
			<thead>
				<tr>
					<td>Nombre</td>
					<td>Descripcion</td>
					<td>Imagen</td>
					<td colspan="2">Opciones</td>
				</tr>
			</thead>
			<tbody>
				<?php 

				//var_dump($glosario);

				for ($i=0; $i <count($glosario) ; $i++) { 
					
				?>
				<tr>
					<td><?php echo $glosario[$i]['nombre'] ?></td>
					<td><?php echo $glosario[$i]['descripcion'] ?></td>
					<td><?php echo $glosario[$i]['imagen'] ?></td>
					<td><a href="#Editar<?php echo $glosario[$i]['id'] ?>">Editar</a></td>
					<td><a href="#Eliminar<?php echo $glosario[$i]['id'] ?>">Eliminar</a></td>
				</tr>

				<div id="Editar<?php echo $glosario[$i]['id'] ?>" class="modalDialog">
        		<div>
          			<a href="#" title="Close" class="close">X</a>
          			<?php echo validation_errors(); ?>
          			<?php echo form_open('glosario/edit/') ?>
            			<input type="hidden" id="id" name="id" value="<?php echo $glosario[$i]['id'];  ?>">
            			<h2>Agregar a glosario</h2>
             			<label class="dialogL" for="nombre">Nombre:</label>
             			<input type="text" name="nombre" id="nombre" value="<?php echo $glosario[$i]['nombre'];  ?>"/>
             			<br/>
             			<label class="dialogL" for="descripcion">Descripcion:</label>
             			<input type="text" name="descripcion" value="<?php echo $glosario[$i]['descripcion'];  ?>" id="descripcion" placeholder="definicion">
             			<br/>
             			<label class="dialogL" for="imagen">Imagen:</label>
             			<input type="text" name="imagen" id="imagen" placeholder="imagen" value="<?php echo $glosario[$i]['imagen'];  ?>" />
             			<br/>
            			<button type="submit" class="eliminarBoton">Editar</button>
          			</form>
        		</div>
      			</div>

      			<div id="Eliminar<?php echo $glosario[$i]['id'] ?>" class="modalDialog">
        			<div>
          				<a href="#" title="Close" class="close">X</a>
          				<?php echo validation_errors(); ?>
          				<?php echo form_open('glosario/delete/') ?>
            				<h2>Estas seguro que deseas eliminar <?php echo $glosario[$i]['nombre'] ?></h2>
             				
             				<input type="hidden" name="id" id="id" value="<?php echo $glosario[$i]['id'] ?>" />
            				<button type="sumit" class="eliminarBoton">Eliminar</button>
          				</form>
        			</div>
      			</div>

				<?php
			 }
				?>
			</tbody>
		</table>
		<br/>
	</div>
</div>