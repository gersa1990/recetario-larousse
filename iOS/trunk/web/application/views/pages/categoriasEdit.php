
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
            <td colspan="2"><input type="submit" class="button mg1 bl1" value="+ Nueva categoria"></td>
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
                          <a href="<?php echo $categorias[$i]['id']; ?>" class="bluetext">
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
        
        <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Nunc tincidunt</a></li>
    <li><a href="#tabs-2">Proin dolor</a></li>
    <li><a href="#tabs-3">Aenean lacinia</a></li>
  </ul>
  <div id="tabs-1">
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
  </div>
  <div id="tabs-2">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
  </div>
  <div id="tabs-3">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
  </div>
      </div>
    
    </div>
  </div>
  <div class="clear"></div>
</div>
<script>
 var base_url = "<?php echo base_url(); ?>";
 var app      =  "<?php echo $app; ?>";

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