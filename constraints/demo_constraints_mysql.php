<?php require_once './application/db/MySQL_PDO.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Demo PDO</title>
<style>
.col_12
{
	background-color: #E6EAEC;
	overflow:hidden;
	padding: 3px;
}
.col_3
{
	float:left;
	background-color: #D9E7F3;
	height: 100px;
	width : 200px;
	overflow:hidden;
	padding: 0px 3px 0px 3px;
	margin: 3px 3px 3px 0px;
}
.volver
{
	background-color: #FAD16A;
}
</style>	
</head>
<body>
<div class="col_12">Demo integridad referencial en tablas MySQL</div>
<div class="col_3">Descripión del ejemplo a desarrollar</div>
<div style="clear:both">
<?php 
//usando Patrón de diseño Singleton
$objConn = MySQL_PDO::getInstance();

$sql = "SELECT * FROM demo_pdo.usuario";
$objConn->conexion();
$objConn->select($sql);

//Ejemplo de consulta parametrizada para obtener datos de una fila por id
$sql = "SELECT id, nombre, nacimiento FROM demo_pdo.usuario
WHERE id=?";
$parametros = array(5);
$objConn->selectPrepare($sql, $parametros);

try {
	$sql = "DELETE FROM demo_pdo.usuario
	WHERE id=?";
	$parametros = array(1);
	$objConn->deletePrepare($sql, $parametros);
	
} catch (PDOException $e) {
	//MySQL
	//$e->errorInfo[0] SQLSTATE
	//$e->errorInfo[1] Error
	if (($e->errorInfo[0] == 23000) && ($e->errorInfo[1] == 1451)) {
		echo "<pre>";
		echo "No puede eliminar este registro; está referenciado en otra tabla.";
		echo "</pre>";
	}


	/*
	echo "<pre>";
	print_r($e->errorInfo);
	print "<p>Message: " . $e->getMessage() . "</p>\n";
	print "<p>Trace: </p>\n";
	print_r($e->getTrace());
	echo "</pre>";
	*/

	/*
	echo "<pre>";
	echo "PDOException en demo_constraints_mysql.php";
	print_r($e->errorInfo);
	echo "</pre>";
	 */
} catch (Exception $ex) {
	echo "<pre>";
	echo "Exception en demo_constraints_mysql.php";
	print_r($ex->errorInfo);
	echo "</pre>";
}

//cerrar la conexion si ya se dejó de utilizar.
$objConn->close();
?>

</div>




<a class="volver" href="javascript:history.back();">Volver</a>
</body>
</html>