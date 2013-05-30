<div class="wrapper">
	<div class="main">

		<div class="popup bg_grey">
	
			<?php 
				$attributes = array('class' => 'newreceta');
				echo form_open('recetas/edit/',  $attributes);
			?>

			<h2 class="mgt_50"><?php echo $receta[0]['titulo'] ?></h2>

			<input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>">
			<input type="hidden" name="id" value="<?php echo $receta[0]['id'] ?>">
			
			<div class="left">
				<label for="">Nombre: </label>
				<input type="text" name="titulo" id="titulo" value="<?php echo $receta[0]['titulo'] ?>" required>
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
				<input type="text" name="coccion" id="coccion" placeholder="minutos" value="<?php echo $receta[0]['coccion']?>">
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
			
			<button id="editar" type="button" class="submit blue">Editar</button>
			<button id="guardar" type="submit" class="submit blue">Guardar</button>

		</form>
		</div>  <!-- Form -->

		<div id="glosario" class="tablas">
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<th colspan="2">
	              			Glosario receta
							<a href="#add_glosario" class="button orange mg_form">Agregar</a>
	              		</th>
	              		
	            	</tr>
	          	</thead>

	          	<tbody>
					<?php
						if(isset($glosarioRelacionado)){
							for ($i=0; $i <count($glosarioRelacionado) ; $i++) 
							{ 
								?>
								<tr>
									<td><?php echo $glosarioRelacionado[$i]['nombre']; ?></td>
									<td class="delete">
										<?php echo "<a href='#eliminarGlosario".$glosarioRelacionado[$i]['id']."'>Eliminar</a>"; ?>
									</td>
								</tr>

								<div id="eliminarGlosario<?php echo $glosarioRelacionado[$i]['id']; ?>" class="modalDialog">
			                        <div class="popup form_delete">
			                          <a href="#" title="Close" class="close">x</a>
			                
			                          <?php echo form_open("glosario/deleteToRecipe/"); ?>
			                            <h2>Término de glosario</h2>

			                            <input type="hidden" name="id_glosario" value="<?php echo $glosarioRelacionado[$i]['id']; ?>">
			                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
										<input type="hidden" name="id_receta" value="<?php echo $receta[0]['id'] ?>">
			

			                            <p class="mg-auto"><?php echo $glosarioRelacionado[$i]['nombre']; ?></p>         
			                            <button type="submit" class="submit">Eliminar</button>

			                          </form>
			                    	</div>
			                    </div>
								<?php
							}
							if(count($glosarioRelacionado)<=0)
		                	{
		                		echo "<tr>";
								print "<td>No existen glosarios relacionados</td>";
								print "</tr>";
		                	}
						}
					?>
	          	</tbody>
	        </table>
		</div> <!-- Tabla glosario -->

		<div id="complementarias" class="tablas">
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<th colspan="2">
	              			Complementarias receta
	              			<a href="#add_receta" class="button orange mg_form">Agregar</a>
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
									<td class="delete">
										<?php echo "<a href='#eliminarReceta".$complementariasRelacionadas[$i]['id']."'>Eliminar</a>"; ?>
									</td>
								</tr>

								<div id="eliminarReceta<?php echo $complementariasRelacionadas[$i]['id']; ?>" class="modalDialog">
			                        <div class="popup form_delete">

			                          <a href="#" title="Close" class="close">x</a>
			                
			                          <?php echo form_open("complementarias/deleteToRecipe/"); ?>

										<input type="hidden" name="id_app" value="<?php echo $app; ?>">
			                          	<input type="hidden" name="id_comp" value="<?php echo $complementariasRelacionadas[$i]['id']; ?>">
			                          	<input type="hidden" name="id_receta" value="<?php echo $receta[0]['id'] ?>">

			                            <h2>Receta complementaria</h2>
			                            <p class="mg-auto"><?php echo $complementariasRelacionadas[$i]['titulo']; ?></p>         
			                            <button type="submit" class="submit">Eliminar</button>

			                          </form>
			                        </div>
			                     </div>

								<?php
							}

							if(count($complementariasRelacionadas)<=0)
							{
								print "<tr>";
								print "<td>No existen recetas complementarias relacionadas</td>";
								print "</tr>";
							}	
						} 
					?>	
	          	</tbody>
	        </table>
		</div> <!-- Tabla complementarias -->

		<div id="videos" class="tablas">
			<table id="" class="wt_50">
				<thead>
	            	<tr>
	              		<th colspan="2">
	              			Videos receta
	              			<a href="#add_video" class="button orange mg_form">Agregar</a>
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
									<td class="delete">
										<?php echo "<a href='#eliminarVideo".$videosRelacionados[$i]['id']."'>Eliminar</a>"; ?>
									</td>
								</tr>

								<div id="eliminarVideo<?php echo $videosRelacionados[$i]['id']; ?>" class="modalDialog">
			                        <div class="popup form_delete">

			                          <a href="#" title="Close" class="close">x</a>
			                
			                          <?php echo form_open("videos/deleteToRecipe/"); ?>

			                           	<input type="hidden" name="id_video" value="<?php echo $videosRelacionados[$i]['id']; ?>">
			                           	<input type="hidden" name="id_app" value="<?php echo $app; ?>">
			                           	<input type="hidden" name="id_receta" value="<?php echo $receta[0]['id'] ?>">

			                            <h2>Video</h2>
			                            <p class="mg-auto"><?php echo $videosRelacionados[$i]['titulo']; ?></p>         
			                            <button type="submit" class="submit">Eliminar</button>

			                          </form>
			                        </div>
			                     </div>

								<?php
							}

							if(count($videosRelacionados)<=0)
							{
								print "<tr>";
								print "<td>No existen videos relacionados</td>";
								print "</tr>";
							}
						}
					?>
	          	</tbody>
	        </table>
		</div> <!-- Tabla video -->

		<!-- popup's-->
		<div id="add_glosario" class="modalDialog">
          <div class="popup form_receta">

            <a href="#" title="Close" class="close">x</a>

            <h2 class="mg_20 myriadFont">Terminos de glosario</h2>
            <?php echo form_open('glosario/addCheckGlosario');?>

            	<input type="hidden" name="id_app" value="<?php echo $app; ?>">
			    <input type="hidden" name="id_receta" value="<?php echo $receta[0]['id'] ?>">


		        <table>
		            <thead>
		              <tr>
		                <th>Terminos de glosario</th>
		              </tr>
		            </thead>

		            <tbody>
		              <?php
		                if(isset($glosarioComplemento)){
		                  for ($i=0; $i <count($glosarioComplemento) ; $i++) { 
		                    ?>
		                    <tr>
		                      <td class="txleft">
		                        <input type="checkbox" name="glosarioComplemento[]" value="<?php echo $glosarioComplemento[$i]['id']?>">
		                        <?php echo $glosarioComplemento[$i]['nombre']; ?>
		                      </td>
		                    </tr>
		                    <?php
		                  }
		                }
		                if(count($glosarioComplemento)<=0)
		                {
		                		echo "<tr>";
								print "<td>No existen glosarios para relacionar</td>";
								print "</tr>";
		                }
		              ?>
		            </tbody>
	         	</table>

	         	<input type="submit" class="submit add" value="Agregar"/> 
      		</form>

          </div>
        </div> <!-- popup addglosario -->
		
		<div id="add_receta" class="modalDialog">
          <div class="popup form_receta">

            <a href="#" title="Close" class="close">x</a>


            <h2 class="mg_20 myriadFont">Relacionar receta complementaria</h2>
            <?php echo form_open('complementarias/addCheckComplemento');?>

            	<input type="hidden" name="id_app" value="<?php echo $app; ?>">
			    <input type="hidden" name="id_receta" value="<?php echo $receta[0]['id'] ?>">


		        <table>
		            <thead>
		              <tr>
		                <th>Recetas complementarias</th>
		              </tr>
		            </thead>

		            <tbody>
		              <?php
		                if(isset($recetasComplemento)){
		                  for ($i=0; $i <count($recetasComplemento) ; $i++) { 
		                    ?>
		                    <tr>
		                      <td class="txleft">
		                        <input type="checkbox" name="recetasComplemento[]" value="<?php echo $recetasComplemento[$i]['id']?>">
		                        <?php echo $recetasComplemento[$i]['titulo']; ?>
		                      </td>
		                    </tr>
		                    <?php
		                  }

		                  if(count($recetasComplemento)<=0)
		                  {
		                  		echo "<tr>";
								print "<td>No existen recetas complementarias para relacionar</td>";
								print "</tr>";
		                  }
		                }
		              ?>
		            </tbody>
	         	</table>

	         	<input type="submit" class="submit add" value="Agregar"/> 
      		</form>

          </div>
        </div><!-- popup receta -->

        <div id="add_video" class="modalDialog">
          <div class="popup form_receta">

            <a href="#" title="Close" class="close">x</a>

            <h2 class="mg_20 myriadFont">Relacionar video</h2>
            <?php echo form_open('videos/addCheckVideos');?>

            	<input type="hidden" name="id_app" value="<?php echo $app; ?>">
			    <input type="hidden" name="id_receta" value="<?php echo $receta[0]['id'] ?>">


		        <table>
		            <thead>
		              <tr>
		                <th>Videos</th>
		              </tr>
		            </thead>

		            <tbody>
		              <?php
		                if(isset($videosComplemento)){
		                  for ($i=0; $i <count($videosComplemento) ; $i++) { 
		                    ?>
		                    <tr>
		                      <td class="txleft">
		                        <input type="checkbox" name="videosComplemento[]" value="<?php echo $videosComplemento[$i]['id']?>">
		                        <?php echo $videosComplemento[$i]['titulo']; ?>
		                      </td>
		                    </tr>
		                    <?php
		                  }

		                  if(count($videosComplemento)<=0)
		                  {
		                  		echo "<tr>";
								print "<td>No existen videos para relacionar</td>";
								print "</tr>";
		                  }

		                }
		              ?>
		            </tbody>
	         	</table>

	         	<input type="submit" class="submit add" value="Agregar"/> 
      		</form>
            
            
			




          </div>
        </div><!-- popup addvideo -->


        <!-- popup eliminar -->
        

	</div>
