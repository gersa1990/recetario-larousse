
<div class="wrapper">

    <a href="<?php echo base_url(); ?>" class="home">Home</a>

	<div id="receta">
		
       <!--  <form> -->
       <?php echo validation_errors(); ?>
       <?php echo form_open('updateR') ?>

            <div class="receta-pics">

                <br><br><br>

                <input class="input-img" type="image" name="file" id="file" src="<?php echo base_url()?>src/img-ejemplo.jpg">
                
                <br><br><br>
                <label>Id receta:</label>
                <input class="input-mini" type="text" name="id" id="id" value="<?php  echo $recetas_item['id'] ?>" readonly/>

                <br>

                <label>Tiempo de preparación:</label>
                <input class="centrados" type="text" name="prepa" id="prepa" value="<?php echo $recetas_item['preparacion'] ?>"/>
                <label>min.</label>

                <br>

                <label>Tiempo de cocción:</label>
                <input class="centrados" type="text" name="coccion" id="coccion" value="<?php echo $recetas_item['coccion'] ?>"/>
                <label>min.</label>

                <br>

                <label>Costo:</label>
                <input class="input-mini" type="text" name="costo" id="costo" value="<?php  echo $recetas_item['costo'] ?>"/>
    
                <br>

                <label>Categoria:</label>
                <input class="input-mini" type="number" name="categoria" id="categoria" value="<?php  echo $recetas_item['id_categoria'] ?>"/>
              
                <br>

                <label>Id de la Aplicación:</label>
                <select class="input-mini" name="app" id="app">

                    <option value="<?php  echo $recetas_item['id_app'] ?>"><?php  echo $recetas_item['id_app'] ?></option>

                    <?php foreach ($apps as $apps_item): ?>

                    <option value="<?php echo $apps_item['id'] ?>"><?php echo $apps_item['id'] ?></option>

                    <?php endforeach ?>

                </select>

                <br>
    
                <label>Video:</label>
                <input type="text" name="video" id="video" value="None"/>

                <br>
    
                <label>Foto:</label>
                <input type="text" name="foto" id="foto" value="<?php  echo $recetas_item['foto'] ?>">
                
                

                <?php
            if(isset($relations))
            {

            ?>
            <table>
                <?php       

                for ($i=0; $i <count($relations) ; $i++) 
                {

                ?>

                <tr>
                    <td><?php  echo $relations[$i]['titulo'] ?></td>
                </tr>
                <?php

                }
                ?>

                

                <?php
                }
                ?>


                </table>
                <a href="<?php echo base_url() ?>recetas/relationships/<?php echo $recetas_item['id'] ?>">Modificar relaciones</a>

            </div>

            <div class="receta-info">
        
                <input class="formTitulo" type="texto" name="titulo" id="titulo" value="<?php echo $recetas_item['titulo']?>"/>

                <h3>Procedimiento</h3>
                <textarea cols="46" rows="4" id="proce" name="proce" title="proce">
                    <?php echo $recetas_item['procedimiento'] ?>
                </textarea>

                <br>

                <h3>Ingredientes</h3>
                <textarea name="ingre" title="ingre" rows="4" cols="46">
                    <?php echo $recetas_item['ingredientes'] ?>
                </textarea>

                <br>
                
            </div>

            <button type="submit">Guardar</button>
        </form>

	</div>
</div>