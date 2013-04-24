
<div class="wrapper">


  <span style="font-size:25px;">Aplicación:</span> <input type="text" name="nombreApp" id="nombreApp" class="input post" value="<?php echo $apps['nombre']; ?>">
  
  <nav id="menu">
    <ul>
      <li><a href="<?php echo base_url(); ?>apps/view/<?php echo $app; ?>" class="">Recetas</a></li>
      <li><a href="<?php echo base_url(); ?>glosario/view/<?php echo $app; ?>" class="">Glosarios</a></li>
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
            <td colspan="2"><input type="submit" class="button mg1" value="+ Nueva Receta"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="text" name="" id="buscar" class="input post buscar" placeholder="Buscar.." value="">
            <span class="postfix email">  </span></td>
          </tr>
        </thead>

        <tbody>
          <?php if(isset($recetas))
                {
                  for ($i=0; $i <count($recetas) ; $i++) 
                    { ?>

                    <tr>
                        <td><a href="<?php echo $recetas[$i]['id']; ?>" class="bluetext"><?php echo $recetas[$i]['titulo']; ?></a></td>
                        <td><a href="">Eliminar</a></td>
                    </tr>

                    <?php     
                    }   
                } ?>
        </tbody>
      </table>
      
      
    </div>
    
    <div class="columna">

      <div id="addblock">
        
        <h2>Nueva receta</h2>
        <p>Información de la receta</p>
        <br>
        
        <div class="myform">
          
            <?php echo validation_errors(); ?>
            <?php echo form_open('recetas/create/'.$app) ?>
            
            
            
            <label for="titulo" class="fixh1">Título</label>
            <input type="texto" name="titulo" id="titulo" />
            
            <br>
            <label for="categoria" class="fixh2">Categoria</label>
            <select name="categoria" id="categoria">
            
              <?php foreach ($categorias as $c_item): ?>
              
                <option value="<?php echo $c_item['id'] ?>"><?php echo $c_item['nombre'] ?></option>
              
              <?php endforeach ?>
            
            </select>

            <br>
            
            <label for="dificultad">Dificultad <span class="small">Dificultad para realizarla</span></label>
            <select name="dificultad">
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
            
            <button type="submit" class="button">Guardar</button>

          </form>
        </div>
      </div>
    
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

$("#buscar").keyup(function ()
{
    var buscar = $("#buscar");

    if(buscar != "")
    {
        $.post(base_url+"recetas/searchByName/", {palabra: buscar, id_app: app}, function (data)
        {
            console.log(data);
        });
    }
});



</script>