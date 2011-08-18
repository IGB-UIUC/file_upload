<?php
/**
 * Invite user class
 * A static class to allow for easy invites of user
 * Enter description here ...
 * @author nevoband
 *
 */
class invite
{
	
	/**
	 * Invite a user to share files
	 * send a key in the GET field to allow them to login without a password and create one
	 * Enter description here ...
	 * @param unknown_type $email
	 * @param unknown_type $fullName
	 * @param unknown_type $location
	 * @param auth $auth
	 * @param unknown_type $sqlDataBase
	 */
	public static function InviteUser($email,$fullName,$location,auth $auth,$sqlDataBase)
	{

		$invitee = new user($sqlDataBase);
		$invitee->CreateUser($email, $email, "TMP_PASS", $location, $fullName,$auth->getUserFound()->getUserId());
		$inviteKey = $invitee->GenerateInviteKey();
		
		$emailInvite = new email();
		
		if($emailInvite->SendEmail($auth->getUserFound(), $invitee, EMAIL_INVITE))
		{
			return true;
		}

		return false;
	}
	
	/**
	 * Delete a user invite, also marks the user as deleted in the database.
	 * Enter description here ...
	 * @param unknown_type $inviteeId
	 * @param unknown_type $hostUserId
	 * @param unknown_type $sqlDataBase
	 */
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