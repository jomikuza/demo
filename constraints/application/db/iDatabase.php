<?php
interface iDatabase {
	protected function conexion();
	protected function select();
	protected function insert();
	protected function update();
	protected function delete();
	protected function close();
}
?>