<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" href="resources/img/icon.png">
	
	<link rel="stylesheet" href="<?php echo base_url()?>css/reset.css" type="text/css" media="screen"/> 
	<link rel="stylesheet" href="<?php echo base_url()?>css/styles.css" type="text/css" media="screen"/> 

	<script src="<?php echo base_url()?>js/jquery-1.8.3.min.js"></script> 
	<script src="<?php echo base_url()?>js/kendo.all.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/colorpicker.css" type="text/css" media="screen">	
	<script src="<?php echo base_url(); ?>Resources/js/colorpicker.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery_ui/ui/jquery-ui.js"></script>

	<script src="<?php echo base_url(); ?>js/funcionesJS.js"></script>

</head>

<body>
	<header>
		<div class="wrapper">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>resources/img/logo.png" width="200"></a>
			<a href="" class="help">Ayuda</a>

			<div id="app_name">
				<?php if(isset($app)){ ?>
		        Nombre de la aplicación: <input type="text" name="nameApp" id="nameApp" value="<?php echo $apps['nombre']; ?>" >
		        <input type="checkbox"  name="editNameApp" id="editNameApp" value="acepto"> Editar
		        <?php } else{ ?>
		         <nav>
    				<ul>
        				<li class="">
            				<a href="#nuevaApp" class="">Nueva Aplicación</a>
        				</li>
        			</ul>
  				</nav>
		        <?php } ?>	      
	      </div>
		</div>
		<script>

		var aplication = "<?php echo $app; ?>";

		$("#nameApp").css("border","1px solid #ccc").attr("disabled","disabled");

		var check = $("#editNameApp").is(":checked");
			
			if(check==true)
			{
				$("#nameApp").css("border","1px solid black").removeAttr("disabled");	
			}
			if(check==false)
			{
				$("#nameApp").css("border","1px solid #ccc").attr("disabled","disabled");	
			}	

		$("#editNameApp").change(function ()
		{
			var check = $("#editNameApp").is(":checked");
			
			if(check==true)
			{
				$("#nameApp").css("border","1px solid black").removeAttr("disabled");	
			}
			if(check==false)
			{
				$("#nameApp").css("border","1px solid #ccc").attr("disabled","disabled");	
			}
		});



		
			$("#nameApp").keyup(function (data)
			{
				$("#nombreApp").stop(true,false);

					setTimeout(function() {

      				var nombreApp = $("#nameApp").val();

      				//console.log(nombreApp);
			
					if(nombreApp!="")
					{
						$.post(base_url+"apps/changeName/", {app: aplication, name: nombreApp }, function (data)
						{
							$("#status").stop(true);
							$("#status").html("<div class='alert info'><button type='button' class='aclose' data-dismiss='alert'>×</button><strong></strong> Actualizastes el nombre de tu aplicación</div>");
							$(".info").stop(true);
							$(".info").slideDown("slow");						

							setTimeout(function() 
							{
								$(".alert").stop(true);
								$(".alert").fadeOut("slow");
							},2000);
						});
					}
					else
					{
						$("#status").html("<div class='alert error'><button type='button' class='aclose' data-dismiss='alert'>×</button><strong>Error</strong> No puedes dejar vacio el nombre de la APP</div>");
					}

				}, 2000);

			
			});
			
		</script>
	</header>