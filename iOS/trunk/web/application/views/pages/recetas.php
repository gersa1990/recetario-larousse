
<div class="wrapper">
  
  <!-- <input type="submit" class="exportar" value="Exportar"> -->

  <div class="main">

    <div class="columl">

      <nav id="menu">
        <ul>
          <li class="active"><a href="<?php echo base_url(); ?>categorias/view/<?php echo $app; ?>" class="">Categorias</a></li>
          <li><a href="<?php echo base_url(); ?>glosario/view/<?php echo $app; ?>" class="">Glosarios</a></li>
          <li><a href="<?php echo base_url(); ?>videos/view/<?php echo $app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url(); ?>complementarias/view/<?php echo $app; ?>" class="">Recetas complementarias</a></li>
          <li><a href="<?php echo base_url(); ?>apps/view/<?php echo $app; ?>" class="">Recetas</a></li>
        </ul>
      </nav>


      <div id="mjs">
        <div class="alert">
          <button type="button" class="aclose" data-dismiss="alert">×</button>
          <strong>Warrning</strong> Pfff pregunta mejor
        </div>

        <div class="alert error">
          <button type="button" class="aclose" data-dismiss="alert">×</button>
          <strong>Nope</strong> Error no sabes hacerlo, intenta preguntarle a alguien
        </div>

        <div class="alert success">
          <button type="button" class="aclose" data-dismiss="alert">×</button>
          <strong>Hmmm</strong> hay la llevas
        </div>

        <div class="alert info">
          <button type="button" class="aclose" data-dismiss="alert">×</button>
          <strong>Hey</strong> intenta no suicidarte
        </div>
      </div>
      

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
                          <td class="txleft"><a id="<?php echo $recetas[$i]['id']; ?>" class="bluetext"><?php echo $recetas[$i]['titulo']; ?></a></td>
                          <td><a href="">Eliminar</a></td>
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

$( "#tabs" ).tabs().css('display','none');

var app = "<?php echo $app; ?>";
var base_url = "<?php echo base_url(); ?>";


$(".blockscroll tr .txleft").each(function (text)
{
  $(".txleft a").click(function (data)
  {
      var id = $(this).attr('id');

      $("#tabs").fadeIn("slow");

      $.post(base_url+"recetas/searchById/", {id_receta:id, id_app: app }, function (data)
      {
          $("#tabs-1").html(data);
          console.log(data);
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