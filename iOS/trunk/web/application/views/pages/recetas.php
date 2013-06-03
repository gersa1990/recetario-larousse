
<div class="wrapper">

  <div class="main">
    <div id="status"></div>

    <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a>

    <div class="columl">
      <h2 class="myriadFont title_app"><?php echo $name[0]['nombre']; ?></h2>

      <nav id="menu">
        <ul>
          <li><a class="active" href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>

    </div>
    
    <div class="columr">

      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a href="<?php echo base_url().'recetas/nueva/'.$app ?>" class="button large orange">Nueva receta</a>
        </div> 
  
        <table id="recetas">
          <thead>
            <tr>
              <th colspan="3">Recetas</th>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($recetas))
                  {
                    for ($i=0; $i <count($recetas) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <a href="<?php echo base_url().'recetas/ver/'.$recetas[$i]['id'].'/'.$recetas[$i]['id_app'] ?>">
                              <?php echo $recetas[$i]['titulo']; ?>
                            </a>
                          </td>

                          <td>
                            <a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="eliminarReceta(<?php echo $recetas[$i]['id']; ?>);">Eliminar</a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php
          $cat = count($categorias);
        ?>
      </div>
    </div>
  </div>

  
  <div class="clear"></div>

  <div id="lean_overlay"></div>

  <div id="ventana" class="chica">
      
  </div>

</div>

<script>

  var app       = "<?php echo $app; ?>";
  var base_url  = "<?php echo base_url(); ?>";

  $(".ventana").click(function(data){
    return false;
  });

  function eliminarReceta(id){
    $.post( base_url+"recetas/getRecetaDelete/"+id, function(response){
      $('#ventana').html(response);
    });
  }


  var categorias = "<?php echo $cat; ?>";
  console.log(categorias);
  var cat = parseInt(categorias);

  if(cat<1)
  {
    $("#status").html("<div class='alert error'>Es necesario agregar una categoria primero.</div>").slideDown("slow");
    $("#addblock").slideUp("slow");

    setTimeout(function(){
      location.href=base_url+"categorias/view/"+app;
    },3000) 
    
  }


  $("#exportar").click(function ()
  {
      location.href=base_url+"export/create/"+app;
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