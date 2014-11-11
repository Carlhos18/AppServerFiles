<?php
	include_once('phpORM/ORMBase.php');
	include('config_db.php');

	$link = mysql_connect('localhost', 'root', '') ;
	mysql_select_db('datos');

// Realizar una consulta MySQL
	$query = "SELECT * FROM cursos WHERE codigofacultad='07'";
	$result = mysql_query($query);

	//echo "<table>";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    //print_r($line);
	    $descrip=$line['DescripcionCurso'];
	    //echo $descrip."<br>";
	    $query = ORMConnection::Execute("INSERT INTO  general.cursos  VALUES ('{$line['CodigoCurso']}', '{$line['CodigoPlan']}', '{$line['CodigoEscuela']}', '{$line['CodigoFacultad']}', '{$descrip}', '{$line['Creditos']}', '{$line['TipoCurso']}', '{$line['Ciclo']}', '{$line['CodCursoSira']}', '{$line['OrdenSegunPlan']}', '{$line['EstadoCursoPlan']}', '{$line['RequisitoCreditos']}', '{$line['OrdenSegunPlanAlterno']}', '{$line['DescripcionCursoIngles']}', '{$line['CodigoEspecialidad']}', '{$line['CodigoAreaCurricular']}', '{$line['HorasTeoria']}', '{$line['HorasPractica']}', '{$line['RequisitoCertificado']}','','A');");
	    /*echo "<tr>";
	    foreach ($line as $col_value) {
	        echo "<td>$col_value</td>";
	    }
	    echo "</tr>";*/
	}
	//echo "</table>";{}
?>