<div class="wrapper">
	<div class="main">
    <a href="<?php echo base_url().'apps/view/'.$app; ?>" class="home"><span>←</span> regresar</a>

    <div id="status"></div>

    <div class="popup bg_grey">

      <h2 class="myriadFont title_app">Nueva receta</h2>

        <?php 
            $attributes = array('class' => 'newreceta');
            echo form_open(base_url()."recetas/addComplementarias/",  $attributes);
        ?>
    			<input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>

					<div class="left">
  					<label for="">Nombre: </label>
  					<input type="text" name="titulo" id="titulo" value="" placeholder="nombre" required>
					  <div class="alert error" id="errorNuevaReceta" style="display:none">Este nombre de receta ya existe</div>
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

          <div class="left mg_input">
            <label for="">Imagen: </label>
            <input type="text" name="foto" id="foto" placeholder="imagen" required>
          </div>

    			<div class="clear"></div>

          <div class="left">
            <label for="" class="mg_t">Tiempo de preparación: </label>
            <input type="text" name="preparacion" id="preparacion" placeholder="minutos" required>
          </div>

          <div class="left mg_input">
            <label for="" class="mg_t">Tiempo de cocción: </label>
            <input type="text" name="coccion" id="coccion" placeholder="minutos" required>
          </div>

          <div class="left mg_input">
            <label for="" class="mg_t">Costo: </label>
            <select name="costo" id="costo">
                <?php for ($i=1; $i <6 ; $i++) { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
          </div>
  
          <div class="left mg_input">
            <label for="" class="mg_t">Dificultad: </label>
            <select name="dificultad" id="dificultad">
                <?php for ($i=1; $i <6 ; $i++) { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
          </div>

          <div class="clear"></div>

          <div class="left">
            <label for="" class="mg_e">Ingredientes: </label>
            <textarea name="ingredientes" id="ingredientes" class="full"></textarea>
          </div>

          <div class="clear"></div>

					<div class="left">
  					<label for="" class="mg_e">Procedimiento: </label>
  					<textarea name="procedimiento" id="procedimiento" class="full"></textarea>
					</div>

    			<div class="clear"></div>
  
    			<button type="submit" id="submitNuevaReceta" class=" mg_e submit">Siguiente</button>
  			</form>
  		
  	</div>

</div>

<script>
  
  var base_url = "<?php echo base_url(); ?>";
  var app      = "<?php echo $app; ?>";

  $(document).ready(function (){
    tinymce.init({
        selector: "textarea",
        width: 950,
        height: 200,
        menubar: false
    });
  });

  $("#titulo").keyup(function ()
    {
      var tittle = $("#titulo").val();

      $.post(base_url+"recetas/checkExistence/", {titulo: tittle, id_app: app }, function(data)
        {
            if(data=="Existe")
            {
              $("#errorNuevaReceta").slideDown("slow");
              $("#submitNuevaReceta").slideUp("slow");
            }
            else
            {
              $("#errorNuevaReceta").slideUp("slow");
              $("#submitNuevaReceta").slideDown("slow");
            }
        });
    });
        
</script>