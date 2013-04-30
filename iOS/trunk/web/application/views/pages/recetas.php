
<div class="wrapper">
  
   <input type="submit" id="exportar" class="exportar" value="Exportar">

  <!-- <input type="submit" class="exportar" value="Exportar"> -->
  <div id="status" style="height:30px;">
     
  </div>

  <div class="main">


    <div class="columl">

      <nav id="menu">
        <ul>
          <li class="active"><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorias</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosarios</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
      

    </div>
    
    <div class="columr">

      <div id="addblock">

        <div id="tabla">
  
        <table id="recetas">
          <thead>
            <tr>
              <td colspan="2"><a href="#nuevaReceta" class="button mg1 bl1">Nueva receta</a></td>
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
                          <td class="txleft">
                            <a href="<?php echo base_url().'recetas/view/'.$recetas[$i]['id']; ?>" class="bluetext">
                              <?php echo $recetas[$i]['titulo']; ?>
                            </a>
                          </td>

                          <td>
                            <a href="<?php echo base_url().'recetas/edit/'.$recetas[$i]['id']; ?>">
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

         <?php if(isset($recetas))
                  {
                    for ($i=0; $i <count($recetas) ; $i++) 
                      { ?>

                      <div id="eliminarReceta<?php echo $recetas[$i]['id']; ?>" class="modalDialog">
                        <div>
                          <a href="#" title="Close" class="close">X</a>
            
                        <?php echo form_open("recetas/delete/"); ?>
                          <h2>Eliminar receta</h2><br><br>
                          <div class="centrar">
                            <label for="">Nombre: </label>
                              <?php echo $recetas[$i]['titulo']; ?>
                          </div>
                          <input type="hidden" name="id" value="<?php echo $recetas[$i]['id']; ?>">
                          <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                          <br>
                          <button type="submit" class="eliminarBoton">Eliminar</button>
                        </form>
            
                        </div>
                      </div>

                      <?php } 
                    } ?>



                      <div id="nuevaReceta" class="modalDialog">
                        <div>
                          <a href="#" title="Close" class="close">X</a>
            
                        <?php echo form_open("recetas/create/"); ?>
                          <h2>Nueva Receta</h2><br><br>

                        
                    
                             <input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="tiempo en minutos" required>
                          

                          <div class="centrar">
                            <label for="">Titulo: </label>
                             <input type="text" name="titulo" id="titulo" value="" placeholder="titulo de la receta" required>
                          </div>

                          <div class="centrar">
                            <label for="">Categoria: </label>
                             <select name="categoria">
                              <?php for ($i=0; $i <count($categorias) ; $i++) { ?>
                                <option value="<?php echo $categorias[$i]['id'] ?>"><?php echo $categorias[$i]['nombre'] ?></option>
                              <?php } ?>
                             </select>
                          </div>

                          <div class="centrar">
                            <label for="">Procedimiento: </label>
                             <textarea name="procedimiento"></textarea>
                          </div>

                          <div class="centrar">
                            <label for="">Ingredientes: </label>
                             <textarea name="ingredientes"></textarea>
                          </div>

                          <div class="centrar">
                            <label for="">Preparación: </label>
                             <input type="text" name="preparacion" value="" placeholder="tiempo en minutos" required>
                          </div>

                          <div class="centrar">
                            <label for="">Cocción: </label>
                             <input type="text" name="coccion" value="" placeholder="tiempo en minutos" required>
                          </div>

                          <div class="centrar">
                              <label for="">Costo: </label>
                              <select name="costo">
                                <?php for ($i=1; $i <6 ; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                              </select>
                          </div>

                          <div class="centrar">
                            <label for="">Foto: </label>
                             <input type="text" name="foto" value="" placeholder="nombre de archivo que contendrá la imagen" required>
                          </div>

                          <div class="centrar">
                              <label for="">Dificultad: </label>
                              <select name="dificultad">
                                <?php for ($i=1; $i <6 ; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                              </select>
                          </div>

                          <br>
                          <button type="submit" class="eliminarBoton">Agregar receta</button>
                        </form>
            
                        </div>
                      </div>

        </div>
        
      </div>


    </div>
  </div>

</div>

<div class="clear"></div>

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