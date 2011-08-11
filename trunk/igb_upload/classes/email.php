<?php
/**
 * Email class
 * Used to allow for easy sending of e-mails based on a template in teh config file.
 * Enter description here ...
 * @author nevoband
 *
 */
class email
{
	private $fromUser;
	private $toUser;
	private $message;
	private $subject;
	
	public function __construct()
	{
		
	}
	
	/**
	 * Send an e-mail out based on a predfined template
	 * Enter description here ...
	 * @param user $fromUser
	 * @param user $toUser
	 * @param unknown_type $messageType
	 */
	public function SendEmail(user $fromUser, user $toUser,$messageType)
	{
		$this->fromUser = $fromUser;
		$this->toUser = $toUser;
		
		$this->GenerateFromTemplate($messageType);
		
		$to = $this->toUser->getEmail();
		$from = FROM_EMAIL;
		
		//To send HTML mail, the content-type header must be set
		$header ='MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = "From: ".$from."\r\n";
		
		// Mail it
		return mail($to, $this->subject, $this->message, $headers);	
	}
	
	/**
	 * Generate the template based on the message type requested
	 * Enter description here ...
	 * @param unknown_type $messageType
	 */
	private function GenerateFromTemplate($messageType)
	{
		switch($messageType)
		{
			case EMAIL_INVITE:
				$this->message = $this->EmailTemplateSetVariables(INVITE_MESSAGE);
				$this->subject = $this->EmailTemplateSetVariables(INVITE_SUBJECT);
				break;
		}
	}
	
	/**
	 * Set the variables in the template and return the modified text
	 * Enter description here ...
	 * @param unknown_type $text
	 */
	private function EmailTemplateSetVariables($text)
	{
		$fromUserName = $this->fromUser->getFullName();
		$toUser = $this->toUser->getFullName();
		$secretKey = $this->toUser->getInviteKey();
		
		$text = str_replace("%USERNAME%",$fromUserName,$text);
		$text = str_replace("%INVITEKEY%", URL."?id=".$this->toUser->getUserId()."&activate=".$secretKey, $text);
		
		return $text;
		
	}
	
	
}
?>