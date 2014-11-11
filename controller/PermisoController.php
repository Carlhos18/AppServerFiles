<?php
require_once 'lib/Controller.php';
require_once 'lib/View.php';
require_once 'model/Permiso.php';
require_once 'model/perfil.php';
class PermisoController extends Controller {

    public function Index(){
        include('config_db.php');
        $obj = new Perfil();
		$data = array();
        $view = new View();
	    $data['url'] = $config_db['url'];
		$data['cabeza'] = self::mycabeza($config_db['url']);
        $data['perfil']=$obj->combo("idperfil","perfil");
        $view->setData( $data );
        $view->setTemplate( 'view/Permiso/_Permisos.php' );
		$view->setLayout( 'template/Sistema.php');
        $view->render();
    }

    public function mycabeza($url){
		$data=array();
		$data['url'] = $url;
        $view = new View();
		$view->setData($data);
        $view->setTemplate( '_cabeza.php' );
        return $view->renderPartial();
    }

    public function Modulos(){
        include('config_db.php');
	    $data = array();
        $obj = new Permiso();
        $data['mod'] = $obj->Modulos($_GET['idperfil']);
        $data['idperfil'] = $_GET['idperfil'];
        $data['url'] = $config_db['url'];
        $view = new View();
        $view->setData($data);        
        $view->setTemplate( 'view/Permiso/_Modulos.php' );
        echo $view->renderPartial();
    }

	public function _Save(){
        try{
            //print_r($_REQUEST['codigo']);
	        foreach($_REQUEST['codigo'] as $key=>$val){
		        if ($_REQUEST['pm_acceder'][$key]=='on')	{$_REQUEST['pm_acceder'][$key]=1;}else{$_REQUEST['pm_acceder'][$key]=0;}
			    if ($_REQUEST['pm_insertar'][$key]=='on')	{$_REQUEST['pm_insertar'][$key]=1;}else{$_REQUEST['pm_insertar'][$key]=0;}
                if ($_REQUEST['pm_modificar'][$key]=='on')	{$_REQUEST['pm_modificar'][$key]=1;}else{$_REQUEST['pm_modificar'][$key]=0;}
                if ($_REQUEST['pm_eliminar'][$key]=='on')	{$_REQUEST['pm_eliminar'][$key]=1;}else{$_REQUEST['pm_eliminar'][$key]=0;}
				$stmt=ORMConnection::Execute(" SELECT sp_permiso ('{$_REQUEST['idperfil']}','{$val}','{$_REQUEST['pm_modificar'][$key]}', '{$_REQUEST['pm_eliminar'][$key]}','{$_REQUEST['pm_insertar'][$key]}','{$_REQUEST['pm_acceder'][$key]}','{$_REQUEST['pm_id'][$key]}' ) ");
               // echo " SELECT sp_permiso ('{$_REQUEST['idperfil']}','{$val}','{$_REQUEST['pm_modificar'][$key]}', '{$_REQUEST['pm_eliminar'][$key]}','{$_REQUEST['pm_insertar'][$key]}','{$_REQUEST['pm_acceder'][$key]}','{$_REQUEST['pm_id'][$key]}' ) "."</br>";
            }
	        print_r("Sus Cambios fueron guardados Correctamente!");
	    }catch(ORMException $e){
            print_r(json_encode(array("rep"=>$e->getMessage())));
      	}
		
    }
}

?>
