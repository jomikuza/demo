<?php
class Util {
	public static function mysql_escape_mimic($inp) {
		if (is_array ( $inp ))
			return array_map ( __METHOD__, $inp );
		
		if (! empty ( $inp ) && is_string ( $inp )) {
			return str_replace ( 
					array ('\\', "\0", "\n", "\r",	"'", '"', "\x1a"), 
					array ('\\\\',	'\\0', '\\n', '\\r', "\\'",	'\\"', '\\Z'), $inp 
			);
		}		
		return $inp;
	}
}

$usr = 'joe';
$pass = 'password';
$sql = "SELECT * FROM users WHERE user='$usr' AND password='$pass'";

//echo Util::mysql_escape_mimic ( $sql );

?>