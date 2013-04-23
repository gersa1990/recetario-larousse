
<div class="wrapper">

    <a href="<?php echo base_url() ?>" class="home">Home</a>
    <a href="<?php echo base_url()."apps/view/".$app; ?>" class="homeh1">Apps</a>
    <a href="<?php echo base_url()."recetas/modificar/".$recetas_item['id'].'/'.$app; ?>" class="homeh2">Editar Receta</a>

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

                <img src="http://placehold.it/200x200/4D99E0/ffffff.png&amp;text=<?php echo $recetas_item['foto'] ?>">
                
                <br><br><br>
                
                <input class="input-mini" type="hidden" name="id" id="id" value="<?php  echo $recetas_item['id'] ?>" readonly/>

                <br>

                <label>Nombre de imagen</label>
                <input type="text" name="foto" id="foto" value="<?php echo $recetas_item['foto']; ?>">

                <br/>

                <label>Tiempo de preparación:</label>
                <input class="centrados" type="text" name="prepa" id="prepa" value="<?php echo $recetas_item['preparacion'] ?>"/>
                <label>min.</label>

                <br>

                <label>Tiempo de cocción:</label>
                <input class="centrados" type="text" name="coccion" id="coccion" value="<?php echo $recetas_item['coccion'] ?>"/>
                <label>min.</label>

                <br>

                <label>Costo:</label>
                <select name="costo">
                    <?php for ($i=1; $i <6 ; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if ($i==$recetas_item['costo']){ echo "selected"; } ?> ><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                
                <br>

                <label>Categoria:</label>
        
                <input type="" name="categoria" id="categoria" value="<?php  echo $recetas_item['id_categoria'] ?>"/>
              
                <br>

                
                <input type="hidden" name="app" id="app" value="<?php  echo $recetas_item['id_app'] ?>">

                 <br>
    
                <label>User Fav:</label>
                <input type="text" name="user_fav" id="user_fav" value="<?php  echo $recetas_item['user_fav'] ?>">

                 <br>
    
                <label>Dificultad:</label>
                <select name="dificultad" id="dificultad">
                    <?php for ($i=1; $i <6 ; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if ($i==$recetas_item['dificultad']){ echo "selected"; } ?> ><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                                

                <?php
            if(isset($relations))
            {

            ?>
            <table class="fix-top">
                <thead>
                    <tr>
                        <td colspan="1">Relaciones</td>
                    </tr>
                </thead>
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
                <br/>
                <a href="<?php echo base_url() ?>recetas/relationships/<?php echo $app."/".$recetas_item['id'] ?>">Modificar relaciones</a>

                <div>
                <?php if(isset($videoReceta) && count($videoReceta)>0) {  ?>
            
                <p >
                <table>
                    <thead>
                        <tr>
                            <td>Videos en esta receta</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php for ($i=0; $i <count($videoReceta) ; $i++) 
                        { 
                        ?>
                        
                        <tr>
                            <td><?php echo $videoReceta[$i]['video']; ?></td>
                        </tr>
                        
                        <?php 
                        } 
                        ?>

                    </tbody>
                </table>
                </p>

                <?php } ?>
                    <div id="myform" class="myform" style="width:80%; min-height: 200px;">
                        <h4>Relacionar videos con esta receta.</h4>
                            <input type="search" name="search"   id="search" placeholder="Buscar videos para asignar">
                            <br/><br/><br/>
                            <div class="Result" id="ResultVideos">Resultados</div>
                            <input type="text"   name="id_receta" id="id_receta" value="<?php echo $recetas_item['id']; ?>">
                    </div>
                </div>

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
            <div>

            </div>
        </form>

        <div id="myform" class="myform" style="height:100px;">

            <fieldset>
                <legend>Agrega glosario a tu receta</legend>
                <input type="text" class="Buscar centrar" name="Buscar" id="BuscarGlosarioToRecipe" value="" style="width:380px;">
            </fieldset>

        </div>
       


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

$("#search").keyup(function (data)
{
    var texto = $("#search").val();
    if(texto!="")
    {
        $.post(base_url+"videos/searchRelation/", {id_receta: idReceta, id_video: texto, application: app }, function (datos)
        {
            $("#ResultVideos").html(datos);
        });
    }
});
</script>