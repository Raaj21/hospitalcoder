<?php
	$active_status = array(
		0	=> 'Inactive',
		1	=> 'Active',
	);

	function getAllUserRoles($active=2)
	{
		$conn = db();
		$active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$active_condition = " active = ".$active." AND ";
		}
		$get_all = "SELECT user_role_id, user_role_name 
						FROM ".USER_ROLES_TABLE." WHERE ".$active_condition." user_role_delete = 1
						ORDER BY user_role_name ASC";

		$get_all_user_role = mysqli_query($conn,$get_all);
		$count_user_role  = mysqli_num_rows($get_all_user_role);
		
		if($count_user_role >0) {
			$arr_user_role    = array();
			
			while($record = mysqli_fetch_array($get_all_user_role)) {
				
				$arr_user_role[] = $record;
			}
			
			return $arr_user_role;
			
		} else {
			return 	$count_user_role;	
		}
	}
	
	function getAllLocation($active=2)
	{
		$conn = db();
		$active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$active_condition = " active = ".$active." AND ";
		}
		$get_all = "SELECT location_id, locationt_name 
						FROM ".LOCATION_TABLE." WHERE ".$active_condition." location_delete = 1
						ORDER BY locationt_name ASC";
		
		$get_all_location = mysqli_query($conn,$get_all);
		$count_location  = mysqli_num_rows($get_all_location);
		
		if($count_location >0) {
			$arr_location    = array();
			
			while($record = mysqli_fetch_array($get_all_location)) {
				
				$arr_location[] = $record;
			}
			
			return $arr_location;
			
		} else {
			return 	$count_location;	
		}
	}
	
	function getAllProjects($active=2)
	{
		$conn = db();
		$active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$active_condition = " active = ".$active." AND ";
		}
			
		$get_all = "SELECT project_id, project_name 
						FROM ".PROJECT_TABLE." WHERE ".$active_condition." project_delete = 1
						ORDER BY project_name ASC";

		$get_all_projects = mysqli_query($conn,$get_all);
		$count_projects  = mysqli_num_rows($get_all_projects);
		
		if($count_projects >0) {
			$arr_user_role    = array();
			
			while($record = mysqli_fetch_array($get_all_projects)) {
				$arr_user_role[] = $record;
			}
			
			return $arr_user_role;
			
		} else {
			return 	$count_projects;	
		}
	}
	
	
	function getAllProjectwithDetails($active=2)
	{
		$conn = db();
		$p_active_condition = "";
		$s_active_condition = "";
		$c_active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$p_active_condition = " p.active = ".$active." AND ";
			$s_active_condition = " s.active = ".$active." AND ";
			$c_active_condition = " c.active = ".$active." AND ";
			$u_active_condition = " u.active = ".$active." AND ";
		}
			$c_active_condition = " c.active = 1 AND ";
			$u_active_condition = " u.active = 1 AND ";

		$get_all = "SELECT p.project_id, p.project_name, p.active, p.created_at,
						(SELECT COUNT(*) 
							FROM ".SUB_PROJECT_TABLE." as s 
							WHERE s.main_project_id  = p.project_id AND 
							".$s_active_condition."
							s.sub_project_delete = 1 
						) AS sub_count ,
						(SELECT COUNT(*) 
							FROM ".CLIENT_IDS_TABLE." as c 
							WHERE c.main_project_id  = p.project_id AND 
							".$c_active_condition."
							c.client_id_delete = 1 
						) AS client_count ,
						(SELECT COUNT(*) 
							FROM ".USER_CLIENT_TABLE." as u 
							WHERE u.main_project_id  = p.project_id AND 
							".$u_active_condition."
							u.user_client_delete = 1 
						) AS coder_count 
					FROM ".PROJECT_TABLE." as p  
					WHERE ".$p_active_condition." p.project_delete = 1 
					ORDER BY p.active DESC, p.created_at DESC";
					
		$get_all_projects = mysqli_query($conn,$get_all);
		$count_projects  = mysqli_num_rows($get_all_projects);
		
		if($count_projects >0) {
			$arr_projects    = array();
			
			while($record = mysqli_fetch_array($get_all_projects)) {
				$arr_projects[] = $record;
			}

			return $arr_projects;
			
		} else {
			return 	$count_projects;	
		}
	}
	
	
	function getAllSubProjectwithDetails($active=2,$main_pro_id=0)
	{
		$conn = db();
		$main_project_id = "";
		$s_active_condition = "";
		$c_active_condition = "";
		$p_active_condition = "";
		$u_active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$p_active_condition = " p.active = ".$active." AND ";
			$s_active_condition = " s.active = ".$active." AND ";
			$c_active_condition = " c.active = ".$active." AND ";
			$u_active_condition = " u.active = ".$active." AND ";
		}
			$c_active_condition = " c.active = 1 AND ";
			$u_active_condition = " u.active = 1 AND ";
		if($main_pro_id != 0){
			$main_project_id = " s.main_project_id = ".$main_pro_id." AND ";
		}

		$get_all = "SELECT s.sub_project_id, s.sub_project_name, s.active, s.status, s.created_at,
						(SELECT COUNT(*) 
							FROM ".CLIENT_IDS_TABLE." as c 
							WHERE c.sub_project_id  = s.sub_project_id AND 
							".$c_active_condition."
							c.client_id_delete = 1 
						) AS client_count , 
						(SELECT m.project_name 
							FROM ".PROJECT_TABLE." as m 
							WHERE m.project_id  = s.main_project_id AND 
							m.project_delete = 1 
						) AS main_project_name ,
						(SELECT COUNT(*) 
							FROM ".USER_CLIENT_TABLE." as u 
							WHERE u.sub_project_id  = s.sub_project_id AND 
							".$u_active_condition."
							u.user_client_delete = 1 
						) AS coder_count 
					FROM ".SUB_PROJECT_TABLE." as s  
					WHERE ".$s_active_condition." ".$main_project_id." s.sub_project_delete= 1 
					ORDER BY s.active DESC, s.created_at DESC";
					
		$get_all_projects = mysqli_query($conn,$get_all);
		$count_projects  = mysqli_num_rows($get_all_projects);
		
		if($count_projects >0) {
			$arr_projects    = array();
			
			while($record = mysqli_fetch_array($get_all_projects)) {
				$arr_projects[] = $record;
			}

			return $arr_projects;
			
		} else {
			return 	$count_projects;	
		}
	}


	function getAllClientIds($active=2,$sub_pro_id=0)
	{
		$conn = db();
		$sub_project_id_sel = "";
		$active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$active_condition = " active = ".$active." AND ";
		}
		if($sub_pro_id != 0){
			$sub_project_id_sel = " sub_project_id = ".$sub_pro_id." AND ";
		}

		$get_all = "SELECT id, client_id, created_at, active 
						FROM ".CLIENT_IDS_TABLE." WHERE ".$sub_project_id_sel." ".$active_condition." client_id_delete = 1
						ORDER BY client_id ASC";

		$get_all_ids = mysqli_query($conn,$get_all);
		$count_projects  = mysqli_num_rows($get_all_ids);
		
		if($count_projects >0) {
			$arr_user_role    = array();
			
			while($record = mysqli_fetch_array($get_all_ids)) {
				$arr_user_role[] = $record;
			}
			
			return $arr_user_role;
			
		} else {
			return 	$count_projects;	
		}
	}	
	
	
	function getAllUser($active=2,$role=0)
	{
		$conn = db();
		
		$active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$active_condition = " u.active = ".$active." AND ";
		}
		
		$role_condition = "";
		if(($role == 1)|| ($role == 2)|| ($role == 3)){
			$role_condition = " u.user_role_id = ".$role." AND ";
		}
		
		$get_all = "SELECT u.id, u.user_id, u.user_name, u.active, u.user_role_id,r.user_role_name 
					FROM ".USER_TABLE." as u 
					left join ".USER_ROLES_TABLE." as r 
					on u.user_role_id=r.user_role_id 
					WHERE ".$active_condition." ".$role_condition." u.user_delete = 1 ";

		$get_all_users = mysqli_query($conn,$get_all);
		$count_users  = mysqli_num_rows($get_all_users);
		
		if($count_users >0) {
			$arr_users    = array();
			
			while($record = mysqli_fetch_array($get_all_users)) {
				$arr_users[] = $record;
			}
			
			return $arr_users;
			
		} else {
			return 	$count_users;	
		}
	}
	
	function isMainProjectActive($pro_id=0)
	{
		if(($pro_id !=0) && ($pro_id !='') ){
			$main_pro_id = (int)(trim($pro_id));
			$conn = db();
			$get_all = "SELECT project_name 
							FROM ".PROJECT_TABLE." WHERE project_id = '".$main_pro_id."' AND active = 1 AND  project_delete = 1 ";

			$get_all_projects = mysqli_query($conn,$get_all);
			$projects  = mysqli_num_rows($get_all_projects);
			
			if($projects >0) {
				$row = mysqli_fetch_array($get_all_projects);
				return $row['project_name'];
			}
		}
		return "";
	}
	
	function getMainAndSubProIdsByClientIdId($clientId=0)
	{
		if(($clientId != 0) && ($clientId != '')){
			$clientId = (int)(trim($clientId));
			$conn = db();
			$get_all = "SELECT main_project_id,sub_project_id 
							FROM ".CLIENT_IDS_TABLE." WHERE id = '".$clientId."' AND active = 1 AND  client_id_delete = 1 ";

			$get_all_projects = mysqli_query($conn,$get_all);
			$projects  = mysqli_num_rows($get_all_projects);
			
			if($projects >0) {
				$row = mysqli_fetch_array($get_all_projects);
				return array($row['main_project_id'],$row['sub_project_id']);
			}
		}
		return array(0,0);
	}
	
	function getAllCoderIdOfClientIdId($clientId=0)
	{
		if(($clientId != 0) && ($clientId != '')){
			$clientId = (int)(trim($clientId));
			$conn = db();
			$get_all = "SELECT user_id,active 
							FROM ".USER_CLIENT_TABLE." WHERE client_ids_id = '".$clientId."' AND active = 1 AND  user_client_delete = 1 ";

			$get_all_user = mysqli_query($conn,$get_all);
			$count_user  = mysqli_num_rows($get_all_user);
			
			if($count_user >0) {
				$arr_user    = array();
				
				while($record = mysqli_fetch_array($get_all_user)) {
					
					$arr_user[] = $record['user_id'];
				}
				
				return $arr_user;
				
			} else {
				return 	$count_user;	
			}
		}
		return 0;
	}
	
	
	function getAllCoderDetailsOfClientIdId($active=2,$clientId=0)
	{
		if(($clientId != 0) && ($clientId != '')){
			$clientId = (int)(trim($clientId));
			$conn = db();
			
			$active_condition = "";
			if(($active == 1)|| ($active == 0)){
				$active_condition = " c.active = ".$active." AND ";
			}
			$get_all = "SELECT c.user_id,c.active,
							( SELECT u.user_name
							FROM ".USER_TABLE." as u
							WHERE u.id = c.user_id AND
							u.active = 1 AND u.user_delete = 1) as u_name
							FROM ".USER_CLIENT_TABLE." as c
							WHERE c.client_ids_id = '".$clientId."' AND ".$active_condition."  c.user_client_delete = 1 ";

			$get_all_user = mysqli_query($conn,$get_all);
			$count_user  = mysqli_num_rows($get_all_user);
			
			if($count_user >0) {
				$arr_user    = array();
				
				while($record = mysqli_fetch_array($get_all_user)) {
					
					$arr_user[] = $record;
				}
				
				return $arr_user;
				
			} else {
				return 	$count_user;	
			}
		}
		return 0;
	}
	
	function getSubProjectbySubProjectId($sub_pro_id=0)
	{
		if(($sub_pro_id != 0) && ($sub_pro_id != '')){
			$sub_pro_id = (int)(trim($sub_pro_id));
			$conn = db();
			$get_all = "SELECT sub_project_name,main_project_id,status,created_at,active 
							FROM ".SUB_PROJECT_TABLE." WHERE sub_project_id = '".$sub_pro_id."' AND sub_project_delete = 1 ";

			$get_sub_pro = mysqli_query($conn,$get_all);
			$count_pro  = mysqli_num_rows($get_sub_pro);
			
			if($count_pro >0) {
				$arr_pro    = array();
				
				while($record = mysqli_fetch_array($get_sub_pro)) {
					
					$arr_pro[] = $record;
				}
				
				return $arr_pro;
				
			} else {
				return 	$count_pro;	
			}
		}
		return 0;
	}
	
	function getAllAdmin($active=2)
	{
		return getAllUser($active,1);
	}

	function getAllTL($active=2)
	{
		return getAllUser($active,2);
	}
	
	function getAllCoder($active=2)
	{
		return getAllUser($active,3);
	}
	
	function userAuthentication()
	{
		try {
			$conn = db();
			$user_username       = dataValidation($_POST['user_name'],$conn);
			$user_password       = dataValidation($_POST['user_pass'],$conn);

			$request_fields = ((!empty($user_username)) && (!empty($user_password)));
				
			#checkRequestFields($request_fields, PROJECT_PATH, "");
			
			$select_user = "SELECT id,user_id, user_name, user_password, user_role_id 
							FROM   ".USER_TABLE." 
							WHERE  user_name      = '".$user_username."' 
							AND    active = 1
							AND    user_delete = 1"; 
			
			$result_user = mysqli_query($conn,$select_user);
			$count_user  = mysqli_num_rows($result_user);

			if($count_user == 1) {
				$record_user      = mysqli_fetch_array($result_user);
				$user_password    = md5($user_password);
				$user_db_password = getRealPassword($record_user['user_password']);
				
				if($user_password == $user_db_password) {
					$_SESSION[SESS.'_session_id']              		= $record_user['id'];
					$_SESSION[SESS.'_session_user_id']              = $record_user['user_id'];
					$_SESSION[SESS.'_session_user_username']        = $record_user['user_name'];
					$_SESSION[SESS.'_session_user_level']           = $record_user['user_role_id'];
					$_SESSION[SESS.'_session_alert_msg']			= '';
					
					
					if($_SESSION[SESS.'_session_user_level'] == '1')
					{
						header("Location:home.php");
						exit();
					}

					else if($_SESSION[SESS.'_session_user_level'] == '3')
					{

						header("Location:user-home.php");
						exit();
						//header("Location:".PROJECT_PATH."/user-home.php");
						//exit();					
					}

				 } else {
				 	$_SESSION[SESS.'_session_alert_msg'] = 'Invalide username or password';
				 	header("Location:index.php?msg=1");  
					exit();
				 }
			}
			else {
				$_SESSION[SESS.'_session_alert_msg'] = 'Invalide username or password';
				header("Location:".PROJECT_PATH."/index.php?msg=2");  
				exit();
			}
		}

		//catch exception
		catch(Exception $e) {
				$error = $e->getMessage();
				$_SESSION[SESS.'_session_alert_msg'] = $error;
				header("Location:".PROJECT_PATH."/index.php?msg=3".$error);  
				exit();
		}
	}
	
	
	function checkRequestFields($request_fields, $path, $page) {
		if (!$request_fields) { 
			$_SESSION[SESS.'_session_alert_msg'] = 'Please fill all required fields';
			header("Location:".PROJECT_PATH.'/?1'); 
			exit();
		} else {
			return true;
		}	
	}
	
	function adminPermission()
	{
		if($_SESSION[SESS.'_session_user_level'] == '1')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function tlPermission()
	{
		if($_SESSION[SESS.'_session_user_level'] == '2')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function coderPermission()
	{
		if($_SESSION[SESS.'_session_user_level'] == '3')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getRealPassword($password) {
		$real_password = substr($password,0,7).substr($password,10,4).substr($password,19,21); 
		return $real_password;
	}
	
	function generatePassword($password) {
		$password = md5($password);
		$generate_password = substr($password,0,7).generateRandomString(3).substr($password,7,4).generateRandomString(5).substr($password,11,22);
		return $generate_password;
	}
	
	function generateRandomString($length) {
		$alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);
	}
	
	function dataValidation($value,$connection) 
	{
		$value = trim(htmlspecialchars($value));
		// if(get_magic_quotes_gpc()) { 

			
		// 	$value = stripslashes($value); 
		// }  
		$value = mysqli_real_escape_string($connection,$value); 
		return $value;
	}
	
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
	
	function db () {
		static $conn;
		if ($conn===NULL){ 
			$conn = mysqli_connect (HOST, USERNAME, PASSWORD, DB);
		}
		return $conn;
	}

	function addUser()
	{
		$conn = db();
		$new_user_name      = trim(dataValidation($_POST['new_user_name'],$conn));
		$new_user_id      	= trim(dataValidation($_POST['new_user_id'],$conn));
		$new_user_password		= trim(dataValidation($_POST['new_user_password'],$conn));
		$new_user_role		= trim(dataValidation($_POST['new_user_role'],$conn));
		$arr_projects    = array();
		if(!empty($_POST['new_user_projects'])) {
			$vals = $_POST['new_user_projects'];
		  foreach($vals as $selected){
			$arr_projects[] = $selected;
		  }          
		}
		$d = date("Y-m-d H:i:s");
		$user_password = generatePassword($new_user_password);
		#$request_fields = (!empty($customer_name));
			
		#checkRequestFields($request_fields, PROJECT_PATH, "");
		if((!empty($new_user_name)) && (!empty($user_password)) && (!empty($new_user_role)) && (!empty($new_user_id)) )
		{
			$query = "select count(*) as cntUser from ".USER_TABLE." where user_name='".$new_user_name."' OR user_id = '".$new_user_id."'  " ;
			$result = mysqli_query($conn,$query);
			if(mysqli_num_rows($result)){
				  $row = mysqli_fetch_array($result);

				  $count = $row['cntUser'];

				  if($count == 0){
						$insert_feedback = "INSERT INTO ".USER_TABLE."(user_name,user_password ,user_role_id, user_id,
									created_by, created_at ) 
									VALUES ('".$new_user_name."','".$user_password."', '".$new_user_role."','".$new_user_id."',
									 '".$_SESSION[SESS.'_session_id']."','".$d."' )"; 		

						if(mysqli_query($conn,$insert_feedback)){
								return "1";
							}
				  }
				  else{
					  return "User Name/ User Id already taken. Use Different.";
				  }
			}
		}
		else{
			return "Please fill all required fields";
		}
		return "Something Wrong! Try Again Later";
	}
	
	
	function addProject()
	{
		$conn = db();
		$project_name      = trim(dataValidation($_POST['project_name'],$conn));
		$project_location      	= trim(dataValidation($_POST['project_location'],$conn));
		$project_user		= trim(dataValidation($_POST['project_user'],$conn));

		$d = date("Y-m-d H:i:s");
		#$request_fields = (!empty($customer_name));
			
		#checkRequestFields($request_fields, PROJECT_PATH, "");
		if((!empty($project_name)) && (!empty($project_location)) && (!empty($project_user)) )
		{
			$query = "select count(*) as cntProject from ".PROJECT_TABLE." where project_name='".$project_name."'  " ;
			$result = mysqli_query($conn,$query);
			if(mysqli_num_rows($result)){
				  $row = mysqli_fetch_array($result);

				  $count = $row['cntProject'];

				  if($count == 0){
						$insert_feedback = "INSERT INTO ".PROJECT_TABLE."(project_name,location_id , user_id,
									created_by, created_at ) 
									VALUES ('".$project_name."','".$project_location."','".$project_user."',
									 '".$_SESSION[SESS.'_session_id']."','".$d."' )"; 		

						if(mysqli_query($conn,$insert_feedback)){
								return "1";
							}
				  }
				  else{
					  return "Project Name already taken. Use Different.";
				  }
			}
		}
		else{
			return "Please fill all required fields";
		}
		return "Something Wrong! Try Again Later";
	}

	function addSubProject()
	{
		$conn = db();
		$main_pro_id      = trim(dataValidation($_POST['main_pro_id'],$conn));
		$s_project_name      	= trim(dataValidation($_POST['s_project_name'],$conn));

		$arr_client_ids    = array();
		if(!empty($_POST['client_id'])) {
			$vals = $_POST['client_id'];
			foreach($vals as $selected){
				if( (trim($selected)) != ''){
					if(isValidEmail($selected)){
						$arr_client_ids[] = $selected;
					}
				}
			}          
		}
		
		$d = date("Y-m-d H:i:s");

		if((!empty($main_pro_id)) && (!empty($s_project_name)) )
		{
			$query = "select count(*) as cntSubProject from ".SUB_PROJECT_TABLE." where sub_project_name='".$s_project_name."' AND main_project_id='".$main_pro_id."' " ;
			$result = mysqli_query($conn,$query);
			if(mysqli_num_rows($result)){
				  $row = mysqli_fetch_array($result);

				  $count = $row['cntSubProject'];

				  if($count == 0){
						$insert_feedback = "INSERT INTO ".SUB_PROJECT_TABLE."(sub_project_name,main_project_id,
									created_by, created_at ) 
									VALUES ('".$s_project_name."','".$main_pro_id."',
									 '".$_SESSION[SESS.'_session_id']."','".$d."' )"; 		

							if(mysqli_query($conn,$insert_feedback)){
								if(!empty($arr_client_ids))
								{
									$sub_project_id = mysqli_insert_id($conn);
									foreach($arr_client_ids as $client_id){
										$insert_clientid = "INSERT INTO ".CLIENT_IDS_TABLE."(client_id,main_project_id,sub_project_id,
													created_by, created_at ) 
													VALUES ('".$client_id."','".$main_pro_id."','".$sub_project_id."',
													 '".$_SESSION[SESS.'_session_id']."','".$d."' )";
										mysqli_query($conn,$insert_clientid);
									}
								}
								return "1";
							}
				  }
				  else{
					  return "Sub-Project Name already taken for this Main Project. Use Different.";
				  }
			}
		}
		else{
			return "Please fill all required fields";
		}
		return "Something Wrong! Try Again Later";
	}	
	
	
	function addCoder()
	{
		$conn = db();
		$sel_client_id      = trim(dataValidation($_POST['sel_client_id'],$conn));

		$arr_user_ids    = array();
		if(!empty($_POST['user_ids'])) {
			$vals = $_POST['user_ids'];
			foreach($vals as $selected){
				if( (trim($selected)) != ''){
					$arr_user_ids[] = $selected;
				}
			}          
		}
		
		$d = date("Y-m-d H:i:s");

		if(!empty($sel_client_id))
		{
			list($main_pro_id,$sub_pro_id ) = getMainAndSubProIdsByClientIdId($sel_client_id);
			$coun = 0;
			
			$update_qry = "UPDATE ".USER_CLIENT_TABLE." SET active = 0 WHERE client_ids_id='".$sel_client_id."' ";
			$result = mysqli_query($conn,$update_qry);
			
			foreach($arr_user_ids as $user_id){
				$query = "select count(*) as cnt from ".USER_CLIENT_TABLE." where user_id='".$user_id."' AND client_ids_id='".$sel_client_id."' AND user_client_delete = 1 " ;
				$result = mysqli_query($conn,$query);
				if(mysqli_num_rows($result))
				{
					$row = mysqli_fetch_array($result);
					$count = $row['cnt'];

					if($count == 0){
							$insert_feedback = "INSERT INTO ".USER_CLIENT_TABLE."(user_id,client_ids_id , main_project_id, sub_project_id,
								created_by, created_at ) 
								VALUES ('".$user_id."','".$sel_client_id."','".$main_pro_id."','".$sub_pro_id."',
								 '".$_SESSION[SESS.'_session_id']."','".$d."' )"; 		

					if(mysqli_query($conn,$insert_feedback)){
						$coun++;
						}
					}
					else if($count == 1){
						$update_qry = "UPDATE ".USER_CLIENT_TABLE." SET active = 1 WHERE client_ids_id='".$sel_client_id."' AND user_id='".$user_id."' AND user_client_delete = 1 ";
						$result = mysqli_query($conn,$update_qry);
					}
				}
			}
			return "1";
		}
		else{
			return "Please fill all required fields";
		}
		return "Something Wrong! Try Again Later";
	}


	function getAllCoderDetailsOfUser($active=2,$clientId=0)
	{
		if(($clientId != 0) && ($clientId != '')){
			$clientId = (int)(trim($clientId));
			$conn = db();
			
			$active_condition = "";
			if(($active == 1)|| ($active == 0)){
				$active_condition = " c.active = ".$active." AND ";
			}
			$get_all = "SELECT c.user_id,c.active,c.client_ids_id,c.main_project_id,c.sub_project_id,
							( SELECT u.user_name
							FROM ".USER_TABLE." as u
							WHERE u.id = c.user_id AND
							u.active = 1 AND u.user_delete = 1) as u_name
							FROM ".USER_CLIENT_TABLE." as c
							WHERE c.user_id = '".$clientId."' AND ".$active_condition."  c.user_client_delete = 1 ";

			$get_all_user = mysqli_query($conn,$get_all);
			$count_user  = mysqli_num_rows($get_all_user);
			
			if($count_user >0) {
				$arr_user    = array();
				
				while($record = mysqli_fetch_array($get_all_user)) {
					
					$arr_user[] = $record;
				}
				
				return $arr_user;
				
			} else {
				return 	$count_user;	
			}
		}
		return 0;
	}



	function getAllClientProject($active=2,$pro_id = 0,$sub_pro_id=0)
	{
		if(($pro_id !=0) && ($pro_id !='') ){
			$main_pro_id = (int)(trim($pro_id));
			$conn = db();

			$get_all = "SELECT  u.user_id,r.user_name
					FROM ".PROJECT_TABLE." as u 
					left join ".USER_TABLE." as r 
					on u.user_id=r.id 
					WHERE u.project_id = '".$main_pro_id."' AND u.active = 1 AND  project_delete = 1 ";



			
			$get_all_projects = mysqli_query($conn,$get_all);
			$projects  = mysqli_num_rows($get_all_projects);
			
			if($projects >0) {
				$row = mysqli_fetch_array($get_all_projects);
				return $row['user_name'];
			}
		}
		return "";
	
	}	
	function adduserdailly(){

		
		$conn = db();
		$main_pro_id      = trim(dataValidation($_POST['main_pro_id'],$conn));
		$sub_project_name      	= trim(dataValidation($_POST['sub_project_name'],$conn));
		$tl		= trim(dataValidation($_POST['tl'],$conn));
		$chart_id		= trim(dataValidation($_POST['chart_id'],$conn));
		$total_page		= trim(dataValidation($_POST['total_page'],$conn));
		$total_docs		= trim(dataValidation($_POST['total_docs'],$conn));
		$total_icd		= trim(dataValidation($_POST['total_icd'],$conn));
		$pro_date		= trim(dataValidation($_POST['pro_date'],$conn));

		$d = date("Y-m-d H:i:s");
		#$request_fields = (!empty($customer_name));
			
		#checkRequestFields($request_fields, PROJECT_PATH, "");
		if((!empty($main_pro_id)) && (!empty($sub_project_name)) && (!empty($tl)) )
		{
		
						$insert_feedback = "INSERT INTO ".USER_WORK."(user_id,work_date , project_id,sub_project_id,tl_name,chart_id,total_page,total_docs,total_icd,
									created_by, created_at ) 
									VALUES ('".$_SESSION[SESS.'_session_id']."','".$pro_date."','".$main_pro_id."','".$sub_project_name."','".$tl."','".$chart_id."','".$total_page."','".$total_docs."','".$total_icd."',
									 '".$_SESSION[SESS.'_session_id']."','".$d."' )"; 	

									

						if(mysqli_query($conn,$insert_feedback)){
								return "1";
							}
				  
				 
			
		}
		else{
			return "Please fill all required fields";
		}
		return "Something Wrong! Try Again Later";
	
	}

	function getAllUserReport($active=1,$role=0){
		
		$conn = db();
		$active_condition = "";
		if(($active == 1)|| ($active == 0)){
			$active_condition = " active = ".$active."  ";
		}
		$get_all = "SELECT chart_id, total_page ,total_docs,total_icd,tl_name
						FROM ".USER_WORK." WHERE ".$active_condition." 
						";


		$get_all_user_role = mysqli_query($conn,$get_all);
		$count_user_role  = mysqli_num_rows($get_all_user_role);
		
		if($count_user_role >0) {
			$arr_user_role    = array();
			
			while($record = mysqli_fetch_array($get_all_user_role)) {
				
				$arr_user_role[] = $record;
			}
			
			return $arr_user_role;
			
		} else {
			return 	$count_user_role;	
		}

	}
	