<?php
class invite
{
	
	public static function InviteUser($email,$fullName,$location,auth $auth,$sqlDataBase)
	{

		$invitee = new user($sqlDataBase);
		$invitee->CreateUser($email, $email, GUEST, $location, $fullName,$auth->getUserFound()->getUserId());
		$inviteKey = $invitee->GenerateInviteKey();
		
		$emailInvite = new email();
		
		if($emailInvite->SendEmail($auth->getUserFound(), $invitee, EMAIL_INVITE))
		{
			return true;
		}

		return false;
	}
	
	public static function DeleteInvite($inviteeId,$hostUserId, $sqlDataBase)
	{
		$userToDelete = new user($sqlDataBase,$inviteeId);
		if($userToDelete->getHostId()==$hostUserId)
		{
			$userToDelete->DeleteUser();
			return true;
		}
		
		return false;
	}
}
?>