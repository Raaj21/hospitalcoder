<?php

	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';

// Read POST data
$data = json_decode(file_get_contents("php://input"));

if(isset($data->username)){
   $conn = db();
   $username = mysqli_real_escape_string($conn,$data->username);

   $query = "select count(*) as cntUser from ".USER_TABLE." where user_name='".$username."'";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>User Name is Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];

      if($count > 0){
         $response = "<span style='color: red;'>User Name is Not Available.</span>";
      }

   }
   echo $response;
}