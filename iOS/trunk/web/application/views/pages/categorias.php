
<div class="wrapper">

  
  <input type="submit" id="exportar"  class="exportar" value="Exportar">

  <span class="uptext left">Aplicación:</span> <input type="text" name="nombreApp" id="nombreApp" class="input post left" value="<?php echo $apps['nombre']; ?>">
  <div class="status left spinner"></div>

  <div class="clear"></div>
  
  <nav id="menu">
    <ul>
      <li><a href="<?php echo base_url(); ?>apps/view/<?php echo $app; ?>" class="">Recetas</a></li>
      <li class="active"><a href="<?php echo base_url(); ?>glosario/view/<?php echo $app; ?>" class="">Glosarios</a></li>
      <li><a href="<?php echo base_url(); ?>videos/view/<?php echo $app; ?>" class="">Videos</a></li>
      <li><a href="<?php echo base_url(); ?>complementarias/view/<?php echo $app; ?>" class="">Recetas complementarias</a></li>
      <li><a href="<?php echo base_url(); ?>categorias/view/<?php echo $app; ?>" class="">Categorias</a></li>
    </ul>
  </nav>

  <div class="main">
    <div class="columna">
  
      <table id="recetas" class="lista">
        <thead>
          <tr>
            <td colspan="2"><input type="submit" class="button mg1 bl1" value="+ Nuevo glosario"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="text" name="" id="buscar" class="input post buscar" placeholder="Buscar.." value="">
            <span class="postfix email">  </span></td>
          </tr>
        </thead>

        <tbody>
          <?php if(isset($videos))
                {
                  for ($i=0; $i <count($videos) ; $i++) 
                    { 
                      ?>

                    <tr>
                        <td class="txleft">
                          <a href="<?php echo $videos[$i]['id']; ?>" class="bluetext">
                            <?php echo $videos[$i]['video']; ?>
                          </a>
                        </td>
                        <td>
                          <a href="#eliminarGlosario<?php echo $videos[$i]['id']; ?>">Eliminar</a></td>
                    </tr>
                    <?php     
                    }   
                } ?>
        </tbody>
      </table>

      <?php
      if(isset($videos))
      {
        

        for ($i=0; $i <count($videos) ; $i++) 
        { 
          ?>
          <div id="eliminarGlosario<?php echo $videos[$i]['id']; ?>" class="modalDialog">
                      <div>
                        <a href="#" title="Close" class="close">X</a>
                          
                          <?php echo form_open("videos/eliminar/") ?>
                          <form method="post" action="<?php echo base_url(); ?>videos/eliminar/">
        
                            <h2><?php echo $videos[$i]['video']; ?></h2>
                            <p>Nota: Eliminará este video de forma definitiva.</p>
        
                            <input type="hidden" name="id_glosario"  id="id_glosario"  value="<?php echo $videos[$i]['id']; ?>">
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

          <h2>Nuevo video</h2>
        <p>Información del video</p>
        <br>
          
            <?php echo validation_errors(); ?>
            <?php echo form_open('videos/create/'.$app) ?>
            
            
            
            <label for="nombre" class="fixh1">Nombre</label>
            <input type="text" name="nombre" id="nombre" />
            
            <br>

            <input type="hidden" name="app" value="<?php echo $app; ?>"> 

            <label for="categoria" class="fixh2">Descripcion</label>
            <textarea type="text" name="descripcion"></textarea>

            <br>
            
            
            
            <label for="proce" class="fixmargin">Imagen <span class="small">Nombre del archivo de imagen</span></label>
            <input name="imagen" title="imagen" rows="4" cols="46">

           
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


$("#exportar").click(function ()
{
  location.href=""+base_url+"export/create/"+app+"";
});

</script>