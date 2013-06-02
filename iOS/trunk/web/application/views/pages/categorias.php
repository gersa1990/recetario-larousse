
<div class="wrapper">

  <div class="main">
    <div id="status"><div class="alert alert-succes">Nuevo orden de categorias guardado</div></div>

    <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a>

    <div class="columl">

      <!-- <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a> -->


      <h2 class="myriadFont title_app"><?php echo $name[0]['nombre']; ?></h2>

      <nav id="menu">
        <ul>
          <li><a href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a class="active" href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" class="">Recetas complementarias</a></li>
        </ul>
      </nav>

    </div>
    
    <div class="columr">
      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." style="display:none" value="">
          <a class="ventana button large orange" rel="leanModal" name="#ventana" href="#ventana" onclick="nuevaCategoria();">Nueva categoría</a>
        </div> 
  
        <table id="categorias">
          <thead>
            <tr>
              <td colspan="3">Categorías</td>
            </tr>
          </thead>
        </table>

          <ul id="sortable">
            <?php 
              if(isset($categorias)){
                for ($i=0; $i <count($categorias) ; $i++) { ?>
                  <li id="<?php echo $categorias[$i]['id']; ?>">
                        <!-- <a href="" class="bluetext">
                          
                        </a> -->
                        <span><?php echo $categorias[$i]['nombre']; ?></span>

                      <span>
                        <a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="editarCategoria(<?php echo $categorias[$i]['id']; ?>);">
                          Editar
                        </a>
                      </span>

                      <span>
                        <a class="ventana" rel="leanModal" name="#ventana" href="#ventana" onclick="eliminarCategoria(<?php echo $categorias[$i]['id']; ?>);">
                          Eliminar
                        </a>
                      </span>

                  </li>

                <?php     
                }   
              } ?>
        </ul>        
      </div>
    </div>

  </div>

<div class="clear"></div>

<div id="lean_overlay"></div>

<div id="ventana" class="chica">Hola</div>


</div>
<script>

/* Nueva categoria */
function nuevaCategoria(){

  $.post(base_url+"categorias/nuevaCategoria/", {id_app : app}, function (data){

      $("#ventana").html(data);

      /*Checar que no existan repetidos los nombres*/
      $("#ventana #nombre").keyup(function ()
      {
        var tittle = $("#ventana #nombre").val();
        
        $.post(base_url+"categorias/checkExistence/", {titulo:tittle, id_app: app }, function (datos){

          if (datos.length==1) {

            $("#ventana #submitNuevaCategoria").slideUp("slow");
            $("#ventana #status").slideDown("slow");
          }
          else{

            $("#ventana #submitNuevaCategoria").slideDown("slow"); 
            $("#ventana #status").slideUp("slow");
          }
        });
      });
      /*Termina checar nombres repetidos*/
      
      $("#ventana #color").ColorPicker({
  
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
          $("#ventana #color").val(rgb.r+","+rgb.g+","+rgb.b);
        }
      });
  });
} 
//Termina nueva categoria

/*Editar categoria*/
function editarCategoria(id){

  $.post(base_url+"categorias/editarCategoria/", { id_categoria : id } , function (data){

      $("#ventana").html(data);

       $("#ventana #nombre").keyup(function (){

        var tittle = $("#ventana #nombre").val(); console.log(tittle);

        $.post(base_url+"categorias/updateCheckExistence/", {titulo: tittle, id_app:app, id_cat:id }, function (data){

          if(data.length==1){

            $("#ventana #status").slideDown("slow");
            $("#ventana #submitEditarCategoria").slideUp("slow");
          }
          else{

            $("#ventana  #status").slideUp("slow");
            $("#ventana  #submitEditarCategoria").slideDown("slow");
          }
        });
      });
      
    $("#ventana #color").ColorPicker({
  
        color: '#0000ff',
        
        onShow: function (colpkr){

          $(colpkr).fadeIn(500);
          return false;
        },
  
        onHide: function (colpkr){

          $(colpkr).fadeOut(500);
          return false;
        },
        onChange: function (hsb, hex, rgb){

          $("#ventana #color").val(rgb.r+","+rgb.g+","+rgb.b);
        }
      });
    });
}
/*Termina editar categoria*/

/* Eliminar categoria */
function eliminarCategoria(id){

  $.post(base_url+"categorias/eliminarCategoria/", { id_categoria : id } , function (data)
  {
      $("#ventana").html(data);
  });
}
/* Termina eliminar categoria */

$("#sortable").sortable({
      revert: true,
      placeholder: "ui-state-highlight",
      
      stop: function (){
        $("#sortable li").each(function (data)
        {
          var id = $(this).attr('id');
          var orden = data+1;

          $.post(base_url+"categorias/updateOrden/", {id_categoria : id, orden_categoria : orden}, function (data){

              console.log(data);
          });
        });
        
        $("#status").slideDown("slow");

        setTimeout(
          function(){
            $("#status").slideUp("slow");
          },3000);
      }

  });

 var base_url = "<?php echo base_url(); ?>";
 var app      =  "<?php echo $app; ?>";

$("#buscar").keyup(function ()
{
    var palabra = $("#buscar").val();
    console.log(palabra);

    $.post(base_url+"categorias/searchByTitulo/", {titulo: palabra, id_app: app} , function (data)
    {
        $("#categorias tbody").html(data);
        //console.log(data);
    });

});

</script>