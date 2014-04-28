<?php
class Persona {
	public $id;
	public $nombre;
	public $apellidoP;
	public $rut;
	public $dv;
	
	public function __construct() {}
	
	public function listarTodos() {
		$arrayPersona = array();
		$oPersona = new Persona();
		$oPersona->nombre = 'Juan';
		$oPersona->apellidoP = 'Perez';
		$oPersona->rut = '14890456';
		$oPersona->dv = 'k';
		
		for ($i=0; $i < 10; $i++) {
			$arrayPersona[] = $oPersona;
		}
		return json_encode($arrayPersona);
	}
	
	public function getPersonaById($id, $ajax = false) {
	
		$this->id = $id;
		$this->nombre = 'Carla';
		$this->apellidoP = 'Araya';
		$this->rut = '12333990';
		$this->dv = '7';
		
		if ($ajax) {
			return json_encode($this);
		}else {
			return $this;			
		}
	}
	
	
	
}