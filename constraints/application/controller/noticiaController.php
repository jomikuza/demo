<?php
require_once '../db/MySQL_PDO.php';
require_once '../../application/clases/MyLog.php';
require_once '../../application/clases/Persona.php';

if (isset ( $_POST )) {
	if (isset ( $_POST ['ajax'] )) {
		if ($_POST ['ajax']) {
			// El parámetro f indica la funcion a ocupar:
			if (isset ( $_POST ['f'] ) && ($_POST ['f'] == 1)) {
				if (isset ( $_POST ['id'] ) && ($_POST ['id'] > 0)) {
					$oP = new Persona ();
					$oP->getPersonaById ( ( int ) $_POST ['id'] );					
					$datos = array (
							"mensaje" => "ok",
							"error" => false,
							"id" => $oP->id,
							"nombre" => $oP->nombre,
							"apellidoP" => $oP->apellidoP,
							"rut" => $oP->rut,
							"dv" => $oP->dv,
							"likes" => rand(1, 50)
					);
					
					//print_r($datos);
					echo json_encode ( $datos );
				}
			}
		}
	}
}

?>