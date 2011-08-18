<?php
if(isset($_POST['setPassword']))
	{
		$newPassword = mysql_real_escape_string($_POST['newPassword']);
		$matchPassword = mysql_real_escape_string($_POST['matchPassword']);
		if($matchPassword == $newPassword)
		{
			$passwordStrength = auth::VerifyPasswordStrength($newPassword);
			if($passwordStrength>1)
			{
				$auth->getUserFound()->SetPassword($newPassword);
				$auth->getUserFound()->setUserType("GUEST");
				$auth->getUserFound()->UpdateUser();
				$auth->Login($auth->getUserFound()->getNetid(), $newPassword);
				$auth->getUserFound()->DeleteInviteKey();
				$passwordMessage = alerts::alertBox("Change Password","Password successfully changed",alerts::$INFO);
				
			}
			else
			{
				$passwordMessage = alerts::alertBox("Change Password","Password must be at least 8 characters, <br>must contain at least one lower case letter, <br>one upper case letter and one digit.",alerts::$ERROR);
			}
		}
	}
?>