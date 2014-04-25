<?php
require_once 'iDatabase.php';

class MySQL_PDO implements iDatabase {
	private $_host = "mysql:host=localhost"; // Nombre de host MYSQL
	private $_user = "pulga";// Nombre de usuario de MySQL
	private $_pass = "atomica,.-";// Contraseña de usuario de MySQL
	private $_db_name = "demo_pdo";// Nombre de la base de datos
	private $_db = null;
	static private $instance = null;
	
	// $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	// PDO::ERRMODE_EXCEPTION
	
	private function __contruct() {}
	/**
	 * usando patrón de diseño Singleton.
	 * @return MySQL_PDO
	 */
	public static function getInstance() {	
		if (self::$instance == null) {			
			self::$instance = new MySQL_PDO();			
		}		
		return self::$instance;		
	}

	/*
	 * Establece conexion con la bd.
	 */
	public function conexion() {
		try {		
			$this->_db = new PDO($this->_host, $this->_user, $this->_pass);
			$this->_db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
			
			//$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			//si quiero manejar excepciones ocupo esta opción.
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			//ESTO ESTÁ PENDIENTE, EL COMO MANEJAR ESTOS ERRORES.
			//EVITANDO QUE SE INTERRUMPA LA NAVEGACIÓN EN EL CLIENTE.
			print "<p>Error: No puede conectarse con la base de datos.</p>\n";
			print "<p>Error: " . $e->getMessage() . "</p>\n";
			exit();
		}
	}
	/**
	 * @param String $sql la consulta a ejecutar.
	 *  
	 */
	public function select($sql) {		
		try {
			$result = $this->_db->query($sql);
		} catch (PDOException $e) {
			throw $e;
		} catch (Exception $ex) {
			throw $ex;
		}
	}

	public function deletePrepare($sql,$parametros) {			
		try {
			$result = $this->_db->prepare($sql);
			$result->execute($parametros);			
		} catch (PDOException $e) {			
			throw $e;			
		} catch (Exception $ex) {			
			throw $ex;			
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
	/*
	 * Cierra la conexion con la bd.
	 */
	public function close() {
		$this->_db = null;
	}
}
?>