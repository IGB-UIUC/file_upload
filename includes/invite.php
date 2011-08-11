<?php
if(isset($_POST['sendSharingInvite']))
{
	$inviteEmail = $_POST['inviteEmail'];
	$fullName = $_POST['fullName'];
	$location = $_POST['location'];
	
	if(invite::InviteUser($inviteEmail, $fullName, $location, $auth, $sqlDataBase))
	{
		echo "Invite sent.";
	}
	else
	{
		echo "Failed to send invite.";
	}
}
if(isset($_POST['deleteInvites']))
{
	if(isset($_POST['invites']))
	{
		$invites = $_POST['invites'];
		foreach($invites as $invitee)
		{
			invite::DeleteInvite($invitee, $auth->getUserFound()->getUserId(), $sqlDataBase);
		}
	}
}
?>
<script>
$(function() 
	    { 
	        $("#invitesTable").tablesorter(); 
	    });
</script>

<form action="index.php#send_invites" method="post">
<table>
<tr><td>Full Name: </td><td><input type="text" name="fullName"></td></tr>
<tr><td>Location: </td><td><input type="text" name="location" size=20></td></tr>
<tr><td>Send sharing invite (E-Mail): </td><td><input type="text" name="inviteEmail"></td></tr>
<tr><td></td><td><center><input class="ui-state-default ui-corner-all" type="submit" name="sendSharingInvite" value="Send Sharing Invite"></center></td></tr>
</table>
</form>

<form action="index.php#send_invites" method="post">

My Invitations:<br>
<input class="ui-state-default ui-corner-all" type="submit" name="deleteInvites" value="Delete Selected">
<table id="invitesTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>E-Mail</th> 
    <th>Full Name</th> 
    <th>Date</th>
    <td></td>
</tr> 
</thead> 
<tbody> 
<?php 
$queryInviteInfo = "SELECT user_id,email,full_name,created FROM users WHERE user_host_id=".$auth->getUserFound()->getUserId()." AND status=\"CREATED\"";

$inviteInfo = $sqlDataBase->query($queryInviteInfo);
foreach($inviteInfo as $id=>$userInfo)
{
	echo "<tr>
			<td>".$userInfo['email']."</td>
			<td>".$userInfo['full_name']."</td>
			<td>".$userInfo['created']."</td>
			<td><input type=\"checkbox\" name=\"invites[]\" value=\"".$userInfo['user_id']."\"></td>
		</tr>";
}

?>
</tbody> 
</table> 

</form>