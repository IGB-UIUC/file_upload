<?php
if($passwordMessage)
{
	
	echo $passwordMessage;
}
?>

<form action="index.php#set_password" method="POST">
<table>
<tr><td>User Name: </td><td><?php echo $auth->getUserFound()->getNetid(); ?></td></tr>
<tr><td>Enter Password:</td><td><input type="password" name="newPassword"></td></tr>
<tr><td>Verify Password:</td><td><input type="password" name="matchPassword"></td></tr>
<tr><td></td><td><input class="ui-state-default ui-corner-all" type="submit" name="setPassword" value="Set Password"></td></tr>
</table>
</form>