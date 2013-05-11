<div class="wrapper">
	<div class="main">
		<!-- <a href="<?php echo base_url().'apps/view/'.$app ?>" class="back"><span>←</span> regresar</a> -->
		<div class="popup bg_grey">
	
			<?php 
				$attributes = array('class' => 'newreceta');
				echo form_open('recetas/edit/',  $attributes);
			?>

			<h2 class="mgt_50"><?php echo $receta[0]['titulo'] ?></h2>

			<input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>
			<input type="hidden" name="id" value="<?php echo $receta[0]['id'] ?>">
			
			<div class="left">
				<label for="">Nombre: </label>
				<input type="text" name="titulo" id="titulo" value="<?php echo $receta[0]['titulo'] ?>" required disabled>
			</div>
			
			<div class="left mg_input">
				<label for="">Categoria: </label>

				<select name="categoria" id="categoria" disabled>
					<?php	
						for ($i=0; $i <count($categorias) ; $i++) { ?>
						<option value="<?php echo $categorias[$i]['id'] ?>" <?php if ($receta[0]['id_categoria'] ==  $categorias[$i]['id']){ echo "selected"; } ?> ><?php echo $categorias[$i]['nombre'] ?></option>
					<?php
					} ?>
				</select>

			</div>

			<div class="left mg_input">
				<label for="">Imagen: </label>
				<input type="text" name="foto" id="foto" value= "<?php echo $receta[0]['foto']?>" placeholder="" required>
			</div>

			<div class="clear"></div>

			<div class="left">
				<label for="" class="mg_t">Tiempo de preparación: </label>
				<input type="text" name="preparacion" id="preparacion" placeholder="minutos" value="<?php echo $receta[0]['preparacion']?>" required>
			</div>

			<div class="left mg_input">
				<label for="" class="mg_t">Tiempo de cocción: </label>
				<input type="text" name="coccion" id="coccion" placeholder="minutos" value="<?php echo $receta[0]['coccion']?>"  disabled >
			</div>
			
			<div class="left mg_input">
				<label for="" class="mg_t">Costo: </label>
				<select name="costo" id="costo">
					<?php for ($i=1; $i <6 ; $i++) { ?>
						<option value="<?php echo $i; ?>" <?php if($receta[0]['costo'] == $i ){ echo "selected"; } ?> ><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
			
			<div class="left mg_input">
				<label for="" class="mg_t">Dificultad: </label>
				<select name="dificultad" id="dificultad">
					<?php for ($i=1; $i <6 ; $i++) { ?>
						<option value="<?php echo $i; ?>" <?php if($receta[0]['dificultad']==$i){ echo "selected"; } ?> ><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="left">
				<label for="" class="mg_e">Ingredientes: </label>
				<textarea name="ingredientes" id="ingredientes" class="full"><?php echo $receta[0]['ingredientes']?></textarea>
			</div>
			
			<div class="clear"></div>

			<div class="left">
				<label for="" class="mg_e">Procedimiento: </label>
				<textarea name="procedimiento" id="procedimiento" class="full"><?php echo $receta[0]['procedimiento']?></textarea>
			</div>
			
			<div class="clear"></div>
			
			<button id="editar" onclick="editar()" type="submit" class="submit blue">Editar</button>
			<button id="guardar" onclick="guardar()" type="submit" class="submit blue">Guardar</button>

			<a onClick="activar()" class="button large orange">Editar</a>

		</form>
		</div>  <!-- grey-->

		<div id="glosario" class="tablas">
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<th colspan="2">
	              			Glosario receta
	              			<!-- <a href="#buscar_compl" class="button orange mg_form">Agregar</a> -->
	              		</th>
	              		
	            	</tr>
	          	</thead>

	          	<tbody>
					<?php
						if(isset($glosarioRelacionado))
						{
							for ($i=0; $i <count($glosarioRelacionado) ; $i++) 
							{ 
								?>
								<tr>
									<td><?php echo $glosarioRelacionado[$i]['nombre']; ?></td>
									<td><?php echo "<a href='#eliminarGlosario".$glosarioRelacionado[$i]['id']."'>Eliminar</a>"; ?></td>
								</tr>
								<?php
							}
						} 
					?>
	          	</tbody>
	        </table>
		</div>

		<div id="complementarias" class="tablas">
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<th colspan="2">
	              			Complementarias receta
	              			<!-- <a href="#buscar_compl" class="button orange mg_form">Agregar</a> -->
	              		</td>
	            	</tr>
	          	</thead>
	      
	          	<tbody>
					<?php
						if(isset($complementariasRelacionadas))
						{
							for ($i=0; $i <count($complementariasRelacionadas) ; $i++) 
							{ 
								?>
								<tr>
									<td><?php echo $complementariasRelacionadas[$i]['titulo']; ?></td>
									<td><?php echo "<a href='#eliminarGlosario".$complementariasRelacionadas[$i]['id']."'>Eliminar</a>"; ?></td>
								</tr>
								<?php
							}
						} 
					?>		
	          	</tbody>
	        </table>
		</div>

		<div id="videos" class="tablas">
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<th colspan="2">
	              			Videos receta
	              			<!-- <a href="#buscar_compl" class="button orange mg_form">Agregar</a> -->
	              		</th>

	            	</tr>
	          	</thead>

	          	<tbody>
				<?php
						if(isset($videosRelacionados))
						{
							for ($i=0; $i <count($videosRelacionados) ; $i++) 
							{ 
								?>
								<tr>
									<td><?php echo $videosRelacionados[$i]['video']; ?></td>
									<td><?php echo "<a href='#eliminarGlosario".$videosRelacionados[$i]['id']."'>Eliminar</a>"; ?></td>
								</tr>
								<?php
							}
						} 
					?>
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

	    var tiny = tinymce;

	    tiny.init({
	        selector: "textarea",
	        menubar: false,
	        width: 950,
	        readonly: true,
	        theme : 'modern',
	        skin : 'lightgray',
	        protect: [
        		/\<\/?(if|endif)\>/g,
        		/\<xsl\:[^>]+\>/g,
        		/<\?php.*?\?>/g],
        	visual: false
	    });



	  });



	function activar()
	{
  		$('textarea').removeAttr("readonly");
		$('#guardar').show();
		$('.mg_form').show();
  	}

</script>