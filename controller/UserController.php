<?php

require_once 'lib/Controller.php';
require_once 'lib/View.php';
require_once 'lib/funciones.php';
require_once 'model/User.php';
require_once 'model/usuario.php';
require_once 'model/perfil.php';
//require_once 'model/Grid.php';

class UserController extends Controller 
{
    
	function login()
	{
		$obj=new  User();
        $obj = $obj->getAll()
                ->whereAnd('nick_usuario =', $_REQUEST['user'])
                ->whereAnd('clave_usuario =', $_REQUEST['clave']);
        
        if ( $obj->count() == 0 ){
            // NO tiene permisos de acceso
           print_r(json_encode(array("rep"=>"0","msgs"=>"Usuario/Clave Incorrecto")));
        }else{
    		$usuario = $obj->get(0);
            $obj = $usuario->getFields();
            $_SESSION['usuario'] = $obj['nombre_usuario']." ".$obj['apellidos_usuario'];
            $_SESSION['usuario_n'] = $obj['nombre_usuario'];
            $_SESSION['id_usuario']=$obj['idusuario'];
            $_SESSION['id_perfil']=$obj['idperfil'];
            $_SESSION['perfil']=$obj['perfil'];
    	    $_SESSION['user']=$obj['nick_usuario'];
            $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
			
            
            //$_SESSION['ruta_asignada'] = 'default';
            $_SESSION['ruta_asignada'] = 'admin';
            

            if (cont_d_xp('b4qGemajdpd0oA==')>0) {
                $XxXvar_rand_not_found=rand(cont_d_xp('b4qGemajdpd0oA=='), 10);
            }

            if ($XxXvar_rand_not_found) {
                $PropertyAddress = new GetMacAddr(PHP_OS);

                if (ReadLicense('LTGljZW5zZS9rZXkudHh0CS',$PropertyAddress->mac_addr,false) == 1){
                   print_r(json_encode(array("rep"=>"1","msgs"=>"Ok")));
                }
                else{
                    print_r(json_encode(array("rep"=>"-1","msgs"=>"Fail")));
                }
            }else{
                print_r(json_encode(array("rep"=>"2","msgs"=>"")));
            }

         // $_SESSION['foto']=$obj['usu_photo'];
		}
    }


    public function Index()
    {
	    include('config_db.php');
		$grilla = new jsGrid();
        $obj = new perfil();
        $grilla->setCaption("Usuario");
        $grilla->setPager("pgusuario");
        $grilla->setTabla("lsusuario");
        $grilla->setSortname("nombre_usuario");
        $grilla->setUrl("index.php?controller=User&action=listaAction");
        $grilla->setWidth(700);

        $grilla->addColumnas("nombre_usuario", "Nombres",30);
        $grilla->addColumnas("apellidos_usuario", "Apellidos",30);
        $grilla->addColumnas("email_usuario", "E-Mail",20);
        $grilla->addColumnas("nick_usuario", "Nick",20);
		$data=array();
		$data['grilla']=$grilla->buildJsGrid();
		$data['url'] = $config_db['url'];
		$data['cabeza'] = self::mycabeza($config_db['url']);
	    $data['perfil']=$obj->combo("idperfil","perfil");
        $view = new View();
        $view->setData($data);
        $view->setTemplate('view/User/_frm.php');
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

	public function listaAction()
	{
        $db = new jsGridBdORM();
        $db->setTabla('usuario');
        $db->setParametros($_REQUEST);
        $db->setColumnaId('idusuario');
        $db->addColumna("nombre_usuario");
        $db->addColumna("apellidos_usuario");
        $db->addColumna("email_usuario");
        $db->addColumna("nick_usuario");
        $db->addColumna("dni");
        $db->addWhereAnd('estado=', 'A');
        echo $db->to_json();
    }

	public function save(){
        include('config_db.php');
        $obj = new usuario();
       /* foreach ($_REQUEST as $key => $value) {
           $_REQUEST[$key]=  strtoupper($value); 
        }*/
        $obj->setFields($_REQUEST);
        $obj->estado = 'A';
        //$obj->rsp_photo = 'default';
        try{
            
            $obj->find($_REQUEST);            
            $obj->setFields($_REQUEST);
            $obj->update();  
        }catch(ORMException $e){
            $obj->create(true);           
        }

        print_r (json_encode($obj->getFields()));
    }
    public function edit(){
       $obj = new usuario();
        try{
            
         
			$obj = $obj->getAll()->whereAnd('idusuario =', $_REQUEST['idusuario']);
            if ($obj->count() > 0){
			    $obj = $obj->get(0);
                $obj = $obj->getFields();
				 print_r(json_encode($obj));
           } else{
                return null;
            }
        }catch(ORMException $e){
            return null;
        }
		
    }
	 public function anular(){
        $obj = new Usuario();
        try{
            $obj->find($_REQUEST);

            $obj->estado = 'I';

            $obj->update();
        }catch(ORMException $e){

        }

        return $obj->getFields();
    }	
}
?>
