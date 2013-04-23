
<div class="wrapper">

    <a href="<?php echo base_url() ?>" class="home">Home</a> =>
    <a href="<?php echo base_url()."apps/view/".$app; ?>" class="home">Apps</a> =>
    <a href="<?php echo base_url()."recetas/modificar/".$recetas_item['id'].'/'.$app; ?>" class="home">Editar Receta</a>

	<div id="receta">
        <br/>

        
        <br/><br/>

        <?php
        //var_dump($recetas_item);
        ?>
		
       <!--  <form> -->
       <?php echo validation_errors(); ?>
       <?php echo form_open('recetas/updateR/'.$app."/".$recetas_item['id']) 

       ?>

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
                <input type="text" name="video" id="video" value="<?php  echo $recetas_item['video'] ?>"/>

                <br>
    
                <label>Foto:</label>
                <input type="text" name="foto" id="foto" value="<?php  echo $recetas_item['foto'] ?>">
                
                

                <?php
            if(isset($relations))
            {

            ?>
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Esta Receta esta relacionada con</td>
                    </tr>
                </thead>
                <?php       

                for ($i=0; $i <count($relations) ; $i++) 
                {

                ?>

                <tr>
                    <td>Titulo => </td>
                    <td><?php  echo $relations[$i]['titulo'] ?></td>
                </tr>
                <?php

                }
                ?>

                

                <?php
                }
                ?>


                </table>
                <br/>
                <a href="<?php echo base_url() ?>recetas/relationships/<?php echo $app."/".$recetas_item['id'] ?>">Modificar relaciones</a>

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

        <fieldset class="BuscarForm">
            <legend>Busca un glosario para agregarla a tu receta</legend>
             <center><input type="text" class="Buscar" id="BuscarGlosarioToRecipe" value=""></center>
        </fieldset>
        <br/>
        <div id="resultGlosario">Resultados</div>
        <br/><br/><br/>
       
<?php if(isset($glosarioByRecipe)) 
{
    ?>
         <table align="center" id="tableGlosario" class="BuscarForm">
            <thead>
                <tr>
                    <td colspan="4">Glosario de esta receta</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre</td>
                    <td>Descripcion</td>
                    <td>Imagen</td>
                    <td>Opciones</td>
                </tr>
                <?php for ($i=0; $i <count($glosarioByRecipe) ; $i++) 
                { 
                    
                ?>
                <tr>
                    <td><?php echo $glosarioByRecipe[$i]['nombre'] ?></td>
                    <td><?php echo $glosarioByRecipe[$i]['descripcion'] ?></td>
                    <td><img src="<?php echo $glosarioByRecipe[$i]['imagen'] ?>"/></td>
                    <td><a href="#Eliminar<?php echo $glosarioByRecipe[$i]['id'] ?>">Eliminar</a></td>
                </tr>

                <div id="Eliminar<?php echo $glosarioByRecipe[$i]['id'] ?>" class="modalDialog">
                    <div>
                        <a href="#" title="Close" class="close">X</a>
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('glosario/deleteRelation/'.$recetas_item['id'].'/'.$glosarioByRecipe[$i]['id'].'/'.$app.'/') ?>
                            
                            <h2>Eliminar la relacion con el glosario: <?php echo $glosarioByRecipe[$i]['nombre'] ?>. <br/></h2>
            
                            <input type="hidden" name="id" id="id"  value="<?php echo $glosarioByRecipe[$i]['id'] ?>"/>

                            <button type="submit" class="eliminarBoton">Eliminar</button>
                        </form>
                    </div>
                </div>

                <?php }?>
            </tbody>
        </table>
        <?php } ?>
        <br/><br/>

	</div>
   
</div>
<script>

var base_url = "<?php echo base_url() ?>";
var app      = "<?php echo $app; ?>";
var idReceta = "<?php echo $recetas_item['id']; ?>";

$("#BuscarGlosarioToRecipe").keyup(function (data)
{
    var palabra = $("#BuscarGlosarioToRecipe").val();

    if(palabra!="")
    {
         $.post(base_url+"glosario/getLike/",{nombre : palabra, application : app, id : idReceta },function (data)
        {
            $("#resultGlosario").html(data);
        });
    }

   

});
</script>