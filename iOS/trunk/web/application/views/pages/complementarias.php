
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
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosarios</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a class="active" href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
      
    </div>
    
    <div class="columr">

      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a class="ventana button large orange" rel="leanModal" name="#ventana" href="#ventana" onclick="nuevaReceta(<?php echo $app;?>);">Nueva receta</a>
        </div> 
  
        <table id="recetas_complementarias">
          <thead>
            <tr>
              <td colspan="3">Recetas complementarias</td>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($recetas_complementarias))
                  {
                    for ($i=0; $i <count($recetas_complementarias) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <!-- <a href="<?php echo base_url().'recetas_complementarias/view/'.$recetas_complementarias[$i]['id']; ?>" class="bluetext"> -->
                              <!--  -->
                            <!-- </a> -->
                            <p><?php echo $recetas_complementarias[$i]['titulo']; ?></p>
                          </td>

                          <td>
                            <a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="editarRecetas(<?php echo $recetas_complementarias[$i]['id']; ?>);">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a class="ventana2" rel="leanModal" name="#ventana2" href="#ventana2" onclick="eliminarRecetas(<?php echo $recetas_complementarias[$i]['id']; ?>);">
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

   <div id="ventana" class="form_receta"></div>

  <div id="ventana2" class="chica"></div>

</div> <!-- Wrapper -->

<script>

  var app = "<?php echo $app; ?>";
  var base_url = "<?php echo base_url(); ?>";


  $("#buscar").keyup(function (data)
  {
    var texto = $("#buscar").val();

    $.post(base_url+"complementarias/searchByName/" ,{palabra: texto, id_app: app}, function (data)
    {
      $("#recetas_complementarias tbody").html(data);
      
      $(function() {
        $('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '.modal_close' }); 
      });
    }); 
  });

  /* Nueva receta */

  function nuevaReceta(){

    $.post(base_url+"complementarias/nuevaReceta/", {id_app : app}, function (data)
    {
        $("#ventana").html(data);

        tinymce.init({
          selector: "#ventana textarea",
          width: 950,
          height: 200,
          menubar: false
        });

        $("#ventana #nombre").keyup(function (){

          var titulo = $("#ventana #nombre").val();

          console.log(titulo);
      
          $.post(base_url+"complementarias/checkExistence/", {palabra: titulo, id_app: app}, function (data)
          {
            if(data.length==1){

              $("#ventana #status").slideDown("slow");
              $("#ventana #submitComplementariaNueva").slideUp("slow");
            }
            else{

              $("#ventana #status").slideUp("slow");
              $("#ventana #submitComplementariaNueva").slideDown("slow");
            }
          });
        });
    });
  }
  /* termina nueva receta */

  /* Editar recetas */
  function editarRecetas(id){

    $.post(base_url+"complementarias/editarRecetas/", {id_receta: id, id_app : app}, function (data)
    {
        $("#ventana").html(data);

        tinymce.init({
          selector: "#ventana textarea",
          width: 950,
          height: 200,
          menubar: false
        });

        $("#ventana #nombre").keyup(function (){

          var titulo = $("#ventana #nombre").val();

          console.log(titulo);
      
          $.post(base_url+"complementarias/updateCheckExistence/", {complementaria: id, nombre: titulo, id_app: app}, function (data){

            if(data.length==1){

              $("#ventana #status").slideDown("slow");
              $("#ventana #submitEditarComplementaria").slideUp("slow");
            }
            else{

              $("#ventana #status").slideUp("slow");
              $("#ventana #submitEditarComplementaria").slideDown("slow");
            }
          });
        });
    });

  }
  /* Termina editar recetas */

  /* Eliminar recetas */
  function eliminarRecetas(id){

    $.post(base_url+"complementarias/eliminarRecetas/", {id_receta: id, id_app : app}, function (data){

        $("#ventana2").html(data);
    });

  }
  /* Termina eliminar recetas */



$(".editarComplementaria").each(function ()
{
  var id = $(this).attr('id');
  //console.log(id);

  $("#"+id+" #titulo").keyup(function ()
  {
    var titulo            = $("#"+id+" #titulo").val();
    var id_complementaria = $("#"+id+" #id_complementaria").val();

    $.post(base_url+"complementarias/updateCheckExistence/", {nombre:titulo, complementaria:id_complementaria, id_app:app}, function (data)
    {
      console.log(data);

      if(data=="Existe")
      {
          $("#"+id+" #updateComplementaria").slideDown("slow");
          $("#"+id+" #submitUpdateComplementaria").slideUp("slow");
      } 
      else
      {
          $("#"+id+" #updateComplementaria").slideUp("slow");
          $("#"+id+" #submitUpdateComplementaria").slideDown("slow");
      }
    });

  });

});

</script>