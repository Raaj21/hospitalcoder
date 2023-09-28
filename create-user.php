<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && adminPermission())
	{
		$user_roles = getAllUserRoles(1);
		$all_projects = getAllProjects(1);
		$error_msg = "";
		$success_msg = "";
		$user_name = "";
		$user_id = "";
		$user_password  = "";
		$user_role = "";
		$arr_projects    = array();
		if(isset($_POST['new_user_name']) && isset($_POST['new_user_id'])) {
			$user_name = trim($_POST['new_user_name']);
			if($user_name == ''){ $error_msg .= " User Name,";}
			else if(strlen($user_name)<5){ $error_msg .= " User Name - Minimum Length 5 ,";}
			$user_id = trim($_POST['new_user_id']);
			if($user_id == ''){ $error_msg .= " User Id,";}
			$user_password = trim($_POST['new_user_password']);
			if($user_password == ''){ $error_msg .= " Password,";}
			$user_role = trim($_POST['new_user_role']);
			if($user_role == ''){ $error_msg .= " User Role,";}
			
			if(!empty($_POST['new_user_projects'])) {
				$vals = $_POST['new_user_projects'];

			  foreach($vals as $selected){
				$arr_projects[] = $selected;
			  }          
			}

			if($error_msg != ''){
				$error_msg = "Enter correct value in require field: ".(substr($error_msg, 0, -1));
			}
			else{
				$result = addUser();
				if($result != '1')
				{
					$error_msg = $result;
				}else{
					$error_msg = "";
					$user_name = "";
					$user_id = "";
					$user_password  = "";
					$user_role = "";
					$arr_projects    = array();
					$success_msg = "User Created Successfully!";
				}
			}
			
		}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project panel</title>
    <meta name="description" content="Project panel">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include(INCLUDES_FOLDER."head-css.php"); ?>
</head>

<body class="open">


    <!-- Left Panel -->
		<?php include(INCLUDES_FOLDER."left-menu.php"); ?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
			<?php include(INCLUDES_FOLDER."right-header.php"); ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Create New User</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <a href="<?php echo "users-list.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-table"></i>&nbsp; Users List</button>
						</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Enter the User Informations</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
							<?php include(INCLUDES_FOLDER."form-alert.php"); ?>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">User Name </label><code>*</code></div>
                                <div class="col-12 col-md-9">
									<input type="text" id="new_user_name" name="new_user_name" placeholder="User Name" class="form-control" autocomplete="off" pattern="\s*(\S\s*){5,}" required value="<?php echo $user_name; ?>" onkeyup="checkUsername(this.value);" >
									<small class="help-block form-text" id="uname_response" ></small>
								</div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">User Id </label><code>*</code></div>
                                <div class="col-12 col-md-9"><input type="text" id="new_user_id" name="new_user_id" placeholder="User Id" class="form-control" pattern="\s*(\S\s*){5,}" required value="<?php echo $user_id; ?>" onkeyup="checkUserid(this.value);">
								<small class="help-block form-text" id="uid_response" ></small>
								</div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password </label><code>*</code></div>
                                <div class="col-12 col-md-9">
									<input type="password" id="new_user_password" name="new_user_password" placeholder="Password" autocomplete="off" class="form-control" required  value="<?php echo $user_password; ?>">
									<small class="help-block form-text">Please enter a complex password</small>
								</div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectSm" class=" form-control-label">User Role </label><code>*</code></div>
                                <div class="col-12 col-md-9">
                                    <select name="new_user_role" id="new_user_role" class="form-control-sm form-control" required>
										<option value="">Select the Role</option>
										<?php
											foreach($user_roles as $role)
											{
										?>
												<option value="<?php echo ($role['user_role_id']); ?>"  <?php if($user_role==$role['user_role_id']){echo "selected";} ?>>
													<?php echo strtoupper($role['user_role_name']); ?>
												</option>
										<?php
											}
										?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="multiple-select" class=" form-control-label">Projects</label></div>
                                <div class="col col-md-9">
                                    <select name="new_user_projects[]" id="new_user_projects" multiple data-placeholder="Choose Projects..." class="standardSelect">
										<?php 
											foreach($all_projects as $project)
											{
										?>
											<option value="<?php echo ($project['project_id']); ?>" <?php if (in_array($project['project_id'], $arr_projects)) { echo "selected";} ?> >
												<?php echo strtoupper($project['project_name']); ?>
											</option>
										<?php
											}
										?>
                                    </select>
                                </div>
                            </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
	<?php include(INCLUDES_FOLDER."foot-js.php"); ?>
	
<script>
function checkUsername(username){

   var usernameRegex = /^[a-zA-Z0-9]+$/;

   if(usernameRegex.test(username)){
      document.getElementById('uname_response').innerHTML ="";

      if(username.length > 4){

         // AJAX request
         var xhttp = new XMLHttpRequest();
         xhttp.open("POST", "username_check.php", true); 
         xhttp.setRequestHeader("Content-Type", "application/json");
         xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

               // Response
               var response = this.responseText; 
               document.getElementById('uname_response').innerHTML = response;
            }
         };
         var data = {username: username};
         xhttp.send(JSON.stringify(data));
      }
   }else{
      document.getElementById('uname_response').innerHTML = "<span style='color: red;'>Please enter valid value</span>";
   }

}
function checkUserid(userid){

   var usernameRegex = /^[a-zA-Z0-9]+$/;

   if(usernameRegex.test(userid)){
      document.getElementById('uid_response').innerHTML ="";

      if(userid.length > 4){

         // AJAX request
         var xhttp = new XMLHttpRequest();
         xhttp.open("POST", "userid_check.php", true); 
         xhttp.setRequestHeader("Content-Type", "application/json");
         xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

               // Response
               var response = this.responseText; 
               document.getElementById('uid_response').innerHTML = response;
            }
         };
         var data = {userid: userid};
         xhttp.send(JSON.stringify(data));
      }
   }else{
      document.getElementById('uid_response').innerHTML = "<span style='color: red;'>Please enter valid value</span>";
   }

}
$('#alert').delay(2000).fadeOut('slow');
</script>
</body>

</html>
<?php
	}
	else{
		header("Location:redirect.php");
		exit();
	}
?>
