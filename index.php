<?php
	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';
	
	if(!isset($_SESSION[SESS.'_session_user_id'])) 
	{
		if(isset($_POST['user_name']) && isset($_POST['user_pass'])) {
			$authen = userAuthentication();
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
    <title>Login Page</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <img class="align-content" src="images/logo.png" alt="">
                </div>
                <div class="login-form">
                    <form action="<?php echo "index.php"; ?>" method="post" name="sign_in_form" id="sign_in_form"> 
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" placeholder="User Name" id="user_name" name="user_name" required>
                        </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" id="user_pass" name="user_pass" required>
                        </div>
                                <div class="checkbox">
                                    <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
								<?php 
				if((isset($_SESSION[SESS.'_session_alert_msg'])) && ($_SESSION[SESS.'_session_alert_msg'] != '') )
				{
			?>
				<a href="#" data-role="button" data-theme="c" data-icon="info"><?php echo $_SESSION[SESS.'_session_alert_msg']; ?></a>
			<?php 
				} $_SESSION[SESS.'_session_alert_msg'] = '';
			?>
                </div>
            </div>
        </div>
    </div>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>
<?php
	}
	else if(adminPermission()){
		header("Location:home.php"); 
		exit();
	}
    else if(coderPermission()){
        header("Location:user-home.php"); 
		exit();
    }
	else{
		#session_destroy();
		header("Location:".PROJECT_PATH."user-home.php"); 
		exit();		
	}
?>