<?php
	//++EXTENCIONES
	$array=array(
		"jpg",
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
		"xmlx",
		"xls",
		"xlsx",
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
	);
	//include('../config_db.php');
	@session_start();
	$size = 0;
	function fecha_es($fecha){
	  	$dia=substr($fecha,8,2);
	  	$mes=substr($fecha,5,2);
	  	$anio=substr($fecha,0,4);
  
  		return "$dia-$mes-$anio";
  	}
  
 	function fecha_en($fecha){
	  	$dia=substr($fecha,0,2);
	  	$mes=substr($fecha,3,2);
	  	$anio=substr($fecha,6,4);
  
  		return "$anio-$mes-$dia";
  	}

  	function encrypt($string, $key) {
	    $result = '';
	    $key_aux=base64_decode($key);
	    for($i=0; $i<strlen($string); $i++) {

		    $char = substr($string, $i, 1);

		    $keychar = substr($key_aux, ($i % strlen($key_aux))-1, 1);

		    $char = chr(ord($char)+ord($keychar));

		    $result.=$char;

    	}

    	return base64_encode($result);
 	}

  function decrypt($string, $key) {
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
    }
    return $result;
  }

  function cont_d_xp($data){
    $aux=decrypt($data,'ZUF9sDjBktjjDMAIPe54vOZGO0XU1z1q5kLpy0K35Uo=');
    $XyZ__=interval_date(encrypt(date('Y-m-d'),'WlVGOXNEakJrdGpqRE1BSVBlNTR2T1pHTzBYVTF6MXE1a0xweTBLMzVVbz0='),'MjAxNC0xMS0xNQ==');

    if ($XyZ__>0) {
      $XyZ__ = $XyZ__;
    }else{
      $XyZ__ = 'error';
    }
    return $XyZ__;
  }

  function interval_date($init,$finish){
    $init=decrypt($init,'ZUF9sDjBktjjDMAIPe54vOZGO0XU1z1q5kLpy0K35Uo=');
    $finish=base64_decode($finish);
    $diferencia = strtotime($finish) - strtotime($init);

    if($diferencia < 60){
        $tiempo = floor($diferencia);
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo = floor($diferencia/60);
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo = floor($diferencia/3600);
    }else if($diferencia >= 86400 && $diferencia < 2592000){
        $tiempo =floor($diferencia/86400);

    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo = floor($diferencia/2592000);
    }else if($diferencia > 31104000){
        $tiempo = floor($diferencia/31104000);
    }else{
        $tiempo = $diferencia;
    }
    return $tiempo;

  }

  function extension($str){
    return end(explode(".", $str));
  }


  function elements($items, $array, $default = FALSE) {
    $return = array();
    if ( ! is_array($items)){
      $items = array($items);
    }
    foreach ($items as $item){
      if (isset($array[$item])){
        $return[$item] = $array[$item];
      }else{
        $return[$item] = $default;
      }
    }
    return $return;
  }

    function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    function devolver_imagen_ext($ext){
    	global $array;

    	if ( in_array ( $ext , $array ) ) {
    		if ($ext == 'wap' || $ext == 'mp3') {
    			return 'mp3.png';
    		}else{
    			if ($ext == 'mp4' || $ext == 'mpg' || $ext == 'mpeg' || $ext == 'mp4' || $ext == 'rmvb' || $ext == 'avi'  || $ext == '3gp'  || $ext == 'wmv') {
    				return 'video.png';
	    		}else{
	    			if ($ext == 'rar' || $ext == 'zip' || $ext == 'tar' || $ext == 'gz') {
	    				return 'rar.png';
	    			}else{
	    				if ($ext == 'xls' || $ext == 'xlsx' || $ext == 'csv') {
	    					return 'xls.png';
	    				}else{
	    					if ($ext == 'doc' || $ext == 'docx') {
	    						return 'doc.png';
	    					}else{
	    						if ($ext == 'pptx' || $ext == 'ppt') {
	    							return 'ppt.png';
		    					}else{
									if($ext == 'xml')
										return $ext.'.png';		    						
	    							else 
										return $ext.'.png';	
	    							//return $ext.'.png';		    						
		    					}
	    					}
	    				}
	    			}
	    		}
    		}
		} else {
			return 'none.png';
								   // echo 'Does not exist-->'.$name_fichero.'<br>';
		}
    }

    function search_files( $dir , &$files ,$cadena,$ruta_asignada){
	    if (is_dir($dir)){
	        if ($gd = opendir($dir)){
	            while (($file = readdir($gd)) !== false){
	                if ( $file != '.' AND $file != '..'  )
	                {
	                    // ¿ Dir or File ?
	                    if ( is_dir( $dir.'/'.$file ) )
	                    {
	                        search_files( $dir.'/'.$file , $files ,$cadena,$ruta_asignada);
	                    }

	                    if (preg_match('/'.$cadena.'/i', $file)) {
						   $files[ dirname($dir.'/'.$file)."/".$file  ] = $file  ;
						} else {
						  //  echo "No se encontró ninguna coincidencia.";
						}

	                }
	            }
	            closedir($gd);
	        }
	    }
	}

	function Calculo_total_directorio( $dir , &$files ){
		global $size;
	    if (is_dir($dir)){
	        if ($gd = opendir($dir)){
	        	
	            while (($file = readdir($gd)) !== false){
	                if ( $file != '.' AND $file != '..'  ){
	                    if ( is_dir( $dir.'/'.$file ) ){
	                        Calculo_total_directorio( $dir.'/'.$file , $files );
	                    }else{
	                    	$files[ dirname($dir.'/'.$file)."/".$file  ] = $file  ;
						    $size = $size + filesize(dirname($dir.'/'.$file)."/".$file );
	                    }
	                }
	            }
	            return formatSizeUnits($size);
	            closedir($gd);
	        }
	    }
	}

	function download_file($archivo, $downloadfilename = null) {

	    if (file_exists($archivo)) {
	        $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
	        header('Content-Description: File Transfer');
	        header('Content-Type: application/octet-stream');
	        header('Content-Disposition: attachment; filename=' . $downloadfilename);
	        header('Content-Transfer-Encoding: binary');
	        header('Expires: 0');
	        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	        header('Pragma: public');
	        header('Content-Length: ' . filesize($archivo));

	        ob_clean();
	        flush();
	        readfile($archivo);
	        exit;
	    }
	}

	function validar_nombre($cadena){

		$array = str_split($cadena);

		$except = array('\\', '/', ':', '*', '?', '"', '<', '>', '|','#','ñ','Ñ');
		$cont = 0;

		foreach ($array as $value) {
			foreach ($except as $val) {
				if ($value == $val) {
					$cont++;
				}
			}
		}
		return $cont;
	}

	function getImage($file){
      return 'data:image/png;base64,' . base64_encode(file_get_contents($file));
	}

	function getImageEncode($file){
      return base64_encode(file_get_contents($file));
	}
	
	function ReadLicense($Url,$Property,$bool){
		$Url = substr($Url, 1, -2);
		$Url = base64_decode($Url);
		
		if ($bool) {
			if( file_exists ( $Url ) ){
			    $file = fopen($Url, "r");
			    $key = '';
				/*while(!feof($file))
				{
					$key = fgets($file);
					//echo $key;
				}*/

				$fichero = fopen($Url,"r");
				while ( ($xxx = fgets($fichero)) !== false) {
					$key=$xxx;
				}

				if ( $Property == substr($key, 2, -3) )
					return 1;
				else
					return 0;

			}else{
				return 0;
			}
			//fclose($file);			
		}else{
			return 1;
		}
	}

	class GetMacAddr{
     
            var $return_array = array(); //
            var $mac_addr;
     
            function GetMacAddr($os_type){
                 switch ( strtolower($os_type) ){
                          case "linux":
                                    $this->forLinux();
                                    break;
                          case "solaris":
                                    break;
                          case "unix":
                                     break;
                           case "aix":
                                     break;
                           default:
                                     $this->forWindows();
                            break;
     
                  }
     
                  $temp_array = array();
                  foreach ( $this->return_array as $value ){
     
                            if (preg_match("/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i",$value,$temp_array ) ){
                                     $this->mac_addr = $temp_array[0];
                                     break;
                           }
     
                  }
                  unset($temp_array);
                  return $this->mac_addr;
             }
     
             function forWindows(){
                  @exec("ipconfig /all", $this->return_array);
                  if ( $this->return_array )
                           return $this->return_array;
                  else{
                           $ipconfig = $_SERVER["WINDIR"]."\system32\ipconfig.exe";
                           if ( is_file($ipconfig) )
                              @exec($ipconfig." /all", $this->return_array);
                           else
                              @exec($_SERVER["WINDIR"]."\system\ipconfig.exe /all", $this->return_array);
                           return $this->return_array;
                  }
             }
     
             function forLinux(){
                  @exec("ifconfig -a", $this->return_array);
                  return $this->return_array;
             }
     
    }
?>