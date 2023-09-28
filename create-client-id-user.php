<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && adminPermission())
	{
		$error_msg = "";
		$success_msg = "";
		$main_pro_id = "";
		$sel_client_id = "";
		$act = 1;
		$main_project_name="";
		$arr_client_ids = array();
		if(isset($_GET['main'])){
			$pro_id = (int)(trim($_GET['main']));
			$main_project_name = isMainProjectActive($pro_id);
			if($main_project_name != ''){$main_pro_id = $pro_id; $act=1;}
		}

		$all_project = getAllSubProjectwithDetails($act,$main_pro_id);
		
		if(isset($_POST['sel_client_id'])) {
			$sel_client_id = trim($_POST['sel_client_id']);
			if($sel_client_id == ''){ $error_msg .= " Client Id ,";}
			if($error_msg == ''){
				if(isset($_POST['user_ids'])) {
				$vals = $_POST['user_ids'];
				foreach($vals as $selected){
					if( (trim($selected)) != ''){
						$arr_client_ids[] = $selected;
					}
				}
				}

				$result = addCoder();
				if($result != '1')
				{
					$error_msg = $result;
				}else{
					$error_msg = "";
					$sel_client_id = "";
					$arr_client_ids    = array();
					$success_msg = "Coder(s) updated to Client-id Successfully!";
				}
			}
			else{
				$error_msg = "First select Client Id...";
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
                        <h1>Create Id - User</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
						<a href="<?php echo "create-sub-project.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-bullseye"></i>&nbsp; Create Sub Project</button>
						</a>
						<a href="<?php echo "create-user.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-user"></i>&nbsp; Create New User</button>
						</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
		
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Create Id - User - Link</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
							<?php include(INCLUDES_FOLDER."form-alert.php"); ?>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Client Id</label></div>
                                <div class="col-12 col-md-9">
									<select data-placeholder="Choose a Client Id..." class="standardSelect" name="sel_client_id" id="sel_client_id"  onselect="load_users(this.value);">
										<option value=""></option>
										
										<?php
											foreach($all_project as $spro)
											{
										?>
												<optgroup label="<?php echo strtoupper($spro['main_project_name']." :- ".$spro['sub_project_name']); ?>">
												
												<?php
													$arr_client_ids = getAllClientIds(1,$spro['sub_project_id']);
													foreach($arr_client_ids as $cid)
													{
												?>
														<option value="<?php echo ($cid['id']); ?>"  <?php if($sel_client_id==$cid['id']){echo "selected";} ?>>
															<?php echo strtoupper($cid['client_id']); ?>
														</option>
													<?php
													}
												?>
										<?php
											}
										?>
                                    </select>
                                </div>
                            </div>
							

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Coders</label></div>
                                <div class="col-12 col-md-9">
									<select data-placeholder='Choose a Coders...' multiple class='standardSelect' name='user_ids[]' id='user_ids' >
									</select>
								</div>
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

$("#sel_client_id").chosen().change(function() {
    var client_id = $(this).val();
	if(client_id != ''){
		load(client_id);
	}
});

$(document).ready(function() { 
	var client_id = document.getElementById('sel_client_id').value;
	if(client_id != ''){
		load(client_id);
	}
});

function load(client_id){
	document.getElementById('user_ids').innerHTML ="";
	 var xhttp = new XMLHttpRequest();
	 xhttp.open("POST", "get_user_list_for_client.php", true); 
	 xhttp.setRequestHeader("Content-Type", "application/json");
	 xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {

		   var response = this.responseText; 
		   //alert(response);
		   document.getElementById('user_ids').innerHTML = response;
				 $("#user_ids").trigger("chosen:updated");
				$("#user_ids").trigger("liszt:updated");
		}
	 };
	 var data = {client_id:client_id};
	 xhttp.send(JSON.stringify(data));
}

$('.reset-b').click(function(){
        $("#sel_client_id").val('Choose a Project...').trigger("chosen:updated");
		$("#user_ids").val('Choose a Project...').trigger("chosen:updated");
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
