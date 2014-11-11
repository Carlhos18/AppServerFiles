<?php

require_once 'lib/Controller.php';
require_once 'lib/funciones.php';
require_once 'lib/View.php';
require_once 'model/auditoria.php';

class AuditoriaController extends Controller 
{
    public function Index()
    {   include('config_db.php');
	    $grilla = new jsGrid();
        $grilla->setCaption("Auditoria");
        $grilla->setPager("pgauditoria");
        $grilla->setTabla("lsauditoria");
        $grilla->setSortname("direccion_ip");
        $grilla->setUrl("index.php?controller=AuditoriaController&action=listaAction");
        $grilla->setWidth(730);
        $grilla->addColumnas("perfil", "Descripcion");
		$data=array();
		$data['grilla']=$grilla->buildJsGrid();
		$data['url'] = $config_db['url'];
		$data['cabeza'] = self::mycabeza($config_db['url']);
        $view = new View();
        $view->setData($data);
        $view->setTemplate('view/Auditoria/_frm.php');
		
		echo $view->renderPartial();
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
        $db->setTabla('auditoria');//nombre del model
        $db->setParametros($_REQUEST);
        $db->setColumnaId('idauditoria');
        $db->addColumna("direccion_ip");
        $db->addWhereAnd('estado=', 'A');
        echo $db->to_json();
    }

    public function create_grid(){
        $post=array(
            'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',
            'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',
            'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',
            'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',
            'search'=>(isset($_REQUEST['_search']))?$_REQUEST['_search']:'',
        );
        $se ="";

        if($post['search'] == 'true'){
            $b = array();
            $search['like']=elements(array('usuario','perfil'),$_REQUEST);
            foreach($search['like'] as $key => $value){
                if($value != false) $b[]="$key like '%$value%'";
            }
            $search['where']=elements(array('perfil'),$_REQUEST);
            foreach($search['where'] as $key => $value){
                if($value != false) $b[]="$key = '$value'";
            }
            $se=" where ".implode(' and ',$b );     
        }

        $query = ORMConnection::Execute("SELECT count(*) as t FROM   auditoria.auditoria_vista_previa ".$se);
        if(!$query)
            echo mysql_error();
        $count =$query[0]['t'];

        if( $count > 0 && $post['limit'] > 0) {
            $total_pages = ceil($count/$post['limit']);
            if ($post['page'] > $total_pages) $post['page']=$total_pages;
            $post['offset']=$post['limit']*$post['page'] - $post['limit'];
        } else {
            $total_pages = 0;
            $post['page']=0;
            $post['offset']=0;
        }
        $sql = "SELECT * FROM   auditoria.auditoria_vista_previa ".$se;
        if( !empty($post['orden']) && !empty($post['orderby']))
            $sql .= " ORDER BY $post[orderby] $post[orden] ";
        if($post['limit'] && $post['offset']) $sql.=" limit $post[limit] offset  $post[offset]";
            elseif($post['limit']) $sql .=" limit $post[limit] offset 0";
        
        //echo $sql;
        $query = ORMConnection::Execute($sql);
        if(!$query)
            //echo pgsql_error();
        $result = array();
        $i = 0;

        foreach ($query as $key => $row) {

            $result[$key]['id']=$row['idusuario'];
            $result[$key]['cell']=array($row['usuario'],$row['nick_usuario'],$row['perfil']);
            $i++;
        }
        $json->rows=$result;
        $json->total=$total_pages;
        $json->page=$post['page'];

        $json->records=$count;
        echo json_encode($json);
    }
	
	public function view_subgrid(){
        $post=array(
            'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',
            'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',
            'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',
            'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',
            'search'=>(isset($_REQUEST['_search']))?$_REQUEST['_search']:'',
        );
        $se =" WHERE idusuario='{$_REQUEST['id']}' ";

        if($post['search'] == 'true'){
            $b = array();
            $search['like']=elements(array('accion_realizada','objeto','nombre_objeto','hora_accion','direccion_ip_local','direccion_ip'),$_REQUEST);
            foreach($search['like'] as $key => $value){
                if($value != false) $b[]="$key like '%$value%'";
            }
            //$search['where']=elements(array('objeto'),$_REQUEST);
            /*foreach($search['where'] as $key => $value){
                if($value != false) $b[]="$key = '$value'";
            }*/
            $se=" AND ".implode(' and ',$b );     
        }
		
		$query = ORMConnection::Execute("SELECT count(*) as t FROM   auditoria.auditoria_vista ".$se);
        if(!$query)
            echo pg_last_error();
        $count =$query[0]['t'];

        if( $count > 0 && $post['limit'] > 0) {
            $total_pages = ceil($count/$post['limit']);
            if ($post['page'] > $total_pages) $post['page']=$total_pages;
            $post['offset']=$post['limit']*$post['page'] - $post['limit'];
        } else {
            $total_pages = 0;
            $post['page']=0;
            $post['offset']=0;
        }
        $sql = "SELECT * FROM   auditoria.auditoria_vista ".$se;
        if( !empty($post['orden']) && !empty($post['orderby']))
            $sql .= " ORDER BY $post[orderby] $post[orden] ";
        if($post['limit'] && $post['offset']) $sql.=" limit $post[limit] offset  $post[offset]";
            elseif($post['limit']) $sql .=" limit $post[limit] offset 0";
        
        //echo $sql;
        $query = ORMConnection::Execute($sql);
        if(!$query)
            echo pg_last_error();
        $result = array();
        $i = 0;
		
		foreach ($query as $key => $row) {
			$result[$key]['id']=$row['idauditoria'];
			$rutaComprimida = explode("/", $row['ruta_objeto']);
            $result[$key]['cell']=array($row['accion_realizada'],$row['objeto'],$row['nombre_objeto'],$row['hora_accion'],$row['direccion_ip'],$row['direccion_ip_local'],$rutaComprimida[1]);
            $i++;
        }
        $json->rows=$result;
        $json->total=$total_pages;
        $json->page=$post['page'];

        $json->records=$count;
        echo json_encode($json);
    }

}
?>