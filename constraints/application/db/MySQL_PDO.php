<?php
require_once 'iDatabase.php';

class MySQL_PDO implements iDatabase {
	private $_host = "mysql:host=localhost"; // Nombre de host MYSQL
	private $_user = "pulga";// Nombre de usuario de MySQL
	private $_pass = "atomica,.-";// Contraseña de usuario de MySQL
	private $_db_name = "demo_pdo";// Nombre de la base de datos
	private $_db = null;
	static private $instance = null;
	
	private function __contruct() {}
	
	public static function getInstance() {	
		if (self::$instance == null) {			
			self::$instance = new MySQL_PDO();			
		}		
		return self::$instance;		
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
	
	public function select($sql) {		
		$result = $this->_db->query($sql);
		if (!$result) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			foreach ($result as $valor) {
				print "<p>$valor[id] $valor[nombre] $valor[nacimiento]</p>\n";
			}
		}
	}
	
	/**
	 * 
	 * @param String $sql la consulta preparada usando ?
	 * @param array $parametros a reemplazar por cada ? en la consulta.
	 */
	public function selectPrepare($sql, $parametros) {
		$result = $this->_db->prepare($sql);
		$result->execute($parametros);
		if (!$result) {
			print "<p>Error en la consulta.</p>\n";
		} else {
			foreach ($result as $valor) {
				print "<p>$valor[id] $valor[nombre] $valor[nacimiento]</p>\n";
			}
		}	
	}
	
	public function close() {
		$this->_db = null;
	}
}
?>