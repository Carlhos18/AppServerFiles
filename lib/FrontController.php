<?php
	error_reporting(E_ALL);
	class FrontController 
	{
		public static function Main() 
		{
			$controllerDir = "controller/";
			switch ($_SERVER['REQUEST_METHOD']) 
			{
				case 'GET':
				if(!isset($_GET['controller'])){$_GET['controller']="";}
				if(!isset($_GET['action'])){$_GET['action']="";}
					$controller = $_GET['controller'];
					$action = $_GET['action'];
					break;
				case 'POST':
				if(!isset($_GET['controller'])){$_GET['controller']="";}
				if(!isset($_GET['action'])){$_GET['action']="";}
					$controller = $_POST['controller'];
					$action = $_POST['action'];
					break;
				default:
					break;
			}
			if(empty($controller)) 
			{ // Comprobamos si esta vacia, si asi es definimos que por defecto cargue Index
				$controller = "index";
			}
			if(empty($action)) 
			{ // Comprobamos tambien..
				$action = "Index";
			}
			$controller=ucfirst($controller);
			//para validar que el usuario debe de iniciar sesion para acceder al sistema
			if (!isset($_SESSION['usuario']) && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
			{
				
				header('Location: Portal.php');
				
            }else{
            	//header('Location: index.php?controller=Sistema');
            }
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && !isset ($_SESSION['usuario'])   ) 
			{
				header('NOT_AUTHORIZED: 499');
				die();
            }
			// concatena la direccion con el controlador
           
			$controllerFile = $controllerDir . $controller . "Controller.php";
			if(!file_exists($controllerFile)) 
			{ // Si no existe el controlador lanzamos una excepcion
				die( "No se encontro el archivo especificado".$controllerFile );
			}
			else
			{// si no existe la accion lanzamos una excepcion
				require_once $controllerFile;
			}
			$controllerClass = $controller . "Controller";
			if(!class_exists($controllerClass,false)) 
			{ // Si existe el archivo pero no esta la clase lanzamos otra excepcion
				die("El controlador fue cargado pero no se encontro la clase");
			}
			$controllerInst = new $controllerClass();
			if( !is_callable( array( $controllerInst, $action ) ) ) 
			{ // Comprobamos si la accion es posible llamarla
				die( "El controlador no tiene definida la accion $action" );
			} 
			else 
			{
				$controllerInst->$action(); // Llamamos a la accion y dejamos el proceso al controlador
			}
		}
	}
?>
