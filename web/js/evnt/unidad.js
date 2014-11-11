$(function(){    

    $("#nuevo").bind('click',function(e){
        e.preventDefault();
        Limpiar();
        AbrirForm();
    });
    
    $("#modificar").bind('click',function(e){
        e.preventDefault();
        var indexR = jQuery('#lsunidad').getGridParam("selrow");
        if (indexR != null){
			$.get("index.php","controller=Unidad&action=edit&idunidad="+indexR,function(data){
                $( "#idunidad" ).val(data.idunidad);
                $( "#iddependencia" ).val(data.iddependencia);
				$( "#unidad" ).val(data.unidad);
				AbrirForm();
			},'json');		
        }else alert("Seleccione un Registro");
   
   })
   
   $("#eliminar").bind('click',function(e){
    	e.preventDefault();
     	var indexR = jQuery('#lsunidad').getGridParam("selrow");
        if (indexR != null){
            $.get("index.php","controller=Unidad&action=anular&idunidad="+indexR,function(response){
                jQuery('#lsunidad').trigger('reloadGrid');
			});
		}else{ alert("Seleccione un Registro");}
	
	});

   $("#form").dialog({
        title:'Formulario de Unidad',
        width:'700px',
        autoOpen:false,
        modal:true,
        buttons:{
            "Guardar":function(){
                    bval = true;  
                    bval = bval && $( "#iddependencia" ).required();  
                    bval = bval && $( "#unidad" ).required();                
                    if(bval){
                        $.post("index.php","controller=Unidad&action=save&"+$("#form").serialize(),function(response){
                            if (response.code && response.code == 'ERROR'){
                                sms_state('error');
                                alert(response.message);
                            }else{
                                Limpiar();
                                sms_state('correct');
                                jQuery('#lsunidad').trigger('reloadGrid');
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
    $("input[type=text]").css({'width':'400px'});
})
 Limpiar = function(){
            $("input").attr("value",'');
            $("#form select").val(0);
            $("#idunidad").val(-1);
            $("#form").dialog("close");
            
 }
 AbrirForm=function(){
     $("#load").empty();
     $("#form").dialog("open");
 }
/*
    REVISAR:
    New in version 3.4->Autoloading data with scroll
*/