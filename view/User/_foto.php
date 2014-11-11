<?php echo $cabeza;?>
<script type="text/javascript" src="<?php echo $url;?>web/js/login.js"></script>
<script>
$(function()
{
$( "#subir" ).button();
});
</script>

<style>
.#subir p
{
  margin-top:-18px;
  margin-left:15px;
}
.#subir span
{
  margin-left:-5px;
}
.boxex {
    border:1px solid #dadada;
    padding: 3px;
    margin-right: 5px;
    margin-bottom: 2px;    

}
</style>
<fieldset class="ui-widget-content ui-corner-all">
	<form id="form_1" method="post" enctype="multipart/form-data" target="fotoim">
		<input type="hidden" name="controller" value="User" />
			<input type="hidden" name="action" value="save_photo_temp" />
			<input type="hidden" name="usu_id" value="<?php echo $_SESSION['id_usuario'];?>" />
		<table  width="350px" cellspacing="4"cellpadding="0" border="0" >
			<tr>
				<td>
					<label for="archivo" class="required"><input type="file" id="archivo" name="archivo" onchange="uploadImage();"/></label>
				</td>
				<td>
					<div class="boxex" style="float:right; width: 90px; height: 100px;">
						<div id="r_foto">
							<iframe id="fotoim" name="fotoim" src="" style="width:90px; height:100px;" frameborder="0" marginheight="0" marginwidth="0"></iframe>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center" colspan='2'>
					<input type="button" id="subir" value="Subir" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" style="width: 90px; height: 25px;"   tabindex="3" />
				</td>
			</tr>
		</table>
		<span id="load"></span>
	</form><b>
<div id="msg" style="display:none; font-size: 15px;" align="center"></div></b>
<div id="res"></div>
<div id="loader" style="display:none" align="center"><img src="web/images/ajax-loader.gif" /></div>
</div>
</fieldset>