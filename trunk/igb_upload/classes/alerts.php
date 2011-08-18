<?php
class alerts
{
	public static $ERROR = 1;
	public static $INFO = 2;
	
	public static function alertBox($subject, $message,$type)
	{
		switch($type)
		{
			
			case self::$ERROR:
				return "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em; width:300px;\"> 
							<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span> 
							<strong>".$subject.":</strong><br>".$message."</p>
						</div>";
			case self::$INFO:
				return "<div class=\"ui-state-highlight ui-corner-all\" style=\"padding: 0 .7em; width:300px;\"> 
							<p><span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span> 
							<strong>".$subject.":</strong><br>".$message."</p>
						</div>";
		}
		
		return "Alert box not found";
	}
	
}

?>