
<div class="wrapper">

  <div id="status">
     
  </div>

  <div class="main">


    <div class="columna">

      <h1>Menu</h1>
      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li class="active"><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorias</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosarios</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>

    </div>
    
    <div class="columna">
      <div id="addblock">
  
        <div id="controles">
          <a href="#nuevaReceta" class="button bl1">Nueva receta</a>
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
        </div> 
  
        <table id="categorias">
          <thead>
            <tr>
              <td colspan="2">Recetas</td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php 

            var_dump($categorias);

            if(isset($categorias))
                  {

                    for ($i=0; $i <count($categorias) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <a href="<?php echo base_url().'categorias/view/'.$categorias[$i]['id']; ?>" class="bluetext">
                              <?php echo $categorias[$i]['nombre']; ?>
                            </a>
                          </td>

                          <td>
                            <a href="<?php echo base_url().'categorias/edit/'.$categorias[$i]['id']; ?>">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a href="#eliminarReceta<?php echo $categorias[$i]['id']; ?>" class='eliminarRecetas'>
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php if(isset($categorias))
                  {
                    for ($i=0; $i <count($categorias) ; $i++) 
                      { ?>

                      <div id="eliminarReceta<?php echo $categorias[$i]['id']; ?>" class="modalDialog">
                        <div>
                          <a href="#" title="Close" class="close">X</a>
            
                        <?php echo form_open("categorias/delete/"); ?>
                          <h2>Eliminar receta</h2><br><br>
                          <div class="centrar">
                            <label for="">Nombre: </label>
                              <?php echo $categorias[$i]['nombre']; ?>
                          </div>
                          <input type="hidden" name="id" value="<?php echo $categorias[$i]['id']; ?>">
                          <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                          <br>
                          <button type="submit" class="eliminarBoton">Eliminar</button>
                        </form>
            
                        </div>
                      </div>

                      <?php } 
                    } ?>
        
      </div>
    </div>

  </div>


  <div id="nuevaReceta" class="modalDialog">
    <div>
      <a href="#" title="Close" class="close">X</a>
      
      <?php echo form_open("categorias/create/"); ?>
      <h2>Nueva Receta</h2><br><br>
      
      <input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="tiempo en minutos" required>
      
      
      <div class="centrar">
        <label for="">Titulo: </label>
        <input type="text" name="titulo" id="titulo" value="" placeholder="titulo de la receta" required>
      </div>
      
      <div class="centrar">
        <label for="">Categoria: </label>
        <select name="categoria">
          <?php for ($i=0; $i <count($categorias) ; $i++) { ?>
            <option value="<?php echo $categorias[$i]['id'] ?>"><?php echo $categorias[$i]['nombre'] ?></option>
          <?php } ?>
        </select>
      </div>
      
      <div class="centrar">
        <label for="">Procedimiento: </label>
        <textarea name="procedimiento"></textarea>
      </div>
      
      <div class="centrar">
        <label for="">Ingredientes: </label>
        <textarea name="ingredientes"></textarea>
      </div>
      
      <div class="centrar">
        <label for="">Preparación: </label>
        <input type="text" name="preparacion" value="" placeholder="tiempo en minutos" required>
      </div>
      
      <div class="centrar">
        <label for="">Cocción: </label>
        <input type="text" name="coccion" value="" placeholder="tiempo en minutos" required>
      </div>
      
      <div class="centrar">
        <label for="">Costo: </label>
        <select name="costo">
        <?php for ($i=1; $i <6 ; $i++) { ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php } ?>
        </select>
      </div>
      
      <div class="centrar">
        <label for="">Foto: </label>
        <input type="text" name="foto" value="" placeholder="nombre de archivo que contendrá la imagen" required>
      </div>
      
      <div class="centrar">
        <label for="">Dificultad: </label>
        <select name="dificultad">
          <?php for ($i=1; $i <6 ; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php } ?>
        </select>
      </div>
      
      <br>
        <button type="submit" class="eliminarBoton">Agregar receta</button>
      </form>
      
    </div>
  </div>
</div>

<div class="clear"></div>

</div>

<script>

 var base_url = "<?php echo base_url(); ?>";
 var app      =  "<?php echo $app; ?>";

 $("#addblock").css('display','none');

$("#nuevaCategoria").click(function ()
{
  $("#addblock").slideDown("slow");
});

$("#nombreApp").keyup(function ()
{
    var nombreApp = $("#nombreApp").val();
    console.log(nombreApp);

    $.post(base_url+"apps/updateNombre/", {nombre: nombreApp, id_app: app}, function (data)
    {

    });
});

$("#buscar").keyup(function ()
{
  
});

$("#color").ColorPicker({
  
  color: '#0000ff',
  onShow: function (colpkr) 
  {
    $(colpkr).fadeIn(500);
    return false;
  },
  
  onHide: function (colpkr) 
  {
    $(colpkr).fadeOut(500);
    return false;
  },
  
  onChange: function (hsb, hex, rgb) 
  {
    $('#color').val(rgb.r+","+rgb.g+","+rgb.b);
  }

  });


$("#exportar").click(function ()
{
  location.href=""+base_url+"export/create/"+app+"";
});

</script>