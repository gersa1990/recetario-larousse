
<div class="wrapper">

  <input type="text" name="nombreApp" class="input post" value="Título">
  
  <nav id="menu">
    <ul>
      <li><a href="" class="">Receta</a></li>
      <li><a href="" class="">Glosario</a></li>
      <li><a href="" class="">Video</a></li>
      <li><a href="" class="">Receta complementaria</a></li>
  </nav>

  <div class="main">
    <div class="columna">

      <input type="submit" class="button" value="+ Nueva">

      <table>
        <thead>
          <tr>
            <td colspan="3">Recetas</td>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><a href="">Frijoles en ajo a la naranja con jitomate y queso</a></td>
            <td><a href="">Eliminar</a></td>
            <td><a href="">Exportar</a></td>
          </tr>
        </tbody>
      </table>
      <input type="text" name="" class="input post buscar" placeholder="Buscar.." value="">
      <span class="postfix email">  </span>
      
    </div>
    
    <div class="columna">

      <div id="addblock">
        
        <h2>Nueva receta</h2>
        <p>Información de la receta</p>
        <br>
        
        <div class="myform">
          <form action="">
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
            <input type="number" name="dificultad" id="dificultad" />

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
            <input type="text" name="costo" id="costo" />

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



