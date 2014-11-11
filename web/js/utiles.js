 
function permite(elEvento, permitidos) {
// Variables que definen los caracteres permitidos

var numeros = "0123456789.,";
var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-/@=?_";
var numeros_caracteres = numeros + caracteres;
var teclas_especiales = [8, 37, 39, 46, 13];
// 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
// Seleccionar los caracteres a partir del parámetro de la función
  switch(permitidos) {
    case 'num':
    permitidos = numeros;
    break;
    case 'texto':
    permitidos = caracteres;
    break;
    case 'all':
    permitidos = numeros_caracteres;
    break;
}
// Obtener la tecla pulsada
var evento = elEvento || window.event;
var codigoCaracter = evento.charCode || evento.keyCode;
var caracter = String.fromCharCode(codigoCaracter);
// Comprobar si la tecla pulsada es alguna de las teclas especiales
// (teclas de borrado y flechas horizontales)
var tecla_especial = false;
for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
    tecla_especial = true;
    break;
  }
}
// Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
// o si es una tecla especial
return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

//Funcion que nos permite escribir una fecha 
//de una manera rapida
function formafecha(campo)
{
	if (campo.value.length==2 || campo.value.length==5)
	{	
		campo.value = campo.value+"/";
		return false;
	}
}

//Funcion que elimina los espacios en blaco o saltos de linea
//al principio de una cadena
function ltrim(s) {
	return s.replace(/^\s+/, "");
}

//Funcion que elimina los espacios en blaco o saltos de linea
//al final de una cadena
function rtrim(s) {
	return s.replace(/\s+$/, "");
}

//Funcion que elimina los espacios en blanco o saltos de linea
//al comienzo y al final de una cadena
function trim(s) {
	return rtrim(ltrim(s));
}

//Funcion que permite, que cuando se preciona enter se vaya
//al siguien campo de texto del formulario
function handleEnter(field, event) {

	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
			if (keyCode == 13) {
				var i;
				for (i = 0; i < field.form.elements.length; i++)
					if (field == field.form.elements[i])
						break;
				i = (i + 1) % field.form.elements.length;
				field.form.elements[i].focus();
				return false;
			} 
			else
			return true;
		}


$(document).ready(function(){
		$("input[type=text],textarea").addClass("ui-corner-all karEll");
		$("select").addClass("ui-corner-all");
		$("select").addClass("ui-widget-content");
        $("<span class='msg' style='float:right;'>"+"*"+"</span>").insertAfter('.required');
		$( ".btn" ).button();
})
refresh=function(controller){
	$('#rightnow').fadeOut('slow').load('index.php?controller='+controller).fadeIn("slow");
}

function addPanel(item,plugin){
	if ($('#tt').tabs('exists',plugin)){
		$('#tt').tabs('select', plugin);
	} else {
		$('#tt').tabs('add',{
			title:plugin,
			content: "<iframe frameborder='0' width='99%' class='Iframe-Load' src='"+$("#url"+item).text()+"' ></iframe>",
							//href:plugin+'.php',
			closable:true,
			extractor:function(data){
				$().attr({});
							//Redimensionar($(window).height(),$(window).width());
							data = $.fn.panel.defaults.extractor(data);
                var tmp = $('<div></div>').html(data);
								data = tmp.find('#content').html();
								tmp.remove();
								return data;
							}
						});
	}
  $(window).trigger('resize');
}

function show5(){
        if (!document.layers&&!document.all&&!document.getElementById)
        return

         var Digital=new Date()
         var hours=Digital.getHours()
         var minutes=Digital.getMinutes()
         var seconds=Digital.getSeconds()

        var dn="PM"
        if (hours<12)
        dn="AM"
        if (hours>12)
        hours=hours-12
        if (hours==0)
        hours=12

         if (minutes<=9)
         minutes="0"+minutes
         if (seconds<=9)
         seconds="0"+seconds
        //change font size here to your desire
        myclock="<font size='3' face='Arial' ><b>"+hours+":"+minutes+":"
         +seconds+" "+dn+"</b></font>"
        if (document.layers){
        document.layers.liveclock.document.write(myclock)
        document.layers.liveclock.document.close()
        }
        else if (document.all)
        liveclock.innerHTML=myclock
        else if (document.getElementById)
        //document.getElementById("liveclock").innerHTML=myclock
    	$('#liveclock').html(myclock);
        setTimeout("show5()",1000)
}
window.onload=show5;