</div>

<script>

var base_url = "<?php echo base_url(); ?>";
var app   = "<?php echo $app; ?>";

	  $(document).ready(function (){

	  	$('#guardar').hide();
	  	$('.mg_form').hide();
	  	$('.delete').hide();
	  	$('input[type=text], textarea').attr("disabled", "disabled");
	  	$('select').attr('disabled', true); 

	  	var tiny = tinymce;

			tiny.init({

	        	selector: "textarea",
	        	menubar: false,
	        	width: 950,
	        	readonly: true
	    	});
	  	
	  });

	  $('#editar').click(function (data)
	  	{
			$('#guardar').show();
			$('.mg_form').show();
			$('.delete').show();
			$('input[type=text], textarea').removeAttr('disabled');
			$('select').attr('disabled', false);

	    	var tiny = tinymce;

			tiny.init({

	        	selector: "textarea",
	        	menubar: false,
	        	width: 950

	    	});
	  	});

$("#titulo").keyup(function (data)
{
	var tittle = $("#titulo").val();
	
	if (tittle!=""){
		$.post(base_url+"recetas/updateCheckExistence/", {titulo:tittle, id_app: app }, function (data)
		{
			console.log(data);
		});
	}
});

$(".newreceta").validate(
  {
    rules: {
      preparacion: 
      {
         digits: true,
         required: true
      },
      coccion: 
      {
         digits: true,
         required: true
      }
    },
    messages: 
    {
      preparacion: 
      {
        digits: "Solo minutos (0-9)",
        required: "Tienes que completa este campo"
      },
      coccion: 
      {
        digits: "Solo minutos (0-9)",
        required: "Tienes que completa este campo"
      }
    }
  });
</script>