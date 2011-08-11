<?php
/**
 * Authentication class
 * Enter description here ...
 * @author nevoband
 *
 */
class auth
{
	private $sqlDataBase;
	private $error;
	private $userFound;
	private $fileFound;
	private $sessionKey;

	public function __construct(SQLDataBase $sqlDataBase)
	{
		$this->sqlDataBase = $sqlDataBase;
	}
	
	public function __destruct()
	{
		
	}
	
	/**
	 * Try to login using either ldap or the local database
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $password
	 */
	public function Login($username, $password)
	{
		if($this->AuthLdap($username,$password))
		{
			$this->CreateSession($username,$password);
			return true;
		}
			
		if($this->AuthDatabase($username,$password))
		{
			$this->CreateSession($username,$password);
			return true;
		}
		
		return false;
	}

	/**
	 * Log in using the session information
	 * Enter description here ...
	 */
	public function SessionLogin()
	{
		if($this->AuthLdap($_SESSION['username'], $_SESSION['password']) || $this->AuthDataBase($_SESSION['username'],$_SESSION['password']))
		{
			return true;
		}
		
		return false;
	}
	
	/**
	 * Public view of delete session so user can click on logout
	 * Enter description here ...
	 */
	public function SessionLogout()
	{
		$this->DeleteSession();
	}
	
	/**
	 * Authenticate with LDAP
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @param unknown_type $group
	 */
	public function AuthLdap($username,$password,$group=null)
	{
		if (LDAP_SSL == 1) {
			$connect = ldap_connect("ldaps://" . LDAP_HOST,LDAP_PORT);
			 
		}
		elseif (LDAP_SSL == 0) {
			$connect = ldap_connect("ldap://" . LDAP_HOST,LDAP_PORT);
			 
		}
		 
		$bindDN = "uid=" . $username . "," . LDAP_PEOPLE;
		 
		$success = @ldap_bind($connect, $bindDN, $password);

		if ($success == 1 && $group!= null) {
			$search = ldap_search($connect,LDAP_GROUP,"(cn=" . $group . ")");
			$data = ldap_get_entries($connect,$search);
			ldap_unbind($connect);

			foreach($data[0]['memberuid'] as $groupMember) { 
				if ($username == $groupMember) {
					$success = 1;
					break;
				}
				else {
					$success = 0;
				}
			}
		}
		
		if($success == 0)
		{
			$this->error=ldap_error($connect);
		}
		elseif($success == 1)
		{
			$queryUserNetId = "SELECT user_id FROM users WHERE netid=\"".$username."\"";
			$userId = $this->sqlDataBase->singleQuery($queryUserNetId);
			
			if($userId)
			{
				$this->userFound = new user($this->sqlDataBase,$userId);
			}
			else
			{
				$justthese = array("cn","mail");
				$filter="uid=".$username;
				$sr = ldap_search($connect, $bindDN, $filter, $justthese);
				$info = ldap_get_entries($connect,$sr);
				
				$this->userFound = new user($this->sqlDataBase);
				$this->userFound->CreateUser($username, $info[0]['email'][0], "IGB", "IGB", $info[0]['cn'][0]);
			}
			$this->username = $username;
			$this->password = $password;
		}
		ldap_close($connect);
		return $success;
	}
	
	/**
	 * Authenticate with database
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $password
	 */
	public function AuthDatabase($username,$password)
	{
		$queryUser = "SELECT user_id FROM users WHERE netid=\"".$username."\" AND password=SHA1('".$password."') AND status=\"CREATED\"";
		$userFound = $this->sqlDataBase->singleQuery($queryUser);
		if($userFound)
		{
			$this->userFound = new user($this->sqlDataBase,$userFound);
			if($this->userFound->getStatus()=="CREATED")
			{
				return true;
			}	
		}
		else
		{
			return false;
		}
	}
	

