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

$sql = "DELETE FROM demo_pdo.usuario
WHERE id=?";
$parametros = array(1);
$objConn->deletePrepare($sql, $parametros);

//cerrar la conexion si ya se dejó de utilizar.
$objConn->close();
?>

</div>




<a class="volver" href="javascript:history.back();">Volver</a>
</body>
</html>