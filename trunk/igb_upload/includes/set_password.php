<?php
if(isset($_POST['setPassword']))
{
	$newPassword = mysql_real_escape_string($_POST['newPassword']);
	$matchPassword = mysql_real_escape_string($_POST['matchPassword']);
	if($matchPassword == $newPassword)
	{
		$auth->getUserFound()->SetPassword($newPassword);
		$auth->Login($auth->getUserFound()->getNetid(), $newPassword);
		$auth->getUserFound()->DeleteInviteKey();
	}
}
?>

<form action="index.php" method="POST">
<table>
<tr><td>User Name: </td><td><?php echo $auth->getUserFound()->getNetid(); ?></td></tr>
<tr><td>Enter Password:</td><td><input type="password" name="newPassword"></td></tr>
<tr><td>Verify Password:</td><td><input type="password" name="matchPassword"></td></tr>
<tr><td></td><td><input type="submit" name="setPassword" value="Set Password"></td></tr>
</table>
</form>