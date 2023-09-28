<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && adminPermission())
	{
		$all_users = getAllUser();

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
                        <h1>Users List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
						<a href="<?php echo "create-user.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-user"></i>&nbsp; Create New User</button>
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
                                            <th>Name</th>
                                            <th>User Id</th>
                                            <th>Role</th>
                                            <th>Projects</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											foreach($all_users as $user)
											{
										?>
												
													
											<tr>
												<td><?php echo strtoupper($user['user_name']); ?></td>
												<td><?php echo strtoupper($user['user_id']); ?></td>
												<td><?php echo strtoupper($user['user_role_name']); ?></td>
												<td>
													<span class="badge badge-primary">project 1</span>
													<span class="badge badge-primary">project 2</span>
													<span class="badge badge-primary">project 3</span>
												</td>
												<td><?php echo $active_status[$user['active']]; ?></td>
												<td>
													<a href="edit-user.html?#"><i class="fa fa-pencil"></i></a>
												</td>
											</tr>
											
										<?php
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
		header("Location:redirect.php");
		exit();
	}
?>
