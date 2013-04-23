  <div class="wrapper">   
  


  <input type="text" name="nombreApp" class="inputWindowsPhone" value="<?php echo $apps['nombre']; ?>">
  

   <ul class="menu">
      <li><a href="" class="">Nueva Receta</a></li>
      <li><a href="" class="">Nuevo glosario</a></li>
      <li><a href="" class="">Nuevo video</a></li>
      <li><a href="" class="">Nueva Receta complementaria</a></li>
    </ul>
  
  <br/>
  
  <div id="lista">
    
    <table class="lista2">
    <thead>
      <tr>
        <td><a href="<?php echo base_url(); ?>recetas/agregar/"<?php echo $apps['id']; ?>>+ Nueva</a></td>
      </tr>
    </thead>
    <tbody>
      <?php if(isset($recetasByApp))
      { 
        for ($i=0; $i <count($recetasByApp) ; $i++) 
        { 

        ?>

        <tr>
          <td><?php echo $recetasByApp[$i]['titulo']; ?></td>
        </tr>

        <?php
        }
      } 
      ?>
    </tbody>
  </table>

  <div id="derecha">
    <table class="lista">
      <thead>
        <tr>
          <td>Agregar nueva (o) <?php if(isset($accion)){ echo $accion; }else{ echo "Receta";} ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Titulo</td>
        </tr>
      </tbody>
    </table>
  </div>

  </div>
</div>