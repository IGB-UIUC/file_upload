<?php
function __autoload($class_name) {
	require_once '../classes/' . $class_name . '.php';
}

include "../includes/config.php";

if(isset($_GET['id']) && isset($_GET['key']))
{


	$fileKey = mysql_real_escape_string($_GET['key']);
	$fileId= mysql_real_escape_string($_GET['id']);

	//Initiate mysql connection
	$sqlDataBase = new SQLDataBase(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	//Create authentication object
	$auth = new auth($sqlDataBase);

	if($auth->AuthFileKey($fileId, $fileKey))
	{
		$file = $auth->getFileFound();
		header("Content-Disposition: attachment; filename=" . urlencode($file->getFileName()));
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Description: File Transfer");
		header("Content-Length: " . filesize(UPLOAD_PATH.DIRECTORY_SEPARATOR.$file->getFileId()));
		flush(); // this doesn't really matter.


		$fp = fopen(UPLOAD_PATH.DIRECTORY_SEPARATOR.$file->getFileId(), "r");
		while (!feof($fp))
		{
			echo fread($fp, 65536);
			flush(); // this is essential for large downloads
		}
		fclose($fp);

	}
}
?>