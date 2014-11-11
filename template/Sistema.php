<!DOCTYPE html>
	<?php 
		require_once 'controller/SistemaController.php';
		$obj=new sistemaController();
		if (!$_SESSION['usuario_n']) {
			echo $obj->logout();
		}
	?>
<html>
<head>
	<title>Principal</title>
	<meta charset="ISO-8859-1">
	<link href="web/css/principal.css" rel="stylesheet"/>
	
	<link rel="stylesheet" type="text/css" href="web/css/themes/default/easyui.css">
	<script src="web/js/jquery-1.8.3.js"></script>
	<script src="web/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="web/js/jquery.collapse.js"></script>
	<script src="web/js/utiles.js"></script>

	<script src="web/js/jquery.easyui.min.js"></script>

	<script src="web/js/jquery.cookie.js"></script>

	<script type="text/javascript">

		$(document).ready(function(){
			alto=$(window).height();
			ancho=$(window).width();
			$('#Contenedor-Body,#Content-Left,#Content-Right').css({'height':alto-50,"min-height":'600px'});
			$('#Content-Right').css({'width':ancho-240});
			
			$(window).trigger('resize');

			var checkCookie = $.cookie("nav-item");
			if (checkCookie != "") {
				$('#nav > li > a:eq('+checkCookie+')').addClass('active').next().show();
			}
			
			$('#nav > li > a').click(function(){
			    var navIndex = $('#nav > li > a').index(this);
				$.cookie("nav-item", navIndex);
				$('#nav li ul').slideUp();
				
				if ($(this).next().is(":visible"))
					$(this).next().slideUp();
				else
					$(this).next().slideToggle();
				
				$('#nav li a').removeClass('active');
				$(this).addClass('active');
			});
		});

		$(window).resize(function(){
			ancho=$(window).width();
			$('#Content-Right').css({'width':ancho-245});
		});
	</script>
</head>
<body>
	<div id="Contenedor-General" >
		<div id="Contenedor-Head" style="">
			<div id="Contenedor-Logo" style="">
				<a href="index.php">
					<div style="display:inline-block">
						<img src="web/image/logo_web.png" width="40px" height="45px">
					</div>
					<div class="name" id="Name-sistema" style="">
						Inter
						<span class="last-name">Files V 1.0</span> 
					</div>					
				</a>
			</div>

			<div id="Contenedor-Center" style="">
				<div id="Informativo" style="">
					<ul style="padding:15px;">
						<li><?php //echo date('Y-m-d') ?></li>
						<li class="Main-son">
							<span class="Icon-Info key"></span>
                           	<a href="#" id="Change-Passw" >Cambiar Clave</a>
                        </li>
					</ul>
				</div>


				<div id="Contenedor-Logout" style="">
					<a href="index.php?controller=Sistema&action=logout"><img src="web/image/logout.png" width="30px"></a>
				</div>
				<div id="Welcome" style="" class="Main-son">
					<div style="display:inline-block">Welcome:</div>
					<div style="display:inline-block;font-weight:bold;"><?php echo $_SESSION['usuario']; ?></div>
				</div>
			</div>
		</div>

		<div id="Contenedor-Body" style="">
			<div id="Content-Left" style="">
				<ul style="border:0px solid black;">
					<li class="side-user hidden-xs">
                        <img class="img-circle" src="web/image/profile-pic.jpg" alt="">
                        <p class="welcome">
                            Conectado como
                        </p>
                        <p class="name" id="Name-User">
                            <?php echo $_SESSION['user'].': '; ?>
                            <span class="last-name"><?php echo $_SESSION['perfil']; ?></span> 
                            <a style="color: inherit" href="index.php?controller=Sistema&action=logout" class="logout_open" href="#logout" >
                            	<img src="web/image/logout.png" width="20px" class="seccion">
                            </a>
                        </p>
                    </li>
				</ul>
                <div id='Contenedor-Menu' >
					<?php echo $obj->menu();  ?>
				</div>
			</div>
			<div id="Content-Right" style="">
                <div id="cCont"><?php echo $content; ?></div>
			</div>
		</div>
	</div>
</body>
</html>