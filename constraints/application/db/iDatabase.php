<?php
interface iDatabase {
	public function conexion();
	public function select($sql);

	/*
	 * 
	public function delete();
	public function insert($sql);
	public function update();
	 */
	
	
	//si no es soportada por la bd se declara el método pero sin definir
	public function selectPrepare($sql, $parametros); 
	public function deletePrepare($sql,$parametros);
	public function close();
}
?>