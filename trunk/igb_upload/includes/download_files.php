<?php
if(isset($_POST['deleteDownloads']))
{
	if(isset($_POST['downloads']))
	{
		echo 1;
		$downloadsToDelete = $_POST['downloads'];
		foreach($downloadsToDelete as $downloadToDelete)
		{
			$file = new file($sqlDataBase,$downloadToDelete);
			$invitee = new user($sqlDataBase,$file->getUserId());
			if($invitee->getHostId()==$auth->getUserFound()->getUserId())
			{
				$file->DeleteFile();
			}
		}
	}
}
?>
<script>
$(function() 
	    { 
	        $("#filesTable").tablesorter(); 
	    });
</script>

<form action="index.php#download_files" method="post">
<input class="ui-state-default ui-corner-all" type="submit" name="deleteDownloads" value="Delete Selected">
<input class="ui-state-default ui-corner-all" type="submit" name="refreshDownloadList" value="Refresh">
<table id="filesTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>Filename</th> 
    <th>Size</th> 
    <th>Date</th>
    <th>Uploader</th> 
    <th>E-Mail</th>  
    <td>Select</td>
</tr> 
</thead> 
<tbody> 
<?php 
$queryUserFiles = "SELECT f.file_id, f.filename, f.extension, f.upload_date, f.secret_key, f.size, f.user_id, f.group_id, f.status, u.full_name,u.email
					FROM files f, users u
					WHERE (f.user_id=u.user_id 
							AND u.user_host_id=".$auth->getUserFound()->getUserId().") AND f.status=\"COMPLETE\" AND u.user_host_id!=0";

$userFiles = $sqlDataBase->query($queryUserFiles);
foreach($userFiles as $id=>$userFile)
{
	echo "<tr>
			<td><a href=\"includes/download.php?id=".$userFile['file_id']."&key=".$userFile['secret_key']."\">".$userFile['filename']."</a></td>
			<td>".round(($userFile['size']/1048576),2)."MB</td>
			<td>".$userFile['upload_date']."</td>
			<td>".$userFile['full_name']."</td>
			<td>".$userFile['email']."</td>
			<td><input type=\"checkbox\" name=\"downloads[]\" value=\"".$userFile['file_id']."\"></td>
		</tr>";
}

?>
</tbody>
</table> 
</form>