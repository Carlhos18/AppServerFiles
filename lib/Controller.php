<?php

//require_once '../model/Main.php';
class Controller  {
    public function  __call($name, $arguments) {
        die("Error! El metodo {$name}  no esta definido.");
    }
    public function Select($p) {
        $data=array();
        $data['rows'] = $p['rows'];
        $data['name'] = $p['name'];
        $data['id'] = $p['id'];
       $data['code'] = $p['code'];
        $view = new View();

        $view->setData( $data );

        $view->setTemplate( 'view/_Select.php' );

        return $view->renderPartial();
    }


    public function Select_ajax($p) {
 

        $data = array();
        $data['rows'] = $p['rows'];
        $data['name'] = $p['name'];
        $data['id'] = $p['id'];
        $data['code'] = $p['code'];         
	    $view = new View();
        $view->setData( $data );
        $view->setTemplate( 'view/_Select_ajax.php' );
        return $view->renderPartial();
    }

    public function selectDetails($p) { 

        $data = array();
        $data['rows'] = $p['rows'];
        $data['name'] = $p['name'];
        $data['talla_minima'] = $p['talla_minima'];
        $data['talla_maxima'] = $p['talla_maxima'];
        $data['id'] = $p['id'];
        $data['code'] = $p['code'];         
	    $view = new View();
        $view->setData( $data );
        $view->setTemplate( 'view/_Select_ajaxDetails.php' );
        return $view->renderPartial();
    }

}
?>
