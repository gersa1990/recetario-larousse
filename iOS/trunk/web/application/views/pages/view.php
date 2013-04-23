<div class="wrapper">

    <a href="<?php echo base_url() ?>" class="home">Home</a>
    <a href="<?php echo base_url()."apps/view/".$app; ?>" class="homeh1">Apps</a>
    <a href="<?php echo base_url()."recetas/view/".$recetas_item['id'].'/'.$app; ?>" class="homeh2">Ver Receta</a>

	<div id="receta">
		
		<div class="receta-pics">

			<img src="http://placehold.it/200x200/4D99E0/ffffff.png&amp;text=<?php echo $recetas_item['foto'] ?>">

			<p> Precio: <span><?php  echo $recetas_item['costo'] ?></span><p>

			<p >Usuarios a quienes les a gustado: <span><?php echo $recetas_item['user_fav'] ?></span><p>

            <p >Dificultad para realizar esta receta: <span><?php echo $recetas_item['dificultad'] ?></span><p>

            <?php if(isset($videoReceta) && count($videoReceta)>0){  ?>
            
            <p>
                <table>
                    <thead>
                        <tr>
                            <td>Videos en esta receta</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i=0; $i <count($videoReceta) ; $i++){ ?>
                        <tr>
                            <td><?php echo $videoReceta[$i]['video']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </p>

         <?php
            }
            
            if(isset($relations))
            {

            ?>
            <table>
              <thead>
                <tr>
                  <td>Se relaciona con </td>
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

                
                </table>


                <?php
                }
                else
                {
                    echo "Esta receta no cuenta con recetas complementarias";
                }
                ?>

              </br></br></br>

                <?php

                 if(isset($glosarioByRecipe)) 
                {
                ?>
         <table>
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
                    
                </tr>
                <?php for ($i=0; $i <count($glosarioByRecipe) ; $i++) 
                { 
                    
                ?>
                <tr>
                    <td><?php echo $glosarioByRecipe[$i]['nombre'] ?></td>
                    <td><?php echo $glosarioByRecipe[$i]['descripcion'] ?></td>
                    <td><?php echo $glosarioByRecipe[$i]['imagen'] ?></td>
                    
                </tr>

                <?php }?>
            </tbody>
        </table>
        <?php } else{echo "Esta receta no cuenta con glosario relacionado";}?>
        <br/><br/>



		</div>

		<div class="receta-info">

			<h2 class="centrar"><?php echo $recetas_item['titulo']?></h2>
			<p class="centrar"> Listo en: <span> <?php echo $recetas_item['preparacion'] ?> min.</span><p>

			<h3>Ingredientes</h3>
				<!-- <p><p> -->
				<div id="proce" class="nolinea" readonly><?php echo $recetas_item['ingredientes'] ?></div>

			<h3>Modo de preparación</h3>
				<p class="aling">	Preparación:  	   <span><?php echo $recetas_item['coccion'] ?> min.</span> |</p>
				<p class="aling">	Tiempo de cocción: <span><?php echo $recetas_item['coccion'] ?> min.</span></p> 
				<!-- <p class="clear" > <p> -->
				<div  class="nolinea" readonly><?php echo $recetas_item['procedimiento'] ?></div>
		</div>

	</div>
</div>




    <div id="agregarGlosario" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <?php echo validation_errors(); ?>
          <?php echo form_open('glosario/create') ?>
            <input type="hidden" id="id" name="id" value="<?php echo $recetas_item['id'];  ?>">
            <h2>Agregar a glosario</h2>
             <label class="dialogL" for="palabra">Palabra:</label>
             <input type="text" name="palabra" id="palabra" value="" readonly/>
             <br/>
             <label class="dialogL" for="definicion">Definición:</label>
             <input type="text" name="definicion" id="definicion" placeholder="definicion">
             <br/>
             <label class="dialogL" for="imgGlosario">Imagen:</label>
             <input type="text" name="imgGlosario" id="imgGlosario" placeholder="imagen" value="" />
             <br/>
            <button type="submit" class="eliminarBoton">Agregar</button>
          </form>
        </div>
      </div>

<script>

/*$(document).ready(function(){
    
//variables de control
var menuId = "menu";
var menu = $("#"+menuId);

//EVITAMOS que se muestre el MENU CONTEXTUAL del sistema operativo al hacer CLICK con el BOTON DERECHO del RATON
$(document).bind("contextmenu", function(e){
    menu.css({'display':'block', 'left':e.pageX, 'top':e.pageY});
    return false;
});
    
    //controlamos ocultado de menu cuando esta activo
    //click boton principal raton
    $(document).click(function(e){
        if(e.button == 0 && e.target.parentNode.parentNode.id != menuId){
            menu.css("display", "none");
        }
    });
    //pulsacion tecla escape
    $(document).keydown(function(e){
        if(e.keyCode == 27){
            menu.css("display", "none");
        }
    });
    
    //Control sobre las opciones del menu contextual
    menu.click(function(e){
        //si la opcion esta desactivado, no pasa nada
        if(e.target.className == "disabled"){
            return false;
        }
        //si esta activada, gestionamos cada una y sus acciones
        else{
            switch(e.target.id){
                case "add_glosario":
                    console.log("Glosario");
                    break;
                case "menu_favoritos":
                    var title = "Tutoriales de Desarrollo y Diseño Web | Web.Ontuts";
                    var url = "http://web.ontuts.com";
                    //para firefox
                    if(window.sidebar)
                        window.sidebar.addPanel(title, url, "");
                    //para Internet Explorer
                    else if(window.external)
                        window.external.AddFavorite(url, title);
                    break;
            }
            menu.css("display", "none");
        }
    });

});
var selectedText="Test";

$(".nolinea").select( function (data) 
{
  var selectedText = document.getSelection();
  console.log("Seleccionado"+selectedText);
  $("#palabra").attr("value",selectedText);
});
*/
    

</script>
