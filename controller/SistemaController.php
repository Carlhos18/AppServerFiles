<?php

require_once 'lib/Controller.php';
require_once 'lib/View.php';
require_once 'model/Sistema.php';
//error_reporting(E_ALL);
class SistemaController extends Controller{
  public function Index(){   
    $data=array();
    $view = new View();
    $view->setData($data);
    $view->setTemplate( 'view/_Index.php' );
    $view->setLayout( 'template/Sistema.php');   
	  echo $view->render(); 
  }

  public function Notifiacion(){   
    $data=array();
		
    $view = new View();
    $view->setData($data);
    $view->setTemplate( 'view/Notificaciones/list_not.php' );
    echo $view->renderPartial();
  } 

  public function menu(){
    $data=array();
  	$obj = new Sistema();
  	print_r($obj->menu_dinamico());
  }

  public function logout(){
    session_destroy();
    echo"<script>window.location='Portal.php';</script>"; 
  }
}
?>
