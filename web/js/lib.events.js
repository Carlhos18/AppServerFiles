	AbrirForm=function(){
    	$("#load").empty();
    	$("#form").dialog("open");
 	}

 	AbrirForm_Fich=function(){
    	$("#form_fichero").dialog("open");
 	}

 	AbrirForm_delete = function(){
 		$("#form_delete").dialog("open");
 	}

	Abrir_Upload=function(){
 		$("#form_upload").dialog("open");
 	}

 	Abrir_Inf=function(){
 		$("#form_Inf").dialog("open");
 	}

 	Limpiar = function(){
   		$("#directorio").attr("value",'');
        $("#form").dialog("close");
    }

    Limpiar_fichero = function(){
   		$("#fichero").attr("value",'');
        $("#form_fichero").dialog("close");
    }

    Limpiar_upload = function(){
      	$('.mensajito,#output,#loader-upload').html('');
      	$('.filename').html('No file selected');
       	if ($( '#detalle tbody tr' ).hasClass( "variable" )) {
        		$('#detalle tbody tr.variable').remove();
        }
        item=0;
   		$fileupload = $('#archivo0');  
		$fileupload.replaceWith($fileupload.clone(true));  
        $("#form_upload").dialog("close");
    }

    Selection = function(obj){
    	id_name = "case-" + obj;
    	var numClics = 0;
		var numDobleClics = 0;
    	$("#rename_button,#delete_button,#download_button").removeClass('disabled');
		$.each($(".thumbnail_selectable_cell"),function(i,n){
            if (id_name=='case-'+i) {
                $("#"+id_name).addClass('selected-focus').removeClass('no_selectable');
                Load_Detail_Secnd($("#"+id_name+" span .thumbLabel").attr('ajx-directory'),$("#"+id_name+" span .thumbLabel").attr('title'),$('#controller').val());
                if ($("#"+id_name+" span .thumbLabel").attr('ajax-text') == 'directorio') {
                  	$('img#download_button_icon').attr('src','web/img/accessories-archiver.png');
                    	//$("#rename_button,#delete_button,#download_button").addClass('disabled');
                }else{
                   	$('img#download_button_icon').attr('src','web/img/download_manager.png');
                }
            }else{
           		$("#case-"+i).addClass('no_selectable').removeClass('selected-focus');
            }
         });
   }
		Select_Node = function(id){
			//alert( Base64.decode(id) );
			//$("#tree").jstree("open_node", id);
			//$.jstree.reference('#tree').select_node(id);
			//$("#tree").jstree("open_content", id);
		}
		

        Load_Detail_Secnd = function(root,name_fichero,controller){

			$('#loader').html('<div><center><img src="web/img/ajax-loader(11).gif"/></center></div>');

			if(root == '/'){
	        		dataString	= "controller="+controller+"&action=Load_Detail_Secnd";
	        	}else{
	        		dataString	= "controller="+controller+"&action=Load_Detail_Secnd&root="+root+"&name="+name_fichero;
	        }
			$.ajax({
			  	
			  	type: 'POST',
			  	url: 'index.php',
			  	data: dataString,
			  	success: function(data) {
			    	$('.panelContent').html(data);
			  	},
			  	error: function() {
			    	$('.panelContent').html("HUBO UN PROBLEMA AL MOMENTO DE CARGAR LOS DATOS...!!");
			  	}
			});
        }

        Load_tree = function(root,controller){
        	$('#loader').html('<div><center><img src="web/img/ajax-loader(11).gif"/></center></div>');

        	if(root == '/'){
        		dataString	= "controller=Gestiondocente&action=Load_tree";

	        }else{
	        	dataString	= "controller=Gestiondocente&action=Load_tree&root="+root;
	        }

			$.ajax({
			  	url: 'index.php',
			  	type: 'POST',
			  	data: dataString,
			  	success: function(data) {
			    	$('.panelContent').html(data);
			  	},
			  	error: function() {
			    	$('.panelContent').html("HUBO UN PROBLEMA AL MOMENTO DE CARGAR LOS DATOS...!!");
			  	}
			});

        }

        Load_Body = function(ruta_body,controller){
			
        	$('#loader_content').html('<div><center><img src="web/img/ajax-loader(11).gif"/></center></div>');
	        	if(ruta_body == '/'){
	        		dataString	= "controller=GestionDocente&action=Load_body";
	        	}else{
	        		dataString	= "controller=GestionDocente&action=Load_body&ruta="+ruta_body;
	        	}
			$.ajax({
			  	url : 'index.php',
			  	data : dataString,
			  	type: 'POST',
			  	success: function(data) {
			    	$('#Content-Reload').html(data);
			  	},
			  	error: function() {
			    	$('#Content-Reload').html("HUBO UN PROBLEMA AL MOMENTO DE CARGAR LOS DATOS...!!");
			  	}
			});
        }

        Load_subdirectorio = function(obj){

        }

        Upload = function() {
            //console.log("submit event");
			$('#loader-upload').html('<center><div><img src="web/img/ajax-loader(11).gif"/></div></center>');
            var fd = new FormData(document.getElementById("form_upload"));
            //fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "index.php",
              type: "POST",
              data: fd,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                console.log("PHP Output:");
                console.log( data );
				$("#loader-upload").fadeOut();
                $('#output').append(data);
                setTimeout(function() {
                	Limpiar_upload();
				}, 5000);
               
                $('.filename').html('No file selected').removeClass('Error-File');
                Load_Body($('#ruta_auxiliar').val());
				Load_tree($('#ruta_auxiliar').val());
				$("#rename_button,#delete_button,#download_button").addClass('disabled');
                Espacio_Ocupado();
            });
            return false;
        }

        addDetalle=function(){
			xxitem=xitem=1;
			Cont_item=cont_reg=1;
			band=1;
			reset_item=1;
		  	limite_subida = 5;
		  	bval1=true;

			 $.each($(".dato"),function(i,n){
			    cont_reg++;
			});
		 
			if (cont_reg>1) {
		    	bval1 = bval1 && $( "#filename" +  item ).file();
		  	}
		 
		  if (bval1) {
		    if (cont_reg<=limite_subida) {
		      item++;

		      cadena = "<tr class='dato variable' id='item"+item+"'>";
		        cadena = cadena + "<td>"+"<div class='Upload'><input class='Input-KarEll' type='file' onchange='control(this,"+item+")' name='archivo[]' id='archivo"+item+"' />"+"<span class='filename' id='filename"+item+"'>No file selected</span><span class='action'>Choose File</span></div>"+"</div>"+"</td>";
		        cadena = cadena + "<td>"+"<center><div class='ui-pg-div'><a style='cursor:pointer' onclick='borrar("+item+");'><span class='ui-icon ui-icon-trash'></span></a></div></center>"+"</td>";
		      cadena =  cadena + "</tr>";

		        $("#detalle tbody").append(cadena);
		        $("#Cant_Fichero").val(cont_reg);
		    }else{
		   		$(".mensajito").html("<div class='msg mensajito' style='text-align:center'>Solo Puede Agregar "+limite_subida+" Ficheros</div>");
		    }
		  }
		}

		validar_detalle=function(cantidad_r){
			contador=0;
			aux=0;
			valor=0;

		    bval1=true; 
		    bval1 = bval1 && $( "#filename"+cantidad_r ).file();
		    if (bval1) {
		    	valor=1;
		    };

		  return valor;
		}

		control =function(f,item){
		    var ext=[	"jpg",
						"JPG",
						"JPEG",
						"jpeg",
						"png",
						"PNG",
						"gif",
						"GIF",
						"BMP",
						"bmp",
						"rar",
						"zip",
						'tar',
						'gz',
						"js",
						"css",
						"php",
						"html",
						'pdf',
						"exe",
						"ppt",
						"pptx",
						"xml",
						"xls",
						"xmlx",
						"doc",
						"docx",
						"csv",
						'mpp',
						'accdb',
						"sql",
						"SQL",
						"backup",
						"BACKUP",
						"wsf",
						"mp3",
						'wav',
						"mp4",
						"avi",
						"wmv",
						"rmvb",
						'mpeg',
						'mpg',
						'3gp',
						'dwg',
						'txt'
					];
		    var v=f.value.split('.').pop().toLowerCase();
		    for(var i=0,n;n=ext[i];i++){
		        if(n.toLowerCase()==v){
		          $("span#filename"+item).html(f.value.split('\\').pop().toLowerCase());
		          return;
		        }
		    }
		    var t=f.cloneNode(true);
		    t.value='';
		    f.parentNode.replaceChild(t,f);
		    alert('Extensión no válida');
		}

		borrar = function(item){
    		$("#item"+item).fadeOut("slow",function(){
        		$("#item"+item).remove();
    		});
		}

		Espacio_Ocupado = function(){
			//alert($('#iduser').val());
			/*$.post("index.php","controller=Asignacion&action=calculo_size&id_usuario="+$('#iduser').val(),function(data){
				//alert(data);
				console.log(data);
				if (data.ocupado==0 ) {//VACIO
					$("#space,#spaceView").addClass('vacio');
				}else{
					if (data.ocupado<=(data.disponible-1)) {//VACIO
						width_ = parseFloat(data.disponible*200/(data.limite));
						xwidth = 200 - width_;
						if (parseFloat(xwidth)>=0 && xwidth <1) {
							$("#space,#spaceView").addClass('consumido').css('width',2);
						}else{
							$("#space,#spaceView").addClass('consumido').css('width',xwidth);
						}
					}else{
						width_ = parseFloat(data.disponible*200/(data.limite));
						xwidth = 200 - width_;
						if (xwidth>200) {
							$("#space,#spaceView").addClass('lleno').css('width',201);
						}else{
							if (data.disponible >= 0 && data.disponible <=100) {
								$("#space,#spaceView").addClass('lleno').css('width',xwidth);
							}else{
								$("#space,#spaceView").addClass('consumido').css('width',xwidth);
							}
						}
					}
				}

				$('#spc_disponible_UM').html(data.disponible+' MB');
				$('#spc_ocupado_UM').html(data.ocupado+' MB');

				porcentaje_ocupado = (100*data.ocupado)/data.limite;
				porcentaje_ocupado = porcentaje_ocupado.toFixed(2);

				porcentje_disponible = 100 - porcentaje_ocupado;
				porcentje_disponible = porcentje_disponible.toFixed(2);

				$('#spc_disponible_Xc').html(porcentje_disponible+' %');
				$('#spc_ocupado_Xc').html(porcentaje_ocupado+' %');
				$('#TotalSize').html(data.limite+'MB');

				$("#color1").addClass('consumido');
				$("#color2").addClass('lleno');

			},'json');*/
		}
		
		//$(function(){
			Preview_View = function(id){

			}
			
		//})

	ListOption = function($obj){
		Selection($obj);
	}

	Rename_FD = function(){
		if (!$( this ).hasClass( "disabled" )) {
	    			$('#msg').html('');
	    			$('#directorio,#fast_directorio').val($("#"+id_name+" span .thumbLabel").attr('title'));
	    			if (!$( this ).hasClass( "disabled" )) {
	    				if ($("#"+id_name+" span .thumbLabel").attr('ajax-text') != 'directorio') {
	    					str = $('#directorio').val();
						res = str.split("");

						nombre_cadena = '';
						cant_point=0;
						for (x=0;x<res.length;x++){
							if (res[x] == '.') {
								cant_point++;
							}
							
						}
						punto_separacion=0;
						comprobacion=1;
						for (x=0;x<res.length;x++){
							if (res[x] != '.') {
								nombre_cadena =  nombre_cadena + res[x];

							}else{
								comprobacion++;
								if (comprobacion <= cant_point) {
									nombre_cadena =  nombre_cadena + res[x];

								}else{
									punto_separacion = x;
									break;
								}
							}
							
						}
						nombre_ext='';
						for (x=0;x<res.length;x++){
							if (x>punto_separacion) {
								nombre_ext =  nombre_ext + res[x];
							}
							
						}
						$('#fichero').val(nombre_cadena);
						$('#extencion').val(nombre_ext);
						$('#fast_fichero').val($("#"+id_name+" span .thumbLabel").attr('title'));
	    				AbrirForm_Fich();

	    				}else{  					
	    					AbrirForm();
	    				}
	    				$("#rename_button,#delete_button,#download_button").addClass('disabled');
	    			}    				
    			}
	}

	Download = function(){
		if (!$( this ).hasClass( "disabled" )) {
  					$('#directorio').val($("#"+id_name+" span .thumbLabel").attr('title'));					
		            
		            if ($("#"+id_name+" span .thumbLabel").attr('ajax-text')=='directorio') {
		            	str= 'ruta=' + Base64.encode($('#ruta_auxiliar').val());
		            	str+= "&type=" + Base64.encode($("#"+id_name+" span .thumbLabel").attr('ajax-text'));
		            	str+= '&directorio=' + Base64.encode($('#directorio').val());
		            	var url = "index.php?controller=Gestiondocente&action=Download"+'&'+str;
		            	window.location.href=url;
		            }else{
		            	str= 'ruta=' + $('#ruta_auxiliar').val();
		            	str+= "&type="+$("#"+id_name+" span .thumbLabel").attr('ajax-text');
		            	str+= '&directorio=' + $('#directorio').val();
		            	var url = "lib/Download.php?"+str;
		            	$.post("index.php","controller=Gestiondocente&action=Download&"+str);
		            	//var url = "index.php?controller=Administracion&action=Download"+'&'+str;
		            	window.location.href=url;
		            	//alert(url);
		            	//window.open=url;
		            }		            
  				}
	}