
<div class="wrapper">
  
  <!-- <input type="submit" class="exportar" value="Exportar"> -->
  <div id="status" style="height:30px;">
     
  </div>

  <div class="main">

    <div class="columl">

      <nav id="menu">
        <ul>
          <li class="active"><a id="getRecipes" class="">Recetas</a></li>
          <li><a id="getCategory" class="">Categorias</a></li>
          <li><a id="getGlosary" class="">Glosarios</a></li>
          <li><a id="getVideos" class="">Videos</a></li>
          <li><a id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
      

    </div>
    
    <div class="columr">

      <div id="addblock">

        <div id="tabla">
  
        <table id="recetas">
          <thead>
            <tr>
              <td colspan="2"><input id="nuevaReceta" type="submit" class="button mg1 bl1" value="Nueva receta"></td>
            </tr>
            <tr>
              <td colspan="2"><input type="text" name="" id="buscar" class="input post buscar" placeholder="Buscar.." value=""></td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php if(isset($recetas))
                  {
                    for ($i=0; $i <count($recetas) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <a class="verRecetas" id="<?php echo $recetas[$i]['id']; ?>" class="bluetext">
                              <?php echo $recetas[$i]['titulo']; ?>
                            </a>
                          </td>

                          <td>
                            <a class="editarRecetas" id="<?php echo $recetas[$i]['id']; ?>">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a class='eliminarRecetas'>
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        </div>
        
      </div>


    </div>
  </div>

</div>

<div class="clear"></div>

</div>

<script>

var app ="<?php echo $app; ?>";

$("#getRecipes").click(function (data)
{
  console.log("recetas");           

    $.post(base_url+"recetas/getAllRecipes/", {id_app: app} , function (data)
    {
        $("#addblock").html(data);

        $(".blockscroll tr .txleft").each(function (text)
        {
          $(".editarRecetas").click(function (data)
          {
            var id = $(this).attr('id');

            console.log("ID_RECETA: "+id+" ID_APP: "+app);

              $.post(base_url+"recetas/searchById/", {id_receta: id, id_app: app }, function (data)
              {
                $("#addblock").html(data);

                  $("#form_recetas2").submit(function ()
                  {
                    console.log("submit");
                    var id_receta = $("#");
                    return false;
                  });
              });

              return false;
          });
        });

        $("#buscar").keyup(function (data)
        {
          var texto = $("#buscar").val();
                  
          console.log(texto);

          $.post(base_url+"recetas/searchByName/" ,{palabra: texto, id_app: app}, function (data)
          {
            console.log(data);

            $("#recetas tbody").html(data);
          }); 
        });

    });
});

$("#getCategory").click(function (data)
{
    console.log("getAllCategorys");
});

$("#getGlosary").click(function (data)
{
    console.log("getAllGlosary");
});

$("#getVideos").click(function (data)
{
    console.log("getAllVideos");
});

$("#getComplementsRecipes").click(function (data)
{
    console.log("getAllRecipesComplements");
});

$( "#tabs" ).tabs().css('display','none');

var app = "<?php echo $app; ?>";
var base_url = "<?php echo base_url(); ?>";


$(".blockscroll tr .txleft").each(function (text)
{
  $(".editarRecetas").stop(true);

  $(".editarRecetas").click(function (data)
  {
      var id = $(this).attr('id');

      $.post(base_url+"recetas/searchById/", {id_receta:id, id_app: app }, function (data)
      {
          $("#addblock").html(data);
          //console.log(data);

          $("#form_recetas2").submit(function ()
          {
            console.log("submit");
            var id_receta = $("#")
            return false;
          });
      });

    return false;
  });
});

//console.log(base_url);

$("#nombreApp").keyup(function ()
{
    var nombreApp = $("#nombreApp").val();

    //Buscar si ya existe ese nombre de APP y no dejar que esté vacio

    $.post(base_url+"apps/updateNombre/", {nombre: nombreApp, id_app: app}, function (data)
    {
        
    });
});

$("#form_recetas").submit(function ()
{
    var title         = $("#titulo").val();
    var id_cat        = $("#categoria").val();
    var proced        = $("#procedimiento").val();
    var ingre         = $("#ingredientes").val();
    var prep          = "0";
    var cocc          = $("#coccion").val();
    var cost          = $("#costo").val();
    var imagen        = $("#foto").val();
    var favoritos     = "0";
    var dificult      = $("#dificultad").val();

    if(ingre!="" && prep!="" && imagen!="")
    {
      $.post(""+base_url+"recetas/creates/" , { titulo: title, id_categoria: id_cat, id_app: app, procedimiento: proced, ingredientes: ingre, preparacion: prep, coccion: cocc, costo:cost, foto: imagen, user_fav: favoritos, dificultad: dificult}, function (data)
        {
            console.log(data);
        });
    }


    return false;
});

$(".myform").css('display','none');

$("#nuevaReceta").click(function ()
{
    $(".myform").fadeIn("slow");
});

$("#buscar").keyup(function (data)
{
  var texto = $("#buscar").val();

  $.post(base_url+"recetas/searchByName/" ,{palabra: texto, id_app: app}, function (data)
  {
    $("#recetas tbody").html(data);
  }); 
});

</script>