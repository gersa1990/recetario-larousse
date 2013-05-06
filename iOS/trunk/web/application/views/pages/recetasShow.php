<div class="wrapper">
	<div class="main">
	<ul class="slideshow">
        <li>
          	
          	<!-- Dar de alta una nueva receta -->
			 <div id="nuevaReceta" class="">
			 	<div class="popup form_receta">
                  <div id="formulario">
					<h1>Dar de alta una nueva receta</h1>

        				<form name="agregarRecetas" id="agregarRecetas" method="post">        

          					<h2 class="mgt_50">Nueva receta</h2>

          					<input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="" required>

          					<div class="left">
            					<label for="">Título: </label>
            					<input type="text" name="titulo" id="titulo" value="" placeholder="Título" required>
          					</div>

          					<div class="left">
            					<label for="">Categoria: </label>
            					<select name="categoria">
              					<?php	
              						for ($i=0; $i <count($categorias) ; $i++) { ?>
              						<option value="<?php echo $categorias[$i]['id'] ?>"><?php echo $categorias[$i]['nombre'] ?></option>
              					<?php
            					} ?>
            					</select>
          					</div>

          					<div class="clear"></div>

          					<div class="left">
            					<label for="">Procedimiento: </label>
            					<textarea name="procedimiento" class="full"></textarea>
          					</div>
          
          					<div class="clear"></div>
          					
          					<div class="left">
            					<label for="">Ingredientes: </label>
            					<textarea name="ingredientes" class="full"></textarea>
          					</div>
          
          					<div class="clear"></div>

          					<div class="left mg_input2">
            					<label for="">Preparación: </label>
            					<input type="text" name="preparacion" value="" placeholder="minutos" required>
          					</div>
        
          					<div class="left mg_input2">
            					<label for="">Cocción: </label>
            					<input type="text" name="coccion" value="" placeholder="minutos" required>
          					</div>
          
          					<div class="left mg_input2">
            					<label for="">Costo: </label>
            					<select name="costo">
              						<?php for ($i=1; $i <6 ; $i++) { ?>
                						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              						<?php } ?>
            					</select>
          					</div>
        
          					<div class="left mg_input2">
            					<label for="">Dificultad: </label>
            					<select name="dificultad">
              						<?php for ($i=1; $i <6 ; $i++) { ?>
                						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              						<?php } ?>
            					</select>
          					</div>
        
          					<div class="clear"></div>

          					<label for="">Imagen: </label>
          					<input type="text" name="foto" value="" placeholder="" required>

          					<button type="submit" class="submit">Siguiente</button>
        				</form>
        			</div>
        		</div>
			</div> 	<!-- nuevaReceta -->
			<!-- Termina dar de alta una nueva receta -->
		</li>
		  	
        <li>
			<div>
		  		<input class="search" type="search" name="searchVideos" id="searchVideos" placeholder="Busqueda de videos">
		  		
		  		<table id="videosRelacionados">
		  			<thead>
		  				<tr>
		  					<td>Videos relacionados</td>
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<tr>
		  					<td>Video 1</td>
		  				</tr>
		 			</tbody>
		  		</table>
		  	</div>
        </li>
          
        <li>
          	<div>
		  		<input class="search" type="search" name="searchComplementarias" id="searchComplementarias" placeholder="Busqueda de recetas complementarias">
		  		<table id="recetasComplementarias">
		  			<thead>
		  				<tr>
		  					<td>Recetas complementarias</td>
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<tr>
		  					<td>Complementaria 1</td>
		  				</tr>
		  			</tbody>
		  		</table>
		  	</div>
        </li>

          
        <li>
          	<div>
		  		<input class="search" type="search" name="searchGlosario" id="searchGlosario" placeholder="Busqueda de glorsarios para relacionar">
		  		<table id="glosariosRelacionados">
		  			<thead>
		  				<tr>
		  					<td>Glosarios relacionados</td>
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<tr>
		  					<td>Glosario 1</td>
		  				</tr>
		  			</tbody>
		  		</table>
		  	</div>
        </li>
     
        </ul>
</div>

<script>
$("#agregarRecetas").submit(function (data)
{
	alert("submit");
	$("ul").append("<li>Hola</li>");
	return false;
});
</script>