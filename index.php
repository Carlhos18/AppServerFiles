<?php 
  session_start();
  
  include_once("lib/jsgrid/funciones.php");
  include_once("lib/jsgrid/JSON.php");
  include_once("lib/jsgrid/jsgrid.php");
  include_once("lib/jsgrid/jsgridbd.php");
  include_once("lib/jsgrid/jsgridbdORM.php");
  include_once("lib/jsgrid/class.phpmailer.php");
  include_once("lib/jsgrid/class.pop3.php");
  include_once("lib/jsgrid/class.smtp.php");
  include_once('lib/funciones.php');
  
  require_once 'lib/FrontController.php';

  if(empty($_SESSION['usuario'])){
    FrontController::Main();
  }else{
    if (empty($_REQUEST['controller'])) {
      $_GET['controller']='Sistema';
    }
    FrontController::Main();
  }        
?>
