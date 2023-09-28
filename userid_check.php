<?php

	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';

// Read POST data
$data = json_decode(file_get_contents("php://input"));

if(isset($data->userid)){
   $conn = db();
   $userid = mysqli_real_escape_string($conn,$data->userid);

   $query = "select count(*) as cntUser from ".USER_TABLE." where user_id='".$userid."'";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>User Id is Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];

      if($count > 0){
         $response = "<span style='color: red;'>User Id is Not Available.</span>";
      }

   }
   echo $response;
}