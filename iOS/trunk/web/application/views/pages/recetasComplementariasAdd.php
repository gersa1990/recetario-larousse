<div class="wrapper">
  <div class="main">

    <div id="status"></div>

    <!-- <a href="<?php echo base_url() ?>" class="back"><span>←</span> regresar</a> -->

    <input type="hidden" name="id_app" id="id_app" value="<?php echo $app; ?>" placeholder="" required>
    <input type="hidden" id="id_receta" value="<?php echo $recetas[0]['id'] ?>">

    <div class="bg_grey">
      <h2 class="myriadFont title_app">Nueva receta</h2>
      
      <div id="resultComplementarias"></div>

      <table id="ComplementariasRelacionadas">
        <thead>
          <tr>
            <td>
              <input class="input fix_input" type="text" name="searchComplementarias" id="searchComplementarias" placeholder="Buscar...">
              Recetas complementarias
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-left" colspan="2">
              <input type="checkbox" name="vehicle" value="Bike">complementaria 1
            </td>
          </tr>
          <tr>
            <td class="text-left" colspan="2">
              <input type="checkbox" name="vehicle" value="Bike">complementaria 2
            </td>
          </tr>
                          
        </tbody>
     </table>
    </div>

    <div class="bg_grey">

      <div id="resultVideos"></div>
      <table id="videos">
          <thead>
          <tr>
            <td>
              Videos relacionados
              <input class="input fix_input" type="text" name="searchVideos" id="searchVideos" placeholder="Buscar...">
            </td>
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
              <td><?php echo $videosRelacionados[$i]['video'] ?></td>
            </tr>              
          <?php
            }
          }
           ?>
        </tbody>
      </table>
    </div>

    <div class="bg_grey">
      
      <div id="resultGlosary"></div>

      <table id="glosariosRelacionados">
        <thead>
          <tr>
            <td>
              Glosarios relacionados
              <input class="input fix_input" type="text" name="searchGlosary" id="glosarioBuscar" placeholder="Buscar glosario...">
            </td>
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


  </div>
</div>

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