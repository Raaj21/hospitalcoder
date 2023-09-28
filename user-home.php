<?php
require_once 'includes/connection.php';
require_once 'includes/utility-class.php';
if (isset($_SESSION[SESS . '_session_user_id']) && coderPermission()) {
        $error_msg = "";
		$success_msg = "";

    if(isset($_POST['submit'])){
        $pro_date = $_POST['pro_date'];
        $projectid =$_POST['main_pro_id'];
        $sub_project_name =$_POST['sub_project_name'];
        $tl =$_POST['tl'];
        $chart_id =$_POST['chart_id'];
        $total_page =$_POST['total_page'];
        $total_docs =$_POST['total_docs'];
        $total_icd =$_POST['total_icd'];

        if($projectid == ''){ $error_msg .= " Project Name,";}
         if($sub_project_name == ''){ $error_msg .= "Sub  Project Name ,";}
         if($tl == ''){ $error_msg .= " TL Name ,";}
         if($chart_id == ''){ $error_msg .= " Chart ID Name ,";}
         if($total_page == ''){ $error_msg .= " Total Page Name ,";}
         if($total_docs == ''){ $error_msg .= " Total Docs Name ,";}
         if($total_icd == ''){ $error_msg .= " Total ICD Name ,";}
         if($error_msg != ''){
            $error_msg = "Enter correct value in require field: ".(substr($error_msg, 0, -1));
        }
         else{
           
            $result = adduserdailly();
            if($result != '1')
				{
					$error_msg = $result;
				}else{
					$error_msg = "";
					
					$success_msg = "Report Created Successfully!";
				}
            

         }

        
      
    }

    $all_project = getAllProjectwithDetails(1);

    $get_all_sel_user = getAllCoderDetailsOfUser(2, $_SESSION[SESS . '_session_id']);
    $main_project_id = array();
    $sub_project = array();

    if ($get_all_sel_user != 0) {
        foreach ($get_all_sel_user as $getuserproject) {
            if (!in_array($getuserproject['main_project_id'], $main_project_id)) {
                $main_project_id[] = $getuserproject['main_project_id'];
            }
            if (!in_array($getuserproject['sub_project_id'], $sub_project)) {
                $sub_project[] = $getuserproject['sub_project_id'];
            }


        }

    }

$subpro = implode(",", $sub_project);

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
        <?php include(INCLUDES_FOLDER . "head-css.php"); ?>
    </head>

    <body class="open">


        <!-- Left Panel -->
        <?php include(INCLUDES_FOLDER . "left-menu.php"); ?>
        <!-- Left Panel -->

        <!-- Right Panel -->

        <div id="right-panel" class="right-panel">

            <!-- Header-->
            <?php include(INCLUDES_FOLDER . "right-header.php"); ?>
            <!-- Header-->

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <!-- <div class="page-title">
                            <a href="<?php echo "projects-list.php"; ?>">
                                <button type="button" class="new-btn btn btn-primary btn-sm" style="margin-top: 10px;"><i
                                        class="fa fa-table"></i>&nbsp; Projects List</button>
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="content mt-3">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daily Status
                                <?php echo (date('d-m-Y')); ?>
                            </strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"
                                autocomplete="off">
                                <?php include(INCLUDES_FOLDER . "form-alert.php"); ?>
                                <div class="row form-group">

                                </div>

                                <div class="row align-items-start mb-3">
                                    <div class="col-3">
                                        <label for="text-input" class=" form-control-label"> Date:</label>

                                        <input type="text" id="date" name="pro_date" placeholder="Date" class="form-control"
                                            autocomplete="off" readonly value="<?php echo (date('d-m-Y')); ?>">


                                    </div>
                                    <div class="col-3">
                                        <label for="text-input" class=" form-control-label">Project Name </label><code>*</code>

                                        <select data-placeholder="Choose a Project..." class="standardSelect" tabindex="1"
                                            name="main_pro_id" id="main_pro_id" required>
                                            <option value=""></option>
                                            <?php
                                            foreach ($all_project as $pro) {
                                                if (in_array($pro['project_id'], $main_project_id)) {
                                                    ?>
                                                    <option value=" <?php echo ($pro['project_id']); ?>">
                                                        <?php echo strtoupper($pro['project_name']); ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <small class="help-block form-text" id="pname_response"></small>

                                    </div>
                                    <div class="col-3">
                                        <label for="text-input" class=" form-control-label">Sub Project </label><code>*</code>
                                        <select data-placeholder='Choose a Coders...'  class='standardSelect' name='sub_project_name' id='sub_project_name' >
									</select>

                                        
                                        <small class="help-block form-text" id="sub_pname_response"></small>

                                    </div>
                                    <div class="col-3">
                                        <label for="text-input" class=" form-control-label">TL</label><code>*</code>

                                        <input type="text" id="tl" name="tl" readonly  required placeholder="TL Name" class="form-control"
                                            autocomplete="off"  value="">
                                        <small class="help-block form-text" id="tl_pname_response"></small>

                                    </div>

                                </div>


                                <div class="row  mt-10">
                                    <div class="col-sm-6 mb-3 ">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Count</h5>

                                                <div class="col-6">
                                                    <label for="text-input" class=" form-control-label">Chart ID</label><code>*</code>

                                                    <input type="text" id="chart_id" name="chart_id" placeholder="Chart ID"
                                                        class="form-control" autocomplete="off" 
                                                        required value="">
                                                    <small class="help-block form-text" id="chart_pname_response"></small>

                                                </div>


                                                <div class="col-6">
                                                    <label for="text-input" class=" form-control-label">Total Page</label><code>*</code>

                                                    <input type="text" id="total_page" name="total_page"
                                                        placeholder="Total Page" class="form-control" autocomplete="off"
                                                        required value="">
                                                    <small class="help-block form-text" id="total_pname_response"></small>

                                                </div>



                                                <div class="col-6">
                                                    <label for="text-input" class=" form-control-label">Total Docs</label><code>*</code>

                                                    <input type="text" id="total_docs" name="total_docs"
                                                        placeholder="Total Docs" class="form-control" autocomplete="off"
                                                        required value="">
                                                    <small class="help-block form-text"
                                                        id="totaldocs_pname_response"></small>

                                                </div>

                                                <div class="col-6">
                                                    <label for="text-input" class=" form-control-label">Total ICD</label><code>*</code>

                                                    <input type="text" id="total_icd" name="total_icd"
                                                        placeholder="Total ICD" class="form-control" autocomplete="off"
                                                        required value="">
                                                    <small class="help-block form-text"
                                                        id="totalicd_pname_response"></small>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm" name = "submit">
                                        <i class="fa fa-dot-circle-o" name = "submit"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div> <!-- .content -->
        </div><!-- /#right-panel -->

        <!-- Right Panel -->

        <?php include(INCLUDES_FOLDER . "foot-js.php"); ?>
        <script>

            $("#main_pro_id").change(function () {
                $('#tl').val('');
                var userid = <?php echo $_SESSION[SESS . '_session_id']; ?>;
                var projectid = this.value;
                var subpro= '<?php echo $subpro ?>';
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "get_user_project_for_client.php", true);
                xhttp.setRequestHeader("Content-Type", "application/json");
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                        var response = this.responseText;
                        //alert(response);
                        document.getElementById('sub_project_name').innerHTML = response;
                        $("#sub_project_name").trigger("chosen:updated");
                        $("#sub_project_name").trigger("liszt:updated");
                    }
                };
                var data = { user_id: userid,projectid:projectid,sub :subpro };
                xhttp.send(JSON.stringify(data));

                
            })
            $("#sub_project_name").change(function () {
                $('#tl').val('');
                var userid = <?php echo $_SESSION[SESS . '_session_id']; ?>;
                var projectid = $('#main_pro_id').val();
                var subpro= this.value;
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "get_user_tl_for_client.php", true);
                xhttp.setRequestHeader("Content-Type", "application/json");
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                        var response = this.responseText;
                      
                       // alert(response);
                       $('#tl').val(response);
                    }
                };
                var data = { user_id: userid,projectid:projectid,sub :subpro };
                xhttp.send(JSON.stringify(data));

                
            })


            $('#alert').delay(2000).fadeOut('slow');
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location:redirect.php");
    exit();
}
?>