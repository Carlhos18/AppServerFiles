<?php

require_once 'lib/Controller.php';
require_once 'lib/View.php';
require_once 'model/perfil.php';


class GestionDocenteController extends Controller 
{
    public function Index(){   
        include('config_db.php');

		$data=array();
		$data['url'] = $config_db['url'];
		$data['cabeza'] = self::mycabeza($config_db['url']);

        $view = new View();
        $view->setData($data);
        $view->setTemplate('view/Gestion Docente/_frm.php');
        $view->setLayout( 'template/Sistema.php' );
        $view->render();
    }
	public function mycabeza($url)
    {
		$data=array();
		$data['url'] = $url;
        $view = new View();
		$view->setData($data);
        $view->setTemplate( '_cabeza.php' );
        return $view->renderPartial();
    }

	 public function save(){
        $obj = new Perfil();
       /* foreach ($_REQUEST as $key => $value) {
           $_REQUEST[$key]=  strtoupper($value); 
        }*/
        foreach ($_REQUEST as $key => $value) {
           $_REQUEST[$key]=  ucfirst($value); 
        }
        
        $obj->setFields($_REQUEST);
        $obj->estado = 'A';
        try{
            
            $obj->find($_REQUEST);            
            $obj->setFields($_REQUEST);
            $obj->update();  
        }catch(ORMException $e){
            $obj->create(true);
        }

        print_r (json_encode($obj->getFields()));
    }
    public function Load_Body(){
        include('config_db.php');

        $cadepeta_raiz = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada']; 
        if (isset($_REQUEST['ruta']) && $_REQUEST['ruta']!='') {
            $carpeta = $cadepeta_raiz.DIRECTORY_SEPARATOR.$_REQUEST['ruta'].DIRECTORY_SEPARATOR;
            $ruta=$_REQUEST['ruta']; 
        }else{
            $carpeta = $cadepeta_raiz.DIRECTORY_SEPARATOR;
            $ruta='';
        }

        $cadena = "";
        $cadena_directorio = "";
        $cadena_fichero = "";
        $complement = "width='64' height='64' align='absmiddle' style='width: 64px; height: 64px; margin-top: 7px; margin-bottom: 7px;'";
        $complement1 = "width='94' height='99' align='absmiddle' style='width: 64px; height: 64px; margin-top: 7px; margin-bottom: 7px;'";
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                $item = -1;
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                        if (strlen($archivo)>14) {
                            $name_fichero = substr($archivo, 0, 14);
                            $name_fichero =  $name_fichero.'...';
                        }else{
                            $name_fichero = $archivo;
                        }
                        if (is_dir($carpeta.$archivo)) {//PARA CARPETAS
                            $item++;
                            $string = $ruta.DIRECTORY_SEPARATOR.$archivo;
                            if ($string[0] == DIRECTORY_SEPARATOR) {
                                $id = substr($ruta.DIRECTORY_SEPARATOR.$archivo,1);
                                
                            }else{
                                $id =  $ruta.DIRECTORY_SEPARATOR.$archivo;
                            }
                            $id=str_replace(DIRECTORY_SEPARATOR,'/',$id);
                            $cadena_directorio.="<div id='loader_content'>
								<div class='thumbnail_selectable_cell no_selectable Main-Context-Directory' onContextMenu='ListOption($item);' ondblclick=\"Select_Node('".base64_encode($id)."');\" onclick='Selection($item);' id='case-".$item."' title='".utf8_encode($archivo)."' style='position: relative; width: 94px; height: 99px;cursor:pointer;'>
                                <span style='cursor:default;' >
                                    <img src='web/img/folder.png' ".$complement.">

                                    <div style='cursor:pointer;' class='thumbLabel' ajx-directory='".$ruta.DIRECTORY_SEPARATOR.utf8_encode($archivo)."' ajax-text='directorio' title='".utf8_encode($archivo)."' alt='".utf8_encode($archivo)."'>".utf8_encode($name_fichero)."</div>
                                </span>
                            </div></div>";
                        }else{//PARA IMAGENES

                            $extn = extension($archivo);
                            $new_Archivo = $carpeta.$archivo;
                            $new_Archivo_or = $carpeta.$archivo;
                            $new_Archivo_Prev = $new_Archivo;
                            if ($extn == "jpg" || $extn == "JPG" || $extn == "JPEG" || $extn == "jpeg" || $extn == "png" || $extn == "PNG" || $extn == "gif" || $extn == "GIF" || $extn == "BMP" || $extn == "bmp") {
                                $item++;

                                $new_Archivo=str_replace(DIRECTORY_SEPARATOR,'/',$new_Archivo);
                                $new_Archivo_or=str_replace(DIRECTORY_SEPARATOR,'/',$new_Archivo);

                                $new_Archivo_or = 'L'.base64_encode( $new_Archivo_or ).'CS';

                                $info_width = getimagesize($new_Archivo);
                                
                                $new_Archivo =getImage( $new_Archivo);
                               // echo '----'.$root_new_Archivo;
                                /*$cadena_fichero.="  <div class='thumbnail_selectable_cell no_selectable demo1' ondblclick=\"Preview_View('".$new_Archivo."');\" onclick='Selection($item);' id='case-".$item."' title='".$archivo."' style='position: relative; width: 94px; height: 99px;cursor:pointer;'>*/
                                $cadena_fichero.="    <div class='thumbnail_selectable_cell no_selectable Main-Context Preview_View' onContextMenu='ListOption($item);' onclick='Selection($item);' id='case-".$item."' title='".$archivo."' style='position: relative; width: 94px; height: 99px;cursor:pointer;'>
                                                        <span style='cursor: default;'>
                                                            <div style='height: 51px; width: 69px; display: inline;' class=''>
                                                               <a  class='group1'><img src='$new_Archivo' ajax-href='$new_Archivo_or' align='absmiddle'  style='width: 69px; height: 51px; margin-top: 14px; margin-bottom: 13px;' ajax-title='".$archivo."' ajax-width='$info_width[0]' ajax-height='$info_width[1]'></a>
                                                            </div>
                                                            <div style='cursor:pointer;' class='thumbLabel' ajx-directory='".$ruta.DIRECTORY_SEPARATOR.$archivo."' ajax-text='fichero' title='".$archivo."'>".$name_fichero."</div>
                                                        </span>
                                                    </div>";
                               
                            }else{//PARA OTRAS EXTENCIONES WORD, EXCEL...
                                $item++;
                                $extn_aux = extension($archivo);
                                
                               $imagen=devolver_imagen_ext($extn_aux);
                                if (!file_exists("web/img/".$imagen)) {
                                    $imagen = 'none.png';
                                }
                                    $cadena_fichero.="<div class='thumbnail_selectable_cell no_selectable Main-Context' onContextMenu='ListOption($item);' onclick='Selection($item);' id='case-".$item."' title='".$archivo."' style='width: 94px; height: 99px; position: relative;cursor:pointer;'>
                                    <span style='cursor:default;'' >
                                        <img src='web/img/".$imagen."' ".$complement.">
                                        <div style='cursor:pointer;' class='thumbLabel' ajx-directory='".$ruta.DIRECTORY_SEPARATOR.$archivo."' ajax-text='fichero' title='".$archivo."'>".$name_fichero."</div>
                                    </span>
                                </div>";
                            }
                        }
                    }
                    
                }
                echo $cadena=$cadena_directorio.$cadena_fichero;
                closedir($dir);
            }
        }
    }

    public function Load_Detail_Secnd(){
        include('config_db.php');
    	if (isset($_REQUEST['root'])) {
    		$root = $_REQUEST['root'];
    		$directorio = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$root;
    	}else{
    	}
    	
    	if (strlen($root)>14) {
            $name_fichero = substr($root, 0, 16);
            $name_fichero =  $name_fichero.'...';
        }else{
            $name_fichero = $root;
        }
        if (strlen($_REQUEST['name'])>14) {
            $new_name = substr($_REQUEST['name'], 0, 16);
            $new_name =  $new_name.'..';
        }else{
            $new_name = $_REQUEST['name'];
        }

        if (file_exists($directorio) && filetype($directorio)=="file"){
            $size = formatSizeUnits(filesize($directorio))."<br>";
            $extn = extension($root);
            if ($extn == "jpg" || $extn == "JPG" || $extn == "JPEG" || $extn == "jpeg" || $extn == "png" || $extn == "PNG" || $extn == "gif" || $extn == "GIF" || $extn == "BMP" || $extn == "bmp") {
                $root=str_replace(DIRECTORY_SEPARATOR,'/',$root);
                $new_Archivo =getImage( 'view'.$config_db['ruta']."{$_SESSION['ruta_asignada']}/".$root );
                echo "  <div class='folderImage infoPanelImagePreview'>
                            <img src='".$new_Archivo."' height='64' width='64'>
                        </div>";
            }else{
                $imagen=devolver_imagen_ext($extn);

				if (!file_exists("web/img/".$imagen)) {
                    $imagen = 'none.png';
                }
                echo "  <div class='folderImage infoPanelImagePreview'>
                            <img src='web/img/".$imagen."' height='64' width='64'>
                        </div>";
            }
            echo "  
                    <div class='panelHeader infoPanelGroup' style='font-size:11px;'>Informaci&oacute;n de archivo</div>
                    <table class='infoPanelTable' cellspacing='0' border='0' cellpadding='0'>
                        <tbody>
                            <tr>
                                <td class='infoPanelLabel'>Nombre</td>
                                <td class='infoPanelValue' title='".$root."' style='cursor:pointer'>".$new_name."</td>
                            </tr>
                            <tr>
                                <td class='infoPanelLabel'>Ultima Modificaci&oacute;n</td>
                                <td class='infoPanelValue'>".date("d/m/Y H:i:s.",filemtime($directorio))."</td>
                            </tr>

                            <tr >
                                <td class='infoPanelLabel'>Tama&ntilde;o</td>
                                <td class='infoPanelValue'>".$size."</td>
                            </tr>

                            <tr >
                                <td class='infoPanelLabel'>Tipo</td>
                                <td class='infoPanelValue'>Archivo ".extension($directorio)."</td>
                            </tr>
                        </tbody>
                    </table>";
        }else{
            if ($name_fichero == '/') {
                $name_fichero = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'];//CAMBIAR AL NOMBRE DE LA CARPETA PADRE
    		}
            echo "  <div class='folderImage infoPanelImagePreview'>
                        <img src='web/img/folder.png' height='64' width='64'>
                    </div>
                    <div class='panelHeader infoPanelGroup' style='font-size:11px'>Informaci&oacute;n de carpeta</div>
                    <table class='infoPanelTable' cellspacing='0' border='0' cellpadding='0'>
                        <tbody>
                            <tr>
                                <td class='infoPanelLabel'>Nombre</td>
                                <td class='infoPanelValue'>".$new_name."</td>
                            </tr>
                            <tr class='even'>
                                <td class='infoPanelLabel'>Ultima Modificaci&oacute;n</td>
                                <td class='infoPanelValue'>".date("d/m/Y H:i:s.",filemtime( utf8_decode($directorio) ))."</td>
                            </tr>
                        </tbody>
                     </table>";
        }   
    }

    public function Load_tree(){
        include('config_db.php');
    	if (!isset($_REQUEST['root'])) {
			$ruta=DIRECTORY_SEPARATOR;
		}else{
			$ruta=DIRECTORY_SEPARATOR.$_REQUEST['root'].DIRECTORY_SEPARATOR;
		}

        //$carpeta = 'Mis Archivos'.$ruta;
		$carpeta = 'view'.$config_db['ruta'].DIRECTORY_SEPARATOR.$_SESSION['ruta_asignada'].$ruta;
		//echo $carpeta;
        $cont_ficheros = 0;
        $cont_directorios = 0;
        $peso_total = 0;
        if(is_dir($carpeta)){
            if($dir = opendir($carpeta)){
                $item = -1;
                while(($archivo = readdir($dir)) !== false){
                    if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                        if (is_dir($carpeta.$archivo)) {

                            $item++;
                            $cont_directorios++;
                        }else{
                            $cont_ficheros++;
                            $peso_total = $peso_total + filesize($carpeta.$archivo);
                        }
                    }
                }
                echo "  <table class='infoPanelTable' cellspacing='0' border='0' cellpadding='0'>
                            <tbody>
                                <tr>
                                    <td class='infoPanelLabel'>Carpetas</td>
                                    <td class='infoPanelValue'>".$cont_directorios."</td>
                                </tr>
                            
                                <tr class='even'>
                                        <td class='infoPanelLabel'>Archivos</td>
                                        <td class='infoPanelValue'>".$cont_ficheros."</td>
                                    </tr>
                                    <tr>
                                        <td class='infoPanelLabel'>Tama&ntilde;o combinado: </td>
                                        <td class='infoPanelValue'>".formatSizeUnits($peso_total)."</td>
                                    </tr>
                                </tbody>
                            </table>";
                closedir($dir);
            }
        }
    }

    public function Create_mkdir(){
        include('config_db.php');
        $name_mkdir = base64_decode(  $_REQUEST['directorio'] ) ;

		$ruta = $_REQUEST['ruta'];

		if ($_REQUEST['ruta']=='/') {//CREAMOS EN LA CARPETA RAIZ;
			$directorio = $name_mkdir;
		}else{
			$directorio = $ruta.DIRECTORY_SEPARATOR.$name_mkdir;
		}
        $ruta_mkdir = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$directorio;// PARA CREAR
        $ruta_AUD = $_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$directorio;// PARA CREAR
		
        $cont=validar_nombre($name_mkdir);

		if ($cont>=1) {
			echo "name_invalid";
		}else{			
			if (!file_exists($ruta_mkdir)) {
				mkdir( $ruta_mkdir, 0777, true );
                echo "ok";
                //$obj = new Auditoria();

                //$array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Create','objeto'=>'Directorio','nombre_objeto'=>$name_mkdir,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
                //$obj = $obj->GetParameter($array,'auditoria',"auditoria");
                //AUDITORIA
			}else{
				echo "La Carpeta Ya Existe..";	
			}
		}
	}

	public function Rename_Directorio(){
        include('config_db.php');
		//$name_mkdir = base64_decode( $_REQUEST['directorio'] );
        if (isset($_REQUEST['extension'])) {
            $extension = $_REQUEST['extension'];
        }else{
            $extension ='';
        }
        
        $fast_mkdir = $_REQUEST['fast_directorio'];
        $ruta = $_REQUEST['ruta'];
        $type = $_REQUEST['type'];

		if($type == 'fichero'){
			$name_mkdir =  $_REQUEST['directorio'] ;		
		}else{
			$name_mkdir =  base64_decode( $_REQUEST['directorio'] );					
		}
		
        if ($_REQUEST['ruta']=='/') {//CREAMOS EN LA CARPETA RAIZ;
            $directorio = $name_mkdir;
            $anterior_directorio=$fast_mkdir;
        }else{
            $directorio = $ruta.DIRECTORY_SEPARATOR.$name_mkdir;
            $anterior_directorio=$ruta.DIRECTORY_SEPARATOR.$fast_mkdir;
        }
        $ruta_mkdir = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$anterior_directorio;// PARA RENOIMBRAR FICHERO
        if ($type == 'fichero') {
			$nombre_directorio = $name_mkdir.'.'.$extension;
            $directorio_ruta = $directorio.'.'.$extension;
		}else{
			$nombre_directorio = $name_mkdir;
			$directorio_ruta = $directorio;
        }   
        $ruta_AUD = $_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$anterior_directorio;

		$array = str_split($nombre_directorio);
		$except = array('\\', '/', ':', '*', '?', '"', '<', '>', '|');
		$cont = 0;
		foreach ($array as $value) {
			foreach ($except as $val) {
				if ($value == $val) {
					$cont++;
				}
			}
		}

		if ($cont>=1) {
			echo "name_invalid";
		}else{
			rename($ruta_mkdir, 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$directorio_ruta);
            echo "ok";
            //$obj = new Auditoria();

            //$array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Update','objeto'=>$type,'nombre_objeto'=>$name_mkdir,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
            //$obj = $obj->GetParameter($array,'auditoria',"auditoria");
            //AUDITORIA
		}
	}

	public function Delete_Directorio($recursive=false){
        include('config_db.php');
		$type = $_REQUEST['type'];
		$ruta = $_REQUEST['ruta'];
		$name_mkdir = $_REQUEST['directorio'];
		if ($_REQUEST['ruta']=='/') {//CREAMOS EN LA CARPETA RAIZ;
			$directorio = $name_mkdir;
		}else{
			$directorio = $ruta.DIRECTORY_SEPARATOR.$name_mkdir;
		}
		$ruta_mkdir = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$directorio;// PARA ELIMINAR
        $ruta_AUD = $_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$directorio;
        
        if (file_exists($ruta_mkdir)) {
            if ($type=='directorio') {
                $carpeta = @scandir($ruta_mkdir);

                if (count($carpeta) > 2){                  
                    if ($recursive) {
                        rmdir_recurse($ruta_mkdir);
                        echo 'ok';
                        //$obj = new Auditoria();

                        //$array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Delete','objeto'=>ucwords($type),'nombre_objeto'=>$name_mkdir,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
                        //$obj = $obj->GetParameter($array,'auditoria',"auditoria");
                        //AUDITORIA
				    }else{
				    	echo 'not_permiss';
				    }
				}else{
					rmdir($ruta_mkdir);
                    //$obj = new Auditoria();

                    //$array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Delete','objeto'=>ucwords($type),'nombre_objeto'=>$name_mkdir,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
                    //$obj = $obj->GetParameter($array,'auditoria',"auditoria");
				    echo 'ok';
                    //AUDITORIA
				}
			}
			else{
				unlink($ruta_mkdir);
                //$obj = new Auditoria();

                //$array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Delete','objeto'=>ucwords($type),'nombre_objeto'=>$name_mkdir,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
                //$obj = $obj->GetParameter($array,'auditoria',"auditoria");
				echo "ok";
                //AUDITORIA
			}
			
		}else{
			echo "error";
		}
		
	}

	public function Upload_file(){
        include('config_db.php');
		if (isset($_FILES['archivo'])) {
		    $archivo = $_FILES['archivo'];
			$time = time();
		    $rpta0 = $rpta1 = $rpta2 = '';
		    $files = array();
		    foreach ($_FILES['archivo'] as $k => $l) {
			    foreach ($l as $i => $v) {
			        if (!array_key_exists($i, $files))
			        $files[$i] = array();
			        $files[$i][$k] = $v;
			    }
			}
			
			$fichero = array();

			foreach ($files as $file) {
				$nombre = "{$file['name']}";
				if ($_REQUEST['ruta_subida']=='/') {
					$fichero = $nombre;
				}else{
					$fichero = $_REQUEST['ruta_subida'].DIRECTORY_SEPARATOR.$nombre;
				}
				
                if (file_exists('view'.$config_db['ruta'].$_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$fichero)) {
					echo "<div class='sms_error'>".$nombre." YA EXISTE EN ESTE DIRECTORIO..!!</div>";
				}else{
					/////////////////////VERIFICAMOS SI HAY ESPACIO PARA SEGUIR SUBIENDO
                    /*$asig=ORMConnection::Execute("  SELECT
                                            (area.area ||' - '|| unidad.iddependencia|| area.idunidad || area.idarea || '/' || asignacion.carpeta_raiz || '/' || asignacion.carpeta_asignada) as ruta
                                            FROM asignacion
                                            INNER JOIN area ON
                                            area.idarea= asignacion.idarea
                                            INNER JOIN unidad ON
                                            unidad.idunidad = area.idunidad
                                            WHERE idusuario = '{$_SESSION['id_usuario']}'
                                            ORDER BY asignacion.idasignacion DESC");
                    $ruta_asg=$asig[0]['ruta'];
                    $ruta_seleccionado = 'view'.$config_db['ruta'].$ruta_asg;

                    $files = array();
                    $total = Calculo_total_directorio($ruta_seleccionado, $files);

                    $size_Mb = explode(" ", $total);
                    $tam_carpeta_fisica =  (double)$size_Mb[0];
                    $uni_carpeta_fisica =  $size_Mb[1];


					$size=ORMConnection::Execute("SELECT size,unidad from asignacion WHERE idusuario = '{$_SESSION['id_usuario']}' ORDER BY asignacion.idasignacion DESC");
					$tam=$size[0]['size'];
					$UM=$size[0]['unidad'];

					$tam_carpeta = $tam;
                
					if ($uni_carpeta_fisica == $UM) {//SI AMBOS TIENEN LA MISMA UNIDAD
						if ($tam_carpeta_fisica <$tam_carpeta) {
							$disponible = true;
						}else{
							$disponible = false;
						}
					}else{
						if ($uni_carpeta_fisica == 'KB') {//KB
						   if ($UM == 'MB') {//MB
							   $tam_carpeta = $tam*1024;
						   }else{//GB
								$tam_carpeta = $tam*1024*1024;
						   }
						}else{
							 if ($uni_carpeta_fisica == 'MB') {//MB
								if ($UM == 'KB') {
									$tam_carpeta = $tam/1024;
								}else{//GB
									$tam_carpeta = $tam*1024;
								}
							}else{//GB
								if ($UM == 'KB') {//KB
									$tam_carpeta = $tam*1024*1024*1024;
								}else{//MB
									$tam_carpeta = $tam/(1024*1024*1024);
								}
							}
						}

						if ($tam_carpeta_fisica <$tam_carpeta) {//HAY ESPACIO
                            $disponible = true;							
						
						}else{//NO HAY ESPACIO
                            $disponible = false;
						}
					}*/
					$disponible=true;
                    if ($disponible) {
                        $tmp_name = $file['tmp_name'];
                        if (move_uploaded_file($tmp_name, 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$fichero)) {

                                echo "<div class='sms_success'>".$nombre." SE SUBIO CORRECTAMENTE..!!</div>";
                                $ruta_AUD = $_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$fichero;
                                //AUDITORIA
                                //$obj = new Auditoria();
                                //$array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Upload','objeto'=>'Fichero','nombre_objeto'=>$nombre,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
                                //$obj = $obj->GetParameter($array,'auditoria',"auditoria");
                            } else {
                                echo "<div class='sms_error'> ".$nombre." NO SE SUBIO CORRECTAMENTE..!!</div>";
                                //echo "<div class='sms_error'> "." ERROR..!! ".$file['error']."</div>";
                            }
                    }else{//NO HAY ESPACIO
                            $disponible = false;
                            echo "<div class='sms_error'> USTED YA NO CUENTA CON ESPACIO DISPONIBLE<br>POR FAVOR SOLICITE AL ADMINISTRADOR UNA AMPLIACION DE ESPACIO</div>";
                    }
					/////////////////////VERIFICAMOS SI HAY ESPACIO PARA SEGUIR SUBIENDO
				}
			}

		}else{
			 echo "<div class='sms_error'> NO LLEGARON LOS DATOS</div>";
		}
	}

	public function Filtro(){
        include('config_db.php');
		$files = array();
		$cadena = $_REQUEST['buscar'];

        //$cont = validar_nombre($cadena){
		$array = str_split($cadena);
		$except = array('\\', '/', ':', '*', '?', '"', '<', '>', '|');
		$cont = 0;

		foreach ($array as $value) {
			foreach ($except as $val) {
				if ($value == $val) {
					$cont++;
				}
			}
		}

		if ($cont>=1) {
			echo "Esta ingresando un Caracter No Valido..!!";
		}else{
			search_files('view'.$config_db['ruta'].$_SESSION['ruta_asignada'], $files ,$cadena, $_SESSION['ruta_asignada'] );
			if (count($files)>=1) {
				echo "<div style='overflow:auto;height:auto;'>";
					echo "<table width='100%' >";
						echo "<thead>";
							echo "<tr>";
								echo "<td>Nombre</td>";
								echo "<td>Ruta</td>";
								echo "<td>Size</td>";
							echo "</tr>";
						echo "</thead>";

						echo "<tbody>";
						foreach ($files as $key => $value) {//$peso_total = 0;
                            $peso_total = filesize($key);
                            $name_completo  = $key;
                            $ruta_0 = explode('view'.$config_db['ruta'].$_SESSION['ruta_asignada'], $name_completo);
                            //echo 'ruta:'.$ruta_0[1]; // piece1
							echo "<tr>";
								echo "<td>".$value."</td>";
								echo "<td>".'Principal'.$ruta_0[1]."</td>";
								echo "<td>".formatSizeUnits($peso_total)."</td>";
							echo "</tr>";
						}
						echo "</tbody>";
					echo "</table>";
				echo "</div>";
			}else{
				echo "No results found.";
			}
		}
	}

	public function Download(){
		include('config_db.php');

		$cadepeta_raiz = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'];

		$ruta = $_REQUEST['ruta'];
		$name_mkdir = $_REQUEST['directorio'];
		$type = $_REQUEST['type'];
		if ($ruta != '/') {
			$carpeta = $cadepeta_raiz.DIRECTORY_SEPARATOR.$ruta.'/'; 
		}else{
			$carpeta = $cadepeta_raiz.'/';
		}
		
		if ($type != 'fichero') {
			$folder_solicitado = '';
			$raiz              = $cadepeta_raiz;
			$nombre_archivo    = base64_decode($_REQUEST['directorio']).'.zip';
 
			$reemplazos = array("'","\"");
 
			if ( !isset($_REQUEST['directorio']) )
			{
			    die('No se especific&oacute; un folder');   
			}
 
			$folder_solicitado = base64_decode($_REQUEST['directorio']);
			 
			$folder_solicitado = trim(str_replace($reemplazos, '', $folder_solicitado));
			$folder_solicitado = strip_tags(stripslashes($folder_solicitado));
 
 
			if( strlen($folder_solicitado) == 0 ){
			    die('El folder no es v&aacute;lido');
			}
 
			if (base64_decode($_REQUEST['ruta']) == '/') {
				$ruta_solicitada = $raiz . '/' . $folder_solicitado;
			}else{
				$ruta_solicitada = $raiz . DIRECTORY_SEPARATOR . base64_decode($_REQUEST['ruta']) . DIRECTORY_SEPARATOR .$folder_solicitado;
			}

			$ruta_resuelta = basename(realpath($ruta_solicitada));
			$ruta_AUD = $_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$folder_solicitado;
			 
			if($folder_solicitado != $ruta_resuelta){			 
			    die('La ruta del folder no es v&aacute;lida');
			}
 
			if(!is_dir($ruta_solicitada)){
			    die('El directorio solicitado no existe o no es un directorio v&aacute;lido');  
			 
			}
            $obj = new Auditoria();

            $array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Download','objeto'=>'Directorio','nombre_objeto'=>$nombre_archivo,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
            $obj = $obj->GetParameter($array,'auditoria',"auditoria");

            genera_archivo_comprimido($raiz, $folder_solicitado, $nombre_archivo);
            //AUDITORIA
		}else{

            $ruta = $_REQUEST['ruta'];
            $name_mkdir = $_REQUEST['directorio'];
            $type = $_REQUEST['type'];
            if ($ruta != '/') {
                $carpeta = $cadepeta_raiz.DIRECTORY_SEPARATOR.$ruta.DIRECTORY_SEPARATOR; 
            }else{
                $carpeta = $cadepeta_raiz.DIRECTORY_SEPARATOR;
            }
            $ruta_AUD = $_SESSION['ruta_asignada'].DIRECTORY_SEPARATOR.$ruta;
            $obj = new Auditoria();

            $array = array('idusuario'=>$_SESSION['id_usuario'],'action'=>'Download','objeto'=>$type,'nombre_objeto'=>$name_mkdir,'ruta_objeto'=>$ruta_AUD,'hora_accion'=>date('Y-m-d H:i:s'),'direccion_ip'=>$_SERVER['REMOTE_ADDR'],'direccion_ip_local'=>$_SERVER['SERVER_ADDR']);
            $obj = $obj->GetParameter($array,'auditoria',"auditoria");
        }
	}

    public function PrevImge(){
        echo "<img src='web/test/daisy.jpg'>";
    }

    public function GetOperation(){
        include('config_db.php');
        if(isset($_GET['operation'])) {
            $fs = new fs( 'view'.$config_db['ruta'].'admin');
            //$fs = new fs( 'view'.$config_db['ruta'].$_SESSION['ruta_asignada']);
            try {
                $rslt = null;
                switch($_GET['operation']) {
                    case 'get_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? $_GET['id'] : '/';
                            $node = utf8_encode($node);
                        $rslt = $fs->lst($node, (isset($_GET['id']) && $_GET['id'] === '#'));
                        break;
                    case "get_content":
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? $_GET['id'] : '/';
                        $rslt = $fs->data($node);
                        break;
                    
                    default:
                        throw new Exception('Unsupported operation: ' . $_GET['operation']);
                        break;
                }
                header('Content-Type: application/json; charset=utf8');
                echo json_encode($rslt);
            }
            catch (Exception $e) {
                header($_SERVER["SERVER_PROTOCOL"] . ' 500 Server Error');
                header('Status:  500 Server Error');
                echo $e->getMessage();
            }
            die();
        }
    }
}

