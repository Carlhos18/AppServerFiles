<?php
	@session_start();
	include('../config_db.php');
	$cadepeta_raiz = 'view'.$config_db['ruta'].$_SESSION['ruta_asignada'];
	//$cadepeta_raiz = 'Mis Archivos';

	$ruta = $_REQUEST['ruta'];
	$name_mkdir = $_REQUEST['directorio'];
	//$type = 'directorio';
	$type = $_REQUEST['type'];
	if ($ruta != '/') {
		$carpeta = '..'.DIRECTORY_SEPARATOR.$cadepeta_raiz.DIRECTORY_SEPARATOR.$ruta.DIRECTORY_SEPARATOR; 
	}else{
		$carpeta = '..'.DIRECTORY_SEPARATOR.$cadepeta_raiz.DIRECTORY_SEPARATOR;
	}
	//echo $carpeta;
	if ($type == 'fichero') {
		//echo $carpeta.$name_mkdir;
		echo download_file($carpeta.$name_mkdir);
	}else{
		echo 'Error';
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
?>