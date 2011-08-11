<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
<div id="tabs">
	<ul>
	<?php 
	if($tmpPasswordSet)
	{
	}
	else
	{
	?>	
		<li><a href="#home">Home</a></li>
		<li><a href="#download_files">Download Shared Files</a></li>
		<li><a href="#upload_files">Upload Files</a></li>
	<?php
	} 

	if($auth->getUserFound()->getUserType()== "GUEST")
	{ 
	?>
		<li><a href="#set_password">Set Password</a></li>
	<?php } elseif($auth->getUserFound()->getUserType()=="IGB") {?>
		<li><a href="#send_invites">Send Invites</a></li>
	<?php } ?>
	</ul>
	
	<?php 
	if($tmpPasswordSet)
	{
	}
	else
	{
	?>	
	<div id="home">
		<?php include "includes/home.php"; ?>
	</div>
	<div id="download_files">
		<?php include "includes/download_files.php"?>
	</div>
	<div id="upload_files">
		<?php include "includes/upload_ui.php"; ?>
	</div>
	<?php
	}
	if($auth->getUserFound()->getUserType()=="GUEST")
	{ 
	?>
		<div id="set_password">
			
			<?php 
			if($tmpPasswordSet)
			{
				echo "You must set a password in order to use file sharing.<br>";
			}	
			include "includes/set_password.php"; 
			?>
		</div>
	<?php } elseif($auth->getUserFound()->getUserType()=="IGB") {?>
		<div id="send_invites">
			<?php include "includes/invite.php"; ?>
		</div>
	<?php } ?>
</div>