	/**
	 * Authenticate an invite key to a userId
	 * Enter description here ...
	 * @param unknown_type $userId
	 * @param unknown_type $inviteKey
	 */
	public function AuthDatabaseKey($userId,$inviteKey)
	{
		if($inviteKey!="")
		{
			$queryUserInfo = "SELECT user_id FROM users WHERE invite_key=\"".$inviteKey."\" AND user_id=".$userId." AND status=\"CREATED\"";
			$userid = $this->sqlDataBase->singleQuery($queryUserInfo);
			if($userid)
			{
				$this->userFound = new user($this->sqlDataBase,$userid);
				if($this->userFound->getStatus()=="CREATED")
				{
					return true;
				}	
			}
		}
		
		return false;
	}
	
	/**
	 * Authenticate a fileId with a fileKey
	 * mostly used for downloading files through the download.php file
	 * Enter description here ...
	 * @param unknown_type $fileId
	 * @param unknown_type $fileKey
	 */
	public function AuthFileKey($fileId,$fileKey)
	{
		if($fileKey!="")
		{
			$queryFileInfo = "SELECT file_id FROM files WHERE file_id=".$fileId." AND secret_key=\"".$fileKey."\"";
			$fileId = $this->sqlDataBase->singleQuery($queryFileInfo);
			if($fileId)
			{
				$this->fileFound = new file($this->sqlDataBase,$fileId);
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Create a key to allow an authenticated user to upload securely
	 * The upload.php file is out of the login $_SESSION scope so I needed a way to allow a user to upload files without having to log in
	 * Enter description here ...
	 */
	public function CreateUploadSession()
	{
		$sessionKey = user::generateCode();
		//Check if there is already an open session for this user, if so just reuse it.
		$querySessionForUser = "SELECT upload_session_id,session_key FROM upload_session 
								WHERE user_id=".$this->userFound->getUserId()." AND 
								(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time))<".SESSION_EXPIRE."";
		$sessionInfo = $this->sqlDataBase->query($querySessionUser);
		
		if($sessionInfo)
		{
			$queryUpdateSession = "UPDATE upload_session SET start_time=NOW() WHERE upload_session_id=".$sessionInfo[0]['upload_session_id'];
			$this->sqlDataBase->nonSelectQuery($queryUpdateSession);
			$this->sessionKey = $sessionInfo[0]['session_key'];
			$sessionKey = $sessionInfo[0]['session_key'];
			
		}else {
			//if there is no open session then create one.
			$queryInsertUploadSession ="INSERT INTO upload_session 
										(user_id,session_key,start_time)
										VALUES(".$this->userFound->getUserId().",\"".user::generateCode()."\",NOW())";
			$this->sqlDataBase->query($queryInsertUploadSession);
			$this->sessionKey = $sessionKey;
		}
		
		return $sessionKey;
	}

	/**
	 * Check whether the user has an open upload session, if not don't allow them to upload
	 * Enter description here ...
	 * @param unknown_type $userId
	 * @param unknown_type $sessionKey
	 */
	public function CheckOpenSession($userId,$sessionKey)
	{
		$querySessionKeys = "SELECT upload_session_id FROM upload_session WHERE user_id=".$userId." AND session_key=\"".$sessionKey."\" AND 
								(UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(start_time))<".SESSION_EXPIRE."";
		return $querySessionKeys;
		if($this->sqlDataBase->query($querySessionKeys))
		{
			return true;
		}
		
		return false;
	}
	
	/**
	 * Create a login session and an upload session for the username and password
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $password
	 */
	private function CreateSession($username,$password)
	{
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$this->CreateUploadSession();
	}
	
	/**
	 * Delete session variable 
	 * Enter description here ...
	 */
	private function DeleteSession()
	{
		unset($_SESSION['username']);
		unset($_SESSION['password']);
	}
	
	
	//Getters and Setters
	public function getUserFound() { return $this->userFound; }
	public function getFileFound() { return $this->fileFound; }
	public function getError() { return $this->error; }
	public function getSessionKey() { return $this->sessionKey; }
}
?>