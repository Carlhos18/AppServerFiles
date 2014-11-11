<!DOCTYPE html>
<html>
<head>
	<title>Principal</title>
	<link href="css/principal.css" rel="stylesheet">
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="js/jquery.cookie.js"></script>

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
				<a href="principal.php">
					<div style="display:inline-block">
						<img src="img/logo_web.png" width="40px" height="45px">
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
						<li>
							<span class="Icon-Info key"></span>
                           	<a href="#" id="Change-Passw" >Cambiar Clave</a>
                        </li>
					</ul>
				</div>


				<div id="Contenedor-Logout" style="">
					<a href="index.html"><img src="img/logout.png" width="30px"></a>
				</div>
				<div id="Welcome" style="">
					<div style="display:inline-block">Welcome:</div>
					<div style="display:inline-block;font-weight:bold;">Llaker Carbajal Saboya</div>
				</div>
			</div>
		</div>

		<div id="Contenedor-Body" style="">
			<div id="Content-Left" style="">
				<ul style="border:0px solid black;">
					<li class="side-user hidden-xs">
                        <img class="img-circle" src="img/profile-pic.jpg" alt="">
                        <p class="welcome">
                            Conectado como
                        </p>
                        <p class="name" id="Name-User">
                            John Salchichon
                            <span class="last-name">Smith</span> 
                            <a style="color: inherit" class="logout_open" href="index.html" ></a>
                        </p>
                    </li>
				</ul>
                
				<div id="Contenedor-Menu" >
					<ul id="nav">
					    <li >
					    	<a href="principal.php" style="background:#2c3e50;">
					    		<span class="Icon-Info home"></span>
					    		<div class="Title-Main" style="">INICIO</div>
					    	</a>
					    	
					    </li>

						<li>
							<a href="#" class="Father">
								<span class="nav_icon assign" style=""></span>
								<div class="Position-Descrp" style="">Asignacion</div>
								<span class="up_down_arrow">&nbsp;</span>
							</a>
							<ul class="acitem">
							    <li><a href="#"><span class="list-icon">&nbsp;</span>Asignar Directorio</a></li>
							</ul>
						</li>

						<li>
							<a href="#" class="Father">
								<span class="nav_icon file" style=""></span>
								<div class="Position-Descrp" style="">Gestion Archivos</div>
								<span class="up_down_arrow">&nbsp;</span>
							</a>
						  	<ul class="acitem">
						    	<li><a href="gestion.php"><span class="list-icon">&nbsp;</span>Gestion Ficheros</a></li>
						  	</ul>
						</li>

						<li>
							<a href="#" class="Father">
								<span class="nav_icon maintenance" style=""></span>
								<div class="Position-Descrp" style="">Mantenimiento</div>
								<span class="up_down_arrow">&nbsp;</span>
							</a>
						  	<ul class="acitem">
						    	<li><a href="#"><span class="list-icon">&nbsp;</span>Sub-Item 3 a</a></li>
								<li><a href="#"><span class="list-icon">&nbsp;</span>Sub-Item 3 b</a></li>
								<li><a href="#"><span class="list-icon">&nbsp;</span>Sub-Item 3 c</a></li>
								<li><a href="#"><span class="list-icon">&nbsp;</span>Sub-Item 3 d</a></li>
						  </ul>
						</li>

						<li>
							<a href="#" class="Father">
								<span class="nav_icon security" style=""></span>
								<div class="Position-Descrp" style="">seguridad</div>
								<span class="up_down_arrow">&nbsp;</span>
							</a>
						  	<ul class="acitem">
						    	<li><a href="#"><span class="list-icon">&nbsp;</span>Usuarios</a></li>
						    	<li><a href="#"><span class="list-icon">&nbsp;</span>Perfil</a></li>
						    	<li><a href="#"><span class="list-icon">&nbsp;</span>Accesos</a></li>
						    	<li><a href="#"><span class="list-icon">&nbsp;</span>Modulos</a></li>
						  	</ul>
						</li>
					</ul>
				</div>
			</div>
			<div id="Content-Right" style="">
                <div id="Contenedor-Modulo" style="border:0px solid red;margin-left:30px;margin-top:10px;">
	                <select>
	                	<option value="">::SELECCIONE CURSO::</option>
	                	<option value="">APRENDIZAJE Y COMUNICACION</option>
	                	<option value="">COMPORTAMIENTO ORGANIZACIONAL</option>
	                	<option value="">ALGORITMOS</option>
	                	<option value="">INTRODUCCION A LA TECNOLOGIA DE INFORMACION</option>
	                	<option value="">MATEMATICA I</option>
	                	<option value="">FISICA APLICADA</option>
	                	<option value="">RECURSOS NATURALES Y MEDIO AMBIENTE</option>
	                </select>
                </div>
			</div>
		</div>
	</div>
</body>
</html>