<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
<div id="tabs">
	<ul>
	<?php 
	switch($auth->getUserFound()->getUserType())
	{
		case "IGB":
			echo "<li><a href=\"#home\">Home</a></li>
					<li><a href=\"#download_files\">Download Shared Files</a></li>
					<li><a href=\"#upload_files\">Upload Files</a></li>
					<li><a href=\"#send_invites\">Send Invites</a></li>";
			break;
		case "GUEST":
			echo "<li><a href=\"#home\">Home</a></li>
					<li><a href=\"#upload_files\">Upload Files</a></li>
					<li><a href=\"#set_password\">Set Password</a></li>";
			break;
		case "TMP_PASS":
			echo "<li><a href=\"#set_password\">Set Password</a></li>";
			
	}
	?>
	</ul>
	<?php 
	switch($auth->getUserFound()->getUserType())
	{
		case "IGB":
			echo "<div id=\"home\">";
			include "includes/home.php";
			echo "</div>";
			echo "<div id=\"download_files\">";
			include "includes/download_files.php";
			echo "</div>";
			echo "<div id=\"upload_files\">";
			include "includes/upload_ui.php";
			echo "</div>";
			echo "<div id=\"send_invites\">";
			include "includes/invite.php";
			echo "</div>";
			break;
		case "GUEST":
			echo "<div id=\"home\">";
			include "includes/home.php";
			echo "</div>";
			echo "<div id=\"upload_files\">";
			include "includes/upload_ui.php";
			echo "</div>";
			echo "<div id=\"set_password\">";
			include "includes/set_password.php";
			echo "</div>";
			break;
		case "TMP_PASS":
			echo "<div id=\"set_password\">";
			echo "You must set a password in order to use file sharing.<br>";
			include "includes/set_password.php";
			echo "</div>";
			break;
	}
	?>
</div>
