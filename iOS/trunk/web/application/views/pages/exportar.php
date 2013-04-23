<div class="wrapper">

	<div>
		
	</div>	

	<a href="<?php echo base_url() ?>" class="home">Home</a>

	<h1>Exportar APP <?php echo $application[0]['nombre']; ?></h1>

	<table class="lista">
		<thead>
			<tr>
				<td colspan="1">Archivo SQLITE <?php echo $app.".sqlite" ?></td>
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<td><a href="<?php echo base_url().'resources/'.$app.'.sqlite' ?>" class="subhome"> Descargar</a></td>
			</tr>
		</tbody>
	</table>
	
	<br/><br/><br/>

	<table class="lista" align="center">
		<thead>
			<tr>
				<td>Exportastes la aplicación</td>
			</tr>
		</thead>
		<tbody>
			
			<?php 
			 for ($i=0; $i <count($application) ; $i++) 
				{ 
				?>
				<tr>
					<td><?php echo $application[$i]['nombre']; ?></td>
					
				</tr>
			<?php

			} 
			?>
		</tbody>
	</table> 
	<br/>

	<table class="lista" align="center">
		<thead>
			<tr>
				<td colspan="3">Exportastes la configuracíon</td>
			</tr>
		</thead>
		<tbody>
			
			<?php 
			 for ($i=0; $i <count($conf) ; $i++) 
				{ 
				?>
				<tr>
					<td><?php echo $conf[$i]['id']; ?></td>
					<td><?php echo $conf[$i]['nombre']; ?></td>
					<td><?php echo $conf[$i]['valor']; ?></td>
					
				</tr>
			<?php

			} 
			?>
		</tbody>
	</table> 
	<br/>

	<table class="lista" align="center">
		<thead>
			<tr>
				<td colspan="3">Exportastes las categorias</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ID</td>
				<td>Nombre</td>
				<td>Color</td>
			</tr>
			
			<?php 
			 for ($i=0; $i <count($categoria) ; $i++) 
				{ 
				?>
				<tr>
					<td><?php echo $categoria[$i]['id']; ?></td>
					<td><?php echo $categoria[$i]['nombre']; ?></td>
					<td><?php echo $categoria[$i]['color']; ?></td>
					
				</tr>
			<?php

			} 
			?>
		</tbody>
	</table> 
	<br/>


	<table class="lista" align="center">
		<thead>
			<tr>
				<td colspan="4">Exportastes las recetas</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ID</td>
				<td>TITULO</td>
				<td>CATEGORIA</td>
				
			</tr>
			<?php for ($i=0; $i <count($recetasByApp) ; $i++) {  ?>
			<tr>
				<td><?php echo $recetasByApp[$i]['id'] ?></td>
				<td><?php echo $recetasByApp[$i]['titulo'] ?></td>
				<td><?php echo $recetasByApp[$i]['id_categoria'] ?></td>
				
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<br/>



	<table class="lista" align="center">
		<thead>
			<tr>
				<td colspan="4">Exportastes las relaciones de recetas</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ID_RECETA</td>
				<td>ID_RECETA_COMPLEMENTARIA</td>
				
			</tr>
			<?php for ($i=0; $i <count($relacionesRecetas) ; $i++) 
			{  
				if(count($relacionesRecetas[$i])>0)
				{
				?>
			<tr>
				<td><?php echo $relacionesRecetas[$i]['id_receta'] ?></td>
				<td><?php echo $relacionesRecetas[$i]['id_receta_complementaria'] ?></td>
			</tr>
			<?php }} ?>
		</tbody>
	</table>
	<br/>

	<table>
		<thead>
			<tr>
				<td colspan="3">Complementarias</td>
			</tr>
			<tr>
				<td>ID</td>
				<td>Titulo</td>
				<td>Contenido</td>
			</tr>
		</thead>
		<tbody>
			<?php

			if(isset($complementarias))
			{
				for ($i=0; $i <count($complementarias) ; $i++) 
				{ 
					?>
					<tr>
						<td><?php echo $complementarias[$i]['id']; ?></td>
						<td><?php echo $complementarias[$i]['titulo']; ?></td>
						<td><?php echo $complementarias[$i]['contenido']; ?></td>
					</tr>
					<?php
				}
			}

			?>
		</tbody>
	</table>

	<br/>





	 <table class="lista" align="center">
		<thead>
			<tr>
				<td colspan="4">Exportastes el glosario</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ID</td>
				<td>NOMBRE</td>
				<td>DESCRIPCION</td>
				<td>IMAGEN</td>
			</tr>
			<?php 
			 for ($i=0; $i <count($glosarioByApp) ; $i++) 
			{ 
				?>
				<tr>
					<td><?php echo $glosarioByApp[$i]['id']; ?></td>
					<td><?php echo $glosarioByApp[$i]['nombre']; ?></td>
					<td><?php echo $glosarioByApp[$i]['descripcion']; ?></td>
					<td><?php echo $glosarioByApp[$i]['imagen']; ?></td>
				</tr>
			<?php

			} 
			?>
		</tbody>
	</table> 
	<br/>


	<table class="lista" align="center">
		<thead>
			<tr>
				<td colspan="4">Exportastes la relación de recetas con glosario</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ID</td>
				<td>ID RECETA</td>
				<td>ID GLOSARIO</td>
			</tr>
			<?php 
			 for ($i=0; $i <count($recetaGlosario) ; $i++) 
			{ 
				if(count($recetaGlosario[$i])>0)
				{
				?>
				<tr>
					<td><?php echo $recetaGlosario[$i]['id']; ?></td>
					<td><?php echo $recetaGlosario[$i]['id_receta']; ?></td>
					<td><?php echo $recetaGlosario[$i]['id_glosario']; ?></td>
				</tr>
			<?php
			}
			} 
			?>
		</tbody>
	</table> 
	<br/>


</div>