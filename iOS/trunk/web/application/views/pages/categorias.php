
<div class="wrapper">

  <div class="main">
    <div id="status"></div>

    <div class="columl">
      <a href="<?php echo base_url() ?>" class="button orange large"><span>←</span> Regresar</a>

      <h1>Menú</h1>
      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a class="active" href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" class="">Recetas complementarias</a></li>
        </ul>
      </nav>

    </div>
    
    <div class="columr">
      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a href="#nuevaCategoria" class="button large blue">Nueva</a>
        </div> 
  
        <table id="categorias">
          <thead>
            <tr>
              <td colspan="2">Categorías</td>
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
      
                <?php echo form_open("categorias/delete/"); ?>
                  <h2>Categoria</h2>
                  <p class="mg-auto"><?php echo $categorias[$i]['nombre']; ?></p>         
                  <input type="hidden" name="id" value="<?php echo $categorias[$i]['id']; ?>">
                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  <button type="submit" class="submit">Eliminar</button>
                </form>
              </div>
            </div>

            <div id="editarCategoria<?php echo $categorias[$i]['id']; ?>" class="modalDialog">
              <div class="popup form_categoria">
                <a href="#" title="Close" class="close">x</a>
                
                <?php echo form_open("categorias/edit/"); ?>
                  <h2 class="mg_20">Información</h2>

                  <div class="centrar">
                    <label for="">Nombre: </label>
                    <input type="text" name="nombre" value="<?php echo $categorias[$i]['nombre']; ?>">
                  
                  
                    <div id="divColorEditar">
                      <label for="">Color:</label>
                      <div id="editar">
                        <input type="hidden" id="nameColor" class="<?php echo $categorias[$i]['id']; ?>" value="<?php echo $categorias[$i]['id']; ?>" >
                        <input type="text" name="color" id="color" class="editar_<?php echo $categorias[$i]['id']; ?>" value="<?php echo $categorias[$i]['color']; ?>">
                        <span id="preview" class="left"></span>
                      </div>
                    </div>
                    <div class="clear"></div>
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

              <div class="popup form_categoria">
                <a href="#" title="Close" class="close">x</a>
                
                <?php echo form_open("categorias/create/"); ?>
                  <h2 class="mg_20">Información</h2>


                  <div class="centrar">
                    <label for="">Nombre: </label>
                    <input type="text" name="nombre" value="">
                  
                  
                    <div id="divColorEditar">
                      <label for="">Color:</label>
                      <div id="editar">
                        <input type="text" name="color" id="color2" value="">
                        <span id="preview" class="left"></span>
                      </div>
                    </div>
                    <div class="clear"></div>
                  </div>

                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                  <button type="submit" class="submit">Guardar</button>
                </form>
              
              </div>
            </div>

<div class="clear"></div>

</div>

<script>

 var base_url = "<?php echo base_url(); ?>";
 var app      =  "<?php echo $app; ?>";

$("#buscar").keyup(function ()
{
    var palabra = $("#buscar").val();

    $.post(base_url+"categorias/searchByTitulo/", {titulo: palabra, id_app: app} , function (data)
    {
        $(".blockscroll").html(data);
    });

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