<?php
require_once 'iDatabase.php';

class MySQL_PDO implements iDatabase {
	private $_host = "mysql:host=localhost"; // Nombre de host MYSQL
	private $_user = "pulga";// Nombre de usuario de MySQL
	private $_pass = "atomica,.-";// Contraseña de usuario de MySQL
	private $_db_name = "demo_pdo";// Nombre de la base de datos
	private $_db = null;
	
	
	public function __construct() {
		$this->conexion();
	}
	
	public function conexion() {
		try {		
			$this->_db = new PDO($this->_host, $this->_user, $this->_pass);
			$this->_db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
			
		} catch (PDOException $e) {
			//cabecera("Error grave");
			print "<p>Error: No puede conectarse con la base de datos.</p>\n";
			print "<p>Error: " . $e->getMessage() . "</p>\n";
			//pie();
			exit();
		}
	}
	
	
	public function close() {
		$this->_db = null;
	}
	
	
}
?>