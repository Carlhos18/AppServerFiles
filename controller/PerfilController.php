<?php

require_once 'lib/Controller.php';
require_once 'lib/View.php';
require_once 'model/perfil.php';


class PerfilController extends Controller 
{
    public function Index(){   
        include('config_db.php');
        $obj = new Perfil();

	    $grilla = new jsGrid();
        $grilla->setCaption("Perfil");
        $grilla->setPager("pgperfil");
        $grilla->setTabla("lsperfil");
        $grilla->setSortname("perfil");
        $grilla->setUrl("index.php?controller=Perfil&action=listaAction");
        $grilla->setWidth(730);
        $grilla->addColumnas("perfil", "Descripcion");

        $id =$obj->getmodulo('Perfil');
        $obj->session($id);
		$data=array();
		$data['grilla']=$grilla->buildJsGrid();
		$data['url'] = $config_db['url'];
		$data['cabeza'] = self::mycabeza($config_db['url']);
        $view = new View();
        $view->setData($data);
        $view->setTemplate('view/Perfil/_frm.php');
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
	public function listaAction(){
        //error_reporting($_REQUEST);
            
        $db = new jsGridBdORM();
        $db->setTabla('perfil');//nombre del model
        $db->setParametros($_REQUEST);
        $db->setColumnaId('idperfil');
        $db->addColumna("perfil");
        $db->addWhereAnd('estado=', 'A');
        echo $db->to_json();
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
    public function edit(){
       $obj = new Perfil();
        try{
            
         
			$obj = $obj->getAll()->whereAnd('idperfil =', $_REQUEST['idperfil']);
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
        $obj = new Perfil();
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
