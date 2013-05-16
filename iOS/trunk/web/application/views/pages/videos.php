<div class="wrapper">

  <div class="main">
    <div id="status"></div>

    

    <div class="columl">
      <!-- <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a> -->
      <h2 class="myriadFont title_app"><?php echo $name[0]['nombre']; ?></h2>

      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a class="active" href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
    </div>
    
    <div class="columr">

      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a href="#nuevoVideo" class="button large orange">Nuevo video</a>
        </div> 
  
        <table id="videos">
          <thead>
            <tr>
              <td colspan="3">Videos</td>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($videos))
                  {
                    for ($i=0; $i <count($videos) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <!-- <a href="" class="bluetext">
                             
                            </a> -->
                            <p> <?php echo $videos[$i]['titulo']; ?></p>
                          </td>

                          <td>
                            <a href="#editarVideo<?php echo $videos[$i]['id']; ?>">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a href="#eliminarVideo<?php echo $videos[$i]['id']; ?>" class='eliminarRecetas'>
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php if(isset($videos))
                  {
                    for ($i=0; $i <count($videos) ; $i++) 
                      { ?>

                      <div id="eliminarVideo<?php echo $videos[$i]['id']; ?>" class="modalDialog">
                        <div class="popup form_delete">

                          <a href="#" title="Close" class="close">x</a>
                
                          <?php echo form_open("videos/delete/"); ?>
                            <h2>Video</h2>
                            <p class="mg-auto"><?php echo $videos[$i]['titulo']; ?></p>         
                            <input type="hidden" name="id" value="<?php echo $videos[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>

                      <div id="editarVideo<?php echo $videos[$i]['id']; ?>" class="modalDialog editarVideo">
                        <div class="popup form_edit">

                        <a href="#" title="Close" class="close">x</a>
                
                        <?php echo form_open("videos/edit/"); ?>
 
  
                            <h2 class="mg_20 myriadFont">Editar video</h2>

                            <input type="hidden" name="id_video" id="id_video" value="<?php  echo $videos[$i]['id']; ?>">

                            <div class="centrar">
                              <label for="">Nombre: </label>
                              <input type="text" name="titulo" id="titulo" value="<?php echo $videos[$i]['titulo']; ?>" required>
                              <div class="alert error" id="updateVideo" style="display:none;">Este nombre de video ya existe.</div>
                              <label for="">Archivo de video: </label>
                              <input type="text" name="video" id="video" value="<?php echo $videos[$i]['video']; ?>" required>
                              
                            </div>

                            <input type="hidden" name="id" value="<?php echo $videos[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit"id="submitUpdateVideo">Guardar</button>
                          </form>
                        </div>
                      </div>

                      <?php } 
                    } ?>
        
      </div>
    </div>

  </div>


  <div id="nuevoVideo" class="modalDialog">
    <div class="popup">
      <a href="#" title="Close" class="close">x</a>

        <?php echo form_open("videos/create/"); ?>    

          <h2 class="mg_20 myriadFont">Nuevo video</h2>

          <div class="centrar">
            <label for="">Nombre: </label>
            <input type="text" name="titulo" id="titulo" value="" placeholder="título" required>
            <div class="alert error" id="videoNuevoAlert" style="display:none;">Este titulo de video ya existe.</div>

            <label for="">Archivo de video: </label>
            <input type="text" name="video" value="" placeholder="video" required>
           </div>
          
          <input type="hidden" name="id_app" value="<?php echo $app; ?>">

          <button type="submit" class="submit" id="submitNuevoVideo">Agregar</button>
    
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

    $.post(base_url+"videos/searchByName/" ,{nombre: texto, id_app: app}, function (data)
    {
      $("#videos tbody").html(data);
    }); 
  });

  $("#nuevoVideo #titulo").keyup(function ()
  {
      var titulo = $("#nuevoVideo #titulo").val();

      $.post(base_url+"videos/checkExistence/", {palabra: titulo, id_app:app}, function (data)
      {
          if(data=="Existe")
          {
            $("#nuevoVideo #videoNuevoAlert").slideDown("slow");
            $("#nuevoVideo #submitNuevoVideo").slideUp("slow");
          }
          else
          {
            $("#nuevoVideo #videoNuevoAlert").slideUp("slow");
            $("#nuevoVideo #submitNuevoVideo").slideDown("slow"); 
          }

      });
  });

  $(".editarVideo").each(function ()
  {
    var id = $(this).attr('id');
    //console.log(id);
    $("#"+id+" #titulo").keyup(function ()
    {
      var titulo      = $("#"+id+" #titulo").val();
      var id_video = $("#"+id+" #id_video").val();

      $.post(base_url+"videos/updateCheckExistence/", {nombre:titulo, video:id_video, id_app:app}, function (data)
      {
        if(data=="Existe")
        {
            $("#"+id+" #updateVideo").slideDown("slow");
            $("#"+id+" #submitUpdateVideo").slideUp("slow");
        } 
        else
        {
            $("#"+id+" #updateVideo").slideUp("slow");
            $("#"+id+" #submitUpdateVideo").slideDown("slow");
        }
    });

    });

  });

</script>