<!DOCTYPE html>
<html>
<head>
	<title>Gestor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

	<link rel="stylesheet" type="text/css" href="web/css/managent.css"></link>
	<?php echo $cabeza; ?>

	<link rel="stylesheet" type="text/css" href="web/css/tree.css"></link>
	
	<script src="<?php echo $url;?>web/js/jstree.min.js"></script>
	<script src="<?php echo $url;?>web/js/required.js"></script>
	<script src="<?php echo $url;?>web/js/lib.tree.js"></script>
	<script src="<?php echo $url;?>web/js/funcionalidad.js"></script>
	<script src="<?php echo $url;?>web/js/lib.events.js"></script>
	<script src="<?php echo $url;?>web/js/utiles.js"></script>
	<script src="<?php echo $url;?>web/js/jquery.contextMenu.js"></script>
	<script src="<?php echo $url;?>web/js/jquery.colorbox.js"></script>

	<link rel="stylesheet" href="<?php echo $url;?>web/css/style.min.css" />
	<link href="<?php echo $url;?>web/css/jquery.contextMenu.css" rel="stylesheet" >

	<link rel="stylesheet" href="<?php echo $url;?>web/css/colorbox.css" />
	<script type="text/javascript">
		document.oncontextmenu = function(){return false}
	</script>

	<script type="text/javascript">
		$(function(){
            $.contextMenu({
                selector: '.Main-Context', 
                callback: function(key, options) {
                    if (key=='edit') {
                    	Rename_FD();
                    }else{
                    	if (key=='delete') {
                    		AbrirForm_delete();
                    	}else{
                    		Download();
                    	}
                    }
                    //window.console && console.log(m) || alert(m); 
                },
                items: {
                    "edit": {name: "Renombrar", icon: "edit"},
                    //"sep1": "---------",
                    "delete": {name: "Delete", icon: "delete"},
                    "sep2": "---------",
                    "download": {name: "Download", icon: "download"}
                }
            });

            $.contextMenu({
                selector: '.Main-Context-Directory', 
                callback: function(key, options) {
                    if (key=='edit') {
                    	Rename_FD();
                    }else{
                    	if (key=='delete') {
                    		Rename_FD();
                    	}else{
                    		Download();
                    	}
                    }
                },
                items: {
                    "edit": {name: "Renombrar", icon: "edit"},
                    "delete": {name: "Delete", icon: "delete"},
                    "sep1": "---------",
                    "download-Directory": {name: "Download", icon: "download-Directory"}
                }
            });

            $('.Preview_View').die().live('dblclick', function() {
            	id_name = $(this).attr('id');
            	root = $("#"+id_name+' a img').attr('src');
            	direction = $("#"+id_name+' a img').attr('ajax-href');

            	alto = $("#"+id_name+' a img').attr('ajax-height');
            	title = $("#"+id_name+' a img').attr('ajax-title');
				alto_pantalla = $(window).height();

				xxalto = 'auto';
				
				if (alto >= alto_pantalla) {
					xxalto = alto_pantalla - 20;
				};
				New_Direction = direction.slice(1, -2);
				New_Direction = Base64.decode( New_Direction );

				$.colorbox({href:New_Direction, open:true,width:'auto',height:xxalto,title:title});
				
				return false;
			});

			$('#form').submit(function(){
                return false;
            });
        });
		
		function convertImgToBase64(url, callback, outputFormat){
			var canvas = document.createElement('CANVAS'),
				ctx = canvas.getContext('2d'),
				img = new Image;
			img.crossOrigin = 'Anonymous';
			img.onload = function(){
				var dataURL;
				canvas.height = img.height;
				canvas.width = img.width;
				ctx.drawImage(img, 0, 0);
				dataURL = canvas.toDataURL(outputFormat);
				callback.call(this, dataURL);
				canvas = null; 
			};
			img.src = url;
		}
	</script>
		
