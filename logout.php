<?php 
require_once 'includes/connection.php'; 
require_once 'includes/utility-class.php'; 
 
	foreach($_SESSION as $key => $value)
	{
		if (strpos($key, SESS.'_') === 0)
		{
			unset($_SESSION[$key]); 
		}
	}
header("Location:".""."redirect.php"); 
exit();


/* End of file logout.php */
/* Location: /logout.php */
?>