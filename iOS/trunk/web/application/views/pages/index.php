
<div class="wrapper">

  <div id="nuevaApp" class="modalDialog" style="z-index:1">
    <div class="popup">
      <a href="#" title="Close" class="close">x</a>
      <?php echo validation_errors(); ?>
      <?php echo form_open('apps/nueva/') ?>
        <h2 class="mg_20">Nueva aplicación</h2>
        <div class="centrar">
          <label for="">Nombre: </label>
          <input type="text" name="nombre" id="nombre" value="" required>
          <div id="errorNuevaApp" class="alert error" style="display:none">Este nombre de app ya existe.</div>
        </div>
        <br>  
        <button id="submitNuevaApp" type="submit" class="submit">Agregar</button>
      </form>
    </div>
  </div>
  
  <div class="main fix_top">
    
      <a href="#nuevaApp" class="button large orange al_right">Nueva Aplicación</a>
      <h2 class="myriadFont mg_top">APLICACIONES DE EDITORIAL LAROUSSE</h2>
      <table class="tablew">
        <thead>
          <tr>
            <th>Nombre</th>
            <th colspan="5">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if(isset($apps))
                {
                  for ($i=0; $i <count($apps) ; $i++) 
                    {  
                      ?>

                    <tr>
                      <td><a href="<?php base_url(); ?>apps/view/<?php echo $apps[$i]['id']; ?>" class="bluetext"><?php echo $apps[$i]['nombre']; ?></a></td>
                      <td><a href="#editar<?php echo $apps[$i]['id'] ?>">Editar</a></td>
                      <td><a href="#eliminar<?php echo $apps[$i]['id'] ?>">Eliminar</a></td>
                      <td><a href="<?php base_url(); ?>export/create/<?php echo $apps[$i]['id']; ?>">Exportar</a></td>
                    </tr>
                     
                      <div id="eliminar<?php echo $apps[$i]['id'] ?>" class="modalDialog">
                        <div>
                          <a href="#" title="Close" class="close">x</a>
                            <?php echo validation_errors(); ?>
                            <?php echo form_open('apps/eliminar') ?>
                              <div class="centrar">
                                <h2><?php echo $apps[$i]['nombre'] ?><br/></h2>
                                <p>Toda la información relacionada se borrara</p>
                              </div>
          
                              <input type="hidden" name="id" id="id"  value="<?php echo $apps[$i]['id']; ?>"/>
            
                              <button type="submit" class="eliminarBoton">Eliminar</button>
                            </form>
                        </div>
                      </div>

                      <div id="editar<?php echo $apps[$i]['id']; ?>" class="modalDialog editar">
                        <div class="popup form_app">
                          <a href="#" title="Close" class="close">x</a>
                          
                          <?php echo form_open("apps/edit/"); ?>
                            <h2 class="mg_20">Editar</h2>
                            
                            <div class="centrar">
                              <label for="">Nombre: </label>
                              <input type="text" id="nombre2" name="nombre" value="<?php echo $apps[$i]['nombre']; ?>" required>
                              <div id="errorEditarApp" class="alert error" style="display:none">Este nombre de aplicación ya existe</div>
                            </div>
                  
                            <input type="hidden" name="id_app" id="id_app" value="<?php echo $apps[$i]['id']; ?>">
                            <button type="submit" id="submitEditarApp" class="submit">Guardar</button>
                          </form>
                        
                        </div>
                      </div>

          <?php     }
                } 
          ?>
        </tbody>
      </table>
  </div>

  <div class="clear"></div>

</div>
<script>

var base_url = "<?php echo base_url() ?>";


$("#nombre").keyup(function ()
{
    var token = $("#nombre").val();
    //console.log(token);

    $.post(base_url+"apps/checkExistence/", {palabra: token}, function (data)
      {

        if(data=="Existe")
        {
          $("#errorNuevaApp").slideDown("slow");
          $("#submitNuevaApp").slideUp("slow");
        }
        else
        {
          $("#errorNuevaApp").slideUp("slow"); 
          $("#submitNuevaApp").slideDown("slow");
        }

      });
});

$(".editar").each(function (data)
  {
    var id = $(this).attr('id');

    $("#"+id+" #nombre2").keyup(function ()
      {
        var word  = $("#"+id+" #nombre2").val();
        var id_ap = $("#"+id+" #id_app").val();

        $.post(base_url+"apps/updateCheckExistence/", {palabra: word, id_app: id_ap}, function (data)
          {
            if(data=="Existe")
            {
              $("#"+id+" #errorEditarApp").slideDown("slow");
              $("#"+id+" #submitEditarApp").slideUp("slow");
            }
            else
            {
              $("#"+id+" #errorEditarApp").slideUp("slow");
              $("#"+id+" #submitEditarApp").slideDown("slow");
            }

          });
      });
  });
</script>
