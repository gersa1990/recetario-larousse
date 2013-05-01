
<div class="wrapper">

  <div class="main">
    <div id="status">
     
    </div>

    <a href="<?php echo base_url() ?>" class="home">Regresar</a>

    <div class="columna">

      <h1>Menú</h1>
      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li class="active"><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
    </div>
    
    <div class="columna">

      <div id="addblock">
  
        <div id="controles">

          <a href="#nuevoVideo" class="button bl1">Nuevo video</a>

          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
        </div> 
  
        <table id="videos">
          <thead>
            <tr>
              <td colspan="2">Videos</td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php if(isset($videos))
                  {
                    for ($i=0; $i <count($videos) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <a href="<?php echo base_url().'videos/view/'.$videos[$i]['id']; ?>" class="bluetext">
                              <?php echo $videos[$i]['titulo']; ?>
                            </a>
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
                            <p class="mg-auto"><?php echo $videos[$i]['video']; ?></p>         
                            <input type="hidden" name="id" value="<?php echo $videos[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>

                      <div id="editarVideo<?php echo $videos[$i]['id']; ?>" class="modalDialog">
                        <div class="popup form_edit">

                        <a href="#" title="Close" class="close">x</a>
                
                        <?php echo form_open("videos/edit/"); ?>
 
  
                            <h2 class="mg_20">Editar video</h2>

                            <div class="centrar">
                              <label for="">Nombre: </label>
                              <input type="text" name="titulo" value="<?php echo $videos[$i]['titulo']; ?>">

                              <label for="">Archivo de video: </label>
                              <input type="text" name="video" id="video" value="<?php echo $videos[$i]['video']; ?>">
                              
                            </div>

                            <input type="hidden" name="id" value="<?php echo $videos[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Guardar</button>
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

      <div id="formulario">

        <?php echo form_open("videos/create/"); ?>        
        <!-- <form action=""> -->

          <h2>Nuevo video</h2>

          <input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="" required>

          <div class="left">
            <label for="">Título: </label>
            <input type="text" name="titulo" id="titulo" value="" placeholder="Título" required>
          </div>

          <div class="clear"></div>

          <label for="">Archivo de video: </label>
          <input type="text" name="video" value="" placeholder="" required>
          <input type="hidden" name="id_app" value="<?php echo $app; ?>">

          <button type="submit" class="submit">Agregar</button>
    
        </form>

      </div> <!-- formulario -->
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

    $.post(base_url+"recetas/searchByName/" ,{palabra: texto, id_app: app}, function (data)
    {
      $("#recetas tbody").html(data);
    }); 
  });

</script>