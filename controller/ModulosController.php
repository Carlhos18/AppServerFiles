<?php

require_once 'lib/Controller.php';
require_once 'lib/View.php';
require_once 'model/Modulos.php';
require_once 'model/v_modulo.php';

class ModulosController extends Controller 
{
    public function Index(){   
        include('config_db.php');
	    $obj=new vista_modulos();

	    $grilla = new jsGrid();
        $grilla->setCaption("Modulos");
        $grilla->setPager("pgmodulos");
        $grilla->setTabla("lsmodulos");
        $grilla->setSortname("padre");
        $grilla->setUrl("index.php?controller=Modulos&action=listaAction");
        $grilla->setWidth(700);
        $grilla->addColumnas("padre", "Padre",40);
        $grilla->addColumnas("m_descripcion", "Descripcion",70);
        $grilla->addColumnas("m_url", "Url",70);
		$data=array();
		$data['grilla']=$grilla->buildJsGrid();
		$data['url'] = $config_db['url'];
		$data['cabeza'] = self::mycabeza($config_db['url']);
		$data['padre']=$obj->combo("m_id_padre","m_descripcion");
        $view = new View();
        $view->setData($data);
        $view->setTemplate('view/Modulos/_frm.php');
        $view->setLayout( 'template/Sistema.php');
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
       // error_reporting($_REQUEST);
            
        $db = new jsGridBdORM();
        $db->setTabla('v_modulo');//nombre del model
        $db->setParametros($_REQUEST);
        $db->setColumnaId('m_id');
        $db->addColumna("padre");
        $db->addColumna("m_descripcion");
        $db->addColumna("m_url");
        $db->addWhereAnd('estado=', 'A');
        echo $db->to_json();
    }
	 public function save(){
        $obj = new Modulos();
       /* foreach ($_REQUEST as $key => $value) {
           $_REQUEST[$key]=  strtoupper($value); 
        }*/
		if($_REQUEST['m_id_padre']==""){$_REQUEST['m_id_padre']=null;}
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
       $obj = new Modulos();
        try{
            
         
			$obj = $obj->getAll()->whereAnd('m_id =', $_REQUEST['m_id']);
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
        $obj = new Modulos();
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
