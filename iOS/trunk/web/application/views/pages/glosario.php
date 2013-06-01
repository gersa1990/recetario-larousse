
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
          <li><a class="active" href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>

    </div>
    
    <div class="columr">
      <div id="addblock">
        
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a class="ventana button large orange" rel="leanModal" name="#ventana" href="#ventana" onclick="nuevoGlosario(<?php echo $app;?>);">Nueva término</a>
        </div> 
  
        <table id="glosario">
          <thead>
            <tr>
              <td colspan="3">Glosario</td>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($glosario))
                  {
                    for ($i=0; $i <count($glosario) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <p><?php echo $glosario[$i]['nombre']; ?></p>
                          </td>

                          <td>
                            <a href="#editarGlosario<?php echo $glosario[$i]['id']; ?>">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a href="#eliminarGlosario<?php echo $glosario[$i]['id']; ?>" class='eliminarRecetas'>
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php if(isset($glosario))
                  {
                    for ($i=0; $i <count($glosario) ; $i++) 
                      { ?>

                      <div id="eliminarGlosario<?php echo $glosario[$i]['id']; ?>" class="modalDialog">
                        <div class="popup form_delete">

                          <a href="#" title="Close" class="close">x</a>
                
                          <?php echo form_open("glosario/delete/"); ?>
                            <h2>Término de glosario</h2>
                            <p class="mg-auto"><?php echo $glosario[$i]['nombre']; ?></p>         
                            <input type="hidden" name="id" value="<?php echo $glosario[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>

                      <div id="editarGlosario<?php echo $glosario[$i]['id']; ?>" class="modalDialog editarGlosario">
                        <div class="popup form_receta">

                        <a href="#" title="Close" class="close">x</a>
                
                        <?php
                              $attributes = array('class' => 'email', 'id' => 'editarGlosario');
                              echo form_open("glosario/edit/",$attributes); ?>
  
                            <h2 class="myriadFont">Editar término de glosario</h2>

                            <div class="left">
                              <label for="">Nombre: </label>
                              <input type="text" name="titulo" id="titulo" value="<?php echo $glosario[$i]['nombre']; ?>" placeholder="Nombre" required>
                              <div class="alert error" style="display:none" id="updateGlosario">Ya existe un glosario con este nombre</div>
                            </div>

                            <input type="hidden" id="id_glosario" value="<?php echo $glosario[$i]['id']; ?>">

                            <div class="clear"></div>

                            <label for="">Descripción: </label>
                            <textarea class="full2 <?php print "editar".$i;  ?>" type="text" name="descripcion" id="descripcion" required><?php echo $glosario[$i]['descripcion']; ?></textarea>

                            <div class="left">
                              <label for="">Imagen: </label>
                              <input type="text" name="imagen" id="imagen" value="<?php echo $glosario[$i]['imagen']; ?>">
                            </div>



                            <input type="hidden" name="id" value="<?php echo $glosario[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            
                            <div class="clear"></div>
                            <button type="submit" class="submit" id="submitUpdateGlosario">Guardar</button>

                            </form>
                        </div>
                      </div>

                      <?php } 
                    } ?>
        
      </div>
    </div>

  </div>

  <div class="clear"></div>

  <div id="lean_overlay"></div>

  <div id="ventana" class="form_receta">
      
  </div>

</div> <!-- Wrapper -->

<script>

  var app = "<?php echo $app; ?>";
  var base_url = "<?php echo base_url(); ?>";

  $(".ventana").click(function(data){
    return false;
  });

  $(function() {
    $('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '.modal_close' }); 
  });

  function nuevoGlosario(id){
    $.post( base_url+"glosario/nuevoGlosario/"+id, function(response) {  
      console.log(response);
      $('#ventana').html(response);
    });
  }

  $("#exportar").click(function ()
  {
      location.href=base_url+"export/create/"+app;
  });


  $("#buscar").keyup(function (data)
  {
    var texto = $("#buscar").val();

    $.post(base_url+"glosario/searchByName/" ,{palabra: texto, id_app: app}, function (data)
    {
        $("#glosario tbody").html(data);
    }); 
  
  });

  $("#nuevoGlosario #nombre").keyup(function ()
  {
      var titulo = $("#nuevoGlosario #nombre").val();
      
      $.post(base_url+"glosario/checkExistence/", {palabra: titulo, id_app: app}, function (data)
      {
          if(data=="Existe")
          {
            $("#nuevoGlosario #glosarioNuevo").slideDown("slow");
            $("#nuevoGlosario #submitGlosarioNuevo").slideUp("slow");
          }
          else
          {
            $("#nuevoGlosario #glosarioNuevo").slideUp("slow");
            $("#nuevoGlosario #submitGlosarioNuevo").slideDown("slow");
          }
      });

});

$(".editarGlosario").each(function ()
{
  var id = $(this).attr('id');
  //console.log(id);

  $("#"+id+" #titulo").keyup(function ()
  {
    var titulo      = $("#"+id+" #titulo").val();
    var id_glosario = $("#"+id+" #id_glosario").val();

    $.post(base_url+"glosario/updateCheckExistence/", {nombre:titulo, glosario:id_glosario, id_app:app}, function (data)
    {
      if(data=="Existe")
      {
          $("#"+id+" #updateGlosario").slideDown("slow");
          $("#"+id+" #submitUpdateGlosario").slideUp("slow");
      } 
      else
      {
          $("#"+id+" #updateGlosario").slideUp("slow");
          $("#"+id+" #submitUpdateGlosario").slideDown("slow");
      }
    });
  });
});

tinymce.init({
  selector: "#nuevoGlosario textarea",
  width: 950,
  height: 200,
  menubar: false,
  convert_newlines_to_brs : false
});


</script>





