<?php
include_once('phpORM/ORMBase.php');

class Auditoria extends ORMBase{
    protected $tablename = 'auditoria.auditoria';

    public function GetParameter($array,$schema,$tablename){ 		
 		$obj = new Auditoria();
		$obj->setFields($array);
		$obj->estado = 'A';
		$obj->create(true);
    }
}

?>
