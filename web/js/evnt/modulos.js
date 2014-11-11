$(function(){
	$('#m_orden').numerico();
   $("#nuevo").bind('click',function(e){
       e.preventDefault();
     
        Limpiar();
        AbrirForm();
   });
   $('.target').hide();
   $("#modificar").bind('click',function(e){
    e.preventDefault();
     var indexR = jQuery('#lsmodulos').getGridParam("selrow");
                    if (indexR != null){
					$.get("index.php","controller=Modulos&action=edit&m_id="+indexR,function(data)
					{
					
					$( "#m_id" ).val(data.m_id);
					$( "#m_id_padre" ).val(data.m_id_padre);
					$( "#m_descripcion" ).val(data.m_descripcion);
					$( "#m_orden" ).val(data.m_orden);
					$( "#m_url" ).val(data.m_url);
					AbrirForm();
					},'json');		
                    }else alert("Seleccione un Registro");
   
   })
   $("#eliminar").bind('click',function(e){
    e.preventDefault();
     var indexR = jQuery('#lsmodulos').getGridParam("selrow");
                    if (indexR != null){
                             $.get("index.php","controller=Modulos&action=anular&m_id="+indexR,function(response){
                                   jQuery('#lsmodulos').trigger('reloadGrid');
							});
	}else{ alert("Seleccione un Registro");}
	
	});
   $("#form").dialog({
        title:'Formulario de Modulos',
        width:'450px',
        autoOpen:false,
        modal:true,
        buttons:{
            "Guardar":function(){
                    bval = true;  
                    bval = bval && $( "#m_descripcion" ).required();                
                    bval = bval && $( "#m_url" ).required();                
                    bval = bval && $( "#m_orden" ).required();                
                    if(bval){
                        $.post("index.php","controller=Modulos&action=save&"+$("#form").serialize(),function(response){                
                          if (response.code && response.code == 'ERROR'){
                                alert(response.message);
                                sms_state('error');
                            }else{
                                Limpiar();
                                sms_state('correct');
                                
                                jQuery('#lsmodulos').trigger('reloadGrid');
                            }

                        },'json');
                    }
                
            },
            "Cancelar":function(){
                Limpiar();
                }
        }
     });
});
$(document).ready(function(){
    $("input[type=text]").css({'width':'300px'});
    $(".num").css({'width':'70px'});
})
 Limpiar = function(){
            $("input[type=text]").attr("value",'');
            $("#form select").val(0);
            $("#m_id").val(-1);
            $("#form").dialog("close");
            
 }
 AbrirForm=function(){
     $("#load").empty();
     $("#form").dialog("open");
 }
