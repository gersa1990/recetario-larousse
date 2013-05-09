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
              <?php if(isset($complementariasRelacionadas))
              { 
                for ($i=0; $i <count($complementariasRelacionadas) ; $i++) 
                { 
               ?>
              <tr>
                <td><?php echo $complementariasRelacionadas[$i]['titulo'] ?></td>
              </tr>
              <?php
                }
              }
               ?>
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

              <?php 

              if(isset($videosRelacionados))
              { 
                for ($i=0; $i <count($videosRelacionados) ; $i++) 
                { 
               ?>
                <tr>
                  <td><?php echo $videosRelacionados[$i]['nombre'] ?></td>
                </tr>              
              <?php
                }
              }
               ?>
            </tbody>
          </table>
        </div>
        
      </li>


      <li>

        <div class="bg_grey">
          <input class="input mg_bt" type="text" name="searchGlosary" id="glosarioBuscar" placeholder="Buscar glosario...">
          
          <div id="resultGlosary"></div>

          <table id="glosariosRelacionados">
            <thead>
              <tr>
                <td>Glosarios relacionados</td>
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
                          <td><?php echo $glosarioRelacionado[$i]['nombre'] ?></td>
                      </tr>
                      <?php
                    }
                  }
                 ?>
            </tbody>
          </table>
        </div>

      </li>



    </ul>
</div>

<script>

var base_url = "<?php echo base_url() ?>";
var app = $("#id_app").val();

var bxSlider = $('.slideshow').bxSlider({
    mode: 'horizontal', // 'horizontal', 'vertical', 'fade'
    pager: true    
  });


// Buscar recetas complementarias

    var app = $("#id_app").val();
    var id_receta = $("#id_receta").val();

$("#searchComplementarias").keyup(function ()
{

    var titulo = $("#searchComplementarias").val();
    var app = $("#id_app").val();
    var id_receta = $("#id_receta").val();

    $.post(base_url+"complementarias/searchByName2/", {palabra: titulo, id_app:app, receta: id_receta  }, function (data)
    {
      // Buscar recetas complementarias que se pueden agregar mediante una palabra en especifico

      $("#resultComplementarias").html(data);
      
      
        // Mostrar recetas complementarias que resultaron de la consulta anterior

          $(".complementarias").click(function (dat)
          {

            // Agregar complementarias para que se relacionen con 

             var id_complementaria = $(this).attr('id');
             
             //console.log(id_complementaria);

             $("#div_"+id_complementaria).css("display","none");

              
                $.post(base_url+"complementarias/addToRecipe/", {complementaria: id_complementaria , id_app: app, receta: id_receta }, function (datas)
                {
                  $("#ComplementariasRelacionadas tbody").append(datas);
                  console.log(datas);
                });
               
               
          });
      
    });
});

$("#searchVideos").keyup(function ()
{
    var titulo = $("#searchVideos").val();
    var app = $("#id_app").val();
    var receta = $("#id_receta").val();

    console.log(titulo);
    console.log(app);
    

    $.post(base_url+"videos/searchByName2/", {palabra: titulo, id_app:app, id_receta: receta  }, function (data)
    {
      console.log(data);

     

        $("#resultVideos").html(data);

            $(".videos").click(function (das)
            { 
             
             var video = $(this).attr('id');
             $("#div_"+video).css("display","none");

            
              $.post(base_url+"videos/addToRecipe/", {id_video: video , id_app: app, receta: id_receta }, function (data2)
                {
                  $("#videos tbody").append(data2);
                });
              
          });
    });
});

$("#glosarioBuscar").keyup(function ()
{

    var titulo  = $("#glosarioBuscar").val();
    var app     = $("#id_app").val();
    var receta  = $("#id_receta").val();

    $.post(base_url+"glosario/searchByName2/", {palabra: titulo, id_app:app, id_receta: receta  }, function (data)
    {
       $("#resultGlosary").html(data);

        $(".glosario").click(function (das)
            { 
             
             var glosario = $(this).attr('id');
             $("#div_"+glosario).css("display","none");

            var i=0;

            if(i==0)
            {
              $.post(base_url+"glosario/addToRecipe/", {id_glosario: glosario , id_app: app, id_receta: receta }, function (data2)
                {
                  console.log(data2);
                  $("#glosariosRelacionados tbody").append(data2);
                });
              i=1;
            }
          });

    });
  
});


</script>