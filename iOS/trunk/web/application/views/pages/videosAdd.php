
<div class="wrapper">

  <div class="main">
    <div id="status">
     
    </div>

    <a href="<?php echo base_url() ?>" class="home">Regresar</a>

    <div class="columna">

      <h1>Menu</h1>
      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorias</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosarios</a></li>
          <li class="active"><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
    </div>
    
    <div class="columna">

      <div id="addblock">
  
        <div id="controles">
          <a href="#nuevaReceta" class="button bl1">Nueva receta</a>
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
                              <?php echo $videos[$i]['video']; ?>
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
                            <h2>Receta:</h2>
                            <p class="mg-auto"><?php echo $videos[$i]['video']; ?></p>         
                            <input type="hidden" name="id" value="<?php echo $videos[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>

                      <div id="editarVideo<?php echo $videos[$i]['id']; ?>" class="modalDialog">
                        <div>
                          <a href="#" title="Close" class="close">X</a>
            
                        <?php echo form_open("videos/delete/"); ?>
                          <h2>Edita los videos</h2><br><br>
                          <div class="centrar">
                            <label for="">Nombre: </label>
                             <input type="text" name="video" value="<?php echo $videos[$i]['video']; ?>">
                          </div>

                          

                          <input type="hidden" name="id" value="<?php echo $videos[$i]['id']; ?>">
                          <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                          <br>
                          <button type="submit" class="eliminarBoton">Editar</button>
                        </form>
            
                        </div>
                      </div>

                      <?php } 
                    } ?>
        
      </div>
    </div>

  </div>


  <div id="nuevaReceta" class="modalDialog">
    <div class="popup">
      <a href="#" title="Close" class="close">x</a>

      <div id="formulario">

        <?php echo form_open("videos/create/"); ?>        
        <!-- <form action=""> -->

          <h2>Nueva Receta</h2>

          <input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="" required>

          <div class="left">
            <label for="">Título: </label>
            <input type="text" name="titulo" id="titulo" value="" placeholder="Título" required>
          </div>

          <div class="left mg_input">
            <label for="">Categoria: </label>
            <select name="categoria">
              <?php for ($i=0; $i <count($videos) ; $i++) { ?>

                <option value="<?php echo $videos[$i]['id'] ?>">
                  <?php echo $videos[$i]['video'] ?>
                </option>

              <?php } ?>
            </select>
          </div>

          <div class="clear"></div>

          <div class="left">
            <label for="">Procedimiento: </label>
            <textarea name="procedimiento" class="full"></textarea>
          </div>
          
          <div class="clear"></div>
          
          <div class="left">
            <label for="">Ingredientes: </label>
            <textarea name="ingredientes" class="full"></textarea>
          </div>
          
          <div class="clear"></div>

          <div class="left mg_input2">
            <label for="">Preparación: </label>
            <input type="text" name="preparacion" value="" placeholder="minutos" required>
          </div>
        
          <div class="left mg_input2">
            <label for="">Cocción: </label>
            <input type="text" name="coccion" value="" placeholder="minutos" required>
          </div>
          
          <div class="left mg_input2">
            <label for="">Costo: </label>
            <select name="costo">
              <?php for ($i=1; $i <6 ; $i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php } ?>
            </select>
          </div>
        
          <div class="left mg_input2">
            <label for="">Dificultad: </label>
            <select name="dificultad">
              <?php for ($i=1; $i <6 ; $i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php } ?>
            </select>
          </div>
        
          <div class="clear"></div>

          <label for="">Imagen: </label>
          <input type="text" name="foto" value="" placeholder="" required>

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