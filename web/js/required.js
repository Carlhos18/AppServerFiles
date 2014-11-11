/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function( $ ){
  $.fn.required = function() {
    if ( $(this).val() == '' ) {
        $(this).addClass('ui-state-error Input-Standar');
        $(this).removeClass('input-focus Input-KarEll TextArea-Standar');
        $(this).focus();
        return false;
    }else {
        $(this).removeClass('ui-state-error');
        $(this).addClass('input-focus');
        return true;
    }
  };

  $.fn.addBack = function (selector) {
    return this.add(selector == null ? this.prevObject : this.prevObject.filter(selector));
  }

  $.fn.file = function () {
    if ( $(this).html() == '' || $(this).html() == 'No file selected' ) {
        $(this).addClass('Error-File');
        $(this).focus();
        return false;
    }else {
        $(this).removeClass('Error-File');
        return true;
    }
  }
	$.fn.required_CarcEs = function() {
		var atributo=$(this).attr("id");
	  	  atributo=atributo.toLowerCase();
			  //alert(atributo);

        //if(atributo=='dni') valor_limit=7;
		    if(/dni/.test(atributo)) valor_limit=7;
        //if(atributo=='nrodoc') valor_limit=7;
		    if(/nrodoc/.test(atributo)) valor_limit=7;
        //if(atributo=='ruc') valor_limit=10;
		    if(/ruc/.test(atributo)) valor_limit=10;
        //if(atributo=='codmatricula') valor_limit=5;
		    if(/codmatricula/.test(atributo)) valor_limit=5;
		    var cant_dig = $(this).val().length;
			  diferencia=(valor_limit+1)-cant_dig;
			//alert(valor_limit);
			  if(diferencia==0){
			 	  $('.sms_'+atributo).fadeOut(300, function(){ 
		   		  $(this).remove();
					});	
			  }
		    if ( $(this).val().length <=valor_limit ) {
			    $(this).addClass('ui-state-error Input-Standar');
          $(this).removeClass('input-focus Input-KarEll TextArea-Standar');
			    $(this).focus();
			//$('.sms_'+atributo).empty().append('Este campo debe tener '+(valor_limit+1)+' caracteres, le falta '+diferencia);
			    $('.sms_'+atributo).remove();
          $("<div class='msg sms_"+atributo+"'>Este campo debe tener "+(valor_limit+1)+" caracteres, le falta "+diferencia+"</div>").insertAfter("#"+atributo);
			    return false;
		    }else {
			    $(this).removeClass('ui-state-error');
          $(this).addClass('input-focus');
			    return true;
		    }	
		   
 	 };
  /*
  //
  //
  */
  $.fn.email=function()
  {
   var filtro=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
     if ( $(this).val() == '' ) {
        $(this).addClass('ui-state-error Input-Standar');
        $(this).removeClass('input-focus Input-KarEll TextArea-Standar');
        $(this).focus();
        return false;
    }else {
      $(this).removeClass('ui-state-error');
      $(this).addClass('input-focus');
		  if (filtro.test($(this).val())){
        $('.msg').fadeOut(300, function(){ 
           //$("#"+atributo).fadeOut(300, function(){ 
            $(this).remove();
        }); 
        return true;
      }else{	     //alert("ingrese un email valido!");
        $(this).addClass('ui-state-error Input-Standar');
        $(this).removeClass('input-focus Input-KarEll TextArea-Standar');
        $('.msg').remove();
        $("<div class='msg '>"+"Ingrese un E-mail Valido"+"</div>").insertAfter(this);
		    $(this).focus();
		    return false;
		  }
    }
  }
})( jQuery );

(function( $ ){
	$.fn.numerico = function() {
		var az = "abcdefghijklmn?opqrstuvwxyz";
		az += az.toUpperCase();
		az += "!@#$%^&*()+=[]\\\';,/{}|\":<>?~`- ";	
		  	
		return this.each (function() {
			$(this).keypress(function (e){
				if (!e.charCode) k = String.fromCharCode(e.which);
				else k = String.fromCharCode(e.charCode);
										
				if (az.indexOf(k) != -1) e.preventDefault();
				if (e.ctrlKey&&k=='v') e.preventDefault();
									
			});
						
			/*$(this).bind('contextmenu',function () {return false});*/
		});	 
	};
})( jQuery );

