<?php
require_once './application/db/MySQL_PDO.php';
require_once './application/db/Util.php';

/**
 * write_mysql_log($message, $db)
 *
 * Author(s): thanosb, ddonahue
 * Date: May 11, 2008
 *
 * Writes the values of certain variables along with a message in a database.
 *
 * Parameters:
 *  $message: Message to be logged
 *  $db: Object that represents the connection to the MySQL Server
 *
 * Returns array:
 *  $result[status]:   True on success, false on failure
 *  $result[message]:  Error message
 */

class MyLog {
	
	public static function write_mysql_log($excepcion)
	{
		$db = MySQL_PDO::getInstance();
		
		// Check database connection
		if( ($db instanceof MySQL_PDO) == false) {
			return array(status => false, message => 'MySQL connection is invalid');
		}
	
		// Check message
		/*
		 * 
		if($message == '') {
			return array('status' => false, 'message' => 'Message is empty');
		}
		 */
	
		// Get IP address
		if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
			$remote_addr = "REMOTE_ADDR_UNKNOWN";
		}
	
		// Get requested script
		if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
			$request_uri = "REQUEST_URI_UNKNOWN";
		}
		
		// Escape values
		$message     = Util::mysql_escape_mimic($excepcion->getMessage());
		$sql_state	 = '';
		$error		 = '';	
		if( $excepcion instanceof PDOException ) {
			$sql_state	 = $excepcion->errorInfo[0];
			$error		 = $excepcion->errorInfo[1];
			$sql_state	 = Util::mysql_escape_mimic($sql_state);
			$error		 = Util::mysql_escape_mimic($error);
		}
		
		$remote_addr = Util::mysql_escape_mimic($remote_addr);
		$request_uri = Util::mysql_escape_mimic($request_uri);
	
		// Construct query
		$sql = "INSERT INTO demo_pdo.my_log 
				(remote_addr, request_uri, message, sql_state, error) 
				VALUES('$remote_addr', '$request_uri','$message','$sql_state','$error')";
	
		// Execute query and save data
		//$result = $db->query($sql);
		$result = $db->select($sql);
	
		if($result) {
			return array('status' => true);
		}
		else {
			return array('status' => false, 'message' => 'Unable to write to the database');
		}
	}
	
}
?>