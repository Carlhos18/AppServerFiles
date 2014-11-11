$(function(){
    $("#nuevo").bind('click',function(e){
       e.preventDefault();
     
        Limpiar();
        AbrirForm();
    });
    $('.target').hide();
    $("#modificar").bind('click',function(e){
    e.preventDefault();
     var indexR = jQuery('#lsusuario').getGridParam("selrow");
                    if (indexR != null){
					$.get("index.php","controller=User&action=edit&idusuario="+indexR,function(data)
					{
					
                    $( "#idusuario" ).val(data.idusuario);
					$( "#idperfil" ).val(data.idperfil);
                    $( "#nombre_usuario" ).val(data.nombre_usuario);
                    $( "#apellidos_usuario" ).val(data.apellidos_usuario);
                    $( "#email_usuario" ).val(data.email_usuario);
                    $( "#telefono_usuario" ).val(data.telefono_usuario);
                    $( "#rpm_usuario" ).val(data.rpm_usuario);
                    $( "#nick_usuario" ).val(data.nick_usuario);
					$( "#clave_usuario" ).val(data.clave_usuario);
					AbrirForm();
					},'json');		
                    }else alert("Seleccione un Registro");
   
    });
    $("#eliminar").bind('click',function(e){
    e.preventDefault();
     var indexR = jQuery('#lsusuario').getGridParam("selrow");
                    if (indexR != null){
                             $.get("index.php","controller=User&action=anular&idusuario="+indexR,function(response){
                                   jQuery('#lsusuario').trigger('reloadGrid');
							});
	}else{ alert("Seleccione un Registro");}
	
	});

    $('#Search').click(function(){
        if ($('#tipouser').required()) {

        };
    })
   $("#form").dialog({
        title:'Formulario de Usuario',
        width:'455px',
        autoOpen:false,
        modal:true,
        buttons:{
            "Guardar":function(){
                    bval = true;  
                    bval = bval && $( "#idperfil" ).required();
		            bval = bval && $( "#nombre_usuario" ).required();         
                    bval = bval && $( "#apellidos_usuario" ).required();
                    bval = bval && $( "#dni" ).required();
                    bval = bval && $( "#email_usuario" ).email();
                    bval = bval && $( "#nick_usuario" ).required();
                    bval = bval && $( "#clave_usuario" ).required();   
                    //bval = bval && $( "#carpeta_raiz" ).required();
                    if(bval){
                        $.post("index.php","controller=User&action=save&"+$("#form").serialize(),function(response){
                                    if (response.code && response.code == 'ERROR'){
                                        alert(response.message);
                                        sms_state('error');
                                    }else{
                                        Limpiar();
                                        sms_state('correct');
                                       jQuery('#lsusuario').trigger('reloadGrid');
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
            $("input[type=text]").attr("value",'');
            $("#form select").val(0);
            $("#usu_id").val(-1);
            $("#form").dialog("close");
            
 }
 AbrirForm=function(){
     $("#load").empty();
     $("#form").dialog("open");
 }
