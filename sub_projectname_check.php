<?php

	require_once 'includes/connection.php';
	require_once 'includes/utility-class.php';

// Read POST data
$data = json_decode(file_get_contents("php://input"));

if(isset($data->projectname) && isset($data->main_pro_id)){
   $conn = db();
   $sprojectname = mysqli_real_escape_string($conn,$data->projectname);
   $main_pro_id = mysqli_real_escape_string($conn,$data->main_pro_id);

   $query = "select count(*) as cntProject from ".SUB_PROJECT_TABLE." where sub_project_name='".$sprojectname."' AND main_project_id='".$main_pro_id."' ";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>Sub-Project Name is Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntProject'];

      if($count > 0){
         $response = "<span style='color: red;'>Sub-Project Name already taken for this Main Project.</span>";
      }

   }
   echo $response;
}