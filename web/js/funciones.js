	$(document).ready(function(){
		
		$("#nuevo").button({icons:{primary:'ui-icon-arrowrefresh-1-s'},text:true}).click(function(e){
					e.preventDefault();
		});

		$("#modificar").button({icons:{primary:'ui-icon-refresh'},text:true}).click(function(e){
					e.preventDefault();
		});
		
		$("#eliminar").button({icons:{primary:'ui-icon-trash'},text:true}).click(function(e){
					e.preventDefault();
		});
		
		$("#traspaso_red").button({icons:{primary:'ui-icon-transferthick-e-w'},text:true}).click(function(e){
					e.preventDefault();
		});
		
		$("#almacenar").button({icons:{primary:'ui-icon-extlink'},text:true}).click(function(e){
					e.preventDefault();
		});
		
		$("#atras").button({icons:{primary:'ui-icon-arrowthick-1-w'},text:true}).click(function(e){
					e.preventDefault();
		});

		$("#pagar").button({icons:{primary:'ui-icon ui-icon-circle-check'},text:true}).click(function(e){
					e.preventDefault();
		});
		
		$("#print").button({icons:{primary:'ui-icon ui-icon-print'},text:true}).click(function(e){
					e.preventDefault();
		});

		$("#aceptar").button({icons:{primary:'ui-icon ui-icon-check'},text:true}).click(function(e){
					e.preventDefault();
		});

		$("#devolver").button({icons:{primary:'ui-icon ui-icon-closethick'},text:true}).click(function(e){
					e.preventDefault();
		});

		$("#save").button({icons:{primary:'ui-icon ui-icon-disk'},text:true}).click(function(e){
					e.preventDefault();
		});

		$(".search_botom").button({icons:{primary:'ui-icon ui-icon-search'},text:false}).click(function(e){
			e.preventDefault();
		});

		$("#mkdir").button({icons:{primary:'ui-icon ui-icon-folder-collapsed'},text:false}).click(function(e){
			e.preventDefault();
		});

		$("#addSpace").button({icons:{primary:'ui-icon ui-icon-newwin'},text:true}).click(function(e){
			e.preventDefault();
			
		});		
	});

	sms_state=function(state){
		if (state=='error') {
			$('.target').css('background','#f2dede');
            $('.target').html('Hubo un Error Al Grabar Los Datos');
        }else{
			//$('.target').css('background','#428bca');
			//$("<div class='target'>Los Datos Se Grabaron Correctamente</div>").insertAfter(".state");
            //$('.target').html('Los Datos Se Grabaron Correctamente');
            $('#state').empty().append("<div class='target' style='background:#428bca'>Los Datos Se Grabaron Correctamente</div>");
            setTimeout(function(){ 
            	$(".target").fadeOut(800).fadeIn(800).fadeOut(500).fadeIn(500).fadeOut(300);
            }, 100); 
            //$('#state').empty().append("<div class='target' style='background:#428bca'>Los Datos Se Grabaron Correctamente</div>");
		}
        //$( ".target" ).parpadear();
	}

	Loguin_function = function(){
		bval = true;
		bval = bval && $( "#user").required();
		bval = bval && $( "#clave").required();
		if(bval){
        	$("#msg").empty();
			$("#loader").css("display","block");
			str=$("#form-loguin").serialize();  

			$.post("process.php",str,function(data){
				if(data.rep=="1"){
					window.location="index.php?controller=Sistema";
				}else{
					if (data.rep=='0') {
						$("#loader").css("display","none");
						$("#msg").empty().append("<div class='Login-Error'><span class='Icon'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>"+data.msgs+"</div>");
						$("#msg").show("slow");
					}else{
						if (data.rep=='-1') {
							window.location="index.php?controller=Index&action=Fail";
						}else{
							window.location="index.php?controller=Index&action=error_404";
						}
						//window.location=Base64.decode("dmlldy9fNDA0Lmh0bWw=");
					}
				}
			},'json');
		}
	}	