(function( $ ){
	$.fn.letras = function() {
		var az = "0123456789.,";
		az += az.toUpperCase();
		az += "!@#$%^&*()+=[]\\\';,/{}|\":<>?~`- ";	
		  	
		return this.each (function() {
			$(this).keypress(function (e){
				if (!e.charCode) k = String.fromCharCode(e.which);
				else k = String.fromCharCode(e.charCode);
										
				if (az.indexOf(k) != -1) e.preventDefault();
				if (e.ctrlKey&&k=='v') e.preventDefault();
									
			});
						
			/*$(this).bind('contextmenu',function () {return false});*/
		});	 
	};
})( jQuery );

(function( $ ){
  item=0;
  $.fn.parpadear = function(){
    this.each(function parpadear()
    {
      item++;
      if (item<=5) {
        $(this).fadeIn(500).delay(250).fadeOut(500, parpadear);
      }else{
        $( this ).hide( "clip", {pieces: 16 }, 500 );
        $('.target').html('');
        item=0;
        //$(this).fadeOut('explode');
      }
    });
  }
})( jQuery );

(function( $ ) {
    $.fn.alfanumerico = function(a) {
        a = $.extend({permitir: ""}, a);
        
        var az = "ñÑ!@#$%^&*()+=[]\\\';,/{}|\":<>?~`.-´ºª·¬¿Ç¡¨_ ";
        if(a.permitir != "") {
            s = a.permitir.split('');
            for (i=0;i<s.length;i++) {
                //if (ichars.indexOf(s[i]) != -1) s[i] = "\\" + s[i];
                az = az.replace(s[i],'');
            }
        }
    
        return this.each (function() {
            $(this).keypress(function (e){
                if (!e.charCode) k = String.fromCharCode(e.which);
                else k = String.fromCharCode(e.charCode);
                                        
                if (az.indexOf(k) != -1) e.preventDefault();
                if (e.ctrlKey&&k=='v') e.preventDefault();
                                    
            });
                        
            /*$(this).bind('contextmenu',function () {return false});*/
        });  
    };
})( jQuery );

(function( $ ) {
    $.fn.directorioandfichero = function(a) {
        a = $.extend({permitir: ""}, a);
        
        var az = "ñÑ!#^*=\\\'/|\":<>?~`´ºª·¬¿Ç¡¨";
        if(a.permitir != "") {
            s = a.permitir.split('');
            for (i=0;i<s.length;i++) {
                //if (ichars.indexOf(s[i]) != -1) s[i] = "\\" + s[i];
                az = az.replace(s[i],'');
            }
        }
    
        return this.each (function() {
            $(this).keypress(function (e){
                if (!e.charCode) k = String.fromCharCode(e.which);
                else k = String.fromCharCode(e.charCode);
                                        
                if (az.indexOf(k) != -1) e.preventDefault();
                if (e.ctrlKey&&k=='v') e.preventDefault();
                                    
            });
                        
            /*$(this).bind('contextmenu',function () {return false});*/
        });  
    };
})( jQuery );

