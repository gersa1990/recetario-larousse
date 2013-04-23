<div class="wrapper">
	
	<a href="<?php echo base_url() ?>" class="home">Home</a>    
    <br/>

	<h2 class="centrado">Opciones de glosario</h2>

	
    <a href="<?php echo base_url() ?>glosario/show/" class="btncatalogo">Ver todo el glosario</a>

	<center><input type="text" placeholder="Buscar glosario" id="BuscarGlosario"></center>
	<div id="ResultsOfGlosary">Resultados</div>
	<br/>

	<div class="centrar">
		
			<?php   
				  echo form_open(base_url().'glosario/create/')
       		?>
			<fieldset>
				<legend>Agregar palabra al glosario</legend>
				Palabra<br/>
				<input type="text" class="input" name="palabra" id="palabra" required>
				<br/>
				<span id="spanWord">Esta palabra ya se encuentra</span>
				<br/>
				Descripcion<br/>
				<textarea type="text" class="" name="descripcion" id="descripcion" cols="4" required style="width:300px;"></textarea>
				<br/><br/>
				Imagen<br/>
				<input type="text" class="input" name="imagen" id="imagen" cols="4" >
				<br/><br/>
				<input type="submit" class="fbutton" id="submitWordToGlosary" value="Agregar Palabra">
			</fieldset>
		</form>
	</div>
	<br/>

	<br/>
</div>

<script>

$(document).ready(function()
{

	$(".centrar form").attr('class','newWordToGlosary');
});


var base_url = "<?php print base_url() ?>";

;

$("#palabra").keyup(function (data)
	{
		var palabra = $("#palabra").val();

		if(palabra!="")
		{
			$.post(base_url+"glosario/get/",{ nombre: palabra },function(data)
			{

				if(data=="Encontrado")
				{
					$("#spanWord").show('slow');
					$("#submitWordToGlosary").hide('slow');
				}
				else
				{
					$("#spanWord").hide('slow');
					$("#submitWordToGlosary").show('slow');
					
				}
			});
			
		}

		
	});


</script>