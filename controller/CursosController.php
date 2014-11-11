<?php

require_once 'lib/Controller.php';
require_once 'lib/View.php';
require_once 'model/Cursos.php';
require_once 'model/v_cursos.php';
require_once 'model/Plancurricular.php';
require_once 'model/Escuelaprofesional.php';
require_once 'model/Facultad.php';


class CursosController extends Controller 
{
    public function Index(){   
        include('config_db.php');
        $obj = new Cursos();
        $obj1 = new Plancurricular();
        $obj2 = new Escuelaprofesional();
        $obj3 = new Facultad();

	    $grilla = new jsGrid();
        $grilla->setCaption("Cursos");
        $grilla->setPager("pgcurso");
        $grilla->setTabla("lscurso");
        $grilla->setSortname("descripcioncurso");
        $grilla->setUrl("index.php?controller=Cursos&action=listaAction");
        $grilla->setWidth(730);
        $grilla->addColumnas("descripcioncurso", "Descripcion",60);
        $grilla->addColumnas("ciclo", "Ciclo",10);
        $grilla->addColumnas("creditos", "Credito",10);
        $grilla->addColumnas("descripcionplan", "Plan Curricular",20);

        //$id =$obj->getmodulo('Perfil');
        //$obj->session($id);
		$data=array();
		$data['grilla']=$grilla->buildJsGrid();
		$data['url'] = $config_db['url'];
        $data['Plancurricular']=$obj1->combo("codigoplan","descripcionplan");
        $data['Escuela']=$obj2->combo("codigoescuela","descripcionescuela");
        $data['Facultad']=$obj3->combo("codigofacultad","descripcionfacultad");
		$data['cabeza'] = self::mycabeza($config_db['url']);
        $view = new View();
        $view->setData($data);
        $view->setTemplate('view/Cursos/_frm.php');
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
        $db->setTabla('v_cursos');//nombre del model
        $db->setParametros($_REQUEST);
        $db->setColumnaId('codigocurso');
        $db->addColumna("descripcioncurso");
        $db->addColumna("ciclo");
        $db->addColumna("creditos");
        $db->addColumna("descripcionplan");
        $db->addWhereAnd('estado=', 'A');
        $db->addWhereAnd('codigofacultad=', '07');
        $db->addWhereAnd('codigosemestre=', '20141');
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
       $obj = new Cursos();
        try{
            
         
			$obj = $obj->getAll()->whereAnd('codigocurso =', $_REQUEST['codigocurso']);
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
