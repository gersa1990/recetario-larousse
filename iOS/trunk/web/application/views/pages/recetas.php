
<div class="wrapper">

  
  <input type="submit" class="exportar" value="Exportar">

  <span class="uptext left">Aplicación:</span> <input type="text" name="nombreApp" id="nombreApp" class="input post left" value="<?php echo $apps['nombre']; ?>">
  <div class="status left spinner"></div>

  <div class="clear"></div>
  
  <nav id="menu">
    <ul>
      <li><a href="<?php echo base_url(); ?>categorias/view/<?php echo $app; ?>" class="">Categorias</a></li>
      <li><a href="<?php echo base_url(); ?>glosario/view/<?php echo $app; ?>" class="">Glosarios</a></li>
      <li><a href="<?php echo base_url(); ?>videos/view/<?php echo $app; ?>" class="">Videos</a></li>
      <li><a href="<?php echo base_url(); ?>complementarias/view/<?php echo $app; ?>" class="">Recetas complementarias</a></li>
      <li   class="active"><a href="<?php echo base_url(); ?>apps/view/<?php echo $app; ?>" class="">Recetas</a></li>
    </ul>
  </nav>

  <div class="main">
    <div class="columl">

      <div id="tabla">
  
        <table id="recetas">
          <thead>
            <tr>
              <td colspan="2"><input type="submit" class="button mg1 bl1" value="Nueva receta"></td>
            </tr>
            <tr>
              <td colspan="2"><input type="text" name="" id="buscar" class="input post buscar" placeholder="Buscar.." value="">
              <span class="postfix email">  </span></td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php if(isset($recetas))
                  {
                    for ($i=0; $i <count($recetas) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft"><a href="<?php echo $recetas[$i]['id']; ?>" class="bluetext"><?php echo $recetas[$i]['titulo']; ?></a></td>
                          <td><a href="">Eliminar</a></td>
                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

      </div>
      
      
    </div>
    
    <div class="columr">

      <div id="addblock">
        
        <div class="myform">

            <h2 class="txcenter">Nueva receta</h2>
            <p class="txcenter">Información de la receta</p>
            <br><br>
          
            <?php echo validation_errors(); ?>
            <?php echo form_open('recetas/create/'.$app) ?>
            
            
            
            <label for="titulo" class="fixh1 left">Título</label>
            <input type="texto" name="titulo" id="titulo" class="left"/>
            <div class="status left error">Ya existe una receta con este nombre.</div>

            <div class="clear"></div>
            
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
             <select name="costo" class="wt1">
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


      <table></table>
    
    </div>
  </div>
  <div class="clear"></div>
</div>

<script>

var app = "<?php echo $app; ?>";
var base_url = "<?php echo base_url(); ?>";

$("#nombreApp").keyup(function ()
{
    var nombreApp = $("#nombreApp").val();
    console.log(nombreApp);

    $.post(base_url+"apps/updateNombre/", {nombre: nombreApp, id_app: app}, function (data)
    {
        
    });
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