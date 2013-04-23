
<div class="wrapper">
  <!-- <form class="form-buscar">
      <input type="text" id="btn-buscar" placeholder="" required>
      <input type="submit" value="Buscar" id="submit">
  </form> -->

  <a href="<?php echo base_url() ?>apps/newapp/" class="button blue fix_b">Nueva aplicación</a>

  <br><br>

  <div id="lista">
    <table class="lista">
      <tr>
        <th colspan="5">Aplicaciones</th>
      </tr>

      <?php foreach ($apps as $apps_item): ?>
      <tr>
        <td><a href="<?php echo base_url()."apps/view/".$apps_item['id'] ?>"><?php echo $apps_item['nombre'] ?></a></td>
        <td><a href="#eliminarApp<?php echo $apps_item['id'] ?>">Eliminar</a></td>
        <td><a href="<?php echo base_url().'export/create/'.$apps_item['id'] ?>">Exportar</a></td>
      </tr>

      <div id="eliminarApp<?php echo $apps_item['id'] ?>" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <?php echo validation_errors(); ?>
          <?php echo form_open('apps/eliminar') ?>
            
            <h2>Eliminar Aplicación: <?php echo $apps_item['nombre'] ?>. <br/></h2>
            <p>Si la eliminas eliminaras las recetas que esta contenga</p>
            
            <input type="hidden" name="id" id="id"  value="<?php echo $apps_item['id'] ?>"/>

            <button type="submit" class="eliminarBoton">Eliminar</button>
          </form>
        </div>
      </div>

      <?php endforeach ?>
    </table>
    
  </div> 
</div>



