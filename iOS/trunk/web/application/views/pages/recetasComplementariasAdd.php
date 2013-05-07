<div class="wrapper">
	<div class="main">

    <div id="status"></div>


    <a href="<?php echo base_url() ?>" class="back"><span>←</span> regresar</a>

    <ul class="slideshow">
      <li>
        <div class="popup bg_grey">

      			<?php echo form_open(base_url()."recetas/addComplementarias/") ?>
              <h2 class="mgt_50">Nueva receta</h2>

        			<input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>

    					<div class="left">
      					<label for="">Título: </label>
      					<input type="text" name="titulo" id="titulo" value="<?php echo $recetas[0]['titulo'] ?>" required>
    					</div>

              <input type="text" id="id_receta" value="<?php echo $recetas[0]['id'] ?>">

    					<div class="left mg_input">
      					<label for="">Categoria: </label>
      					<select name="categoria" id="categoria">
        					<?php	
        						for ($i=0; $i <count($categorias) ; $i++) { ?>
        						  <option value="<?php echo $categorias[$i]['id'] ?>" <?php if($recetas[0]['id_categoria'] == $i){ echo "selected"; }?> ><?php echo $categorias[$i]['nombre'] ?></option>
                      <?php
      					     } ?>
      					</select>
    					</div>

        			<div class="clear"></div>

    					<div class="left">
      					<label for="">Procedimiento: </label>
      					<textarea name="procedimiento" id="procedimiento" class="full"><?php echo $recetas[0]['procedimiento'] ?></textarea>
    					</div>
    
        			<div class="clear"></div>
        					
    					<div class="left">
      					<label for="">Ingredientes: </label>
      					<textarea name="ingredientes" id="ingredientes" class="full"><?php echo $recetas[0]['ingredientes'] ?></textarea>
    					</div>
        
        			<div class="clear"></div>

    					<div class="left mg_input2">
      					<label for="">Preparación: </label>
      					<input type="text" name="preparacion" id="preparacion" value="<?php echo $recetas[0]['preparacion'] ?>" placeholder="minutos" required>
    					</div>
      
    					<div class="left mg_input2">
      					<label for="">Cocción: </label>
      					<input type="text" name="coccion" value="<?php echo $recetas[0]['coccion'] ?>" id="coccion" placeholder="minutos" required>
    					</div>
    
    					<div class="left mg_input2">
      					<label for="">Costo: </label>
      					<select name="costo" id="costo">
        						<?php for ($i=1; $i <6 ; $i++) { ?>
          						<option value="<?php echo $i; ?>" <?php if($recetas[0]['titulo'] ==$i ){ echo "selected";} ?>><?php echo $i; ?></option>
        						<?php } ?>
      					</select>
    					</div>
      
    					<div class="left mg_input2">
      					<label for="">Dificultad: </label>
      					<select name="dificultad" id="dificultad">
        						<?php for ($i=1; $i <6 ; $i++) { ?>
          						<option value="<?php echo $i; ?>"  <?php if($recetas[0]['dificultad'] ==$i ){ echo "selected";} ?>  ><?php echo $i; ?></option>
        						<?php } ?>
      					</select>
    					</div>
      
        			<div class="clear"></div>


        			<label for="">Imagen: </label>
        			<input type="text" name="foto" id="foto" value="<?php echo $recetas[0]['foto']; ?>" placeholder="" required>

        			<button type="submit" class="submit">Siguiente</button>
      			</form>
      		
      	</div>  <!-- popup-->
		  </li> <!-- primer elemento-->   

      <li> <!-- Segundo elemento -->
        <div class="bg_grey">
          <input class="input mg_bt" type="text" name="searchComplementarias" id="searchComplementarias" placeholder="Buscar...">
          <div id="resultComplementarias"></div>
          <table id="ComplementariasRelacionadas">
            <thead>
              <tr>
                <td>Recetas complementarias</td>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
         </table>
        </div>
      </li>  <!-- Fin del segundo elemento -->


      <li>
        <div class="bg_grey">
          <input class="input mg_bt" type="text" name="searchVideos" id="searchVideos" placeholder="Buscar...">
          <div id="resultVideos"></div>
          <table id="videos">
              <thead>
              <tr>
                <td>Videos relacionados</td>
              </tr>
            </thead>
            <tbody>
              
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

var base_url = "<?php echo base_url() ?>";
var app = 

var bxSlider = $('.slideshow').bxSlider({
    mode: 'horizontal', // 'horizontal', 'vertical', 'fade'
    video: true,
    useCSS: true,
    pager: true,
    speed: 500, // transition time
    startSlide: 1,
    infiniteLoop: true,
    captions: true,
    adaptiveHeight: false,
    touchEnabled: true,
    pause: 4000,
    autoControls: false,
    controls: false
  });

$("#searchComplementarias").keyup(function ()
{
    var titulo = $("#searchComplementarias").val();
    var app = $("#id_app").val();
    var id_receta = $("#id_receta").val();

    $.post(base_url+"complementarias/searchByName2/", {palabra: titulo, id_app:app, receta: id_receta  }, function (data)
    {
      $("#resultComplementarias").html(data);
      $("#resultComplementarias div button").each(function (data)
      {
          $(".complementarias").click(function (data)
          {
             var id_complementaria = $(this).attr('id');
             //console.log(id_complementaria);

             $.post(base_url+"complementarias/addToRecipe/", {complementaria: id_complementaria , id_app: app, receta: id_receta }, function (data)
              {
                console.log(data);
                $("#ComplementariasRelacionadas tbody").append(data);
                bxSlider.reloadSlider();
              });
          });
      });
    });
});

</script>