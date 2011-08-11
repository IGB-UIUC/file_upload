<?php

session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//Load the classes automatically without having to include them
function __autoload($class_name) {
	require_once 'classes/' . $class_name . '.php';
}

include "includes/header.php";
include "includes/config.php";

//Set Temporary password set to false
$tmpPasswordSet = false;

//Initiate mysql connection
$sqlDataBase = new SQLDataBase(DB_HOST, DB_NAME, DB_USER, DB_PASS);

//Create authentication object
$auth = new auth($sqlDataBase);

if(isset($_POST['login']))
{
	$username = mysql_real_escape_string($_POST['username']);
	$password = $_POST['password'];
	$auth->Login($username,$password);

}

if(isset($_POST['logout']))
{
	$auth->SessionLogout();
}

if(isset($_GET['id']) && isset($_GET['activate']))
{
	$userId = mysql_real_escape_string($_GET['id']);
	$inviteKey = mysql_real_escape_string($_GET['activate']);
	
	if($auth->AuthDatabaseKey($userId, $inviteKey))
	{
		//Generate a temporary password for the user so they can 
		//have a safe session to change their password
		$tmpPassword = user::generateCode(8);
		$auth->getUserFound()->SetPassword($tmpPassword);
		
		//Login user using the temporary password
		$auth->Login($auth->getUserFound()->getNetid(),$tmpPassword);
		
		//Set tmpPasswordSet to true so users know
		//they need to change password
				
		$tmpPasswordSet = true;
	}
}

//Try to authenticate user with either LDAP or MySQL database
if($auth->SessionLogin())
{	
	include "includes/logout.php";
	include "includes/main_content.php";	
}
else{

	include "includes/login.php";
}

include "includes/footer.php";