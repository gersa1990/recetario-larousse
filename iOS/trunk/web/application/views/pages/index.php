
<div class="wrapper">

  <div id="nuevaApp" class="modalDialog" style="z-index:1">
    <div class="popup">
      <a href="#" title="Close" class="close">x</a>
      <?php echo validation_errors(); ?>
      <?php echo form_open('apps/nueva/') ?>
        <h2 class="mg_20">Nueva aplicación</h2>
        <div class="centrar">
          <label for="">Nombre: </label>
          <input type="text" name="nombre" value="">
        </div>
        <br>  
        <button type="submit" class="submit">Agregar</button>
      </form>
    </div>
  </div>
  
  <div class="main">
    
      <a href="#nuevaApp" class="button large orange al_right">Nueva Aplicación</a>
      <h2 class="myriadFont mg_top">APLICACIONES DE EDITORIAL LAROUSSE</h2>
      <table class="tablew">
        <thead>
          <tr>
            <th>Nombre</th>
            <th colspan="5">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if(isset($apps))
                {
                  for ($i=0; $i <count($apps) ; $i++) 
                    {  
                      ?>

                    <tr>
                      <td><a href="<?php base_url(); ?>apps/view/<?php echo $apps[$i]['id']; ?>" class="bluetext"><?php echo $apps[$i]['nombre']; ?></a></td>
                      <td><a href="">Editar</a></td>
                      <td><a href="#eliminar<?php echo $apps[$i]['id'] ?>">Eliminar</a></td>
                      <td><a href="<?php base_url(); ?>export/create/<?php echo $apps[$i]['id']; ?>">Exportar</a></td>
                    </tr>
                     
                      <div id="eliminar<?php echo $apps[$i]['id'] ?>" class="modalDialog">
                        <div>
                          <a href="#" title="Close" class="close">x</a>
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('apps/eliminar') ?>
          
                              <h2><?php echo $apps[$i]['nombre'] ?><br/></h2>
                              <p>Toda la información relacionada se borrara</p>
          
                              <input type="hidden" name="id" id="id"  value="<?php echo $apps[$i]['id']; ?>"/>
            
                              <button type="submit" class="eliminarBoton">Eliminar</button>
                            </form>
                        </div>
                      </div>


          <?php     }
                } 
          ?>
        </tbody>
      </table>
  </div>

  <div class="clear"></div>

</div>
<script>
$(document).keyup(function (data)
{
   if (data.keyCode == 72) 
   {
      
   }
});
</script>
