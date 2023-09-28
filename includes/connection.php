<?php
	ob_start();
	session_start();


/*
// Local Server Databae Details and Path
*/

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB", "small_projects");

define("SESS", "ADMIN_APP");

define("PROJECT_PATH", "localhost/dhanraj/admin/");
define("PROJECT_FOLDER", "admin/");
define("INCLUDES_PATH", PROJECT_PATH."includes/");
define("INCLUDES_FOLDER", "includes/");


define("PROJECT_NAME", "Admin Panel"); 
define("PRODUCT_NAME", "Admin Panel"); 

define("DEVELOPER", "Karthik Ravi");
define("DEVELOPER_URL", "http://www.steptoinstall.com"); 


define("USER_ROLES_TABLE", "user_role");
define("USER_TABLE", "user");
define("PROJECT_TABLE", "project");
define("SUB_PROJECT_TABLE", "sub_project");
define("LOCATION_TABLE", "location");
define("CLIENT_IDS_TABLE", "client_ids");
define("USER_CLIENT_TABLE", "user_client");
define("USER_WORK", "user_work");


/*
// Timezone Setting
*/
date_default_timezone_set('Asia/Kolkata');


/* End of file connection.php */
/* Location: ./includes/connection.php */
?>