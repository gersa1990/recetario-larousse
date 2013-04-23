<div class="wrapper">
  <a href="<?php echo base_url() ?>" class="home">Home </a> =>
  <a href="<?php echo base_url().'apps/view/'.$app ?>" class="home">Recetas por APP</a>
  <br/><br/>


    <nav> 
      <ul>
        <li><a href="<?php echo base_url() ?>recetas/agregar/<?php echo $app ?>">Nueva receta</a></li>
      </ul>
    </nav>
  
<div id="lista">
    <table class="lista">
      <tr>
        <th colspan="9">Recetas contenidas en esta aplicación</th>
        
      </tr>
      <tr>
        <td>Titulo</td>
        <td>Procedimiento</td>
        <td>ingredientes</td>
        <td>preparacion</td>
        <td>foto</td>
        <td colspan="4">Opciones</td>
      </tr>

      <?php for ($i=0; $i<count($recetas) ; $i++)
      { 
      ?>

      <tr>
        <td><?php echo $recetas[$i]['titulo'] ?></td>
        <td><?php echo $recetas[$i]['procedimiento'] ?></td>
        <td><?php echo $recetas[$i]['ingredientes'] ?></td>
        <td><?php echo $recetas[$i]['preparacion'] ?></td>
        
        <td><?php echo $recetas[$i]['foto'] ?></td>
        
        <td><a href="<?php echo base_url().'recetas/view/'.$recetas[$i]['id']."/".$app; ?>">Ver</a></td>
        <td><a href="<?php echo base_url().'recetas/modificar/'.$recetas[$i]['id'].'/'.$app; ?>">Editar</a></td>
        <td><a href="#openModal<?php echo $recetas[$i]['id']; ?>">Eliminar</a></td>
        <td><a href="<?php echo base_url().'recetas/relationships/'.$app.'/'.$recetas[$i]['id']; ?>">Relacionar</a></td>
      </tr>

      <div id="openModal<?php echo $recetas[$i]['id'] ?>" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <h2>Eliminar: <?php echo $recetas[$i]['titulo']; ?></h2>
          <p>¿Estas seguro de eliminar?.</p>
          <a href="<?php echo base_url().'recetas/eliminar/'.$recetas[$i]['id'].'/'.$app; ?>" class="eliminarBoton">Eliminar</a>
          <a href="#" class="eliminarBoton">Cancelar</a>
        </div>
      </div>
      
      <?php } ?>
    </table>
  </div>
  <br/>
   
</div>