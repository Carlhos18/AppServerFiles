	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

	<link rel="stylesheet" type="text/css" href="<?php echo $url;?>web/css/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo $url;?>web/css/ui.jqgrid.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $url;?>web/css/principal.css" type="text/css" />

  	<script src="<?php echo $url;?>web/js/jquery-1.8.3.js"></script>
	<script src="<?php echo $url;?>web/js/jquery-ui-1.9.2.custom.min.js"></script>
	
	<script src="<?php echo $url;?>web/js/jquery.ui.datepicker-es.js"></script>
	<script SRC="<?php echo $url;?>web/js/i18n/grid.locale-es.js"></script>
	<script SRC="<?php echo $url;?>web/js/jquery.jqGrid.min.js"></script>
	<script src="<?php echo $url;?>web/js/required.js"></script>

	<script src="<?php echo $url;?>web/js/funciones.js"></script>
	<script src="<?php echo $url;?>web/js/jquery.cookie.js"></script>
	
    <style type="text/css">
    	.msg{font-size: 12px;color: red;font-weight: bold;}
		.negrita{font-weight: bold;}
		.demoHeaders {
			margin-top: 2em;
		}
		#dialog-link {
			padding: .4em 1em .4em 20px;
			text-decoration: none;
			position: relative;
		}
		#dialog-link span.ui-icon {
			margin: 0 5px 0 0;
			position: absolute;
			left: .2em;
			top: 50%;
			margin-top: -8px;
		}
		#icons {
			margin: 0;
			padding: 0;
		}
		#icons li {
			margin: 2px;
			position: relative;
			padding: 4px 0;
			cursor: pointer;
			float: left;
			list-style: none;
		}
		#icons span.ui-icon {
			float: left;
			margin: 0 4px;
		}
		.fakewindowcontain .ui-widget-overlay {
			position: absolute;
		}
		body{font: 62.5% "Trebuchet MS", sans-serif;}
		.radio{border-radius: 50%;background: #ecf0f1;}
		.seccion{border-radius: 0%;background: #ecf0f1;}
    </style>

    <script>
    	$(window).resize(function(){
			ancho=$(window).width();
			$('#Content-Right').css({'width':ancho-245});
		});
    </script>