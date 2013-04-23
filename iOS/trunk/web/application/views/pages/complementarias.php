<div class="wrapper">
   <a href="<?php echo base_url() ?>" class="home">Home</a>

   <br/><br/><br/>

   <a href="<?php echo base_url() ?>complementarias/show/" class="btncatalogo">Ver todas las recetas complementarias</a>

  <div id="myform" class="myform">

      <?php echo validation_errors(); ?>
      <?php echo form_open('recetas/complementariaCreate/') ?>

      <h2>Nueva receta complementaria</h2>
      <p>Información de la receta</p>
 
      <label for="titulo">Título</label>
      <input type="texto" name="titulo" id="titulo" required/>
      <div id="existe" style="color:RED; display:none;"> Esta receta complementaria ya esta definida.</div>


    

      <br><br><br>
      <label for="contenido" class="fixmargin">Contenido <span class="small">Pasos de preparación e ingredientes</span></label>
      <textarea name="contenido" title="contenido" rows="4" cols="46" required id="contenido"></textarea>

      <br><br>


      <button type="submit" id="test">Guardar</button>
    </form>


     

  </div>

  
</div>

<script>

var base_url = "<?php echo base_url(); ?>";

$("#titulo").keyup(function (data)
  {
      var palabra = $("#titulo").val();

      if(palabra!="")
      {
          //console.log(palabra);
          $.post(base_url+"complementarias/searchRecipesComplementsByTittle/",{ titulo: palabra}, function (data)
            {
              if(data=="Encontrado")
              {
                $("#existe").slideDown("slow");
                $(".fixmargin").slideUp("slow");
                $("#contenido").slideUp("slow");
                $("#test").slideUp("slow");
              }
              else
              {
                $("#existe").slideUp("slow");
                $(".fixmargin").slideDown("slow");
                $("#contenido").slideDown("slow");
                $("#test").slideDown("slow"); 
              }


            });
      }

  });
</script>
