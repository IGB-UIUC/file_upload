<?php 
if(isset($_POST['deleteUploads']))
{
	if(isset($_POST['uploads']))
	{
		$uploadsToDelete = $_POST['uploads'];
		foreach($uploadsToDelete as $uploadToDelete)
		{
			$file = new file($sqlDataBase,$uploadToDelete);
			if($file->getUserId()==$auth->getUserFound()->getUserId())
			{
				$file->DeleteFile();
			}
		}
	}
}

?>

<form id="uploadForm" method="post" action="dump.php">
	<div id="uploader">
		<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
	</div>
</form>
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").plupload({

		// General settings flash,html4,browserplus,silverlight,gears,
		runtimes : 'flash,silverlight,browserplus,html4,html5',
		url : 'includes/upload.php?id=<?php echo $auth->getUserFound()->getUserId();?>&key=<?php echo $auth->getSessionKey(); ?>',
		max_file_size : '2000mb',
		max_file_count: 40, // user can add no more then 40 files at a time
		//chunk_size : '100mb',
		unique_names : false,
		multiple_queues : true,

		// Resize images on clientside if we can
		resize : {width : 320, height : 240, quality : 90},
		
		// Rename files by clicking on their titles
		rename: true,
		
		// Sort files
		sortable: true,

		// Specify what files to browse for
		filters : [
			{title : "All", extensions : "*"}
		],

		// Flash settings
		flash_swf_url : 'js/plupload.flash.swf',

		// Silverlight settings
		silverlight_xap_url : 'js/plupload.silverlight.xap'
	});

	// Client side form validation
	$('uploadForm').submit(function(e) {
		var uploader = $('#uploader').plupload('getUploader');

		// Validate number of uploaded files
		if (uploader.total.uploaded == 0) {
			// Files in queue upload them first
			if (uploader.files.length > 0) {
				// When all files are uploaded submit form
				uploader.bind('UploadProgress', function() {
					if (uploader.total.uploaded == uploader.files.length)
						$('form').submit();
				});

				uploader.start();
			} else
				alert('You must at least upload one file.');

			e.preventDefault();
		}
	});

});
</script>
<br><br>
My Uploads:
<form name="uploadsListForm" action="index.php#upload_files" method="post">
<input class="ui-state-default ui-corner-all" type="submit" name="deleteUploads" value="Delete Selected">
<input class="ui-state-default ui-corner-all" type="submit" name="refreshUploadList" value="Refresh">
<script>
$(function() 
	    { 
	        $("#uploadsTable").tablesorter(); 
	    });
</script>

<table id="uploadsTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>Filename</th> 
    <th>Size</th> 
    <th>Date</th>
    <td>Select</td>
</tr> 
</thead> 
<tbody> 
<?php 
$queryUserFiles = "SELECT f.file_id, f.filename, f.extension, f.upload_date, f.secret_key, f.size, f.user_id, f.group_id, f.status, u.full_name,u.email
					FROM files f, users u
					WHERE f.user_id=".$auth->getUserFound()->getUserId()." AND u.user_id=f.user_id AND f.status=\"COMPLETE\"";
$userFiles = $sqlDataBase->query($queryUserFiles);

foreach($userFiles as $id=>$userFile)
{

	echo "<tr>
			<td><a href=\"includes/download.php?id=".$userFile['file_id']."&key=".$userFile['secret_key']."\">".$userFile['filename']."</a></td>
			<td>".file::ByteSize($userFile['size'])."</td>
			<td>".$userFile['upload_date']."</td>
			<td><input type=\"checkbox\" name=\"uploads[]\" value=\"".$userFile['file_id']."\"></td>
		</tr>";
}

?>
</tbody>
</table> 
</form>