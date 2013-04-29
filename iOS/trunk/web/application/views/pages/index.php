
<div class="wrapper">

  <div id="nuevaApp" class="modalDialog">
    <div>
      <a href="#" title="Close" class="close">X</a>
      <?php echo validation_errors(); ?>
      <?php echo form_open('apps/nueva/') ?>


        <h2>Nueva aplicación</h2><br><br>
        <div class="centrar">
          <label for="">Nombre: </label>
          <input type="text" name="nombre" value="">
        </div>
        <br>
        <button type="submit" class="eliminarBoton">Agregar</button>
      </form>
    </div>
  </div>
  
 

  <div class="main">
      <table class="tablew">
        <tr>
          <th colspan="5">Aplicaciones</th>
        </tr>
        <?php if(isset($apps))
              {
                for ($i=0; $i <count($apps) ; $i++) 
                  {  
                    ?>

                  <tr>
                    <td><a href="<?php base_url(); ?>apps/view/<?php echo $apps[$i]['id']; ?>" class="bluetext"><?php echo $apps[$i]['nombre']; ?></a></td>
                    <td><a href="#eliminar<?php echo $apps[$i]['id'] ?>">Eliminar</a></td>
                    <td><a href="<?php base_url(); ?>export/create/<?php echo $apps[$i]['id']; ?>">Exportar</a></td>
                  </tr>
                   
                    <div id="eliminar<?php echo $apps[$i]['id'] ?>" class="modalDialog">
                      <div>
                        <a href="#" title="Close" class="close">X</a>
                          <?php echo validation_errors(); ?>
                          <?php echo form_open('apps/eliminar') ?>
        
                            <h2><?php echo $apps[$i]['nombre'] ?><br/></h2>
                            <p>Nota: Se eliminaran las recetas relacionadas con esta aplicación.</p>
        
                            <input type="hidden" name="id" id="id"  value="<?php echo $apps[$i]['id']; ?>"/>
          
                            <button type="submit" class="eliminarBoton">Eliminar</button>
                          </form>
                      </div>
                    </div>


        <?php     }
              } 
        ?>

      </table>
  </div>

  <div class="clear"></div>

</div>
