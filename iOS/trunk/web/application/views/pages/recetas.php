
<div class="wrapper">

  <div class="main">
    <div id="status"></div>

    <div class="columl">
      <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a>

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
          <a href="<?php echo base_url().'recetas/nueva/'.$app ?>" class="button large orange">Nueva</a>
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
                            <a href="<?php echo base_url().'recetas/view/'.$recetas[$i]['id']; ?>" class="bluetext">
                              <?php echo $recetas[$i]['titulo']; ?>
                            </a>
                          </td>

                          <td>
                            <a href="#editarReceta<?php echo $recetas[$i]['id']; ?>">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a href="#eliminarReceta<?php echo $recetas[$i]['id']; ?>" class='eliminarRecetas'>
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php if(isset($recetas)){
          for ($i=0; $i <count($recetas) ; $i++){ ?>
          
            <div id="eliminarReceta<?php echo $recetas[$i]['id']; ?>" class="modalDialog">
              <div class="popup form_delete">

                <a href="#" title="Close" class="close">x</a>
                
                <?php echo form_open("recetas/delete/"); ?>
                  <h2>Receta</h2>
                    
                  <p class="mg-auto"><?php echo $recetas[$i]['titulo']; ?></p>
         
                  <input type="hidden" name="id" value="<?php echo $recetas[$i]['id']; ?>">
                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                  <button type="submit" class="submit">Eliminar</button>
                </form>
              </div>
            </div>

            <div id="editarReceta<?php echo $recetas[$i]['id']; ?>" class="modalDialog">
              <div class="popup form_receta">
                <a href="#" title="Close" class="close">x</a>
                  <div id="formulario">
              
                    <?php echo form_open("recetas/edit/"); ?>

                      <h2 class="mgt_50">Información</h2>

                      <div class="left">
                        <label for="">Título: </label>
                        <input type="text" name="titulo" value="<?php echo $recetas[$i]['titulo']; ?>">
                      </div>
                  
                      <div class="left mg_input">
                        <label for="">Categoría: </label>
                        <select name="categoria">
                          <?php
                          $cat=0;
                           foreach ($categorias as $key => $value) { ?>
                            <option value="<?php echo $value['id']; ?>" <?php if($recetas[$i]['id_categoria'] == $value['id']) { echo "selected"; } ?>><?php echo $value['nombre']; ?></option>
                          <?php $cat++; } ?>
                        </select>
                      </div>
                      
                      <div class="clear"></div>

                      <div class="left">
                        <label for="">Procedimiento: </label>
                        <textarea type="text" class="full" name="procedimiento"><?php echo $recetas[$i]['procedimiento']; ?></textarea>
                      </div>

                      <div class="clear"></div>

                      <div class="left">
                        <label for="">Ingredientes: </label>
                        <textarea type="text" class="full" name="ingredientes"><?php echo $recetas[$i]['ingredientes']; ?></textarea>
                      </div>

                      <div class="clear"></div>

                      <div class="left mg_input2">
                        <label for="">Preparación: </label>
                        <input type="text" name="preparacion" value="<?php echo $recetas[$i]['preparacion']; ?>">
                      </div>

                      <div class="left mg_input2">
                        <label for="">Cocción: </label>
                        <input type="text" name="coccion" value="<?php echo $recetas[$i]['coccion']; ?>">
                      </div>

                      <div class="left mg_input2">
                        <label for="">Costo: </label>
                        <select name="costo">
                          <?php for ($j=1; $j <6 ; $j++) { ?>
                            <option value="<?php echo $j; ?>"  <?php if($j==$recetas[$i]['costo']){ echo "selected"; } ?> ><?php echo $j; ?></option>
                          <?php } ?>
                        </select>
                      </div>
        
                      <div class="left mg_input2">
                        <label for="">Dificultad: </label>
                        <select name="dificultad">
                          <?php for ($j=1; $j <6 ; $j++) { ?>
                            <option value="<?php echo $j; ?>" <?php if($j==$recetas[$i]['dificultad']){ echo "selected"; } ?> ><?php echo $j; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="clear"></div>
                       
                      <label for="">Imagen: </label>
                      <input type="text" name="foto" value="<?php echo $recetas[$i]['foto']; ?>">
                      
                      <input type="hidden" name="id" value="<?php echo $recetas[$i]['id']; ?>">
                      <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                      <button type="submit" class="submit">Guardar</button>
                    </form>
                  </div>
              </div>
            </div>
          <?php 
          } 
        } ?>
      </div>
    </div>
  </div>

  
  <div class="clear"></div>
</div>

<script>

  var app = "<?php echo $app; ?>";
  var base_url = "<?php echo base_url(); ?>";

  var categorias = "<?php echo $cat; ?>";
  console.log(categorias);
  var cat = parseInt(categorias);

  if(cat<1)
  {
    $("#status").html("<div class='alert alert-info'>Para poder dar de alta una receta tienes que crear sus categorias. Serás redirigido.</div>").slideDown("slow");
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