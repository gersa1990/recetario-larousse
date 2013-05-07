<div class="wrapper">
	<div class="main">

    <div id="status"></div>


    <a href="<?php echo base_url() ?>" class="back"><span>←</span> regresar</a>

    <ul class="slideshow">
      <li>
        <div class="popup bg_grey">

      			

            <?php 
                $attributes = array('class' => 'newreceta');
                echo form_open(base_url()."recetas/addComplementarias/",  $attributes);
            ?>

              <h2 class="mgt_50">Nueva receta</h2>

        			<input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>

    					<div class="left">
      					<label for="">Título: </label>
      					<input type="text" name="titulo" id="titulo" value="titulo" required>
    					</div>

    					<div class="left mg_input">
      					<label for="">Categoria: </label>
      					<select name="categoria" id="categoria">
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
      					<textarea name="procedimiento" id="procedimiento" class="full"></textarea>
    					</div>
    
        			<div class="clear"></div>
        					
    					<div class="left">
      					<label for="">Ingredientes: </label>
      					<textarea name="ingredientes" id="ingredientes" class="full"></textarea>
    					</div>
        
        			<div class="clear"></div>

    					<div class="left mg_input2">
      					<label for="">Preparación: </label>
      					<input type="text" name="preparacion" id="preparacion" placeholder="minutos" required>
    					</div>
      
    					<div class="left mg_input2">
      					<label for="">Cocción: </label>
      					<input type="text" name="coccion" id="coccion" placeholder="minutos" required>
    					</div>
    
    					<div class="left mg_input2">
      					<label for="">Costo: </label>
      					<select name="costo" id="costo">
        						<?php for ($i=1; $i <6 ; $i++) { ?>
          						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        						<?php } ?>
      					</select>
    					</div>
      
    					<div class="left mg_input2">
      					<label for="">Dificultad: </label>
      					<select name="dificultad" id="dificultad">
        						<?php for ($i=1; $i <6 ; $i++) { ?>
          						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        						<?php } ?>
      					</select>
    					</div>
      
        			<div class="clear"></div>


        			<label for="">Imagen: </label>
        			<input type="text" name="foto" id="foto" placeholder="" required>

        			<button type="submit" class="submit">Siguiente</button>
      			</form>
      		
      	</div>  <!-- popup-->
		  </li> <!-- primer elemento-->     
    </ul>
</div>

<script>

</script>