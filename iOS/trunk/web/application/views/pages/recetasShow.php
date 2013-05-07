<div class="wrapper">
	<div class="main">
    <div id="status"></div>

    <a href="<?php echo base_url() ?>" class="back"><span>←</span> regresar</a>

    <ul class="slideshow">
      <li>
        <div class="popup bg_grey">

      			<form name="agregarRecetas" id="agregarRecetas" class="newreceta" method="post">
              <h2 class="mgt_50">Nueva receta</h2>

        			<input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="" required>

    					<div class="left">
      					<label for="">Título: </label>
      					<input type="text" name="titulo" id="titulo" value="" placeholder="Título" required>
    					</div>

    					<div class="left mg_input">
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
      		
      	</div>  <!-- popup-->
		  </li> <!-- primer elemento-->
		  	
      <li>
        <div class="bg_grey">
          <input class="input mg_bt" type="text" name="searchVideos" id="searchVideos" placeholder="Buscar...">
		  		
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
        <div class="bg_grey">
          <input class="input mg_bt" type="text" name="searchComplementarias" id="searchComplementarias" placeholder="Buscar...">
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
        <div class="bg_grey">
          <input class="input mg_bt" type="text" name="searchGlosario" id="searchGlosario" placeholder="Buscar...">
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