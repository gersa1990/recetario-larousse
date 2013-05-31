
<div class="wrapper">
  <div class="main fix_top">
    <a class="ventana button large orange al_right" rel="leanModal" name="#ventana" href="#ventana" onclick="nuevaApp();">Nueva Aplicación</a>
    <h2 class="myriadFont mg_top">APLICACIONES DE EDITORIAL LAROUSSE</h2>
    <table class="tablew">
      <thead>
        <tr>
          <th>Nombre</th>
          <th colspan="5">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if(isset($apps)){
          for ($i=0; $i <count($apps) ; $i++) {  
        ?>
            <tr>
              <td><a href="<?php base_url(); ?>apps/view/<?php echo $apps[$i]['id']; ?>" class="bluetext"><?php echo $apps[$i]['nombre']; ?></a></td>
              <td><a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="buscarApp(<?php echo $apps[$i]['id']?>);">Editar</a></td>
              <td><a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="eliminarApp(<?php echo $apps[$i]['id'] ?>);">Eliminar</a></td>
              <td><a href="<?php base_url(); ?>export/create/<?php echo $apps[$i]['id']; ?>">Exportar</a></td>
            </tr>
        <?php   
          }
        } 
        ?>
        </tbody>
    </table>
  </div>

  <div class="clear"></div>

  <div id="lean_overlay"></div>

  <div id="ventana" class="chica">
      
  </div>

</div>
<script>

var base_url = "<?php echo base_url(); ?>";

$(".ventana").click(function(data){
  return false;
});

$(function() {
  $('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '.modal_close' }); 
});


function nuevaApp(){
  $.post( base_url+"apps/nuevaApp/", function(response) {  
    console.log(response);
    $('#ventana').html(response);
  });
}

function buscarApp(id){
  $.post( base_url+"apps/getApp/"+id, function(response) {  
    console.log(response);
    $('#ventana').html(response);
  });
}

function eliminarApp(id){
  $.post( base_url+"apps/getAppDelete/"+id, function(response) {  
    console.log(response);
    $('#ventana').html(response);
  });
}



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
