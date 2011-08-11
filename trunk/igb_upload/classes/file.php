<?php
/**
 * File class
 * used to allow for actions on files uploaded or downloaded
 * Enter description here ...
 * @author nevoband
 *
 */
class file
{
	private $sqlDataBase;
	private $fileId;
	private $fileSize;
	private $fileName;
	private $secretKey;
	private $userId;
	private $groupId;
	private $status;

	public function __construct($sqlDataBase, $fileId=null)
	{
		$this->sqlDataBase = $sqlDataBase;

		if($fileId)
		{
			$this->LoadFile($fileId);
		}
	}

	public function __desctruct()
	{

	}

	/**
	 * Create a file in the database update filesize and name
	 * Enter description here ...
	 * @param unknown_type $fileName
	 * @param unknown_type $fileSize
	 * @param unknown_type $userId
	 * @param unknown_type $groupId
	 */
	public function CreateFile($fileName,$fileSize,$userId,$groupId=0)
	{
		$secretKey = $this->generateCode(25);
		$queryInsertFile = "INSERT INTO files (filename,upload_date,secret_key, size, user_id,group_id,status)
							VALUES(\"".$fileName."\",NOW(),\"".$secretKey."\",".$fileSize.",".$userId.",".$groupId.",\"COMPLETE\")";
		error_log($queryInsertFile,0);
		$fileId = $this->sqlDataBase->insertQuery($queryInsertFile);
		$this->fileId = $fileId;
		$this->fileSize = $fileSize;
		$this->fileName = $fileName;
		$this->secretKey = $secretKey;
		$this->groupId = $groupId;
		$this->status = "COMPLETE";

		return $fileId;
	}

	/**
	 * Move file from its temporary location to a new one.
	 * NOT USED BY ANYTHING RIGHT NOW
	 * Enter description here ...
	 * @param unknown_type $fileTmpName
	 */
	public function MoveFile($fileTmpName)
	{
		if(move_uploaded_file($fileTmpName, UPLOADS_PATH.$this->fileId))
		{
			$secretKey = $this->generateCode();
			$queryUpdateFileMove = "UPDATE files SET status=\"COMPLETED\", secret_key=\"".$secretKey."\" WHERE file_id=".$this->fileId;
			$this->sqlDataBase->nonSelectQuery($queryUpdateFileMove);
			$this->status="COMPLETED";
			return true;
		}
		else
		{
			$queryDeleteFile = "DELETE FROM files WHERE file_id=".$this->fileId;
			$this->sqlDataBase->nonSelectQuery($queryDeleteFile);
				
			return false;
		}
	}

	/**
	 * Load file information from database
	 * Enter description here ...
	 * @param unknown_type $fileId
	 */
	public function LoadFile($fileId)
	{
		$queryFileInfo = "SELECT filename,upload_date,secret_key,size,user_id,group_id,status FROM files WHERE file_id=".$fileId;
		$fileInfo = $this->sqlDataBase->query($queryFileInfo);
		$this->fileName = $fileInfo[0]['filename'];
		$this->uploadDate = $fileInfo[0]['upload_date'];
		$this->secretKey = $fileInfo[0]['secret_key'];
		$this->fileSize = $fileInfo[0]['size'];
		$this->userId = $fileInfo[0]['user_id'];
		$this->groupId = $fileInfo[0]['group_id'];
		$this->fileId = $fileId;
		$this->status = $fileInfo[0]['status'];
	}

	/**
	 * Load file by secret key to allow a user to download the file using wget on linux systems
	 * Enter description here ...
	 * @param unknown_type $secretKey
	 */
	public function LoadFileByKey($secretKey)
	{
		$queryFileInfo = "SELECT file_id,filename,upload_date,secret_key,size,user_id FROM files WHERE secret_key=".$secretKey;
		$fileInfo = $this->sqlDataBase->query($queryFileInfo);
		$this->fileName = $fileInfo[0]['filename'];
		$this->uploadDate = $fileInfo[0]['upload_date'];
		$this->secretKey = $fileInfo[0]['secret_key'];
		$this->fileSize = $fileInfo[0]['size'];
		$this->userId = $fileInfo[0]['user_id'];
		$this->fileId = $fileInfo[0]['file_id'];
		$this->groupId = $fileInfo[0]['group_id'];
	}

	/**
	 * Delete the file from the database and from the drive (only mark it as deleted so we have a history in the database)
	 * Enter description here ...
	 */
	public function DeleteFile()
	{
		$queryDeleteFile = "UPDATE files SET status=\"DELETED\" WHERE file_id=".$this->fileId;
		$this->sqlDataBase->nonSelectQuery($queryDeleteFile);
		unlink(UPLOAD_PATH. DIRECTORY_SEPARATOR .$this->fileId);
	}

	/**
	 * Send a header to download file.
	 * Enter description here ...
	 */
	public function DownoadFile()
	{
		header("download.php?key=".$this->secretKey);
	}

	/**
	 * Convert bytes to a more readable format
	 * Enter description here ...
	 * @param unknown_type $bytes
	 */
	public static function ByteSize($bytes)
	{
		$size = $bytes / 1024;
		if($size < 1024)
		{
			$size = number_format($size, 2);
			$size .= ' KB';
		}
		else
		{
			if($size / 1024 < 1024)
			{
				$size = number_format($size / 1024, 2);
				$size .= ' MB';
			}
			else if ($size / 1024 / 1024 < 1024)
			{
				$size = number_format($size / 1024 / 1024, 2);
				$size .= ' GB';
			}
		}
		return $size;
	}
	
	/**
	 * Delete files that have been sitting on the server for too long. 
	 * This is used to prevent people from using this as a file storate program
	 * Enter description here ...
	 * @param unknown_type $expiredTime
	 * @param unknown_type $sqlDataBase
	 */
	public static function DeleteExpiredFiles($expiredTime,$sqlDataBase)
	{
		$queryExpiredFiles = "SELECT file_id FROM files WHERE (UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(upload_date))>".$expiredTime;
		$expiredFiles = $sqlDataBase->query($queryExpiredFiles);
		if($expiredFiles)
		{
			foreach($expiredFiles as $expiredFile)
			{
				$fileToDelete = new file($sqlDataBase,$expiredFile['file_id']);
				$fileToDelete->DeleteFile();
			}
		}
	}

	/**
	 * Generate a key code for file downloads used thorugh GET
	 * Enter description here ...
	 * @param unknown_type $length
	 */
	private function generateCode($length = 10)
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

	//getters or setters
	public function getFileId() { return $this->fileId; }
	public function getFileSize() { return $this->fileSize; }
	public function getFileName() { return $this->fileName; }
	public function getSecretKey() { return $this->secretKey; }
	public function getUserId() { return $this->userId; }
	public function getGroupId() { return $this->groupId; }
}
?>