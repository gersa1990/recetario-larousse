
<div class="wrapper">
	
	<a href="<?php echo base_url() ?>" class="home">Home</a> =>
    <a href="<?php echo base_url()."apps/view/".$app; ?>" class="home">Apps</a> =>
    <a href="<?php echo base_url()."recetas/relationships/".$app.'/'.$recetas['id']; ?>" class="home">Relacionar  Receta</a>
    <br/><br/><br/><br/>

	<table class="lista" border="1" align="center">
			<thead>
				<tr>
					<td>Titulo</td>
					<td>Costo</td>
					<td>Preparacion</td>
					<td>Ingredientes</td>
					<td>Coccion</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php  echo $recetas['titulo'] ?></td>
					<td><?php  echo $recetas['costo'] ?></td>
					<td><?php  echo $recetas['preparacion'] ?></td>
					<td><?php  echo $recetas['ingredientes'] ?></td>
					<td><?php  echo $recetas['coccion'] ?></td>
				</tr>
			</tbody>

		</table>
		<br/>

		<div class="searchRelaciones">
			<input type="text" id="inputSearchRelations" placeholder="Buscar una receta">
			<div id="resultsOfRelationsSearch">
				<div id="result">
					Resultados
				</div>
			</div>
		</div>

		<div class="RelationsRecipe">
			
			
			<table class=".list-relations" id="relationShips">

			<thead>
				<tr>
					<td colspan="5">Relaciones</td>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>Titulo</td>
					<td>Costo</td>
					<td>Preparación</td>
					<td>Ingredientes</td>
					<td>Tiempo</td>
				</tr>
				<?php
			if(isset($relations))
			{

			?>
				<?php		

				for ($i=0; $i <count($relations) ; $i++) 
				{

				?>
				<tr>
					<td><?php  echo $relations[$i]['titulo'] ?></td>
					<td><?php  echo $relations[$i]['costo'] ?></td>
					<td><?php  echo $relations[$i]['preparacion'] ?></td>
					<td><?php  echo $relations[$i]['ingredientes'] ?></td>
					<td><?php  echo $relations[$i]['coccion'] ?></td>
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

<?php		

				for ($i=0; $i <count($relations) ; $i++) 
				{

				?>

				<div id="eliminarRelacion<?php echo $relations[$i]['id'] ?>" class="modalDialog">
			        <div>
			          <a href="#" title="Close" class="close">X</a>
			          <p>¿Estas seguro de eliminar la relación?.</p>
			          <a href="<?php echo base_url() ?>recetas/eliminarRelacion/<?php echo $app."/".$relations[$i]['id']."/".$recetas['id']?>" class="eliminarBoton">Eliminar</a>
			          <a href="#" class="eliminarBoton">Cancelar</a>
			        </div>
			      </div>

			      <?php
			  }
			      ?>

<script>

var base_url = "http://localhost/recetario-larousse/iOS/trunk/web/";
var identificador  = <?php echo $recetas['id']; ?>;

$("#inputSearchRelations").keyup(function(data)
	{
		var texto = $("#inputSearchRelations").val();
		console.log(texto);

		if(texto!="")
		{
			$.post(base_url+'recetas/getRecipeToRelation/'+identificador,{text: texto }, function(datos) 
		 	{
  				$('#result').html(datos);
  				
  				$(".RecipeRelation").click(function(data)
				{
					var id = $(data.target).attr('id');
					
					$.post(base_url+"recetas/addRelationShip/",{ID1: id, ID2:identificador},function(data)
					{
						$("#relationShips tbody").append(data);
						$("#id_"+id).css('display','none');
						location.href="";
					});

				});
		 	});
		}

		
	});




</script>