</head>
<body style="border:0px solid red;width:auto;">
	<div id="Managenr">
		<div id="Head">
			<div class="Separador">
			</div>
			<div class="Separador">
				<div class="Case">
					<a id="upload_button" >
						<img id="upload_button_icon" src="web/img/yast_backup.png" width="16" height="16" border="0" alt="Subir" title="Subir" >
						<span id="upload_button_label" class="actionbar_button_label">Su<u>b</u>ir</span>
					</a>
				</div>
				<div class="Case">
					<a id="download_button" class="disabled">
						<img id="download_button_icon" src="web/img/download_manager.png" width="16" height="16" border="0" alt="Descargar" title="Descargar" data-action-src="download_manager.png"><span id="download_button_label" class="actionbar_button_label">Descar<u>g</u>ar</span></a>
				</div>
			</div>
			<div class="Separador">
				<div class="Case">
					<a id="mkdir_button" >
						<img src="web/img/folder_new.png" width="16" height="16" border="0" alt="Crear nueva carpeta" title="Crear nueva carpeta" >
						<span id="mkdir_button_label" class="actionbar_button_label">Nueva Car<u>p</u>eta</span>
					</a>
				</div>
				<div class="Case">
					<a id="rename_button" class="disabled">
						<img id="rename_button_icon" src="web/img/applix.png" width="16" height="16" border="0" alt="Renombrar archivo o carpeta seleccionada" title="Renombrar archivo o carpeta seleccionada" >
						<span id="rename_button_label" class="actionbar_button_label">Re<u>n</u>ombrar</span>
					</a>
				</div>

				<div class="Case">
					<a id="delete_button" class="disabled">
						<img id="delete_button_icon" src="web/img/editdelete.png" width="16" height="16" border="0" alt="Borrar archivos seleccionados." title="Borrar archivos seleccionados." >
						<span id="delete_button_label" class="actionbar_button_label"><u>S</u>uprimir</span>
					</a>
				</div>
			</div>
			<div class="Separador">
				<div class="Case">
					<a id="refrescar" >
						<img src="web/img/refresh.png" width="16" height="16" border="0" alt="Refrescar" title="Refrescar" >
						<span id="mkdir_button_label" class="actionbar_button_label">Actualizar</span>
					</a>
				</div>

			</div>

			<div class="Separador " title="Espacio Disponible">
				<div class="Case_static ">
					<a id="info" style="cursor:pointer">
						<img src="web/img/info.png" width="16" height="16" border="0" alt="Espacio Disponible" title="Espacio Disponible" >Espacio Disponible
						<span id="mkdir_button_label" class="actionbar_button_label">
							<div style="width:200px;border-radius:2px;border:2px solid #ddd;height:11px;">
								<input name="space" id="space" style="height:10px;float:left;border:none;margin-left:-1px;border-radius:2px;" disabled="" />
							</div>
						</span>
					</a>
				</div>
				
			</div>
		</div>

		<div id="Cuerpo">
			<div id="Left" style="">
				<div class="Panel" style="background:white">
					<div class="panelHeader panelHeaderWithIcon">
						<img src="web/img/view_tree.png" class="panelHeaderIcon">Carpetas
					</div>
					<div style="height:88%;overflow:auto;boder:0px solid red;overflow-x:hidden">
						<div class="webfx-tree-item Ruta" style="position: relative;">
							<div >
								<div id="tree"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="PanelDetail" style="">
					<div class="panelHeader panelHeaderWithIcon">
						<img src="web/img/file_info.png" class="panelHeaderIcon">Detalles
					</div>
					<div style="" id="info_panel">
						<div class="panelContent">
							<div id="loader"></div>
						</div>
						
						
					</div>
				</div>
			</div>
			<div id="Right" >
				<!-- search panel -->
				<div id="search_container" style="overflow: hidden; top: 0px; width: 100%;border:0px solid red;">
					<div id="search_panel" style='height:90%;'>
						<div class="panelHeader panelHeaderWithIcon no_select_bg">
							<img src="web/img/xmag.png" class="panelHeaderIcon">Buscar
						</div>
						
						<div id="search_form">
							<input style="float:left;width: 174px" id="search_txt" class='campo_input ' name="search_txt" >
								<a id="search_button" title="Buscar en la carpeta actual y en las subcarpetas" class="no_select_bg">
									<img width="16" height="16" align="absmiddle" src="web/img/search.png" border="0">
								</a>

								<a id="stop_search_button" title="Parar la búsqueda" class="disabled no_select_bg">
									<img width="16" height="16" align="absmiddle" src="web/img/fileclose.png" border="0">
								</a>

						</div>
						<div id="search_results"  class="no_select_bg" style="overflow:auto;height:80px;display:none"></div>
					</div>
				</div>


				<div id="content_pane" style="border: 0px solid solid rgb(187, 187, 187);top:4px; width: 96%;margin-top:-5px;height:90% !important;" >
					<div class="panelHeader" style='padding:5px;'>
						<input id='ruta_auxiliar' name='ruta_auxiliar' type='hidden' class='campo_input' style='width:99%;' disabled value='/' />
						<input id='ruta_auxiliar0' name='ruta_auxiliar0' class='campo_input' style='width:99%;' disabled  value='/'/>
					</div>

					<div class="panelHeader">
						<div style="float:right;padding-right:5px;font-size:1px;height:16px;"></div>Directorios
					</div>						
					<div id="filelist_scroller1" style='border:0px solid rgb(187, 187, 187);width:100%;height: 88%;min-height:100px;overflow: auto;'>
						<div style="overflow:auto;padding: 2px 5px; height:85%;" class="selectable_div" id="Content-Reload">
							<div id="loader_content">
								
							</div>
						</div>					
					</div>
				</div>
				
			</div>
		</div>
		
	</div>

	<form id="form" method="post" style="display:none;" >
		<div><label class="required">Nombre de la Carpeta</label></div>
		<input name="directorio" id="directorio" class="campo_input directorio" />
		<input name="fast_directorio" type="hidden" id="fast_directorio" class="campo_input fast_directorio" />
		
		<div class="msg" id="msg"></div>
	</form>

	<form id="form_fichero" method="post" style="display:none;" >
		<div><label class="required">Nombre del Fichero</label></div>
		<input name="fichero" id="fichero" style='width:80%;' class="campo_input fichero" />
		<input name="fast_fichero" type="hidden" id="fast_fichero" class="campo_input fast_directorio" />.
		<input style='display:inline-block;width:15%;' disabled class="campo_input" id='extencion' name='extencion' />
		<div class="msg" id="msg"></div>
	</form>

	<form id='form_delete' style='padding-left: 56px;'>
		<span class="icon-confirm"></span>
		<label>&#191;Est seguro de querer eliminar archivos?</label>
		<label>Esto no tiene Vuelta atr&#225;s..!</label>
		<div id='sms_delete'></div>
	</form>

	<form id="form_upload" name='form_upload' onsubmit="return Upload();" >
		<input type="hidden" name="controller" value="GestionDocente" />
    	<input type="hidden" name="action" value="Upload_file" />
		<table style='border:0px solid red;' width='100%'>
			<tbody>
				<tr>
					<td valign='top'>
						<input name="ruta_subida" id="ruta_subida" type='hidden' class="campo_input" />
						<input type="hidden" name="Cant_Fichero" id="Cant_Fichero" />
						
						<button id="addFichero">ADD+</button>
						<!--<button id="subir_upload">SUBIR</button>-->
						<div style='margin-top:10px;'></div>
						<center>
							<a id='submit' >
								<div class="fakeUploadButton">
									<img src="web/img/yast_backup.png"><br>
									Subir
								</div>
							</a>
						</center>
					</td>
					<td valign='top'>					
						<div id="upload_files_list" class="uploadFilesList droparea">
							<table id='detalle' boder='1' width='100%' >
								
								<tbody>
									<tr class='dato static' id='item0'>
										<td>
											<div class='Upload'>
												<input class='Input-KarEll' type='file' name='archivo[]' id='archivo0' onchange='control(this,0)' />
												<span class='filename' id='filename0'>No file selected</span>
												<span class='action'>Choose File</span>
											</div>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<th>
										<div id='loader-upload'>
											
										</div>
									</th>
								</tfoot>
							</table>
						</div>
					</td>
				</tr>
			</tbody>

			<tfoot>
				<tr>
					<td colspan='2' >
						<div class='mensajito'></div>
						<div id="output">
							
						</div>
					</td>
				</tr>
			</tfoot>
		</table>

	</script>	
	</form>
	
	<form id="form_Inf">
		<span class="actionbar_button_label" style='cursor:default'>
			
			<table border="0" cellpadding="0" align="center" cellspacing="0" width="90%" style='border-left:#0068a7 solid 1px;border-right:#0068a7 solid 1px;border-top:#0068a7 solid 1px;'>
				<thead class="ui-widget-header">
					<th  width="40px" style="border-bottom:#0068a7 solid 1px;" align="left">ESPACIO \ TAMAÑO</th>
					<th style="border-bottom:#0068a7 solid 1px;" align="right">MB</th>
					<th style="border-bottom:#0068a7 solid 1px;" align="right">%</th>
					<th style="border-bottom:#0068a7 solid 1px;" align="right">Color</th>
				</thead>
				<tbody>
					<tr>
						<td><label>Espacio Disponible</label></td>
						<td align="right"><div id='spc_disponible_UM'></div></td>
						<td align="right"><div id='spc_disponible_Xc'></div></td>
						<td align="right"><div id='color1'>&nbsp;</div></td>
					</tr>

					<tr>
						<td><label>Espacio Ocupado</label></td>
						<td align="right"><div id='spc_ocupado_UM'></div></td>
						<td align="right"><div id='spc_ocupado_Xc'></div></td>
						<td align="right"><div id='color2'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
					</tr>
				</tbody>
				<tfoot>
					<th>
						<div style="width:200px;border-radius:2px;border:2px solid #ddd;height:11px;cursor:default">
							<input name="space" class="space" id="space" style="height:10px;float:left;border:none;margin-left:-1px;border-radius:2px;" disabled="" />
						</div>
					</th>
					<th colspan="2">
						Total : <div style="display:inline-block" id='TotalSize'></div>
					</th>
				</tfoot>
			</table>
		</span>
	</form>

	<input type="hidden" id='controller' value="GestionDocente">
</body>
</html>

<?php
	if ($_SESSION['ruta_asignada'] == 'default') {
		echo "<input type='hidden' name='default' id='default' value='{$_SESSION['ruta_asignada']}' />";
	}
	
	//echo date("d-m-Y H:i:s"); 
?>
<input type='hidden' name='iduser' value="<?php echo $_SESSION['id_usuario'] ?>" id="iduser">