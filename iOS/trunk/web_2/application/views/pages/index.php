
<div class="wrapper">
  <!-- <form class="form-buscar">
      <input type="text" id="btn-buscar" placeholder="" required>
      <input type="submit" value="Buscar" id="submit">
  </form> -->

  <div id="lista">
    <table class="listaApp">
      <tr>
        <th colspan="4">Aplicaciones</th>
        
      </tr>

      <?php foreach ($apps as $apps_item): ?>
      <tr>
        <td><?php echo $apps_item['nombre'] ?></td>
        <td><a href="<?php echo base_url()."apps/view/".$apps_item['id'] ?>">Ver</a></td>
        <td><a href="#editarApp<?php echo $apps_item['id'] ?>">Editar</a></td>
        <td><a href="#eliminarApp<?php echo $apps_item['id'] ?>">Eliminar</a></td>
      </tr>

      <div id="editarApp<?php echo $apps_item['id'] ?>" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <?php echo validation_errors(); ?>
          <?php echo form_open('apps/modificar') ?>
            
            <h2>Editar Aplicación.</h2>
            
            <input type="hidden" name="id" id="id"  value="<?php echo $apps_item['id'] ?>"/>

            <label class="dialogL">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $apps_item['nombre'] ?>"/>

            <button type="submit" class="eliminarBoton">Guardar</button>
          </form>
        </div>
      </div>

      <div id="eliminarApp<?php echo $apps_item['id'] ?>" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <?php echo validation_errors(); ?>
          <?php echo form_open('apps/eliminar') ?>
            
            <h2>Eliminar Aplicación => <?php echo $apps_item['nombre'] ?>. <br/></h2><h1>Si la eliminas eliminaras las recetas que esta contenga</h1>
            
            <input type="hidden" name="id" id="id"  value="<?php echo $apps_item['id'] ?>"/>

            <button type="submit" class="eliminarBoton">Eliminar</button>
          </form>
        </div>
      </div>

      <?php endforeach ?>
    </table>
    
  </div>
  
  <div id="izquierda">

    <nav> 
      <ul>
       
        <li><a href="#agregarApp">Nueva app</a></li>
        <li><a href="<?php echo base_url() ?>categorias/index">Categorías</a></li>
        <li><a href="<?php echo base_url() ?>glosario/index/">Glosario</a></li>
      </ul>
    </nav>

    <div id="agregarApp" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <?php echo validation_errors(); ?>
          <?php echo form_open('apps/create') ?>
            <h2>Agregar nueva App</h2>
             <label class="dialogL">Nombre: </label>
             <input type="text" name="nombre" id="nombre" />
            <button type="submit" class="eliminarBoton">Agregar</button>
          </form>
        </div>
      </div>

    

  </div>
 
</div>



