
<div class="wrapper">

  
  <input type="submit" id="exportar"  class="exportar" value="Exportar">

  <span class="uptext left">Aplicación:</span> <input type="text" name="nombreApp" id="nombreApp" class="input post left" value="<?php echo $apps['nombre']; ?>">
  <div class="status left spinner"></div>

  <div class="clear"></div>
  
  <nav id="menu">
    <ul>
      <li><a href="<?php echo base_url(); ?>apps/view/<?php echo $app; ?>" class="">Recetas</a></li>
      <li class="active"><a href="<?php echo base_url(); ?>glosario/view/<?php echo $app; ?>" class="">Glosarios</a></li>
      <li><a href="<?php echo base_url(); ?>videos/view/<?php echo $app; ?>" class="">Videos</a></li>
      <li><a href="<?php echo base_url(); ?>complementarias/view/<?php echo $app; ?>" class="">Recetas complementarias</a></li>
      <li><a href="<?php echo base_url(); ?>categorias/view/<?php echo $app; ?>" class="">Categorias</a></li>
    </ul>
  </nav>

  <div class="main">
    <div class="columna">
  
      <table id="recetas" class="lista">
        <thead>
          <tr>
            <td colspan="2"><input type="submit" class="button mg1 bl1" value="+ Nuevo glosario"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="text" name="" id="buscar" class="input post buscar" placeholder="Buscar.." value="">
            <span class="postfix email">  </span></td>
          </tr>
        </thead>

        <tbody>
          <?php if(isset($glosario))
                {
                  for ($i=0; $i <count($glosario) ; $i++) 
                    { ?>

                    <tr>
                        <td class="txleft"><a href="<?php echo $glosario[$i]['id']; ?>" class="bluetext"><?php echo $glosario[$i]['nombre']; ?></a></td>
                        <td class="txleft"><a href="#eliminarReceta<?php echo $glosario[$i]['id']; ?>">Eliminar</a></td>
                    </tr>

                    <div id="eliminarReceta<?php echo $glosario[$i]['id'] ?>" class="modalDialog">
                      <div>
                        <a href="#" title="Close" class="close">X</a>
                          <?php echo validation_errors(); ?>
                          <?php echo form_open('glosario/eliminar') ?>
        
                            <h2><?php echo $glosario[$i]['nombre'] ?><br/></h2>
                            <p>Nota: Se eliminará esta receta de forma definitiva.</p>
        
                            <input type="hidden" name="id"  id="id"  value="<?php echo $glosario[$i]['id']; ?>"/>
                            <input type="hidden" name="app" id="id" value="<?php echo $app; ?>">
          
                            <button type="submit" class="eliminarBoton">Eliminar</button>
                          </form>
                      </div>
                    </div>

                    <?php     
                    }   
                } ?>
        </tbody>
      </table>
      
      
    </div>
    
    <div class="columna">

      <div id="addblock">
        
        <h2>Nuevo glosario</h2>
        <p>Información del glosario</p>
        <br>
        
        <div class="myform">
          
            <?php echo validation_errors(); ?>
            <?php echo form_open('recetas/create/'.$app) ?>
            
            
            
            <label for="nombre" class="fixh1">Nombre</label>
            <input type="text" name="nombre" id="nombre" />
            
            <br>

            <input type="hidden" name="app" value="<?php echo $app; ?>"> 

            <label for="categoria" class="fixh2">Categoria</label>
            <select name="categoria" id="categoria">
            
              <?php foreach ($categorias as $c_item): ?>
              
                <option value="<?php echo $c_item['id'] ?>"><?php echo $c_item['nombre'] ?></option>
              
              <?php endforeach ?>
            
            </select>

            <br>
            
            <label for="dificultad">Dificultad <span class="small">Dificultad para realizarla</span></label>
            <select name="dificultad" class="wt1">
              <?php for ($i=1; $i < 6; $i++) 
              { 
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php 
              } 
              ?>
            </select>
            
            <br><br>
            
            <label for="proce" class="fixmargin">Procedimiento <span class="small">Pasos de preparación</span></label>
            <textarea name="proce" title="proce" rows="4" cols="46"></textarea>

            <br>
            
            <label for="ingre" class="fixmargin">Ingredientes <span class="small">Lista de ingredientes</span></label>
            <textarea name="ingre" title="ingre" rows="4" cols="46"></textarea>

            <br>
            
            <label for="prepa">Preparación <span class="small">Tiempo en min</span></label>
            <input type="text" name="prepa" id="prepa" />

            <br>
            
            <label for="coccion">Cocción <span class="small">Tiempo en min</span></label>
            <input type="text" name="coccion" id="coccion" />

            <br>
            
            <label for="costo">Costo <span class="small">Precio aproximado</span></label>
             <select name="costo">
              <?php for ($i=1; $i < 6; $i++) { ?>
                  <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
              <?php } ?>
            </select>
            <br><br>
            
            <label for="ïmg">Imagen <span class="small">Cargar file</span></label>
            <input type="text" name="img" id="img" />

            <br><br>
            
            <button type="submit" class="button bl2">Guardar</button>

          </form>
        </div>
      </div>
    
    </div>
  </div>
  <div class="clear"></div>
</div>
<script>
 var base_url = "<?php echo base_url(); ?>";
 var app      =  "<?php echo $app; ?>";

$("#nombreApp").keyup(function ()
{
    var nombreApp = $("#nombreApp").val();
    console.log(nombreApp);

    $.post(base_url+"apps/updateNombre/", {nombre: nombreApp, id_app: app}, function (data)
    {
        
    });
});

$("#exportar").click(function ()
{
  location.href=""+base_url+"export/create/"+app+"";
});

</script>