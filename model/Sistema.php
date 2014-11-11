<?php
include_once('phpORM/ORMBase.php');

class Sistema extends ORMBase{
    protected $tablename = 'seguridad.permiso';

    function menu_dinamico(){
    	$items=array();
        $hijos=array();
		$stmt = ORMConnection::Execute("SELECT
										modulos.m_id,
										modulos.m_id_padre,
										modulos.m_descripcion,
										modulos.m_url,
										modulos.m_orden,
										modulos.estado,
										modulos.class_padre
										FROM
										seguridad.modulos
										INNER JOIN seguridad.permiso ON modulos.m_id = permiso.m_id
										WHERE modulos.estado='A' AND modulos.m_id_padre IS NULL
										AND permiso.idperfil='{$_SESSION['id_perfil']}' AND permiso.pm_acceder=1 
										ORDER BY modulos.m_orden ASC");       
        $items = $stmt;
        $cont = 0; 
        $cont2 = 0;
        if (count($items)>0) {
        	foreach ($items as $valor){
	            $stmt =ORMConnection::Execute("SELECT
													modulos.m_id,
													modulos.m_id_padre,
													modulos.m_descripcion,
													modulos.m_url,
													modulos.m_orden,
													modulos.estado
													FROM
													seguridad.modulos
													INNER JOIN seguridad.permiso ON modulos.m_id = permiso.m_id
													where modulos.estado='A' AND modulos.m_id_padre={$valor['m_id']}
													AND permiso.idperfil='{$_SESSION['id_perfil']}' AND permiso.pm_acceder=1 
													ORDER BY modulos.m_orden");
	            $hijos = $stmt;
	            $menu[$cont] = array(
									'm_id'			=>$valor['m_id'],
						            'texto' 		=> $valor['m_descripcion'],
						            'url' 			=> '',
						            'class_padre' 	=>  $valor['class_padre'],
						            'enlaces' => array()
	                			);
	            $cont2 = 0;

	            foreach($hijos as $h){
	              $menu[$cont]['enlaces'][$cont2] = array('m_id'=>$h['m_id'],'texto' => $h['m_descripcion'],'url' => $h['m_url']);
	              $cont2 ++;
	            }

            	$cont ++;
        	}
       // print_r($menu);
	        $item=0;
	        $xitem=0;

			$str ="	<ul id='nav'>";
			$str.="	    <li >";
			$str.="	    	<a href='index.php' style='background:#2c3e50;'>";
			$str.="	    		<span class='Icon-Info home'></span>";
			$str.="	    		<div class='Title-Main' >INICIO</div>";
			$str.="	    	</a>";
			$str.="	    </li>";

        	foreach ($menu as $value) {
	        	$item++;
		        
		        $str.="<li>";
				$str.="		<a href='#' class='Father'>";
				$str.="			<span class='nav_icon {$value['class_padre']}'></span>";
				$str.="			<div class='Position-Descrp'>{$value['texto']}</div>";
				if (count($value['enlaces'])>0) {
					$str.="			<span class='up_down_arrow'>&nbsp;</span>";
				}
				$str.="		</a>";

				if (count($value['enlaces'])>0) {
					$str.=" <ul class='acitem'>";
						
						foreach ($value['enlaces'] as $keyy => $val) {$xitem++;
							$str.="<li class='Main-son'>";
							$str.="	<a href='{$val['url']}'><span class='list-icon'>&nbsp;</span>{$val['texto']}</a>";
							$str.="</li>";
		        		}

					$str.=" </ul>";
				}	        
				$str.=" </li>";
        	}
			$str.=" </ul>";
        }else{
        	$item=0;
	        $xitem=0;
	        $str="";
        	$item++;

			$str ="	<ul id='nav'>";
			$str.="	    <li >";
			$str.="	    	<a href='index.php' style='background:#2c3e50;'>";
			$str.="	    		<span class='Icon-Info home'></span>";
			$str.="	    		<div class='Title-Main' >INICIO</div>";
			$str.="	    	</a>";
			$str.="	    </li>";

			$str.="	    <li>";
			$str.="			<a href='#' class='Father'>";
			$str.="				<span class='nav_icon alert'></span>";
			$str.="				<div class='Position-Descrp'>NO TIENE PERMISO</div>";
			$str.="			</a>";
			$str.="	    </li>";
        }
		echo $str;       
    }   
}

?>
