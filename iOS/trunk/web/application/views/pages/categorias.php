
<div class="wrapper">

  <div class="main">
    <div id="status"><div class="alert alert-succes">Nuevo orden de categorias guardado</div></div>

    <div class="columl">
      <!-- <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a> -->

      <h2 class="myriadFont title_app"><?php echo $name[0]['nombre']; ?></h2>

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
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." style="display:none" value="">
          <a href="#nuevaCategoria" class="button large orange">Nueva categoría</a>
        </div> 
  
        <table id="categorias">
          <thead>
            <tr>
              <td colspan="3">Categorías</td>
            </tr>
          </thead>
        </table>

          <ul id="sortable">
            <?php 
              if(isset($categorias)){
                for ($i=0; $i <count($categorias) ; $i++) { ?>
                  <li id="<?php echo $categorias[$i]['id']; ?>">
                        <!-- <a href="" class="bluetext">
                          
                        </a> -->
                        <span><?php echo $categorias[$i]['nombre']; ?></span>

                      <span>
                        <a href="#editarCategoria<?php echo $categorias[$i]['id']; ?>">
                          Editar
                        </a>
                      </span>

                      <span>
                        <a href="#eliminarCategoria<?php echo $categorias[$i]['id']; ?>" class='eliminarRecetas'>
                          Eliminar
                        </a>
                      </span>

                  </li>

                <?php     
                }   
              } ?>
        </ul>

        <?php if(isset($categorias)){
          for ($i=0; $i <count($categorias) ; $i++) { ?>

            <div id="eliminarCategoria<?php echo $categorias[$i]['id']; ?>" class="modalDialog">
              <div class="popup form_delete">

                <a href="#" title="Close" class="close">x</a>
      
                <?php echo form_open("categorias/delete/"); ?>
                  <h2>Categoría</h2>
                  <p class="mg-auto"><?php echo $categorias[$i]['nombre']; ?></p>         
                  <input type="hidden" name="id" value="<?php echo $categorias[$i]['id']; ?>">
                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  <button type="submit" class="submit">Eliminar</button>
                </form>
              </div>
            </div>

            <div id="editarCategoria<?php echo $categorias[$i]['id']; ?>" class="modalDialog editarCategoria">
              <div class="popup form_categoria">
                <a href="#" title="Close" class="close">x</a>
                
                <?php echo form_open("categorias/edit/"); ?>
                  <h2 class="mg_20 myriadFont">Editar categoría</h2>

                  <input type="hidden" name="id_categoria" id="id_categoria" value="<?php echo $categorias[$i]['id']; ?>">

                  <div class="centrar">
                    <label for="">Nombre: </label>
                    <input type="text" id="nombreEditar" name="nombre" value="<?php echo $categorias[$i]['nombre']; ?>" required>
                    <div class="alert error" id="updateCategoria" style="display:none;">Este nombre de categoria ya existe</div>
                  
                    <div id="divColorEditar">
                      <label for="">Color:</label>
                      <div id="editar">
                        <input type="hidden" id="nameColor" class="<?php echo $categorias[$i]['id']; ?>" value="<?php echo $categorias[$i]['id']; ?>" >
                        <input type="text" name="color" id="color" class="editar_<?php echo $categorias[$i]['id']; ?>" value="<?php echo $categorias[$i]['color']; ?>" required>
                      </div>
                    </div>
                    <div class="clear"></div>
                  </div>

                  
                  
                  <input type="hidden" name="id" value="<?php echo $categorias[$i]['id']; ?>">
                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                  <button type="submit" class="submit" id="submitUpdateCategoria">Guardar</button>
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
                  <h2 class="mg_20 myriadFont">Nueva categoría</h2>


                  <div class="centrar">
                    <label for="">Nombre: </label>
                    <input type="text" id="nombre" name="nombre" value="" placeholder="nombre" required>
                    
                    <div class="alert error" id="errorNuevaCategoria" style="display:none;">
                      Este nombre de categoria ya existe.
                    </div>
                  
                  
                    <div id="divColorEditar">
                      <label for="">Color:</label>
                      <div id="editar">
                        <input type="text" name="color" id="color2" value="" placeholder="rgb(0, 0, 0)" required>
                        <!-- <span id="preview" class="left"></span> -->
                      </div>
                    </div>
                    <div class="clear"></div>
                  </div>

                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                  <button type="submit" id="submitNuevaCategoria" class="submit">Guardar</button>
                </form>
              
              </div>
            </div>

<div class="clear"></div>

</div>

<script>

$("#sortable").sortable({
      revert: true,
      placeholder: "ui-state-highlight",
      
      stop: function (){
        $("#sortable li").each(function (data)
        {
          var id = $(this).attr('id');
          var orden = data+1;
          //console.log("Guardando indice: "+id+" en orden: "+orden);

          $.post(base_url+"categorias/updateOrden/", {id_categoria : id, orden_categoria : orden}, function (data)
          {
              console.log(data);
          });
        });
        
        $("#status").slideDown("slow");

        setTimeout(
          function(){
            $("#status").slideUp("slow");
          },3000);
      }

  });

 var base_url = "<?php echo base_url(); ?>";
 var app      =  "<?php echo $app; ?>";

$("#buscar").keyup(function ()
{
    var palabra = $("#buscar").val();
    console.log(palabra);

    $.post(base_url+"categorias/searchByTitulo/", {titulo: palabra, id_app: app} , function (data)
    {
        $("#categorias tbody").html(data);
        console.log(data);
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

$("#nuevaCategoria #nombre").keyup(function ()
{
    var tittle = $("#nuevaCategoria #nombre").val();
    //console.log(tittle);

    $.post(base_url+"categorias/checkExistence/", {titulo:tittle, id_app: app }, function (datos)
    {
        if (datos=="Existe") 
        {
          $("#errorNuevaCategoria").slideDown("slow");
          $("#submitNuevaCategoria").slideUp("slow");
        }
        else
        {
          $("#errorNuevaCategoria").slideUp("slow");
          $("#submitNuevaCategoria").slideDown("slow"); 
        }

    });
});

$(".editarCategoria").each(function (data)
{
  var id            = $(this).attr('id');

  $("#"+id+" #nombreEditar").keyup(function ()
  {
    var nombre = $("#"+id+" #nombreEditar").val();
    var id_categoria  = $("#"+id+" #id_categoria").val();
    //console.log(id_categoria);

    $.post(base_url+"categorias/updateCheckExistence/", {titulo: nombre, id_app:app, id_cat:id_categoria }, function (data)
    {
        if(data=="Existe")
        {
          $("#"+id+" #updateCategoria").slideDown("slow");
          $("#"+id+" #submitUpdateCategoria").slideUp("slow");
        }
        else
        {
          $("#"+id+" #updateCategoria").slideUp("slow");
          $("#"+id+" #submitUpdateCategoria").slideDown("slow");
        }
    });

  });
});

</script>