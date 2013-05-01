
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
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosarios</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li class="active"><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
    </div>
    
    <div class="columna">

      <div id="addblock">
  
        <div id="controles">
          <a href="#nuevaReceta" class="button bl1">Nueva receta</a>
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
        </div> 
  
        <table id="recetas_complementarias">
          <thead>
            <tr>
              <td colspan="2">Recetas complementarias</td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php if(isset($recetas_complementarias))
                  {
                    for ($i=0; $i <count($recetas_complementarias) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <a href="<?php echo base_url().'recetas_complementarias/view/'.$recetas_complementarias[$i]['id']; ?>" class="bluetext">
                              <?php echo $recetas_complementarias[$i]['titulo']; ?>
                            </a>
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

                      

                      <div id="editarComplementaria<?php echo $recetas_complementarias[$i]['id']; ?>" class="modalDialog">
                        <div class="popup form_receta">
                        <a href="#" title="Close" class="close">x</a>
                
                        <?php echo form_open("complementarias/edit/"); ?>
                          <h2>Edita categoria</h2>

                          <div class="centrar">
                            <label for="">Nombre: </label>
                            <input type="text" name="titulo" value="<?php echo $recetas_complementarias[$i]['titulo']; ?>">
                          </div>

                          <div class="left">
                            <label for="">Contenido: </label>
                            <textarea class="full" name="contenido"><?php echo $recetas_complementarias[$i]['contenido']; ?></textarea>
                          </div>

                          <input type="hidden" name="id" value="<?php echo $recetas_complementarias[$i]['id']; ?>">
                          <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                          <button type="submit" class="submit">Guardar</button>
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


  <div id="nuevaReceta" class="modalDialog">
    <div class="popup">
      <a href="#" title="Close" class="close">x</a>

      <div id="formulario">

        <?php echo form_open("complementarias/create/"); ?>        
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
              <?php for ($i=0; $i <count($recetas_complementarias) ; $i++) { ?>

                <option value="<?php echo $recetas_complementarias[$i]['id'] ?>">
                  <?php echo $recetas_complementarias[$i]['titulo'] ?>
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