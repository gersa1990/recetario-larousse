
<div class="wrapper">

  <div class="main">
    <div id="status"></div>


    <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a>

    <div class="columl">
       <h2 class="myriadFont title_app"><?php echo $name[0]['nombre']; ?></h2>

      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a class="active" href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
    </div>
    
    <div class="columr">
      <div id="addblock">
        
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a class="ventana button large orange" rel="leanModal" name="#ventana" href="#ventana" onclick="nuevoGlosario(<?php echo $app;?>);">Nuevo término</a>
        </div> 
  
        <table id="glosario">
          <thead>
            <tr>
              <td colspan="3">Glosario</td>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($glosario))
                  {
                    for ($i=0; $i <count($glosario) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <p><?php echo $glosario[$i]['nombre']; ?></p>
                          </td>

                          <td>
                            <a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="editarGlosario(<?php echo $glosario[$i]['id']; ?>);">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a class="ventana2" rel="leanModal" name="#ventana2" href="#ventana2" onclick="eliminarGlosario(<?php echo $glosario[$i]['id']; ?>);">
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>        
      </div>
    </div>

  </div>

  <div class="clear"></div>

  <div id="lean_overlay"></div>

  <div id="ventana" class="form_receta">
      
  </div>

  <div id="ventana2" class="chica">
      
  </div>

</div> <!-- Wrapper -->

<script>

  var app = "<?php echo $app; ?>";
  var base_url = "<?php echo base_url(); ?>";

  $(".ventana").click(function(data){
    return false;
  });

  $(function() {
    $('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '.modal_close' }); 
  });


  //Nuevo glosario
  function nuevoGlosario(id){
    $.post( base_url+"glosario/nuevoGlosario/"+id, function(response) {  

      $('#ventana').html(response);

      tinymce.init({
          selector: "#ventana textarea",
          width: 950,
          height: 200,
          menubar: false
        });

      $("#ventana #nombre").keyup(function (){

        var titulo = $("#nombre").val();
        
        console.log(titulo);

        $.post(base_url+"glosario/checkExistence/", {palabra: titulo, id_app: app}, function (data){

          console.log(data);

          if(data.length==1){

            $("#ventana #status").slideDown("slow");
            $("#ventana #submitGlosarioNuevo").slideUp("slow");
          }
          else{

            $("#ventana #status").slideUp("slow");
            $("#ventana #submitGlosarioNuevo").slideDown("slow");
          }
        });
      });
    });
  }

  //Editar glosario
  function editarGlosario(id){

    $.post(base_url+"glosario/editarGlosario/", {id_glosario: id, id_app : app}, function (data)
    {
        $('#ventana').html(data);

        tinymce.init({
          selector: "#ventana textarea",
          width: 950,
          height: 200,
          menubar: false
        });

        $("#ventana #nombre").keyup(function ()
        {
        
          var titulo      = $("#nombre").val();
          var id_glosario = $("#id").val();

          $.post(base_url+"glosario/updateCheckExistence/", {nombre:titulo, glosario: id_glosario, id_app:app}, function (data)
          {
           
            if(data.length==1){
        
              $("#ventana #submitEditarGlosario").slideUp("slow");
              $("#ventana #status").slideDown("slow");
            } 
            else{

              $("#ventana #submitEditarGlosario").slideDown("slow");
              $("#ventana #status").slideUp("slow");
            }
          });
        });
    });
  }

  function eliminarGlosario(id){

    $.post(base_url+"glosario/eliminarGlosario/", {id_glosario: id}, function (data)
    {
      $('#ventana2').html(data);
    });
  }

  $("#exportar").click(function ()
  {
      location.href=base_url+"export/create/"+app;
  });


  $("#buscar").keyup(function (data)
  {
    var texto = $("#buscar").val();

    $.post(base_url+"glosario/searchByName/" ,{palabra: texto, id_app: app}, function (data)
    {
        $("#glosario tbody").html(data);

          $("#glosario tbody tr td a").click(function(data){
            return false;
          });

          $(function() {
            $('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '.modal_close' }); 
          });
    }); 
  
  });

tinymce.init({
  selector: "#nuevoGlosario textarea",
  width: 950,
  height: 200,
  menubar: false,
  convert_newlines_to_brs : false
});


</script>





