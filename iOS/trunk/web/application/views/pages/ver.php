<div class="wrapper">
	<div class="main">
		<!-- <a href="" class="home">regresar</a> -->
		<div class="popup bg_grey">
	
			<?php 
			$attributes = array('class' => 'newreceta');
			echo form_open('recetas/edit/',  $attributes);

			?>

			<h2 class="mgt_50"><?php echo $receta[0]['titulo'] ?></h2>

			<input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>
			<input type="hidden" name="id" value="<?php echo $receta[0]['id'] ?>">
			
			<div class="left">
				<label for="">Título: </label>
				<input type="text" name="titulo" id="titulo" value="<?php echo $receta[0]['titulo'] ?>" required disabled >
			</div>
			
			<div class="left mg_input">
				<label for="">Categoria: </label>
				<select name="categoria" id="categoria" disabled >
					
					<?php	
						for ($i=0; $i <count($categorias) ; $i++) { ?>
						<option value="<?php echo $categorias[$i]['id'] ?>" <?php if ($receta[0]['id_categoria'] ==  $categorias[$i]['id']){ echo "selected"; } ?> ><?php echo $categorias[$i]['nombre'] ?></option>
					<?php
					} ?>
				</select>
			</div>
			
			<div class="clear"></div>
			
			<div class="left" class="mg_t">
				<label for="" class="mg_t">Procedimiento: </label>
				<textarea name="procedimiento" id="procedimiento" class="full" disabled><?php echo $receta[0]['procedimiento']?></textarea>
			</div>
			
			<div class="clear"></div>
			
			<div class="left">
				<label for="" class="mg_t">Ingredientes: </label>
				<textarea name="ingredientes" id="ingredientes" class="full" disabled><?php echo $receta[0]['ingredientes']?></textarea>
			</div>
			
			<div class="clear"></div>
			
			<div class="left mg_input2">
				<label for="" class="mg_t">Preparación: </label>
				<input type="text" name="preparacion" id="preparacion" placeholder="minutos" value="<?php echo $receta[0]['preparacion']?>" required disabled >
			</div>
			
			<div class="left mg_input2">
				<label for="" class="mg_t">Cocción: </label>
				<input type="text" name="coccion" id="coccion" placeholder="minutos" value="<?php echo $receta[0]['coccion']?>" required disabled >
			</div>
			
			<div class="left mg_input2">
				<label for="" class="mg_t">Costo: </label>
				<select name="costo" id="costo" disabled>
					<option value="<?php echo $receta[0]['costo']?>"><?php echo $receta[0]['costo']?></option>
					<?php for ($i=1; $i <6 ; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="left mg_input2">
				<label for="" class="mg_t">Dificultad: </label>
				<select name="dificultad" id="dificultad" disabled>
					<option value="<?php echo $receta[0]['dificultad']?>"><?php echo $receta[0]['dificultad']?></option>
					<?php for ($i=1; $i <6 ; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="clear"></div>
			
			<label for="">Imagen: </label>
			<input type="text" name="foto" id="foto" value= "<?php echo $receta[0]['foto']?>" placeholder="" required disabled>
			
			<button id="editar" onclick="editar()" type="submit" class="submit blue">Editar</button>
			<button id="guardar" onclick="guardar()"type="submit" class="submit blue">Guardar</button>
		</form>
		</div>  <!-- grey-->

		<div id="glosario" class="tablas">
			<!-- <a href="#buscar_receta" class="button large orange mg_form">Agregar</a> -->
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<td>Glosario receta</td>
	              		<td><a href="#buscar_compl" class="button orange mg_form">Agregar</a></td>
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
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<td>Complementarias receta</td>
	              		<td><a href="#buscar_compl" class="button orange mg_form">Agregar</a></td>
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
			<!-- <a href="#buscar_video" class="button large orange mg_form">Agregar</a> -->
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<td>Videos receta</td>
	              		<td><a href="#buscar_compl" class="button orange mg_form">Agregar</a></td>
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

<script>
  $(document).ready(function (){
  	$('#guardar').hide();
  	$('.mg_form').hide();

    tinymce.init({
        selector: "textarea",
        width: 950,
        menubar: false
    });

    $('#editar').click(function(){
    	$("read").removeAttr("readonly");
    	$('#guardar').show();
    	$('.mg_form').show();
   });

  });
</script>