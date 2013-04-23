<div class="wrapper">
   <a href="<?php echo base_url() ?>" class="home">Home</a>
   <a href="<?php echo base_url()."apps/view/".$app; ?>" class="homeh1">Aplicación</a>
   <a href="<?php echo base_url() ?>recetas/agregar/<?php echo $app ?>" class="homeh2">Agregar receta</a>

  <div id="myform" class="myform">

      <?php echo validation_errors(); ?>
      <?php echo form_open('recetas/create/'.$app) ?>

      <h2>Nueva receta</h2>
      <p>Información de la receta</p>
 
      <label for="titulo">Título</label>
      <input type="texto" name="titulo" id="titulo" />



      <label for="categoria">Categoria</label>
      <select name="categoria" id="categoria">

        <?php foreach ($categorias as $c_item): ?>

          <option value="<?php echo $c_item['id'] ?>"><?php echo $c_item['nombre'] ?></option>

        <?php endforeach ?>

      </select>

      <label for="dificultad">Dificultad <span class="small">Dificultad para realizarla</span></label>
      <input type="text" name="dificultad" id="dificultad" />

      
      <select name="app" id="app" style="display:none;">
          <option value="<?php echo $app; ?>"><?php echo $app; ?></option>
      </select>

      <br><br><br>
      <label for="proce" class="fixmargin">Procedimiento <span class="small">Pasos de preparación</span></label>
      <textarea name="proce" title="proce" rows="4" cols="46"></textarea>

      <br><br>

      <label for="ingre" class="fixmargin">Ingredientes <span class="small">Lista de ingredientes</span></label>
      <textarea name="ingre" title="ingre" rows="4" cols="46"></textarea>

      <label for="prepa">Preparación <span class="small">Tiempo en min</span></label>
      <input type="text" name="prepa" id="prepa" />

      <label for="coccion">Cocción <span class="small">Tiempo en min</span></label>
      <input type="text" name="coccion" id="coccion" />

      <label for="costo">Costo <span class="small">Precio aproximado</span></label>
      <input type="text" name="costo" id="costo" />

      <label for="ïmg">Imagen <span class="small">Cargar file</span></label>
      <input type="text" name="img" id="img" />

      <button type="submit">Guardar</button>
    </form>


     

  </div>

  
</div>
