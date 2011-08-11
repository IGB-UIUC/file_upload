<?php
/**
 * Groups class
 * NOT USED RIGHT NOW MAYBE IN THE FUTURE
 * This is not used, i had an idea before to give groups access to uploaded files but it was taking too long
 * Enter description here ...
 * @author nevoband
 *
 */
class group
{
	private $sqlDataBase;
	private $groupId;
	private $groupName;
	
	public function __construct(SQLDataBase $sqlDataBase, $groupId=null)
	{
		$this->sqlDataBase = $sqlDataBase;
		if($groupId)
		{
			$this->LoadGroup($groupId);
		}
	}
	
	public function __destruct()
	{
		
	}
	
	public function LoadGroup($groupId)
	{
		$queryGroupInfo = "SELECT group_name FROM groups WHERE group_id=".$groupId;
		$this->sqlDataBase->query($queryGroupInfo);
		$this->groupId = $groupId;
		
	}
	
	public function GetMemebers()
	{
		$queryGroupMemebers = "SELECT user_id FROM memebers WHERE group_id=".$this->GroupId;
		$groupMembers = $this->sqlDataBase->query($queryGroupMembers);
		$membersArray = array();
		foreach($groupMembers as $id=>$groupMember)
		{
			$membersArray[] = $groupMemeber;
		}
		
		return $membersArray;
	}
	
	public function CreateGroup($groupName)
	{
		$queryInsertGroup = "INSERT INTO groups (group_name)VALUES(\"".$groupName."\")";
		$this->groupId = $sqlDataBase->insertQuery($queryInsertGroup);	
	}
	
	public function AddMember($userId)
	{
		$queryAddGroupMember = "INSERT INTO members (user_id,group_id)VALUES(".$userId.",".$this->groupId.")";
		$this->sqlDataBase->insertQuery($queryAddGroupMember);
	}
	
	public function RemoveMember($userId)
	{
		$queryRemoveMember = "DELETE FROM members WHERE user_id=".$userId;
		$this->sqlDataBase->nonSelectQuery($queryRemoveMember);	
	}
}
?>