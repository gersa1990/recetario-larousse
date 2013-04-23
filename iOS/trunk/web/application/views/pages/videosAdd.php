<div class="wrapper">

<a href="<?php echo base_url() ?>" class="home">Home</a>

	<div id="myform" class="myform" style="height:200px;">
		<?php echo validation_errors(); ?>
		<?php echo form_open('videos/create/') ?>
	
			<label for="video">Nombre video</label>
			<input type="text" name="video" id="video" required placeholder="Ingresa el nombre del video sin extensión">
			<br/>
			<br/>
			<br/>
			<label for="video">Titulo video</label>
			<input type="text" name="titulo" id="titulo" required placeholder="Ingresa el titulo del video">
			<div class="alert" id="existence" style="display:none;">Este video ya existe.</div>
				<br/>
				<br/>

			<input type="submit" id="agregarVideo" value="Agregar">
		</form>
	</div>
</div>

<script>

var base_url = "<?php echo base_url(); ?>";

$("#video").keyup(function (data)
{
	var texto = $("#video").val();
	//console.log(texto);

	$.post(base_url+"videos/checkExistence/", {video: texto} , function (datos)
	{
		if(datos =='Existe')
		{
			$("#existence").slideDown("slow");
			$("#agregarVideo").slideUp("slow");
		}
		else
		{
			$("#existence").slideUp("slow");
			$("#agregarVideo").slideDown("slow");
		}		
	});
});
</script>