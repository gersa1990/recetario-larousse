<div class="wrapper">

    <a href="<?php echo base_url(); ?>" class="home">Home</a>

    <h2 class="centrado">Categorías</h2>

     <div id="nueva" class="modalDialog">
        <div>
          <a href="#" title="Close" class="close">X</a>
          <?php echo validation_errors(); ?>
          <?php echo form_open('categorias/create') ?>
            <h2>Nueva categoría.</h2>
            <label class="dialogL">Nombre: </label>
            <input type="text" name="nombre" id="nombre" />

            <br>

            <label class="dialogL">Color: </label>
            <input type="text" name="color" id="color" readonly value="" style="border:none;" />

            <div id="colorSelector" style="width:40px; height:40px;">
              <div style="background-color: rgb(224, 101, 126); width:40px; height:40px;"></div>
            </div>
            <script>
              $('#colorSelector').ColorPicker(
                {
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
                    console.log(rgb);
                    $('#colorSelector div').css('backgroundColor', '#' + hex);
                    $("#nueva div form #color").val(rgb.r+"."+rgb.g+"."+rgb.b);
                  }
                });
            </script>
            <br>

            <button type="submit" class="eliminarBoton">Agregar</button>
          </form>
        </div>
    </div>

	<table class="listaCategorias">
      	<tr>
        	<th>Nombre</th>
        	<th>Color</th>
        	<th></th>
        	<th></th>
      	</tr>

        <script>
        var id=0;
        </script>

       

      	<?php foreach ($categorias as $c_item): ?>
      	<tr>
        	<td><?php echo $c_item['nombre'] ?></td>
        	<td><?php echo $c_item['color'] ?>
          </td>
        	<td><a href="#editar<?php echo $c_item['id'] ?>">Editar</a></td>
        	<td><a href="#eliminar<?php echo $c_item['id'] ?>">Eliminar</a></td>
      	</tr>

        <div id="editar<?php echo $c_item['id'] ?>" class="modalDialog">
          <div>
            <a href="#" title="Close" class="close">X</a>
            <?php echo validation_errors(); ?>
            <?php echo form_open('categorias/modificar') ?>
              
              <h2>Editar Aplicación.</h2>

              <input type="hidden" name="id" id="id"  value="<?php echo $c_item['id'] ?>"/>
              
              <label class="dialogL">Nombre: </label>
              <input type="text" name="nombre" id="nombre" value="<?php echo $c_item['nombre'] ?>"/>

              <br><br>

              <label class="dialogL">Color: </label>
              <input style="border:none;" type="text" name="color" id="color_<?php  echo $c_item['id']; ?>" value="<?php echo $c_item['color'] ?>" readonly/>

              <div class="selectorEditar" id="colorSelectorEditar_<?php echo $c_item['id']; ?>" style="width:40px; height:40px;">
                <input id="number" type="hidden" value="<?php  echo $c_item['id']; ?>">
                <div id="backgroundDiv_<?php  echo $c_item['id']; ?>" style="background-color: rgb(224, 101, 126); width:40px; height:40px;"></div>
              </div>
              <script>
              var i = "<?php echo $c_item['id']; ?>";
              
              $(".selectorEditar").click(function (data)
                {
                  console.log("CLIK 2");
                  var a = $("#number",this).val();
                  id = a;
                  console.log(a);
                });


              $('#colorSelectorEditar_'+i).ColorPicker(
                {
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
                    console.log("ID: "+id);

                    var color = rgb.r+"."+rgb.g+"."+rgb.b+"";
                    
                    $('#backgroundDiv_'+id).css('backgroundColor', '#' + hex);
                    
                    $("#color_"+id).val(rgb.r+"."+rgb.g+"."+rgb.b);
                  }

                });
              </script>

              <button type="submit" class="eliminarBoton">Guardar</button>
            </form>
          </div>
      </div>
		
		    <div id="eliminar<?php echo $c_item['id'] ?>" class="modalDialog">
          <div>
            <a href="#" title="Close" class="close">X</a>
            <h2>Eliminar: <?php echo $c_item['nombre'] ?></h2> 
            <p>¿Estas seguro de eliminar este elemento?.</p>
            <a href="<?php echo base_url()?>categorias/eliminar/<?php echo $c_item['id'] ?>" class="eliminarBoton">Eliminar</a>
            <a href="#" class="eliminarBoton">Cancelar</a>
          </div>
        </div>

       

      	<?php endforeach ?>
    </table>

   



    <a href="#nueva" class="button blue">Nueva</a>

   

</div>
