
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
          <li class="active"><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
    </div>
    
    <div class="columna">

      <div id="addblock">
  
        <div id="controles">
          <a href="#nuevoGlosario" class="button bl1">Agregar</a>
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
        </div> 
  
        <table id="glosario">
          <thead>
            <tr>
              <td colspan="2">Glosario</td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php if(isset($glosario))
                  {
                    for ($i=0; $i <count($glosario) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <a href="<?php echo base_url().'glosario/view/'.$glosario[$i]['id']; ?>" class="bluetext">
                              <?php echo $glosario[$i]['nombre']; ?>
                            </a>
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
                            <h2>Glosario</h2>
                            <p class="mg-auto"><?php echo $glosario[$i]['nombre']; ?></p>         
                            <input type="hidden" name="id" value="<?php echo $glosario[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>

                      <div id="editarGlosario<?php echo $glosario[$i]['id']; ?>" class="modalDialog">
                        <div class="popup form_glosario">
                          <a href="#" title="Close" class="close">x</a>
                  
                          <?php echo form_open("glosario/edit/"); ?>
                            <h2 class="mg_20">Contenido</h2>

                            <label for="">Título: </label>
                            <input type="text" name="titulo" value="<?php echo $glosario[$i]['nombre']; ?>">

                            <label for="">Descripción: </label>
                            <textarea type="text" class="full2" name="descripcion" id="descripcion"><?php echo $glosario[$i]['descripcion']; ?></textarea>
                            
                            <label for="">Imagen: </label>
                            <input type="text" name="imagen" value="<?php echo $glosario[$i]['imagen']; ?>">
                          

                            <input type="hidden" name="id" value="<?php echo $glosario[$i]['id']; ?>">
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


                <div id="nuevoGlosario" class="modalDialog">
                        <div class="popup form_glosario">
                          <a href="#" title="Close" class="close">x</a>
                  
                          <?php echo form_open("glosario/create/"); ?>
                            <h2 class="mg_20">Contenido</h2>

                            <label for="">Título: </label>
                            <input type="text" name="titulo" value=" ">

                            <label for="">Descripción: </label>
                            <textarea type="text" class="full2" name="descripcion" id="descripcion"></textarea>
                            
                            <label for="">Imagen: </label>
                            <input type="text" name="imagen" value=" ">
                        
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Guardar</button>
                          </form>
                        </div>
                      </div>

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