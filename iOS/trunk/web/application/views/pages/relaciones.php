
<div class="wrapper">
	
	<a href="<?php echo base_url() ?>" class="home">Home</a>
    <a href="<?php echo base_url()."apps/view/".$app; ?>" class="homeh1">Apps</a>
    <a href="<?php echo base_url()."recetas/relationships/".$app.'/'.$recetas['id']; ?>" class="homeh2">Receta - relaciones</a>
    <br/><br/><br/><br/>

	<table class="" border="1" align="center" width="100%">
			<thead>
				<tr>
					<td>Titulo</td>
					<td>Costo</td>
					<td>Preparacion</td>
					<td>Ingredientes</td>
					<td>Foto</td>
					<td>Coccion</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php  echo $recetas['titulo'] ?></td>
					<td><?php  echo $recetas['costo'] ?></td>
					<td><?php  echo $recetas['preparacion'] ?></td>
					<td><?php  echo $recetas['ingredientes'] ?></td>
					<td><?php  echo $recetas['foto'] ?></td>
					<td><?php  echo $recetas['coccion'] ?></td>
				</tr>
			</tbody>

		</table>
		<br/>

		<div class="searchRelaciones">
			<input type="text" id="inputSearchRelations" placeholder="Buscar receta complementaria">
			<div id="resultsOfRelationsSearch">
				<div id="result">
					Resultados
				</div>
			</div>
		</div>

		<div class="RelationsRecipe">
			
				<?php
			if(isset($relations))
			{

			?>

			<table class=".list-relations" id="relationShips" align="center">

			<thead>
				<tr>
					<td colspan="6">Recetas complementarias</td>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>Titulo</td>
					<td>Contenido</td>
					<td>Opciones</td>
					
				</tr>
			
				<?php		

				for ($i=0; $i <count($relations) ; $i++) 
				{

				?>
				<tr>
					<td><?php  echo $relations[$i]['titulo'] ?></td>
					<td><?php  echo $relations[$i]['contenido'] ?></td>
					
					<td><a href="#eliminarRelacion<?php echo $relations[$i]['id'] ?>">Eliminar</a></td>
				</tr>
				<?php

				}
				?>

				

				<?php
				}
				?>

				</tbody>

			</table>
			<br/>
			
		</div>

	</div>


</div>

<?php		if(isset($relations))
			{

				for ($i=0; $i <count($relations) ; $i++) 
				{

				?>

				<div id="eliminarRelacion<?php echo $relations[$i]['id'] ?>" class="modalDialog">
			        <div>
			          <a href="#" title="Close" class="close">X</a>
			          <p>¿Estas seguro de eliminar la relación?.</p>
			          <a href="<?php echo base_url() ?>complementarias/eliminarRelacion/<?php echo $app."/".$relations[$i]['id']."/".$recetas['id'] ?>" class="eliminarBoton">Eliminar</a>
			          <a href="#" class="eliminarBoton">Cancelar</a>
			        </div>
			      </div>

			      <?php
			  }
			}
			      ?>

<script>

var base_url = "<?php echo base_url() ?>";
var identificador   = <?php echo $recetas['id']; ?>;
var app 			= <?php echo $app; ?>;

$("#inputSearchRelations").keyup(function(data)
	{
		var texto = $("#inputSearchRelations").val();
		
		console.log(texto);

		if(texto!="")
		{
			$.post(base_url+"complementarias/searchToAddRelation", {titulo: texto, id: identificador, application: app}, function (data)
			{
				$("#result").html(data);
			});
		}

		
	});




</script>
