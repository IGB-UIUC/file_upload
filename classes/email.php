<?php
class email
{
	private $fromUser;
	private $toUser;
	private $message;
	private $subject;
	
	public function __construct()
	{
		
	}
	
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