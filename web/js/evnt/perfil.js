$(function(){
   $("#nuevo").bind('click',function(e){
       e.preventDefault();     
        Limpiar();
        AbrirForm();
   });
   $('.target').hide();
   $("#modificar").bind('click',function(e){
        e.preventDefault();
        var indexR = jQuery('#lsperfil').getGridParam("selrow");
        if (indexR != null){
		    $.get("index.php","controller=Perfil&action=edit&idperfil="+indexR,function(data){
    			$( "#idperfil" ).val(data.idperfil);
	           	$( "#perfil" ).val(data.perfil);
				AbrirForm();
			},'json');		
        }else alert("Seleccione un Registro");
   
   })
    $("#eliminar").bind('click',function(e){
        e.preventDefault();
        var indexR = jQuery('#lsperfil').getGridParam("selrow");
        if (indexR != null){
            $.get("index.php","controller=Perfil&action=anular&idperfil="+indexR,function(response){
                jQuery('#lsperfil').trigger('reloadGrid');
			});
	    }else{ alert("Seleccione un Registro");}
	
	});
   $("#form").dialog({
        title:'Formulario de Perfil',
        width:'400px',
        autoOpen:false,
        modal:true,
        buttons:{
            "Guardar":function(){
                    bval = true;  
                    bval = bval && $( "#perfil" ).required();                
                    if(bval){
                        $.post("index.php","controller=Perfil&action=save&"+$("#form").serialize(),function(response){
                            if (response.code && response.code == 'ERROR'){
                                alert(response.message);
                                sms_state('error');
                            }else{
                                Limpiar();
                                sms_state('correct');
                                jQuery('#lsperfil').trigger('reloadGrid');
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

})
 Limpiar = function(){
    //$("input[type=text]").html('');
    $("form :input[type='text']").attr("value",'');
    //$("input[type=text]").attr("value",'');
    $("#form select").val(0);
    $("#idperfil").val(-1);
    $("#form").dialog("close");
            
 }
 AbrirForm=function(){
     $("#load").empty();
     $("#form").dialog("open");
 }