class fs{
    protected $base = null;

    protected function real($path) {
        $temp = realpath($path);
        if(!$temp) { throw new Exception('Path does not exist: ' . $path); }
        if($this->base && strlen($this->base)) {
            if(strpos($temp, $this->base) !== 0) { throw new Exception('Path is not inside base ('.$this->base.'): ' . $temp); }
        }
        return $temp;
    }
    protected function path($id) {
        $id = str_replace('/', DIRECTORY_SEPARATOR, $id);
        $id = trim($id, DIRECTORY_SEPARATOR);
        $id = $this->real($this->base . DIRECTORY_SEPARATOR . $id);
        return $id;
    }
    protected function id($path) {
        $path = $this->real($path);
        $path = substr($path, strlen($this->base));
        $path = str_replace(DIRECTORY_SEPARATOR, '/', $path);
        $path = trim($path, '/');
        return strlen($path) ? $path : '/';
    }

    public function __construct($base) {
        $this->base = $this->real($base);
        if(!$this->base) { throw new Exception('Base directory does not exist'); }
    }
    public function lst($id, $with_root = false) {
        $dir = $this->path($id);
        $lst = @scandir($dir);
        if(!$lst) { throw new Exception('Could not list path: ' . $dir); }
        $res = array();
        $xitem=0;
        foreach($lst as $item) {$xitem++;
            if($item == '.' || $item == '..' || $item === null) { continue; }
            $tmp = preg_match('([^ a-zа-я-_0-9.]+)ui', $item);

            if(is_dir($dir . DIRECTORY_SEPARATOR . $item)) {

                //$res[] = array('text' => $name_view, 'children' => true,  'id' =>   $Cod_Directory  , 'icon' => 'folder');
                $res[] = array('text' => utf8_encode($item), 'children' => true,  'id' =>  base64_encode( $this->id( $dir . DIRECTORY_SEPARATOR .$item ) ) , 'icon' => 'folder');
            }
        }
        if($with_root && $this->id($dir) === '/') {
            if ($_SESSION['ruta_asignada']=='default') {
                $Name_aux = 'No Asignado';
            }else{
                $Name_aux = 'Principal';
            }
            //$res = array(array('text' => utf8_encode( $Name_aux), 'children' => $res, 'id' => base64_encode('/'), 'icon'=>'root', 'state' => array('opened' => true, 'disabled' => false)));
        }
        return $res;
    }
    public function data($id) {
        if(strpos($id, ":")) {
            $id = array_map(array($this, 'id'), explode(':', $id));
            return array('type'=>'multiple', 'content'=> 'Multiple selected: ' . implode(' ', $id));
        }
        $dir = $this->path($id);
        if(is_dir($dir)) {
            return array('type'=>'folder', 'content'=> $id);
        }
        
        throw new Exception('Not a valid selection: ' . $dir);
    }

}
?>
