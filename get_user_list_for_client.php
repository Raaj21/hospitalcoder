
<?php

	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';

// Read POST data
$data = json_decode(file_get_contents("php://input"));

if(isset($data->client_id)){
	$conn = db();
	$client_id = mysqli_real_escape_string($conn,$data->client_id);
	$response = "";
	
	$get_all = getAllCoder(1);
	$get_all_sel_user = getAllCoderIdOfClientIdId($client_id);

	if ($get_all) {
		$response .= "";
		foreach($get_all as $coder)
		{
			$response .= "<option value='".$coder['id']."' ";
			if (in_array($coder['id'], $get_all_sel_user))
			{
				$response .= " selected ";
			}
			$response .= ">".$coder['user_name']."</option>";
		}
		
	}
	echo $response;
}

?>
