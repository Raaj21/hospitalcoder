<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && adminPermission())
	{
		$all_project = getAllProjectwithDetails(1);
		
		$main_pro_id = "";
		if(isset($_GET['main'])){
			$pro_id = (int)(trim($_GET['main']));
			$check = isMainProjectActive($pro_id);
			if($check != ''){$main_pro_id = $pro_id;}
		}
		$error_msg = "";
		$success_msg = "";
		$sub_pro_name = "";
		$arr_client_ids    = array();
		
		if(isset($_POST['main_pro_id']) && isset($_POST['s_project_name'])) {
			
			$main_pro_id = trim($_POST['main_pro_id']);
			if($main_pro_id == ''){ $error_msg .= " Main Project ,";}
			
			if($error_msg == ''){
				$sub_pro_name = trim($_POST['s_project_name']);
				if($sub_pro_name == ''){ $error_msg .= " Sub-Project Name,";}
				else if(strlen($sub_pro_name)<6){ $error_msg .= " Sub-Project Name - Minimum Length 6 ,";}
				
				if(!empty($_POST['client_id'])) {
					$vals = $_POST['client_id'];
					foreach($vals as $selected){
						if( (trim($selected)) != ''){
							if(isValidEmail($selected)){
							$arr_client_ids[] = $selected;
							}else{
								$error_msg .= " Client id should be Email Id,";
							}
						}
					}          
				}

				if($error_msg != ''){
					$error_msg = "Enter correct value in require field: ".(substr($error_msg, 0, -1));
				}
				else{
					$result = addSubProject();
					if($result != '1')
					{
						$error_msg = $result;
					}else{
						$error_msg = "";
						$sub_pro_name = "";
						$main_pro_id = "";
						$arr_client_ids    = array();
						$success_msg = "Sub-Project Created Successfully!";
					}
				}	
			}
			else{
				$error_msg = "First select Main Project...";
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
                        <h1>Create Sub-Project</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
						<a href="<?php echo "create-project.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-bullseye"></i>&nbsp; Create New Project</button>
						</a>
						<a href="<?php echo "sub-projects-list.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-table"></i>&nbsp; Sub-Projects List</button>
						</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Sub-Project Informations</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
							<?php include(INCLUDES_FOLDER."form-alert.php"); ?>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Main Project</label></div>
                                <div class="col-12 col-md-9">
									<select data-placeholder="Choose a Project..." class="standardSelect" tabindex="1" name="main_pro_id" id="main_pro_id" required >
										<option value=""></option>
										<?php
											foreach($all_project as $pro)
											{
										?>
												<option value="<?php echo ($pro['project_id']); ?>"  <?php if($main_pro_id==$pro['project_id']){echo "selected";} ?>>
													<?php echo strtoupper($pro['project_name']); ?>
												</option>
										<?php
											}
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Sub-Project Name</label></div>
                                <div class="col-12 col-md-9">
									<input type="text" id="s_project_name" name="s_project_name" placeholder="Project Name" class="form-control" autocomplete="off" pattern="\s*(\S\s*){5,}" required value="<?php echo $sub_pro_name; ?>" onkeyup="checkSubProjectname(this.value);" >
									<small class="help-block form-text" id="pname_response" ></small>
								</div>
                            </div>

                            <div id="container">
								<p id="add_field"><a href="#"><span>Click To Add client Id <i class="fa fa-plus-square-o"></i></span></a></p>
							</div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm reset-b">
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
function checkSubProjectname(projectname){

   //var usernameRegex = /^[a-zA-Z0-9]+$/;
   var usernameRegex = /^\S(?:.*\S)?$/;
	var main_pro_id = document.getElementById('main_pro_id').value;
	if(main_pro_id != ''){
	   if(usernameRegex.test(projectname)){
		  document.getElementById('pname_response').innerHTML ="";

		  if(projectname.length > 5){

			 // AJAX request
			 var xhttp = new XMLHttpRequest();
			 xhttp.open("POST", "sub_projectname_check.php", true); 
			 xhttp.setRequestHeader("Content-Type", "application/json");
			 xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

				   // Response
				   var response = this.responseText; 
				   document.getElementById('pname_response').innerHTML = response;
				}
			 };
			 var data = {projectname: projectname,main_pro_id:main_pro_id};
			 xhttp.send(JSON.stringify(data));
		  }
	   }else{
		  document.getElementById('pname_response').innerHTML = "<span style='color: red;'>Please enter valid value</span>";
	   }
	}else{
		document.getElementById('s_project_name').value = "";
		document.getElementById('pname_response').innerHTML = "<span style='color: red;'>Please first select Main Project</span>";
		document.getElementById("main_pro_id").focus();
	}

}


    var counter = 0;
        $(function() {
            $('p#add_field').click(function() {
                counter += 1;
                $('#container').append(
                     'Client Id #' + counter + ': ' + '<input id="field_' + counter + '" name="client_id[]' + '" type="email" class="form-control" placeholder="Client Id" /><br/>');
            });
       });
$('.reset-b').click(function(){
        $("#main_pro_id").val('Choose a Project...').trigger("chosen:updated");
		$("#s_project_name").val('');
});
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
