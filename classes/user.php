<?php
/**
 * User class
 * Allows for easy actions on user information
 * Enter description here ...
 * @author nevoband
 *
 */
class user
{
	private $sqlDataBase;
	private $userId;
	private $netid;
	private $email;
	private $userType;
	private $location;
	private $fullName;
	private $inviteKey;
	private $hostId;
	private $status;
	
	public function __construct(SQLDataBase $sqlDataBase, $userId=null)
	{
		$this->sqlDataBase = $sqlDataBase;
		
		if($userId)
		{
			$this->LoadUser($userId);
		}
	}
	
	public function __destruct()
	{
	
	}
	
	public function CreateUser($netid,$email,$userType,$location,$fullName,$hostId=0)
	{
		if($userType == "GUEST")
		{
			$this->invite_key = $this->generateCode();
		}
		
		$queryInsertUser = "INSERT INTO users (netid,email,user_type,location,full_name,created,user_host_id,status)
							VALUES(\"".$netid."\",\"".$email."\",\"".$userType."\",\"".$location."\",\"".$fullName."\",NOW(),$hostId,\"CREATED\")";
		$this->userId=$this->sqlDataBase->insertQuery($queryInsertUser);
		$this->netid=$netid;
		$this->email=$email;
		$this->userType=$userType;
		$this->location=$location;
		$this->fullName = $fullName;
		$this->hostId = $hostId;
		$this->status="CREATED";
		
		if($password)
		{
			$this->SetPassword($password);
		}
	}
	
	
	
	public function LoadUser($id)
	{
		$queryUserInfo = "SELECT netid,email,user_type,location,full_name,invite_key,user_host_id, status
							FROM users 
							WHERE user_id=".$id;
		$userInfo = $this->sqlDataBase->query($queryUserInfo);
		$this->netid = $userInfo[0]['netid'];
		$this->email = $userInfo[0]['email'];
		$this->userType = $userInfo[0]['user_type'];
		$this->location = $userInfo[0]['location'];
		$this->fullName = $userInfo[0]['full_name'];
		$this->inviteKey = $userInfo[0]['invite_key'];
		$this->hostId = $userInfo[0]['user_host_id'];
		$this->status = $userInfo[0]['status'];
		$this->userId = $id;
	}
	
	public function UpdateUser()
	{
		$queryUpdateUser = "UPDATE users SET 
								email=\"".$this->email."\", 
								netid=\"".$this->netid."\", 
								user_type=\"".$this->userType."\", 
								location=\"".$this->location."\"	
								WHERE user_id=".$this->userId;
	}
	
	public function SetPassword($password)
	{
		$queryUpdatePassword = "UPDATE users SET password = SHA1('".$password."') WHERE user_id=".$this->userId;
		$this->sqlDataBase->nonSelectQuery($queryUpdatePassword);
	}
	
	public function GenerateInviteKey()
	{
		$this->inviteKey = $this->generateCode();
		$queryCreateInviteKey = "UPDATE users SET invite_key=\"".$this->inviteKey."\" WHERE user_id=".$this->userId;
		$this->sqlDataBase->nonSelectQuery($queryCreateInviteKey); 
		return $this->inviteKey;
	}
	
	public function DeleteUser()
	{
		$queryDeleteUser = "UPDATE users SET status=\"DELETED\" WHERE user_id=".$this->userId;
		$this->sqlDataBase->nonSelectQuery($queryDeleteUser);
		$this->status="DELETED";
	}
	
	public function DeleteInviteKey()
	{
		$queryCreateInviteKey = "UPDATE users SET invite_key=\"\" WHERE user_id=".$this->userId;
		$this->sqlDataBase->nonSelectQuery($queryCreateInviteKey);
	}
	
	public static function generateCode($length = 25)
	{
		$passcode="";
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		srand((double)microtime()*1000000);
		for ($i=0; $i<$length; $i++)
		{
			$passcode .= substr ($chars, rand() % strlen($chars), 1);
		}
		return $passcode;
	}
	
	//Getters setters
	public function getUserId() { return $this->userId; } 
	public function getNetid() { return $this->netid; } 
	public function getEmail() { return $this->email; } 
	public function getUserType() { return $this->userType; } 
	public function getLocation() { return $this->location; }  
	public function getFullName() { return $this->fullName; }
	public function getHostId() { return $this->hostId; }
	public function getInviteKey() { return $this->inviteKey; }
	public function getStatus() { return $this->status; }
	public function setNetid($x) { $this->netid = $x; } 
	public function setEmail($x) { $this->email = $x; } 
	public function setUserType($x) { $this->userType = $x; } 
	public function setLocation($x) { $this->location = $x; }
	
}