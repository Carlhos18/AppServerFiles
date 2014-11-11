<?php
require_once 'lib/Controller.php';
require_once 'lib/View.php';

class IndexController extends Controller{
  public function Index(){	  
    $data=array();
	$data['sistema']=0;
    $view = new View();
    $view->setData($data);
    $view->setTemplate( 'view/_Index.php' );
    $view->setLayout( 'template/Layout.php');
    $view->render();  
  }

  public function Fail(){    
    $data=array();
    $data['sistema']=0;
    $view = new View();
    $view->setData($data);
    $view->setTemplate( 'view/_Index.php' );
    $view->setLayout( 'view/Index/Error.php');
    $view->render();
    //echo "LO SIENTO, TU ORDENADOR NO ESTA AUTORIZADO PARA QUE EL SISTEMA FUNCIONE CORRECTAMENTE";
  }

  public function error_404(){
    $data=array();
    $data['sistema']=0;
    $view = new View();
    $view->setData($data);
    $view->setTemplate( 'view/_Index.php' );
    $view->setLayout( 'view/_404.html');
    $view->render(); 
  }
}
?>
