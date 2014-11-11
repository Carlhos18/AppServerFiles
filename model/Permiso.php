<?php
include_once('phpORM/ORMBase.php');

class Permiso extends ORMBase{
    protected $tablename = 'seguridad.permiso';
    function Modulos($p){
       
        $items=array();
        $hijos=array();
        $cadena="SELECT 
					modulos.m_id, 
					modulos.m_descripcion, 
					permiso.pm_modificar, 
					permiso.pm_eliminar, 
					permiso.pm_insertar, 
					permiso.pm_acceder, 
					permiso.pm_id 
				FROM 
					seguridad.permiso 
				RIGHT OUTER JOIN seguridad.perfil ON permiso.idperfil = perfil.idperfil 
				RIGHT OUTER JOIN seguridad.modulos ON permiso.m_id = modulos.m_id AND perfil.idperfil={$p}
				WHERE modulos.m_id_padre is null AND modulos.estado='A' ORDER BY modulos.m_orden ASC";
		$stmt = ORMConnection::Execute($cadena);       
        $items = $stmt;
        $cont = 0; 
        $cont2 = 0;
        //echo $p['idperfil']; 
        //echo $cadena; 
        //print_r($stmt);
        foreach ($items as $valor){
            $stmt =ORMConnection::Execute("SELECT
												modulos.m_id,
												modulos.m_descripcion,
												permiso.pm_modificar,
												permiso.pm_eliminar,
												permiso.pm_insertar,
												permiso.pm_acceder,
												permiso.pm_id
											FROM
											seguridad.permiso
											RIGHT OUTER JOIN seguridad.perfil ON permiso.idperfil = perfil.idperfil
											RIGHT OUTER JOIN seguridad.modulos ON permiso.m_id = modulos.m_id AND perfil.idperfil={$p} WHERE modulos.m_id_padre={$valor['m_id']}
											AND modulos.estado='A' ORDER BY modulos.m_orden ASC");
            $hijos = $stmt;
            $menu[$cont] = array(
			'm_id'=>$valor['m_id'],
            'texto' => $valor['m_descripcion'],
            'pm_modificar' => $valor['pm_modificar'],
            'pm_eliminar' => $valor['pm_eliminar'],
            'pm_acceder' => $valor['pm_acceder'],
            'pm_insertar' => $valor['pm_insertar'],
            'pm_id' => $valor['pm_id'],
            'url' => '',
            'hijos' => array()
                );
            $cont2 = 0;
            foreach($hijos as $h)
            {
              $menu[$cont]['hijos'][$cont2] = array(
			  'm_id'=>$h['m_id'],
			  'texto' => $h['m_descripcion'],
			  'pm_modificar' => $h['pm_modificar'],
              'pm_eliminar' => $h['pm_eliminar'],
              'pm_acceder' => $h['pm_acceder'],
              'pm_insertar' => $h['pm_insertar'],
              'pm_id' => $h['pm_id'],
			 // 'url' => $h['url']
 'url' => ''
			  );
              $cont2 ++;
            }
            $cont ++;
        }
        return $menu;
    }

}
?>
