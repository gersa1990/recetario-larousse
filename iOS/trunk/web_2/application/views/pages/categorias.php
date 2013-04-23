<div class="wrapper">

    <a href="<?php echo base_url(); ?>" class="home">Home</a>

    <h2 class="centrado">Categorías</h2>

	<table class="listaCategorias">
      	<tr>
        	<th>Nombre</th>
        	<th>Color</th>
        	<th></th>
        	<th></th>
      	</tr>

      	<?php foreach ($categorias as $c_item): ?>
      	<tr>
        	<td><?php echo $c_item['nombre'] ?></td>
        	<td><?php echo $c_item['color'] ?></td>
        	<td><a href="#editar<?php echo $c_item['id'] ?>">Editar</a></td>
        	<td><a href="#eliminar<?php echo $c_item['id'] ?>">Eliminar</a></td>
      	</tr>

        <div id="editar<?php echo $c_item['id'] ?>" class="modalDialog">
          <div>
            <a href="#" title="Close" class="close">X</a>
            <?php echo validation_errors(); ?>
            <?php echo form_open('categorias/modificar') ?>
              
              <h2>Editar Aplicación.</h2>

              <input type="hidden" name="id" id="id"  value="<?php echo $c_item['id'] ?>"/>
              
              <label class="dialogL">Nombre: </label>
              <input type="text" name="nombre" id="nombre" value="<?php echo $c_item['nombre'] ?>"/>

              <br><br>

              <label class="dialogL">Color: </label>
              <input type="text" name="color" id="color" value="<?php echo $c_item['color'] ?>"/>

              <button type="submit" class="eliminarBoton">Guardar</button>
            </form>
          </div>
      </div>

		
		    <div id="eliminar<?php echo $c_item['id'] ?>" class="modalDialog">
          <div>
            <a href="#" title="Close" class="close">X</a>
            <h2>Eliminar: <?php echo $c_item['nombre'] ?></h2> 
            <p>¿Estas seguro de eliminar este elemento?.</p>
            <a href="<?php echo base_url()?>categorias/eliminar/<?php echo $c_item['id'] ?>" class="eliminarBoton">Eliminar</a>
            <a href="#" class="eliminarBoton">Cancelar</a>
          </div>
        </div>

      	<?php endforeach ?>
    </table>

    <a href="#nueva" class="button blue">Nueva</a>

    <div id="nueva" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <?php echo validation_errors(); ?>
          <?php echo form_open('categorias/create') ?>
	          <h2>Nueva categoría.</h2>
	          <label class="dialogL">Nombre: </label>
	          <input type="text" name="nombre" id="nombre" />

	          <br>

	          <label class="dialogL">Color: </label>
	          <input type="text" name="color" id="color" />

	          <br>

	          <button type="submit" class="eliminarBoton">Agregar</button>
          </form>
        </div>
    </div>

</div>
