<div class="wrapper">
	<div class="main">
		<a href="" class="home">regresar</a>
		<div class="popup bg_grey">
	
			<?php 
			$attributes = array('class' => 'newreceta');
			echo form_open('',  $attributes);
			
			?>

			<h2 class="mgt_50">Receta: </h2>

			<input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>
			
			<div class="left">
				<label for="">Título: </label>
				<input type="text" name="titulo" id="titulo" value="<?php echo $receta[0]['titulo'].$receta[0]['id_categoria']?>" required>
			</div>
			
			<div class="left mg_input">
				<label for="">Categoria: </label>
				<select name="categoria" id="categoria">
					
					<?php	
						for ($i=0; $i <count($categorias) ; $i++) { ?>
						<option value="<?php echo $categorias[$i]['id'] ?>" <?php if ($receta[0]['id_categoria'] ==  $categorias[$i]['id']){ echo "selected"; } ?> ><?php echo $categorias[$i]['nombre'] ?></option>
					<?php
					} ?>
				</select>
			</div>
			
			<div class="clear"></div>
			
			<div class="left">
				<label for="">Procedimiento: </label>
				<textarea name="procedimiento" id="procedimiento" class="full"><?php echo $receta[0]['procedimiento']?></textarea>
			</div>
			
			<div class="clear"></div>
			
			<div class="left">
				<label for="">Ingredientes: </label>
				<textarea name="ingredientes" id="ingredientes" class="full"><?php echo $receta[0]['ingredientes']?></textarea>
			</div>
			
			<div class="clear"></div>
			
			<div class="left mg_input2">
				<label for="">Preparación: </label>
				<input type="text" name="preparacion" id="preparacion" placeholder="minutos" value="<?php echo $receta[0]['preparacion']?>" required>
			</div>
			
			<div class="left mg_input2">
				<label for="">Cocción: </label>
				<input type="text" name="coccion" id="coccion" placeholder="minutos" value="<?php echo $receta[0]['coccion']?>" required>
			</div>
			
			<div class="left mg_input2">
				<label for="">Costo: </label>
				<select name="costo" id="costo">
					<option value="<?php echo $receta[0]['costo']?>"><?php echo $receta[0]['costo']?></option>
					<?php for ($i=1; $i <6 ; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="left mg_input2">
				<label for="">Dificultad: </label>
				<select name="dificultad" id="dificultad">
					<option value="<?php echo $receta[0]['dificultad']?>"><?php echo $receta[0]['dificultad']?></option>
					<?php for ($i=1; $i <6 ; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="clear"></div>
			
			<label for="">Imagen: </label>
			<input type="text" name="foto" id="foto" value= "<?php echo $receta[0]['foto']?>" placeholder="" required>
			
			<button type="submit" class="submit">Guardar</button>
		</form>
		</div>  <!-- grey-->

		<div id="glosario" class="tablas">
			<a href="#buscar_receta" class="button large orange mg_form">Agregar</a>
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<td colspan="2">Glosario receta</td>
	            	</tr>
	          	</thead>

	          	<tbody>
					<tr>
		              	<td class="txleft">
		                	<a href="" class="bluetext">
		                 		Glosario 1
		                	</a>
		              	</td>

		              	<td>
		                	<a href="#eliminarGlosario" class='eliminarRecetas'>
		                  		Eliminar
		               		 </a>
		              	</td>
		          	</tr>

		          	<tr>
		              	<td class="txleft">
		                	<a href="" class="bluetext">
		                 		Glosario 2
		                	</a>
		              	</td>

		              	<td>
		                	<a href="#eliminarGlosario" class='eliminarRecetas'>
		                  		Eliminar
		                	</a>
		              	</td>
		          	</tr>
	          	</tbody>
	        </table>
		</div>

		<div id="complementarias" class="tablas">
			<a href="#buscar_compl" class="button large orange mg_form">Agregar</a>
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<td colspan="2">Complementarias receta</td>
	            	</tr>
	          	</thead>

	          	<tbody>
					<tr>
		              	<td class="txleft">
		                	<a href="" class="bluetext">
		                 		Receta 1
		                	</a>
		              	</td>

		              	<td>
		                	<a href="#eliminarGlosario" class='eliminarRecetas'>
		                  		Eliminar
		               		 </a>
		              	</td>
		          	</tr>

		          	<tr>
		              	<td class="txleft">
		                	<a href="" class="bluetext">
		                 		Receta 2
		                	</a>
		              	</td>

		              	<td>
		                	<a href="#eliminarGlosario" class='eliminarRecetas'>
		                  		Eliminar
		                	</a>
		              	</td>
		          	</tr>
	          	</tbody>
	        </table>
		</div>

		<div id="videos" class="tablas">
			<a href="#buscar_video" class="button large orange mg_form">Agregar</a>
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<td colspan="2">Videos receta</td>
	            	</tr>
	          	</thead>

	          	<tbody>
					<tr>
		              	<td class="txleft">
		                	<a href="" class="bluetext">
		                 		Video 1
		                	</a>
		              	</td>

		              	<td>
		                	<a href="#eliminarGlosario" class='eliminarRecetas'>
		                  		Eliminar
		               		 </a>
		              	</td>
		          	</tr>

		          	<tr>
		              	<td class="txleft">
		                	<a href="" class="bluetext">
		                 		Video 2
		                	</a>
		              	</td>

		              	<td>
		                	<a href="#eliminarGlosario" class='eliminarRecetas'>
		                  		Eliminar
		                	</a>
		              	</td>
		          	</tr>
	          	</tbody>
	        </table>
		</div>
		<!-- popup's-->
		<div id="buscar_receta" class="modalDialog">
          <div class="popup form_receta">

            <a href="#" title="Close" class="close">x</a>

            <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
            
            <table id="recetas">
	          <thead>
	            <tr>
	              <th colspan="3">Recetas</th>
	            </tr>
	          </thead>

	          <tbody>
                  <tr>
                      <td class="txleft">
                        <a href="">
                          Receta ejemplo
                        </a>
                      </td>

                      <td>
                        <a href="" class=''>
                          Agregar
                        </a>
                      </td>
                  </tr>
	          </tbody>
	        </table>
          </div>
        </div>
		
		<div id="buscar_compl" class="modalDialog">
          <div class="popup form_receta">

            <a href="#" title="Close" class="close">x</a>

            <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
            
            <table id="recetas">
	          <thead>
	            <tr>
	              <th colspan="3">Recetas</th>
	            </tr>
	          </thead>

	          <tbody>
                  <tr>
                      <td class="txleft">
                        <a href="">
                          Receta ejemplo
                        </a>
                      </td>

                      <td>
                        <a href="" class=''>
                          Agregar
                        </a>
                      </td>
                  </tr>
	          </tbody>
	        </table>
          </div>
        </div>

        <div id="buscar_video" class="modalDialog">
          <div class="popup form_receta">

            <a href="#" title="Close" class="close">x</a>

            <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
            
            <table id="recetas">
	          <thead>
	            <tr>
	              <th colspan="3">Recetas</th>
	            </tr>
	          </thead>

	          <tbody>
                  <tr>
                      <td class="txleft">
                        <a href="">
                          Receta ejemplo
                        </a>
                      </td>

                      <td>
                        <a href="" class=''>
                          Agregar
                        </a>
                      </td>
                  </tr>
	          </tbody>
	        </table>
          </div>
        </div>


	</div>
</div>