
<div class="wrapper">

  
  <input type="submit" class="exportar" value="Exportar">

  <span class="uptext left">Aplicación:</span> <input type="text" name="nombreApp" id="nombreApp" class="input post left" value="<?php echo $apps['nombre']; ?>">
  <div class="status left spinner"></div>

  <div class="clear"></div>
  
  <nav id="menu">
    <ul>
      <li><a href="<?php echo base_url(); ?>categorias/view/<?php echo $app; ?>" class="">Categorias</a></li>
      <li><a href="<?php echo base_url(); ?>glosario/view/<?php echo $app; ?>" class="">Glosarios</a></li>
      <li><a href="<?php echo base_url(); ?>videos/view/<?php echo $app; ?>" class="">Videos</a></li>
      <li><a href="<?php echo base_url(); ?>complementarias/view/<?php echo $app; ?>" class="">Recetas complementarias</a></li>
      <li   class="active"><a href="<?php echo base_url(); ?>apps/view/<?php echo $app; ?>" class="">Recetas</a></li>
    </ul>
  </nav>

  <div class="main">
    <div class="columl">

      <div id="tabla">
  
        <table id="recetas">
          <thead>
            <tr>
              <td colspan="2"><input id="nuevaReceta" type="submit" class="button mg1 bl1" value="Nueva receta"></td>
            </tr>
            <tr>
              <td colspan="2"><input type="text" name="" id="buscar" class="input post buscar" placeholder="Buscar.." value="">
              <span class="postfix email">  </span></td>
            </tr>
          </thead>

          <tbody class="blockscroll">
            <?php if(isset($recetas))
                  {
                    for ($i=0; $i <count($recetas) ; $i++) 
                      { ?>

                      <tr>
                          <td class="txleft"><a id="<?php echo $recetas[$i]['id']; ?>" class="bluetext"><?php echo $recetas[$i]['titulo']; ?></a></td>
                          <td><a href="">Eliminar</a></td>
                      </tr>

                      <?php     
                      }   
                  } ?>
          </tbody>
        </table>

      </div>
      
      
    </div>
    
    <div class="columr">

      <div id="addblock">
        
        <div class="myform">

            <h2 class="txcenter">Nueva receta</h2>
            <p class="txcenter">Información de la receta</p>
            <br><br>
          
            <?php echo validation_errors(); ?>
            <form action="" method="" id="form_recetas">
            
            
            
            <label for="titulo" class="fixh1 left">Título</label>
            <input type="texto" name="titulo" id="titulo" class="left"/>
            <div class="status left error">Ya existe una receta con este nombre.</div>

            <div class="clear"></div>
            
            <br>

            <input type="hidden" name="app" value="<?php echo $app; ?>"> 

            <label for="categoria" class="fixh2">Categoria</label>
            <select name="categoria" id="categoria">

              <?php foreach ($categorias as $c_item): ?>
              
                <option value="<?php echo $c_item['id'] ?>"><?php echo $c_item['nombre'] ?></option>
              
              <?php endforeach ?>
            
            </select>

            <br>
            
            <label for="dificultad">Dificultad <span class="small">Dificultad para realizarla</span></label>
            <select name="dificultad" id="dificultad" class="wt1">
              <?php for ($i=1; $i < 6; $i++) 
              { 
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php 
              } 
              ?>
            </select>
            
            <br><br>
            
            <label for="procedimiento" class="fixmargin">Procedimiento <span class="small">Pasos de preparación</span></label>
            <textarea name="procedimiento" id="procedimiento" title="procedimiento" rows="4" cols="46" required></textarea>

            <br>
            
            <label for="ingre" class="fixmargin">Ingredientes <span class="small">Lista de ingredientes</span></label>
            <textarea name="ingredientes" id="ingredientes" title="ingredientes" rows="4" cols="46" required></textarea>

            <br>
            
            <label for="prepa">Preparación <span class="small">Tiempo en min</span></label>
            <input type="text" name="preparacion" id="preparacion" required />

            <br>
            
            <label for="coccion">Cocción <span class="small">Tiempo en min</span></label>
            <input type="text" name="coccion" id="coccion" required/>

            <br>
            
            <label for="costo">Costo <span class="small">Precio aproximado</span></label>
             <select name="costo" id="costo" class="wt1">
              <?php for ($i=1; $i < 6; $i++) { ?>
                  <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
              <?php } ?>
            </select>
            <br><br>
            
            <label for="ïmg">Imagen <span class="small">Cargar file</span></label>
            <input type="text" name="img" id="foto" required />

            <br><br>
            
            <button type="submit" class="button bl2">Guardar</button>

            </form>
        </div>
        
        
          <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Nunc tincidunt</a></li>
                <li><a href="#tabs-2">Proin dolor</a></li>
                <li><a href="#tabs-3">Aenean lacinia</a></li>
            </ul>
            <div id="tabs-1">
                  <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
            </div>
            <div id="tabs-2">
                  <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
            </div>
            <div id="tabs-3">
                <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
            </div>
        </div>

      </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<script>

$( "#tabs" ).tabs().css('display','none');

var app = "<?php echo $app; ?>";
var base_url = "<?php echo base_url(); ?>";


$(".blockscroll tr .txleft").each(function (text)
{
  $(".txleft a").click(function (data)
  {
      var id = $(this).attr('id');

      $("#tabs").fadeIn("slow");
      $(".myform").fadeOut("slow");

      $.post(base_url+"recetas/searchById/", {id_receta:id, id_app: app }, function (data)
      {
          $("#tabs-1").html(data);
          console.log(data);
      });

    return false;
  });
});

//console.log(base_url);

$("#nombreApp").keyup(function ()
{
    var nombreApp = $("#nombreApp").val();

    //Buscar si ya existe ese nombre de APP y no dejar que esté vacio

    $.post(base_url+"apps/updateNombre/", {nombre: nombreApp, id_app: app}, function (data)
    {
        
    });
});

$("#form_recetas").submit(function ()
{
    var title         = $("#titulo").val();
    var id_cat        = $("#categoria").val();
    var proced        = $("#procedimiento").val();
    var ingre         = $("#ingredientes").val();
    var prep          = "0";
    var cocc          = $("#coccion").val();
    var cost          = $("#costo").val();
    var imagen        = $("#foto").val();
    var favoritos     = "0";
    var dificult      = $("#dificultad").val();

    if(ingre!="" && prep!="" && imagen!="")
    {
      $.post(""+base_url+"recetas/creates/" , { titulo: title, id_categoria: id_cat, id_app: app, procedimiento: proced, ingredientes: ingre, preparacion: prep, coccion: cocc, costo:cost, foto: imagen, user_fav: favoritos, dificultad: dificult}, function (data)
        {
            console.log(data);
        });
    }


    return false;
});

$(".myform").css('display','none');

$("#nuevaReceta").click(function ()
{
    $(".myform").fadeIn("slow");
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