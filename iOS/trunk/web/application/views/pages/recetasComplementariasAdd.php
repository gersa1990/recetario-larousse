<div class="wrapper">
  <div class="main">

    <div id="status"></div>

    <!-- <a href="<?php echo base_url() ?>" class="back"><span>←</span> regresar</a> -->

    <input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>
    <input type="hidden" id="id_receta" value="<?php echo $recetas[0]['id'] ?>">

    <h2 class="myriadFont title_app">Nueva receta</h2>

    <div class="bg_grey">
      <?php
        echo form_open('complementarias/addCheck');?>
        <input type="hidden" name="id_app" value="<?php echo $app; ?>">
        <input type="hidden" name="id_receta" value="<?php echo $recetas[0]['id'] ?>">

        <fieldset>
        <!-- <legend>Recetas complementarias:</legend> -->
          <table>
            <thead>
              <tr>
                <th>Recetas complementarias</th>
              </tr>
            </thead>

            <tbody>
              <?php
                if(isset($complementarias)){
                  for ($i=0; $i <count($complementarias) ; $i++) { 
                    ?>
                    <tr>
                      <td class="txleft">
                        <input type="checkbox" name="complementarias[]" value="<?php echo $complementarias[$i]['id']?>">
                        <?php echo $complementarias[$i]['titulo']; ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </fieldset>

        <fieldset>
        <!-- <legend>Videos:</legend> -->
          <table>
            <thead>
              <tr>
                <th>Videos</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($videos)){
                  for ($i=0; $i <count($videos) ; $i++) { 
                    ?>
                    <tr>
                      <td class="txleft">
                        <input type="checkbox" name="videos[]" value="<?php echo $videos[$i]['id'];?>">
                        <?php echo $videos[$i]['titulo']; ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </fieldset>

        <fieldset>
        <!-- <legend>Terminos de glosario:</legend> -->

        <table>
          <thead>
            <tr>
              <th>Terminos de glosario</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(isset($glosario)){
                for ($i=0; $i <count($glosario) ; $i++) { 
                ?>
                <tr>
                  <td class="txleft">
                    <input type="checkbox" name="glosario[]" value="<?php echo $glosario[$i]['id']; ?>">
                    <?php echo $glosario[$i]['nombre']; ?>
                  </td>
                </tr>
                <?php
                }
              } 
            ?>
          </tbody>
        </table>
      </fieldset>

      <input type="submit" class="submit" value="Guardar" /> 
      </form>

    </div>

    

  </div><!-- main -->
</div><!-- wrapper -->

<script>

var base_url = "<?php echo base_url() ?>";
var app = $("#id_app").val();

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

    console.log(titulo);

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
                  //console.log(data2);
                  $("#glosariosRelacionados tbody").append(data2);
                });
              i=1;
            }
          });

    });
  
});


</script>