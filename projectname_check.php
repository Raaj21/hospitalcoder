<?php

	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';

// Read POST data
$data = json_decode(file_get_contents("php://input"));

if(isset($data->projectname)){
   $conn = db();
   $projectname = mysqli_real_escape_string($conn,$data->projectname);

   $query = "select count(*) as cntProject from ".PROJECT_TABLE." where project_name='".$projectname."'";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>Project Name is Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntProject'];

      if($count > 0){
         $response = "<span style='color: red;'>Project Name is Not Available.</span>";
      }

   }
   echo $response;
}