
<div class="wrapper">

  <div class="main">
    <div id="status"></div>

    <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a>

    <div class="columl">
      <h2 class="myriadFont title_app"><?php echo $name[0]['nombre']; ?></h2>

      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosarios</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a class="active" href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
      
    </div>
    
    <div class="columr">

      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a href="#nuevaRecetaComplementaria" class="button large orange">Nueva receta</a>
        </div> 
  
        <table id="recetas_complementarias">
          <thead>
            <tr>
              <td colspan="3">Recetas complementarias</td>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($recetas_complementarias))
                  {
                    for ($i=0; $i <count($recetas_complementarias) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <!-- <a href="<?php echo base_url().'recetas_complementarias/view/'.$recetas_complementarias[$i]['id']; ?>" class="bluetext"> -->
                              <!--  -->
                            <!-- </a> -->
                            <p><?php echo $recetas_complementarias[$i]['titulo']; ?></p>
                          </td>

                          <td>
                            <a href="#editarComplementaria<?php echo $recetas_complementarias[$i]['id']; ?>">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a href="#eliminarComplementaria<?php echo $recetas_complementarias[$i]['id']; ?>" class='eliminarRecetas'>
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php if(isset($recetas_complementarias))
                  {
                    for ($i=0; $i <count($recetas_complementarias) ; $i++) 
                      { ?>

                      <div id="eliminarComplementaria<?php echo $recetas_complementarias[$i]['id']; ?>" class="modalDialog">
                        <div class="popup form_delete">

                          <a href="#" title="Close" class="close">x</a>
                
                          <?php echo form_open("complementarias/delete/"); ?>
                            <h2>Receta complementaria</h2>
                            <p class="mg-auto"><?php echo $recetas_complementarias[$i]['titulo']; ?></p>         
                            <input type="hidden" name="id" value="<?php echo $recetas_complementarias[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>

                      

                      <div id="editarComplementaria<?php echo $recetas_complementarias[$i]['id']; ?>" class="modalDialog editarComplementaria">
                        <div class="popup form_rc">
                        <a href="#" title="Close" class="close">x</a>
                
                        <?php echo form_open("complementarias/edit/"); ?>
                          <h2 class="mg_20 myriadFont">Edita categoria complementaria</h2>

                          <input type="hidden" id="id_complementaria" value="<?php echo $recetas_complementarias[$i]['id']; ?>">

                          <div class="left">
                            <label for="">Nombre: </label>
                            <input type="text" name="titulo" id="titulo" value="<?php echo $recetas_complementarias[$i]['titulo']; ?>">
                            <div class="alert error" id="updateComplementaria" style="display:none;">Este titulo ya existe.</div>
                          </div>

                          <div class="left">
                            <label for="">Contenido: </label>
                            <textarea class="full2" name="contenido"><?php echo $recetas_complementarias[$i]['contenido']; ?></textarea>
                          </div>

                          <div class="clear"></div>

                          <input type="hidden" name="id" value="<?php echo $recetas_complementarias[$i]['id']; ?>">
                          <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                          <button type="submit" class="submit" id="submitUpdateComplementaria">Guardar</button>
                        </form>

                        </div>
                      </div>

                      <?php 
                      } 
                    } 
                    ?>
        
      </div>
    </div>

  </div>


  <div id="nuevaRecetaComplementaria" class="modalDialog">
    <div class="popup form_rc">
      <a href="#" title="Close" class="close">x</a>


        <?php echo form_open("complementarias/create/"); ?>        
        <!-- <form action=""> -->

          <h2 class="mg_20 myriadFont">Nueva receta complementaria</h2>

          <input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="" required>

          <div class="left">
            <label for="">Nombre: </label>
            <input type="text" name="titulo" id="titulo" value="" placeholder="" required>
            <div class="alert error" id="complementariaNueva" style="display:none;">Esta receta complementaria ya existe.</div>
          </div>

          <div class="clear"></div>

          <label for="">Contenido: </label>
          <textarea type="text" name="contenido" class="full2" required></textarea>

          <button type="submit" class="submit" id="submitNuevaComplementaria">Agregar</button>
    
        </form>

    </div> <!-- popup -->
  </div> <!-- modadialog -->

  <div class="clear"></div>

</div> <!-- Wrapper -->

<script>

  var app = "<?php echo $app; ?>";
  var base_url = "<?php echo base_url(); ?>";

  $("#exportar").click(function ()
  {
      location.href=base_url+"export/create/"+app;
  });


  $("#buscar").keyup(function (data)
  {
    var texto = $("#buscar").val();

    $.post(base_url+"complementarias/searchByName/" ,{palabra: texto, id_app: app}, function (data)
    {
      $("#recetas_complementarias tbody").html(data);
    }); 
  });

$("#nuevaRecetaComplementaria #titulo").keyup(function ()
  {
      var titulo = $("#nuevaRecetaComplementaria #titulo").val();
      
      $.post(base_url+"complementarias/checkExistence/", {palabra: titulo, id_app: app}, function (data)
      {
          if(data=="Existe")
          {
            $("#nuevaRecetaComplementaria #complementariaNueva").slideDown("slow");
            $("#nuevaRecetaComplementaria #submitNuevaComplementaria").slideUp("slow");
          }
          else
          {
            $("#nuevaRecetaComplementaria #complementariaNueva").slideUp("slow");
            $("#nuevaRecetaComplementaria #submitNuevaComplementaria").slideDown("slow");
          }
      });

});


$(".editarComplementaria").each(function ()
{
  var id = $(this).attr('id');
  //console.log(id);

  $("#"+id+" #titulo").keyup(function ()
  {
    var titulo            = $("#"+id+" #titulo").val();
    var id_complementaria = $("#"+id+" #id_complementaria").val();

    $.post(base_url+"complementarias/updateCheckExistence/", {nombre:titulo, complementaria:id_complementaria, id_app:app}, function (data)
    {
      console.log(data);

      if(data=="Existe")
      {
          $("#"+id+" #updateComplementaria").slideDown("slow");
          $("#"+id+" #submitUpdateComplementaria").slideUp("slow");
      } 
      else
      {
          $("#"+id+" #updateComplementaria").slideUp("slow");
          $("#"+id+" #submitUpdateComplementaria").slideDown("slow");
      }
    });

  });

});

</script>