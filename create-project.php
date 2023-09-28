<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && adminPermission())
	{
		$all_tl = getAllTL(1);
		$all_location = getAllLocation(1);
		$error_msg = "";
		$success_msg = "";
		$pro_loc = "";
		$project_name = "";
		$pro_tl = "";
		if(isset($_POST['project_name'])) {
			$project_name = trim($_POST['project_name']);
			if($project_name == ''){ $error_msg .= " Project Name,";}
			else if(strlen($project_name)<6){ $error_msg .= " Project Name - Minimum Length 6 ,";}
			
			$pro_loc = trim($_POST['project_location']);
			if($pro_loc == ''){ $error_msg .= " Project Location,";}
			
			$pro_tl = trim($_POST['project_user']);
			if($pro_tl == ''){ $error_msg .= " TL,";}

			if($error_msg != ''){
				$error_msg = "Enter correct value in require field: ".(substr($error_msg, 0, -1));
			}
			else{
				$result = addProject();
				if($result != '1')
				{
					$error_msg = $result;
				}else{
					$error_msg = "";
					$pro_loc = "";
					$project_name = "";
					$pro_tl = "";
					$success_msg = "Project Created Successfully!";
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
                        <h1>Create Project</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
						<a href="<?php echo "projects-list.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-table"></i>&nbsp; Projects List</button>
						</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Enter the Project Informations</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
							<?php include(INCLUDES_FOLDER."form-alert.php"); ?>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Project Name</label></div>
                                <div class="col-12 col-md-9">
									<input type="text" id="project_name" name="project_name" placeholder="Project Name" class="form-control" autocomplete="off" pattern="\s*(\S\s*){5,}" required value="<?php echo $project_name; ?>" onkeyup="checkProjectname(this.value);" >
									<small class="help-block form-text" id="pname_response" ></small>
								</div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Location</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="project_location" id="project_location" class="form-control-sm form-control" required>
                                        <option value="">Select the Location</option>
										<?php
											foreach($all_location as $loc)
											{
										?>
												<option value="<?php echo ($loc['location_id']); ?>"  <?php if($pro_loc==$loc['location_id']){echo "selected";} ?>>
													<?php echo strtoupper($loc['locationt_name']); ?>
												</option>
										<?php
											}
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectSm" class=" form-control-label">TL</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="project_user" id="project_user" class="form-control-sm form-control" required>
                                        <option value="">Select the TL</option>
										<?php
											foreach($all_tl as $tl)
											{
										?>
												<option value="<?php echo ($tl['id']); ?>"  <?php if($pro_tl==$tl['id']){echo "selected";} ?>>
													<?php echo strtoupper($tl['user_name']."-".$tl['user_id']); ?>
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
function checkProjectname(projectname){

   var usernameRegex = /^[a-zA-Z0-9]+$/;

   if(usernameRegex.test(projectname)){
      document.getElementById('pname_response').innerHTML ="";

      if(projectname.length > 5){

         // AJAX request
         var xhttp = new XMLHttpRequest();
         xhttp.open("POST", "projectname_check.php", true); 
         xhttp.setRequestHeader("Content-Type", "application/json");
         xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

               // Response
               var response = this.responseText; 
               document.getElementById('pname_response').innerHTML = response;
            }
         };
         var data = {projectname: projectname};
         xhttp.send(JSON.stringify(data));
      }
   }else{
      document.getElementById('pname_response').innerHTML = "<span style='color: red;'>Please enter valid value</span>";
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
