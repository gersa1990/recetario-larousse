
<div class="wrapper">

  <div class="main">
    <div id="status">
     
  </div>

    <a href="<?php echo base_url() ?>" class="home">Regresar</a>



    <div class="columna">

      <h1>Menu</h1>
      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li class="active"><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorias</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>

    </div>
    
    <div class="columna">
      <div id="addblock">
  
        <div id="controles">
          <a href="#nuevaCategoria" class="button bl1">Nueva categoria</a>
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
        </div> 
  
        <table id="categorias">
          <thead>
            <tr>
              <td colspan="2">Categorias</td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php 
              if(isset($categorias)){
                for ($i=0; $i <count($categorias) ; $i++) { ?>
                  <tr>
                      <td class="txleft">
                        <a href="<?php echo base_url().'categorias/view/'.$categorias[$i]['id']; ?>" class="bluetext">
                          <?php echo $categorias[$i]['nombre']; ?>
                        </a>
                      </td>

                      <td>
                        <a href="#editarCategoria<?php echo $categorias[$i]['id']; ?>">
                          Editar
                        </a>
                      </td>

                      <td>
                        <a href="#eliminarCategoria<?php echo $categorias[$i]['id']; ?>" class='eliminarRecetas'>
                          Eliminar
                        </a>
                      </td>

                  </tr>

                <?php     
                }   
              } ?>
          </tbody>
        </table>

        <?php if(isset($categorias)){
          for ($i=0; $i <count($categorias) ; $i++) { ?>

            <div id="eliminarCategoria<?php echo $categorias[$i]['id']; ?>" class="modalDialog">
              <div class="popup form_delete">

                <a href="#" title="Close" class="close">x</a>
      
                <?php echo form_open("complementarias/delete/"); ?>
                  <h2>Categoria</h2>
                  <p class="mg-auto"><?php echo $categorias[$i]['nombre']; ?></p>         
                  <input type="hidden" name="id" value="<?php echo $categorias[$i]['id']; ?>">
                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  <button type="submit" class="submit">Eliminar</button>
                </form>
              </div>
            </div>

            <div id="editarCategoria<?php echo $categorias[$i]['id']; ?>" class="modalDialog">
              <div class="popup form_edit">
                <a href="#" title="Close" class="close">x</a>
                
                <?php echo form_open("categorias/delete/"); ?>
                  <h2>Edita categoria</h2>

                  <div class="centrar">
                    <label for="">Nombre: </label>
                    <input type="text" name="nombre" value="<?php echo $categorias[$i]['nombre']; ?>">
                  
                  
                    <div id="divColorEditar">
                      <label for="">Color: </label>
                      <div id="editar">
                        <input type="hidden" id="nameColor" class="<?php echo $categorias[$i]['id']; ?>" value="<?php echo $categorias[$i]['id']; ?>" >
                        <input type="text" name="color" id="color" class="editar_<?php echo $categorias[$i]['id']; ?>" value="<?php echo $categorias[$i]['color']; ?>">
                      </div>
                    </div>

                  </div>
                  
                  <input type="hidden" name="id" value="<?php echo $categorias[$i]['id']; ?>">
                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                  <button type="submit" class="submit">Guardar</button>
                </form>
              
              </div>
            </div>
          <?php 
          } 
        } ?>
        
      </div>
    </div>

  </div>


  <div id="nuevaCategoria" class="modalDialog">
    <div>
      <a href="#" title="Close" class="close">X</a>
      
      <?php echo form_open("categorias/create/"); ?>
      <h2>Nueva categoria</h2><br><br>
      
      <input type="hidden" name="id_app" value="<?php echo $app; ?>" placeholder="tiempo en minutos" required>
      
      
      <div class="centrar">
        <label for="">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="" placeholder="Nombre de la categoria" required>
      </div>
      
      <div class="centrar">
        <label for="">Color:</label>
          <input type="text" name="color" id="color2" value="" placeholder="color de la categoria" required>
      </div>

      <br>
        <button type="submit" class="eliminarBoton">Agregar categoria</button>
      </form>
      
    </div>
  </div>
</div>

<div class="clear"></div>

</div>

<script>

 var base_url = "<?php echo base_url(); ?>";
 var app      =  "<?php echo $app; ?>";

$("#buscar").keyup(function ()
{
  
});

$("#divColorEditar #color").each(function (data)
{
  var editar = $(this).attr('class');

    $("."+editar).ColorPicker({
  
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

    var editar2 = editar.split('_');

    $(".editar_"+editar2[1]).val(rgb.r+","+rgb.g+","+rgb.b);

  }

  });
});

$("#color2").ColorPicker({
  
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
    $('#color2').val(rgb.r+","+rgb.g+","+rgb.b);
  }

  });


$("#exportar").click(function ()
{
  location.href=""+base_url+"export/create/"+app+"";
});

</script>