<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && adminPermission())
	{
		$all_project = getAllProjectwithDetails();

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
                        <h1>Project List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
						<a href="<?php echo "create-project.php";  ?>">
							<button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i class="fa fa-bullseye"></i>&nbsp; Create New Project</button>
						</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="animated fadeIn">
                <div class="row">
					<?php
						foreach($all_project as $pro)
						{
					?>
							<div class="col-xl-3 col-lg-6">
								<section class="card project-card">
									<div class="card-header">
										<strong class="card-title mb-3"><?php echo strtoupper($pro['project_name']); ?></strong>
									</div>
									<h6 class="text-sm-left pl-3 mt-2 mb-1">Created On:</h6>
									<h5 class="text-sm-left pl-3 mt-1 mb-1"><?php echo  date("d M Y", strtotime($pro['created_at'])); ?></h5>
									<br/>
									<h6 class="text-sm-left pl-3 mt-2 mb-1"><i class="fa fa-list-alt pr-1"></i>No of Sub-Projects: 
									<?php
										if($pro['active'] == 1)
										{
									?>
										<a href="<?php echo "create-sub-project.php?main=".$pro['project_id'];  ?>" title="Add Sub-Project"><i class="fa fa-plus-square-o pr-1"></i></a>
									<?php
										}
									?>
									</h6>
									<h4 class="text-sm-left pl-4 mb-1"><?php echo ($pro['sub_count']); ?></h4>
									<hr>
									<h6 class="text-sm-left pl-3 mt-2 mb-1"><i class="fa fa-th-list pr-1"></i>No of Client-Ids:</h6>
									<h4 class="text-sm-left pl-4 mb-1"><?php echo ($pro['client_count']); ?></h4>
									<hr>
									<h6 class="text-sm-left pl-3 mt-2 mb-1"><i class="fa fa-users pr-1"></i>No of Resources:</h6><h4 class="text-sm-left pl-4 mb-1"><?php echo ($pro['coder_count']); ?></h4>
									<hr>
									<footer class="twt-footer">	
										<span class="pull-left"><?php echo $active_status[$pro['active']]; ?></span>
										<span class="pull-right"><a href="#" title="Edit this Project"><i class="fa fa-pencil pr-1"></i></a></span>
										<?php
											if($pro['active'] == 1)
											{
										?>
											<span class="pull-right"><a href="<?php echo "sub-projects-list.php?main=".$pro['project_id'];  ?>" title="View Sub-Projects"><i class="fa fa-eye pr-3"></i></a></span>
										<?php
											}
										?>
									</footer>
								</section>
							</div>

					<?php
						}
					?>


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
