
<?php

	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';

// Read POST data
$data = json_decode(file_get_contents("php://input"));

if(isset($data->user_id)){
	$conn = db();
	$client_id = mysqli_real_escape_string($conn,$data->user_id);
	$response = "";
    $act=1;
    $subproject = $data->sub;
    $project =$data->projectid;


 	$get_all = getAllClientProject($act,$data->projectid,$subproject);

    
	
	

	echo $get_all;
}

?>
