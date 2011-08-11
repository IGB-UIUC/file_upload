<?php
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

	public function DeleteFile()
	{
		$queryDeleteFile = "UPDATE files SET status=\"DELETED\" WHERE file_id=".$this->fileId;
		$this->sqlDataBase->nonSelectQuery($queryDeleteFile);
		unlink(UPLOAD_PATH. DIRECTORY_SEPARATOR .$this->fileId);
	}

	public function DownoadFile()
	{
		header("download.php?key=".$this->secretKey);
	}

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

	public function getFileId() { return $this->fileId; }
	public function getFileSize() { return $this->fileSize; }
	public function getFileName() { return $this->fileName; }
	public function getSecretKey() { return $this->secretKey; }
	public function getUserId() { return $this->userId; }
	public function getGroupId() { return $this->groupId; }
}
?>