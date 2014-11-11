<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link href="web/css/layout.css" rel="stylesheet">

	<script src="web/js/jquery-1.8.3.js"></script>
	<script src="web/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" src="web/js/required.js"></script>
	<script type="text/javascript" src="web/js/funciones.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
					
			$("#botom_login").click(function()	{
				Loguin_function();	
			});
		});
				
		$(document).keypress(function(e) {
			if(e.which == 13) {
			    Loguin_function();
			}
		});
	</script>
</head>
<body>
	<div id="Contenedor-General">
		<div id="Log">
			<div id="Contenedor-Logo"></div>
			<div id="Contenedor-Loguin">
				<div id="Head-Log">INGRESE SUS DATOS</div>
			</div>
			<div id="Content-Form">
				<form id="form-loguin">
                    <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User" name="user" id="user" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="******" name="clave" id="clave">
                                </div>

                                <br>
                                <a class="btn btn-lg btn-green btn-block" id="botom_login">Sign In</a>
                    </fieldset>
                </form>
                <div id="Content-State">
					<div id="msg"></div>
					<div id='loader' style='display:none;text-align:center;' colspan="2" ><img src="web/image/ajax-loader.gif"></div>
				</div>
			</div>			
		</div>
	</div>
</body>
</html>