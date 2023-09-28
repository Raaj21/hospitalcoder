<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && adminPermission() && isset($_GET['sub']))
	{
		$spro_id = (int)(trim($_GET['sub']));
		if($spro_id != ''){
			$sub_pro_details = getSubProjectbySubProjectId($spro_id);
			$sub_pro_details = ($sub_pro_details[0]);
			$main_pro_id = trim($sub_pro_details['main_project_id']);

			$main_project_name = isMainProjectActive($main_pro_id);

			if($main_project_name != '')
			{
				$arr_client_ids = getAllClientIds(2,$spro_id,);


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
                        <h1>Sub-Project  
						<?php 
							if($main_project_name !=''){
								echo " Name : ".strtoupper($sub_pro_details['sub_project_name']) ;
							}
						?>
						</h1>

                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
						<a href="<?php echo "create-client-id-user.php?main=".$main_pro_id;  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-list-alt"></i>&nbsp; Assign User to <?php echo strtoupper($main_project_name); ?></button>
						</a>
						<a href="<?php echo "sub-projects-list.php?main=".$main_pro_id;  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-list-alt"></i>&nbsp; Sub Projects List of <?php echo strtoupper($main_project_name); ?></button>
						</a>
						<a href="<?php echo "create-sub-project.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-bullseye"></i>&nbsp; Create Sub Project</button>
						</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Client Id</th>
											<th>Client Id status</th>
											<th>Client Id Created On</th>
                                            <th>User</th>
                                            <th>User Role</th>
                                            <th>Link Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											foreach($arr_client_ids as $cid)
											{
												$get_all_sel_user = getAllCoderDetailsOfClientIdId(2,$cid['id']);
												foreach($get_all_sel_user as $cuser)
												{
										?>
												
												<tr>
													<td><?php echo strtoupper($cid['client_id']); ?></td>
													<td><?php echo strtoupper($active_status[$cid['active']]); ?></td>
													<td><?php echo strtoupper($cid['created_at']); ?></td>
													<td><?php echo ($cuser['u_name']); ?></td>
													<td></td>
													<td><?php echo $active_status[$cuser['active']]; ?></td>
												</tr>
											
										<?php
												}
											}
										?>
								
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- .animated -->

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

	<?php include(INCLUDES_FOLDER."foot-js.php"); ?>

</body>

</html>
<?php
			}
			else{
				header("Location:redirect.php?".$main_project_name);
				exit();
			}
		}
		else{
			header("Location:redirect.php");
			exit();
		}
	}
	else{
		header("Location:redirect.php");
		exit();
	}
?>