var Base64 = {

  // private property
  _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

  // public method for encoding
  encode : function (input) {
    var output = "";
    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
    var i = 0;

    input = Base64._utf8_encode(input);

    while (i < input.length) {

      chr1 = input.charCodeAt(i++);
      chr2 = input.charCodeAt(i++);
      chr3 = input.charCodeAt(i++);

      enc1 = chr1 >> 2;
      enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
      enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
      enc4 = chr3 & 63;

      if (isNaN(chr2)) {
        enc3 = enc4 = 64;
      } else if (isNaN(chr3)) {
        enc4 = 64;
      }

      output = output +
      this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
      this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

    }

    return output;
  },

  // public method for decoding
  decode : function (input) {
    var output = "";
    var chr1, chr2, chr3;
    var enc1, enc2, enc3, enc4;
    var i = 0;

    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

    while (i < input.length) {

      enc1 = this._keyStr.indexOf(input.charAt(i++));
      enc2 = this._keyStr.indexOf(input.charAt(i++));
      enc3 = this._keyStr.indexOf(input.charAt(i++));
      enc4 = this._keyStr.indexOf(input.charAt(i++));

      chr1 = (enc1 << 2) | (enc2 >> 4);
      chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
      chr3 = ((enc3 & 3) << 6) | enc4;

      output = output + String.fromCharCode(chr1);

      if (enc3 != 64) {
        output = output + String.fromCharCode(chr2);
      }
      if (enc4 != 64) {
        output = output + String.fromCharCode(chr3);
      }

    }

    output = Base64._utf8_decode(output);

    return output;

  },

  // private method for UTF-8 encoding
  _utf8_encode : function (string) {
    string = string.replace(/\r\n/g,"\n");
    var utftext = "";

    for (var n = 0; n < string.length; n++) {

      var c = string.charCodeAt(n);

      if (c < 128) {
        utftext += String.fromCharCode(c);
      }
      else if((c > 127) && (c < 2048)) {
        utftext += String.fromCharCode((c >> 6) | 192);
        utftext += String.fromCharCode((c & 63) | 128);
      }
      else {
        utftext += String.fromCharCode((c >> 12) | 224);
        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
        utftext += String.fromCharCode((c & 63) | 128);
      }

    }

    return utftext;
  },

  // private method for UTF-8 decoding
  _utf8_decode : function (utftext) {
    var string = "";
    var i = 0;
    var c = c1 = c2 = 0;

    while ( i < utftext.length ) {

      c = utftext.charCodeAt(i);

      if (c < 128) {
        string += String.fromCharCode(c);
        i++;
      }
      else if((c > 191) && (c < 224)) {
        c2 = utftext.charCodeAt(i+1);
        string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
        i += 2;
      }
      else {
        c2 = utftext.charCodeAt(i+1);
        c3 = utftext.charCodeAt(i+2);
        string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
        i += 3;
      }

    }

    return string;
  }

}

function utf8_encode(argString) {


  if (argString === null || typeof argString === 'undefined') {
    return '';
  }

  var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  var utftext = '',
    start, end, stringl = 0;

  start = end = 0;
  stringl = string.length;
  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;

    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(
        (c1 >> 6) | 192, (c1 & 63) | 128
      );
    } else if ((c1 & 0xF800) != 0xD800) {
      enc = String.fromCharCode(
        (c1 >> 12) | 224, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
      );
    } else { // surrogate pairs
      if ((c1 & 0xFC00) != 0xD800) {
        throw new RangeError('Unmatched trail surrogate at ' + n);
      }
      var c2 = string.charCodeAt(++n);
      if ((c2 & 0xFC00) != 0xDC00) {
        throw new RangeError('Unmatched lead surrogate at ' + (n - 1));
      }
      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(
        (c1 >> 18) | 240, ((c1 >> 12) & 63) | 128, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
      );
    }
    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }
      utftext += enc;
      start = end = n + 1;
    }
  }

  if (end > start) {
    utftext += string.slice(start, stringl);
  }

  return utftext;
}

function utf8_decode(str_data) {
  var tmp_arr = [],
    i = 0,
    ac = 0,
    c1 = 0,
    c2 = 0,
    c3 = 0,
    c4 = 0;

  str_data += '';

  while (i < str_data.length) {
    c1 = str_data.charCodeAt(i);
    if (c1 <= 191) {
      tmp_arr[ac++] = String.fromCharCode(c1);
      i++;
    } else if (c1 <= 223) {
      c2 = str_data.charCodeAt(i + 1);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
      i += 2;
    } else if (c1 <= 239) {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
      i += 3;
    } else {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      c4 = str_data.charCodeAt(i + 3);
      c1 = ((c1 & 7) << 18) | ((c2 & 63) << 12) | ((c3 & 63) << 6) | (c4 & 63);
      c1 -= 0x10000;
      tmp_arr[ac++] = String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF));
      tmp_arr[ac++] = String.fromCharCode(0xDC00 | (c1 & 0x3FF));
      i += 4;
    }
  }

  return tmp_arr.join('');
}