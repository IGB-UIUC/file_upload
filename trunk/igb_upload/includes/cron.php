<?php
/**
 * A cron job php file
 * Will delete all files based on the expiration timeout set in the config file
 * Enter description here ...
 * @param unknown_type $class_name
 */
function __autoload($class_name) {
	require_once '../classes/' . $class_name . '.php';
}

include "../includes/config.php";


if(isset($_GET['key']))
{
	$key = mysql_real_escape_string($_GET['key']);
	if($key == CRON_KEY)
	{
		$sqlDataBase = new SQLDataBase(DB_HOST, DB_NAME, DB_USER, DB_PASS);
		file::DeleteExpiredFiles(FILES_EXPIRE, $sqlDataBase);
	}
}
?>