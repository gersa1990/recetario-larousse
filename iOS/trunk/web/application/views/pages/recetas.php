
<div class="wrapper">

  <div class="main">
    <div id="status"></div>

    <div class="columl">
      <a href="<?php echo base_url() ?>" class="home"><span>←</span> regresar</a>

      <nav id="menu">
        <ul>
          <li><a class="active" href="<?php echo base_url().'apps/view/'.$app; ?>" class="">Recetas</a></li>
          <li><a href="<?php echo base_url().'categorias/view/'.$app; ?>" class="">Categorías</a></li>
          <li><a href="<?php echo base_url().'glosario/view/'.$app; ?>" class="">Glosario</a></li>
          <li><a href="<?php echo base_url().'videos/view/'.$app; ?>" class="">Videos</a></li>
          <li><a href="<?php echo base_url().'complementarias/view/'.$app; ?>" id="getComplementsRecipes" class="">Recetas complementarias</a></li>
        </ul>
      </nav>

    </div>
    
    <div class="columr">

      <div id="addblock">
  
        <div id="controles">
          <input type="text" name="" id="buscar" class="input" placeholder="Buscar.." value="">
          <a href="<?php echo base_url().'recetas/nueva/'.$app ?>" class="button large orange">Nueva</a>
        </div> 
  
        <table id="recetas">
          <thead>
            <tr>
              <th colspan="3">Recetas</th>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($recetas))
                  {
                    for ($i=0; $i <count($recetas) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft">
                            <a href="<?php echo base_url().'recetas/ver/'.$recetas[$i]['id'].'/'.$recetas[$i]['id_app'] ?>" class="bluetext">
                              <?php echo $recetas[$i]['titulo']; ?>
                            </a>
                          </td>

                          <td>
                            <a href="#eliminarReceta<?php echo $recetas[$i]['id']; ?>" class='eliminarRecetas'>
                              Eliminar
                            </a>
                          </td>

                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

        <?php if(isset($recetas)){
          for ($i=0; $i <count($recetas) ; $i++){ ?>
          
            <div id="eliminarReceta<?php echo $recetas[$i]['id']; ?>" class="modalDialog">
              <div class="popup form_delete">

                <a href="#" title="Close" class="close">x</a>
                
                <?php echo form_open("recetas/delete/"); ?>
                  <h2>Receta</h2>
                    
                  <p class="mg-auto"><?php echo $recetas[$i]['titulo']; ?></p>
         
                  <input type="hidden" name="id" value="<?php echo $recetas[$i]['id']; ?>">
                  <input type="hidden" name="id_app" value="<?php echo $app; ?>">
                  
                  <button type="submit" class="submit">Eliminar</button>
                </form>
              </div>
            </div>


          <?php
          
          } 
        } 
        $cat = count($categorias);
        ?>
      </div>
    </div>
  </div>

  
  <div class="clear"></div>
</div>

<script>

  var app = "<?php echo $app; ?>";
  var base_url = "<?php echo base_url(); ?>";

  var categorias = "<?php echo $cat; ?>";
  console.log(categorias);
  var cat = parseInt(categorias);

  if(cat<1)
  {
    $("#status").html("<div class='alert alert-info'>Para poder dar de alta una receta tienes que crear sus categorias. Serás redirigido.</div>").slideDown("slow");
    $("#addblock").slideUp("slow"); 
    
    setTimeout(function(){
      location.href=base_url+"categorias/view/"+app;
    },3000)
  }

  

  $("#exportar").click(function ()
  {
      location.href=base_url+"export/create/"+app;
  });


  $("#buscar").keyup(function (data)
  {
    var texto = $("#buscar").val();

    $.post(base_url+"recetas/searchByName/" ,{palabra: texto, id_app: app}, function (data)
    {
      $("#recetas tbody").html(data);
    }); 
  });

</script>