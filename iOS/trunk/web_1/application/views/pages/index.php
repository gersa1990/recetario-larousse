
<div class="wrapper">
  <!-- <form class="form-buscar">
      <input type="text" id="btn-buscar" placeholder="" required>
      <input type="submit" value="Buscar" id="submit">
  </form> -->

  <div id="lista">
    <table class="lista">
      <tr>
        <th>Recetas</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>

      <?php foreach ($recetas as $recetas_item): ?>
      <tr>
        <td><?php echo $recetas_item['titulo'] ?></td>
        <td><a href="view/<?php echo $recetas_item['id'] ?>">Ver</a></td>
        <td><a href="modificar/<?php echo $recetas_item['id'] ?>">Editar</a></td>
        <td><a href="#openModal<?php echo $recetas_item['id'] ?>">Eliminar</a></td>
      </tr>

      <div id="openModal<?php echo $recetas_item['id'] ?>" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <h2>Eliminar: <?php echo $recetas_item['titulo'] ?></h2>
          <p>¿Estas seguro de eliminar?.</p>
          <a href="eliminar/<?php echo $recetas_item['id'] ?>" class="eliminarBoton">Eliminar</a>
          <a href="#" class="eliminarBoton">Cancelar</a>
        </div>
      </div>
      <?php endforeach ?>
    </table>
  </div>
  
  <div id="izquierda">

    <nav> 
      <ul>
        <li><a href="agregar">Nueva receta</a></li>
        <li><a href="#agregarApp">Nueva app</a></li>
        <li><a href="categoria">Categorías</a></li>
        <li><a href="<?php base_url() ?>glosario">Glosario</a></li>
        
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

    <table class="listaApp">
      <tr>
        <th>Aplicaciones</th>
        <th></th>
      </tr>

      <?php foreach ($apps as $apps_item): ?>
      <tr>
        <td><?php echo $apps_item['nombre'] ?></td>
        <td><a href="#editarApp<?php echo $apps_item['id'] ?>">Editar</a></td>
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

      <?php endforeach ?>
    </table>

  </div>
 
</div>



