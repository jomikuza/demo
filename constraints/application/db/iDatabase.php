<?php
interface iDatabase {
	public function conexion();
	public function select($sql);

	/*
	 * 
	public function insert($sql);
	public function update();
	public function delete();
	 */
	
	
	//si no es soportada por la bd se declara el método pero sin definir
	public function selectPrepare($sql, $parametros); 
	public function close();
}
?>