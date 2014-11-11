<?php echo $cabeza;?>
<script type="text/javascript" src="<?php echo $url;?>web/js/evnt/val_login.js"></script>
<script>
$( "#cambiar_clave" ).button();
</script>
<fieldset class="ui-widget-content ui-corner-all">
	<form id="form" name="form"method="post"  action="" enctype="multipart/form-data">
		<table  width="282" cellspacing="4"cellpadding="0" border="0" >
			<tr>
				<td>Clave actual </td>
				<td colspan="2">:&nbsp;<input type="password" id="rsp_pass_1" name="rsp_pass_1"   /></td>
			</tr>
			<tr id="c1">
				<td colspan="3" align="center">
					<a href="javascript:void(0);" onclick="javascript:valida_password()" style="font-size: 12px; color:#669900;text-decoration:none">Validar Password</a>
				</td>
			</tr>
			<tr>
				<td>Nueva clave</td>
				<td colspan="2">:&nbsp;<input  type="password" id="clave" name="clave"    disabled="" /></td>
			</tr>
			<tr>
				<td>Confirme clave</td>
				<td colspan="2">:&nbsp;<input type="password" id="clave2" name="clave2"  disabled="" /></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" align="center">
					<input type="button" id="cambiar_clave" value="Cambiar" onclick="change_password();" style="display:none;"class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" style="width: 90px; height: 23px;"   tabindex="3" />
				</td>
			</tr>
		</table>
	</form><b>
<div id="msg" style="display:none; font-size: 13px;" align="center"></div></b>
<div id="res"></div>
<div id="loader" style="display:none" align="center"><img src="web/images/ajax-loader.gif" /></div>
</fieldset>