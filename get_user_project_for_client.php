
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
    $subproject =  explode(',',$data->sub);

 
	
	$get_all = getAllSubProjectwithDetails($act,$data->projectid);



	if ($get_all) {
		$response .= "<option value = ''>Select Sub Project</option>";
		foreach($get_all as $coder)
		{
            if (in_array($coder['sub_project_id'], $subproject))
			{
			$response .= "<option value='".$coder['sub_project_id']."' ";
			
				
			
			$response .= ">".$coder['sub_project_name']."</option>";
        }
		}
		
	}
	echo $response;
}

?>
