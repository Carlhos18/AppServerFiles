$(document).ready(function(){
	$('#directorio,#fast_directorio').directorioandfichero();
	id_aux='';
	$('#msg').html('');
	$('#directorio').css({'width':'100%'});
	$('#content_pane').css({'height':'80%'});
	Espacio_Ocupado();
	Load_tree('/');
	Load_Body('/');
	
	$("#addFichero").button({icons:{primary:'ui-icon-plus'},text:true}).click(function(e){
    	e.preventDefault();
    	addDetalle();
    });

	$("#mkdir_button").bind('click',function(e){
		if (!$( this ).hasClass( "disabled" )) {
    		e.preventDefault();
       		$('#msg').html('');
       		Limpiar();
       		AbrirForm();
		}
	});

    $("#rename_button").click(function(e){
    	Rename_FD();    			
  	});

  	$("#delete_button").click(function(e){
  		if (!$( this ).hasClass( "disabled" )) {
  			AbrirForm_delete();
  		}
  	});

	$('#download_button').click(function(){
		Download();
	});

	$('#upload_button').click(function(){
		if (!$( this ).hasClass( "disabled" )) {
			Limpiar_upload();
			Abrir_Upload();  					
  			$('#ruta_subida').val($('#ruta_auxiliar').val());  					
  		}
	});

	$('#refrescar').click(function(){
		location.reload();
	});

	$('#info').click(function(){
		Abrir_Inf();
	});

  	if ($('#default').val()) {
  		$("#upload_button,#mkdir_button,#rename_button,#delete_button,#download_button").addClass('disabled');
  	}

    $("#form").dialog({
	    title:'Crear / Renombrar',
	    width:'200px',
		autoOpen:false,
		modal:true,
		buttons:{
		    "Guardar":function(){
		        bval = true;  
		        bval = bval && $( "#directorio" ).required();           
		                
		        if(bval){
					if ($('#fast_directorio').val() == '') {
		            	op=0;
		            	action='Create_mkdir';
		            }else{
		            	op=1;
		            	action='Rename_Directorio';
		            }
		            
		            str   = 'directorio=' + Base64.encode($('#directorio').val());
		            str+= '&fast_directorio=' + $('#fast_directorio').val();
		            str+= '&ruta=' + $('#ruta_auxiliar').val();
		            str+= "&op=" + op;
		            str+= "&type="+'Directorio';
		                	//alert(str);
		                	
		            $.post("index.php","controller=Gestiondocente&action="+action+'&'+str,function(data){
		            	if (data=='name_invalid') {
		            		$('#msg').html('Nombre De Carpeta Invalido');
		                			$( "#directorio" ).focus();
		                		}else{
		                			if (data == 'ok') {
		                				$('#msg').html('La Carpeta se Creo Correctamente');
		                				Load_Body($('#ruta_auxiliar').val());
										Limpiar();
										//Tree_Principal();
										$('#tree').jstree('refresh',-1);
		                			}else{
		                				$('#msg').html(data);

		                			}
		                			
		                		}
							});
		                }
		                
		            },
		            "Cancelar":function(){
		                Limpiar();
		            }
        		}
    		});

			$("#form_fichero").dialog({
		        title:'Renombrar Fichero',
		        width:'490px',
		        autoOpen:false,
		        modal:true,
		        buttons:{
		            "Guardar":function(){
		                bval = true;  
		                bval = bval && $( "#directorio" ).required();           
		                
		                if(bval){
		                	if ($('#fast_directorio1').val() == '') {
		                		op=0;
		                	}else{
		                		op=1;
		                	}
		                	str   = 'directorio=' + $('#fichero').val();
		                	str+= '&extension=' + $('#extencion').val();
		                	str+= '&fast_directorio=' + $('#fast_fichero').val();
		                	str+= '&ruta=' + $('#ruta_auxiliar').val();
		                	str+= "&op=" + op;
		                	str+= "&type="+'fichero';
		                	
		                	$.post("index.php","controller=Gestiondocente&action=Rename_Directorio"+'&'+str,function(data){
		                		if (data=='name_invalid') {
		                			$('#msg').html('Nombre De Carpeta Invalido');
		                			$( "#directorio" ).focus();
		                		}else{
		                			if (data == 'ok') {
		                				$('#msg').html('La Carpeta se Creo Correctamente');
		                				Load_Body($('#ruta_auxiliar').val());
										Limpiar_fichero();
		                			}else{
		                				$('#msg').html(data);

		                			}
		                			
		                		}
							});
		                }
		                
		            },
		            "Cancelar":function(){
		                Limpiar_fichero();
		            }
        		}
    		});

			$("#form_upload").dialog({
		        title:'Subir  Ficheros',
		        width:'450px',
		        autoOpen:false,
		        modal:true
    		});

    		$("#form_Inf").dialog({
		        title:'ESPACIO DISPONIBLE',
		        width:'450px',
		        autoOpen:false,
		        modal:true
    		});

			$("#form_delete").dialog({
		        title:'Eliminar',
		        width:'250px',
		        autoOpen:false,
		        modal:true,
		        buttons:{
		            "Eliminar":function(){
		                $('#directorio').val($("#"+id_name+" span .thumbLabel").attr('title'));
						str = 'directorio=' + $('#directorio').val();
			            str+= '&fast_directorio=' + $('#fast_directorio').val();
			            str+= '&ruta=' + $('#ruta_auxiliar').val();
			            str+= "&op=3";
			            str+= "&type="+$("#"+id_name+" span .thumbLabel").attr('ajax-text');

						$.post("index.php","controller=Gestiondocente&action=Delete_Directorio"+'&'+str,function(data){// PARA ELIMINAR
							if (data == 'ok') {
								$("#rename_button,#delete_button,#download_button").addClass('disabled');
								Load_Body($('#ruta_auxiliar').val());
								Load_tree($('#ruta_auxiliar').val());
								//Espacio_Ocupado();
								$("#form_delete").dialog("close");
							}else{
								if(data == 'not_permiss'){
									$('#sms_delete').html('<div class="sms_error"> LA CARPETA NO ESTA VACIA, NO TIENE PERMISO PARA ESTA ACCION..! </div>');	
									setTimeout(function() {
                						Load_tree($('#ruta_auxiliar').val());
										$("#form_delete").dialog("close");
										$('#sms_delete').html('');			
									}, 5000);									
								}
																
							}
							Load_Body($('#ruta_auxiliar').val());

						});
						
		            },
		            "Cancelar":function(){
		                $(this).dialog("close");
		            }
		        }
    		});
    		
			cont_file=0;
    		$('#submit').click(function(){
    			$.each($(".dato"),function(i,n){            		
            		$('#Cant_Fichero').val(i);
          		});
          		cont_file = $('#Cant_Fichero').val();     
            	validar_detalle(cont_file);
              	if (valor==1) {   
              		Upload();
              	}
    		});

    		$('#search_button').click(function(){
    			
    			if ($('#search_txt').val() != '') {
    				$.post("index.php",'controller=Gestiondocente&action=Filtro&buscar='+$('#search_txt').val(),function(response){
    					$('#search_results').show();
    					$('#content_pane').css({'height':'60%'});
    					$('#search_results').html(response);
    				})
    			};
    			
    		});

    		$('#stop_search_button').click(function(){
    			$('#search_txt').val('');
    			$('#search_results').hide();
    			$('#content_pane').css({'height':'80%'});
    		})
		});
