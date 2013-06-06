
<div class="wrapper">
  <div class="main fix_top">
    <a class="ventana button large orange al_right" rel="leanModal" name="#ventana" href="#ventana" onclick="nuevaApp();">Nueva aplicación</a>
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

</div>
<script>

var base_url = "<?php echo base_url(); ?>";

$(".ventana").click(function(data){
  return false;
});

function nuevaApp(){
  $.post( base_url+"apps/nuevaApp/", function(response) {  
    //console.log(response);
    $('#ventana').html(response);

    $("#nombre").keyup(function (){

      var token = $("#nombre").val();

      //console.log(token);

      $.post(base_url+"apps/checkExistence/", {palabra: token}, function (data){
        
        console.log(data.length);

        if(data.length==1){

          $("#status").slideDown("slow");
          $("#submitNuevaApp").slideUp("slow");
        }
        else{

          $("#status").slideUp("slow"); 
          $("#submitNuevaApp").slideDown("slow");
        }
      });
    });
  });
}

function buscarApp(id){

  $.post( base_url+"apps/getApp/"+id, function(response) { 

    $('#ventana').html(response);
    
    var id_ap = $("#id_app").val();

    $("#nombre2").keyup(function (){

      var word  = $("#nombre2").val();

      $.post(base_url+"apps/updateCheckExistence/", {palabra: word, id_app: id_ap}, function (data){

        if(data.length==1){

          $("#status").slideDown("slow");
          $("#errorEditarApp").slideDown("slow");
          $("#submitEditarApp").slideUp("slow");
        }
        else{

          $("#errorEditarApp").slideUp("slow");
          $("#submitEditarApp").slideDown("slow");
        }
      });
    });
  });
}

function eliminarApp(id){
  $.post( base_url+"apps/getAppDelete/"+id, function(response){
    $('#ventana').html(response);
  });
}

function myClose(){
  $('#lean_overlay').click();
}



</script>
