<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	if(isset($_SESSION[SESS.'_session_user_id']) && coderPermission())
	{
		$all_users = getAllUserReport();

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
                        <h1>Project 1</h1>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>


        <div class="breadcrumbs">
            <div class="col-sm-3">
                <div class="page-header float-left">
                    <div class="page-title">
                        <label>Sub Project:</label><span>XYZ</span>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-3">
                <div class="page-header float-left">
                    <div class="page-title">
                        <label>Location:</label><span>Vellore</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="page-header float-left">
                    <div class="page-title">
                        <label>Client Id:</label><span>abcd@info.com</span>
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
                                           
                                            <th>SNo</th>
                                            <th>Chart ID</th>
                                            <th>Client ID</th>
                                            <th>TL</th>
											<th>Total Docs</th>
											<th>Total ICD</th>
											<th>Total Page</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
                                        $i = 1;
											foreach($all_users as $user)
											{
										?>
												
													
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo strtoupper($user['chart_id']); ?></td>
												<td><?php echo strtoupper($user['chart_id']); ?></td>
												<td><?php echo strtoupper($user['tl_name']); ?></td>
												<td>
													<?php  echo strtoupper($user['total_docs']); ?>
												</td>
												<td><?php  echo strtoupper($user['total_icd']); ?></td>
												<td><?php  echo strtoupper($user['total_page']); ?></td>
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
