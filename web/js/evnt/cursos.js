$(function(){
    $('select').attr({'disabled':'disabled'});
   $("#nuevo").bind('click',function(e){
       e.preventDefault();     
        Limpiar();
        AbrirForm();
   });
   $('.target').hide();
   $("#modificar").bind('click',function(e){
        e.preventDefault();
        var indexR = jQuery('#lscurso').getGridParam("selrow");
        if (indexR != null){
		    $.get("index.php","controller=Cursos&action=edit&codigocurso="+indexR,function(data){
                $( "#codigocurso" ).val(data.codigocurso);
                $( "#codigoplan" ).val(data.codigoplan);
                $( "#codigoescuela" ).val(data.codigoescuela);
                $( "#codigofacultad" ).val(data.codigofacultad);
                $( "#descripcioncurso" ).val(data.descripcioncurso);
                $( "#creditos" ).val(data.creditos);
                $( "#tipocurso" ).val(data.tipocurso);
                $( "#ciclo" ).val(data.ciclo);
                $( "#codcursosira" ).val(data.codcursosira);
                $( "#ordensegunplan" ).val(data.ordensegunplan);
                $( "#requisitocreditos" ).val(data.requisitocreditos);
                $( "#horasteoria" ).val(data.horasteoria);
    			$( "#horaspractica" ).val(data.horaspractica);
	           	//$( "#perfil" ).val(data.perfil);
				AbrirForm();
			},'json');		
        }else alert("Seleccione un Registro");
   
   })

   $("#form").dialog({
        title:'Formulario de Curso',
        width:'600px',
        autoOpen:false,
        modal:true,
        buttons:{
            "Guardar":function(){
                    bval = true;  
                    bval = bval && $( "#perfil" ).required();                
                    if(bval){
                        $('select').removeAttr('disabled');
                        $.post("index.php","controller=Curso&action=save&"+$("#form").serialize(),function(response){
                            if (response.code && response.code == 'ERROR'){
                                alert(response.message);
                                sms_state('error');
                            }else{
                                Limpiar();
                                sms_state('correct');
                                jQuery('#lscurso').trigger('reloadGrid');
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

})
 Limpiar = function(){
    //$("input[type=text]").html('');
    $("form :input[type='text']").attr("value",'');
    //$("input[type=text]").attr("value",'');
    $("#form select").val(0);
    $("#codigocurso").val(-1);
    $("#form").dialog("close");
            
 }
 AbrirForm=function(){
     $("#load").empty();
     $("#form").dialog("open");
 }
