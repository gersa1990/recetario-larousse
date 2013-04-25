
<div class="wrapper">

  
  <input type="submit" id="exportar"  class="exportar" value="Exportar">

  <span class="uptext left">Aplicación:</span> <input type="text" name="nombreApp" id="nombreApp" class="input post left" value="<?php echo $apps['nombre']; ?>">
  <div class="status left spinner"></div>

  <div class="clear"></div>
  
  <nav id="menu">
    <ul>
      <li><a href="<?php echo base_url(); ?>apps/view/<?php echo $app; ?>" class="">Recetas</a></li>
      <li><a href="<?php echo base_url(); ?>glosario/view/<?php echo $app; ?>" class="">Glosarios</a></li>
      <li><a href="<?php echo base_url(); ?>videos/view/<?php echo $app; ?>" class="">Videos</a></li>
      <li><a href="<?php echo base_url(); ?>complementarias/view/<?php echo $app; ?>" class="">Recetas complementarias</a></li>
      <li  class="active"><a href="<?php echo base_url(); ?>categorias/view/<?php echo $app; ?>" class="">Categorias</a></li>
    </ul>
  </nav>

  <div class="main">
    <div class="columna">
  
      <table id="recetas" class="lista">
        <thead>
          <tr>
            <td colspan="2"><input id="nuevaCategoria" type="submit" class="button mg1 bl1" value="+ Nueva categoria"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="text" name="" id="buscar" class="input post buscar" placeholder="Buscar.." value="">
            <span class="postfix email">  </span></td>
          </tr>
        </thead>

        <tbody>
          <?php if(isset($categorias))
                {

                  for ($i=0; $i <count($categorias) ; $i++) 
                    { 
                      ?>

                    <tr>
                        <td class="txleft">
                          <a href="<?php echo base_url().'categorias/edit/'.$app.'/'.$categorias[$i]['id']; ?>" class="bluetext">
                            <?php echo $categorias[$i]['nombre']; ?>
                          </a>
                        </td>
                        <td>
                          <a href="#eliminarGlosario<?php echo $categorias[$i]['id']; ?>">Eliminar</a></td>
                    </tr>
                    <?php     
                    }   
                } ?>
        </tbody>
      </table>

      <?php
      if(isset($categorias))
      {
        

        for ($i=0; $i <count($categorias) ; $i++) 
        { 
          ?>
          <div id="eliminarGlosario<?php echo $categorias[$i]['id']; ?>" class="modalDialog">
                      <div>
                        <a href="#" title="Close" class="close">X</a>
                          
                          <?php echo form_open("categorias/eliminar/") ?>
                          <form method="post" action="<?php echo base_url(); ?>categorias/eliminar/">
        
                            <h2><?php echo $categorias[$i]['nombre']; ?></h2>
                            <p>Nota: Eliminará este video de forma definitiva.</p>
        
                            <input type="hidden" name="id_glosario"  id="id_glosario"  value="<?php echo $categorias[$i]['id']; ?>">
                            <input type="hidden" name="app" id="id" value="<?php echo $app; ?>">
          
                            <button type="submit" class="eliminarBoton">Eliminar</button>

                          </form>

                      </div>
                    </div>
          <?php
        }
      }
       ?>
      
      
    </div>
    
    <div class="columna">

      <div id="addblock">
        
        <div class="myform">

          <h2>Nueva categoria</h2>
        <p>Información de la categoria para las recetas.</p>
        <br>
          
            <?php echo validation_errors(); ?>
            <?php echo form_open('videos/create/'.$app) ?>
            
            
            
            <label for="nombre" class="fixh1">Nombre</label>
            <input type="text" name="nombre" id="nombre" />
            
            <br>

            <input type="hidden" name="app" value="<?php echo $app; ?>"> 

            <label for="color" class="fixh2">Color</label>
            <input type="text" name="color" id="color">

            <br><br>
            
            <button type="submit" class="button bl2">Guardar</button>

          </form>
        </div>
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