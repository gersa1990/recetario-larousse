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
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a class="active" href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>
      
    </div>
    
    <div class="columr">

      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a class="ventana button large orange" rel="leanModal" name="#ventana" href="#ventana" onclick="nuevoVideo();">Nuevo video</a>
        </div> 
  
        <table id="videos">
          <thead>
            <tr>
              <td colspan="3">Videos</td>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($videos))
                  {
                    for ($i=0; $i <count($videos) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <!-- <a href="" class="bluetext">
                             
                            </a> -->
                            <p> <?php echo $videos[$i]['titulo']; ?></p>
                          </td>

                          <td>
                            <a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="editarVideo(<?php print($videos[$i]['id']) ?>);">
                              Editar
                            </a>
                          </td>

                          <td>
                            <a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="eliminarVideo(<?php print($videos[$i]['id']) ?>);">
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php if(isset($videos))
                  {
                    for ($i=0; $i <count($videos) ; $i++) 
                      { ?>

                      <div id="eliminarVideo<?php echo $videos[$i]['id']; ?>" class="modalDialog">
                        <div class="popup form_delete">

                          <a href="#" title="Close" class="close">x</a>
                
                          <?php echo form_open("videos/delete/"); ?>
                            <h2>Video</h2>
                            <p class="mg-auto"><?php echo $videos[$i]['titulo']; ?></p>         
                            <input type="hidden" name="id" value="<?php echo $videos[$i]['id']; ?>">
                            <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                            <button type="submit" class="submit">Eliminar</button>
                          </form>
                        </div>
                      </div>
                      <?php } 
                    } ?>
        
      </div>
    </div>
  </div>

  <div class="clear"></div>

  <div id="lean_overlay"></div>

  <div id="ventana" class="chica">
      
  </div>

</div> <!-- Wrapper -->

<script>

  var app = "<?php echo $app; ?>"; //Numero de aplicación en la que te encuentras
  var base_url = "<?php echo base_url(); ?>";


  /* Agregar nuevo video */
  function nuevoVideo(){

    $.post( base_url+"videos/nuevoVideo/", {id_app: app} ,function(response) {  

      $('#ventana').html(response);

      $("#ventana #nombre").keyup(function (){

        var titulo = $("#nombre").val();
        
        console.log(titulo);

        $.post(base_url+"videos/checkExistence/", {palabra: titulo, id_app: app}, function (data){

          console.log(data);

          if(data.length==1){

            $("#ventana #status").slideDown("slow");
            $("#ventana #submitVideoNuevo").slideUp("slow");
          }
          else{

            $("#ventana #status").slideUp("slow");
            $("#ventana #submitVideoNuevo").slideDown("slow");
          }
        });
      });
    });
  }
  /* Termina agregar nuevo video */

  /* Editar video*/

 function editarVideo(id){

     $.post( base_url+"videos/editarVideo/", {id_video : id, id_app: app} ,function(response) {  

      $('#ventana').html(response);

      $("#ventana #nombre").keyup(function (){

        var titulo = $("#nombre").val();
        
        console.log(titulo);

        $.post(base_url+"videos/updateCheckExistence/", {video : id, nombre: titulo, id_app: app}, function (data){

          console.log(data);

          if(data.length==1){

            $("#ventana #status").slideDown("slow");
            $("#ventana #submitEditarVideo").slideUp("slow");
          }
          else{

            $("#ventana #status").slideUp("slow");
            $("#ventana #submitEditarVideo").slideDown("slow");
          }
        });
      });
    });
  }
  /* Termina editar video */

  /* Eliminar video */
  function eliminarVideo(id){

    $.post( base_url+"videos/eliminarVideo/", {id_video : id} ,function(response) {  

      $('#ventana').html(response);
    });
  }
  /*Termina eliminar video */

  $("#buscar").keyup(function (data)
  {
    var texto = $("#buscar").val();

    $.post(base_url+"videos/searchByName/" ,{nombre: texto, id_app: app}, function (data)
    {
      $("#videos tbody").html(data);

      $(function() {
        $('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '.modal_close' }); 
      });

    }); 
  });

</script>