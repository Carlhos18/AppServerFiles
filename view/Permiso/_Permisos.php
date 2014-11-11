<?php echo $cabeza;?>
<script>
  $(document).ready(function(){
    $('#cabesera_table').hide();
    $("#idperfil").change(function(){
      vv = $(this).val();
      if(vv!=""){
        $("#result").hide("slow");
        $("#modulos").load("index.php","controller=Permiso&action=Modulos&idperfil="+vv,function(){
	        document.getElementById("modulos").style.display="none";
          $("#modulos,#cabesera_table").slideDown("slow");
        });
      }else {
        $("#result,#modulos,#cabesera_table").hide("slow");                
      }
    });
      
    $("#save").click(function(){
      v = $("#idperfil").val();
      if(v!=""){
        $.each($("input:checkbox"), function(){
          if($(this).attr("checked")){
          }else {
            $(this).attr("checked","checked")
            $(this).val('off');
          }
        });
        str = $("#frmpermisos").serialize();
        $("#result").hide("slow");
        $.post("index.php","controller=Permiso&action=_Save&"+str, function(data){ 
          $("#msg").empty().append(data);
				  setTimeout("window.location='index.php?controller=Permiso'",2000);
			  });
		  }else {
        alert("Porfavor Seleccione un perfil antes de guardar los cambios.");
        $("#idperfil").focus();
      }
    });
	});   
</script>

<div class="page-title">
  <ol class="breadcrumb">
    <li class="active page_title">
      <span class="title_icon">
        <span class="privilegios"></span>
      </span>
      <div class="Titulo">PERMISOS Y PRIVILEGIOS</div>
      
    </li>
  </ol>

  <div class="div_container">
        <div style="padding:10px; float: left; width:550px;">
              <div style='width:200px;float:left'>Seleccione Perfil:</div>
              <div style='width:200px;float:left'><?php echo $perfil;?></div>
              <div style='float:left'><a><button id="save">Guardar Cambios</button></a></div>
        </div>
      
        <div style="clear:both"></div>
        <div id="msg">
            <table align="center" width="750px" >
              <tr  class='ui-widget-header tr-head' style="border-bottom:1px solid #666" id="cabesera_table">
                  <td align="center" width="450px">&nbsp;Modulos</td>
                  <td align="center"><a title="acceder"  ><img src='<?php echo $url;?>web/images/acceder.png' class="radio" style='border: 0'/></a></td>
                  <td align="center"><a title="insertar" ><img src='<?php echo $url;?>web/images/add.png' class="radio" style='border: 0'/></td>
                  <td align="center"><a title="editar"   ><img src='<?php echo $url;?>web/images/edit.png' class="radio" style='border: 0'/></td>
                  <td align="center"><a title="eliminar" ><img src='<?php echo $url;?>web/images/delete.png' class="radio" style='border: 0'/></td>
              </tr>
              <tr>
                <td colspan="5">
                  <div id="modulos" style='clear:both;height: 400px;min-height:400px; width:100%; overflow:auto;'></div>
                </td>
              </tr>
            </table>
        </div>
      </div>
</div>