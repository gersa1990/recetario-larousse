<div class="wrapper">
	<h1>Glosario por recetas</h1>
	<div class="centrar">
		<input type="text" class="centrar" id="BuscarReceta" placeholder="Buscar receta">
		<div id="result">
			Resultados
		</div>
	</div>
	<br/>

	<div class="GlosarioByRecipe">
	</br>
	</div>
	<br/>
</div>

<script>

var base_url = "http://localhost/recetario-larousse/iOS/trunk/web/";
var name = "Hola";
var id =2, bandera=0;

$("#BuscarReceta").keyup(function(data)
	{
		var texto = $("#BuscarReceta").val();
		bandera =0;

		if(texto!="")
		{
			$.post(base_url+'glosario/getRecipes/',{text: texto }, function(datos) 
		 	{
  				$('#result').html(datos);

  				$(".buttonRecipe").click(function(data)
				{
					id 		= $(data.target).attr('id');
					name	= $("#recipe_"+id).text();

					//console.log("ID: "+id+" Contenido: "+name);
					
					$.post(base_url+"glosario/getGlosarioByRecipe/",{identificador: id},function(data)
					{
						if(data=="Null")
						{
							console.log();

							$(".GlosarioByRecipe").html("<h2 class='centrar'>"+name+" :: no cuenta con glosario.</h2></br><form class='newWordToGlosary' id='newWordToGlosary' method='post' action='"+base_url+"glosario/creates'><fieldset><legend>Agrega su glosario</legend><center>Nombre</br><input type='text' class='input' name='palabra' id='palabra' placeholder='Nombre' required><input type='hidden' name='id' id='id' placeholder='id' value='"+id+"'></center><center>Descripción</br><input type='text' class='input' name='definicion' id='definicion' placeholder='Descripcion' value='' required></center><center>Imagen</br><input type='text' class='input' name='imgGlosario' id='imgGlosario' placeholder='Imagen' value='' required></center><center><input type='submit' name='submitWordToGlosary' id='submitWordToGlosary' value='Agregar'></center></fieldset></form>");	
							$("#recipe_"+id).css('display','none');

							
							$("#newWordToGlosary").submit(function()
							{
								var nombre 		= $("#palabra").val();
								var descripcion = $("#definicion").val();
								var img 		= $("#imgGlosario").val();
								

								$.post(base_url+"glosario/creates",{identificador: id, palabra: nombre, definicion: descripcion, imgGlosario: img},function(data)
								{
									console.	log("POST :"+data);

									if(bandera==0)
									{

										$('.GlosarioByRecipe').html("<table class='lista' align='center'><thead><tr><td>Nombre</td><td>Descripcion</td><td>Imagen</td><td>Opciones</td><tr></thead><tbody></tbody></table><br/><br/>");
										$('.GlosarioByRecipe .lista tbody').append("<tr id='tr_"+data+"'>");
  										$('.GlosarioByRecipe .lista tbody #tr_'+data+'').append("<td>"+nombre+"</td>");
  										$('.GlosarioByRecipe .lista tbody #tr_'+data+'').append("<td>"+descripcion+"</td>");
  										$('.GlosarioByRecipe .lista tbody #tr_'+data+'').append("<td>"+img+"</td>");
  										$('.GlosarioByRecipe .lista tbody #tr_'+data+'').append("<td><button class='EliminarGlosario' id='"+data+"'>Eliminar</button></td>");
  										$('.GlosarioByRecipe .lista tbody #tr_'+data+'').append("</tr>");

  										$(".GlosarioByRecipe").append("<form class='newWordToGlosary' id='newWordToGlosary' method='post' action='"+base_url+"glosario/creates'><fieldset><legend>Agrega su glosario</legend><center>Nombre</br><input type='text' class='input' name='palabra' id='palabra' placeholder='Nombre' required><input type='hidden' name='id' id='id' placeholder='id' value='"+id+"'></center><center>Descripción</br><input type='text' class='input' name='definicion' id='definicion' placeholder='Descripcion' value='' required></center><center>Imagen</br><input type='text' class='input' name='imgGlosario' id='imgGlosario' placeholder='Imagen' value='' required></center><center><input type='submit' name='submitWordToGlosary' id='submitWordToGlosary' value='Agregar'></center></fieldset></form>");	
										
										$("#newWordToGlosary").submit(function()
										{
											console.log(bandera);
											var nombre 		= $("#palabra").val();
											var descripcion = $("#definicion").val();
											var img 		= $("#imgGlosario").val();

											$.post(base_url+"glosario/creates",{identificador: id, palabra: nombre, definicion: descripcion, imgGlosario: img},function(data)
											{
												console.log("POST :"+data);
												$('.GlosarioByRecipe .lista tbody').append("<tr id='tr_"+data+"'>");
  												$('.GlosarioByRecipe .lista tbody').append("<td>"+nombre+"</td>");
  												$('.GlosarioByRecipe .lista tbody').append("<td>"+descripcion+"</td>");
  												$('.GlosarioByRecipe .lista tbody').append("<td>"+img+"</td>");
  												$('.GlosarioByRecipe .lista tbody').append("<td><button class='EliminarGlosario' id='"+data+"'>Eliminar</button></td>");
  												$('.GlosarioByRecipe .lista tbody').append("</tr>");

  												$(".EliminarGlosario").click(function(data)
												{
													var identif = $(data.target).attr('id');
													console.log("FIRST WORD IDENTIF: "+identif);

													/*$.post(base_url+"glosario/delete/"+identif+"", function(data)
													{
														console.log("Not null: "+data);
													});*/

								
												});
											});

											return false;
										});

										bandera = 1;
										console.log(bandera);	
									}
									if(bandera==1)
									{
										
										$("#newWordToGlosary").submit(function()
										{
											var nombre 		= $("#palabra").val();
											var descripcion = $("#definicion").val();
											var img 		= $("#imgGlosario").val();

											return false;
										});

										$(".EliminarGlosario").click(function(data)
										{
											var identif = $(data.target).attr('id');
											console.log("FIRST WORD IDENTIF: "+identif);

											/*$.post(base_url+"glosario/delete/"+identif+"", function(data)
											{
												console.log("Not null: "+data);
											});*/

								
										});

									}
									
								});

								$.post(base_url+"glosario/getGlosarioByRecipe/",{identificador: id},function(data)
								{

									$('.GlosarioByRecipe .lista tbody').append("<tr id='tr_"+data+"'><td>"+nombre+"</td><td>"+descripcion+"</td><td>"+img+"</td><td><form name='deleteGlosario' id='deleteGlosario' action='"+base_url+"glosario/delete/"+id+"'><input type='text' id='idGlsoario' name='idGlosario' value='"+id+"'><input type='submit' value='Eliminar'></form></td></tr>");


   									console.log(data);
								});

								return false;
							});

							$(".EliminarGlosario").click(function(data)
							{
								var identif = $(data.target);
								console.log("Null IDENTIF: "+identif);

								/*$.post(base_url+"glosario/delete/"+identif+"", function(data)
								{
									console.log("Not null: "+data);
								});*/
								
							});

						}
						else
						{
							$(".GlosarioByRecipe").html(data);
							$("#recipe_"+id).css('display','none');	
							
							$("#newWordToGlosary").submit(function()
							{
								var nombre 		= $("#palabra").val();
								var descripcion = $("#definicion").val();
								var img 		= $("#imgGlosario").val();
								console.log("ID: "+id);

								$.post(base_url+"glosario/creates",{identificador: id, palabra: nombre, definicion: descripcion, imgGlosario: img},function(data)
								{
									$('.GlosarioByRecipe .lista tbody').append("<tr id='"+data+"'><td>"+nombre+"</td><td>"+descripcion+"</td><td>"+img+"</td><td><button class='EliminarGlosario' id='"+data+"'>Eliminar</button></td></tr>");
									
									$(".EliminarGlosario").click(function(data)
									{
										var identif = $(data.target).attr('id');
										console.log("ADDING WORD IDENTIF: "+identif);

										/*$.post(base_url+"glosario/delete/"+identif+"", function(data)
										{
											console.log("Not null: "+data);
										});*/
								
									});

								});
								
								return false;
							});

							$(".EliminarGlosario").click(function(data)
							{
								var identif = $(data.target).attr('id');
								console.log("Not null IDENTIF: "+identif);

								/*$.post(base_url+"glosario/delete/"+identif+"", function(data)
								{
									console.log("Not null: "+data);
								});*/
								
							});
						}
						
					});

				});

		 	});
		}	
	});

$("#newWordToGlosary").submit(function()
							{
								var nombre = $("#palabra").text();
								console.log(nombre);

								$.post(base_url+"glosario/creates",{identificador: id}, function(data)
								{
									$('.GlosarioByRecipe').html(data);
									console.log(data);
								});

								$.post(base_url+"glosario/getGlosarioByRecipe/",{identificador: id},function(data)
								{
  									$('.GlosarioByRecipe').html(data);
  									console.log(data);
								});

								return false;
							});

$(".EliminarGlosario").click(function(data)
							{
								var identif = $(data.target).attr('id');
								console.log("Another IDENTIF: "+identif);

								/*$.post(base_url+"glosario/delete/"+identif+"", function(data)
								{
									console.log("Not null: "+data);
								});*/
								
							});


</script>