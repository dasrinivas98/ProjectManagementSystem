<?php
  include('../assests/dbconnect.php');
  include('../assests/fileslogic.php');
  include('../signin/login/login.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PMS</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- endinject -->  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="../index.html"style="width: 100%;"><img src="../images/logo.jpg" alt="logo" style="width: 100%;"></a>
          <a class="navbar-brand brand-logo-mini" href="../index.html"><img src="../images/logomini.jpg" alt="logo"></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <!--<ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>-->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../images/faces/face5.png" alt="profile"/>
              <span class="nav-profile-name"><?php echo $_SESSION["uname"]?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <!--<a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>-->
              <a class="dropdown-item" href="../logout/logout.php">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addProject/addProject.php">
              <i class="mdi mdi-plus-box menu-icon"></i>
              <span class="menu-title">Add Project</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <?php
                    echo "Welcome ".$_SESSION["uname"];
                  ?>
                </div>
              </div>
            </div>
           </div>
           <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My projects</h4>
                    <p class="card-description">Status as on : <code id="date"></code></p>
                      <script>
                      function getday(){
                          let today = new Date().toISOString().slice(0, 10);
                          document.getElementById('date').textContent = today;
                          document.getElementById('date1').textContent = today;
                      }
                          window.onload = getday;
                      </script>
                    <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table" style="text-align: center;">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Project Title</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  $sid = $_SESSION["s_id"];
                                  $sql = "select * from projects where s_id = $sid";
                                  if (!($result = mysqli_query($link, $sql))) { 
                                    printf("Errormessage: %s\n", mysqli_error($link));
                                }
                                else {     
                                    if(mysqli_num_rows($result) >0){
                                      $i = 1;
                                      while($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                  <td><?php echo $i?></td>
                                  <td><?php echo $row['p_title'];?></td>
                                  <?php 
                                      if($row['finalStatus'] == 0){
                                        echo "<td><label class='text-danger'>In progress</label></td>";
                                      }
                                      else{
                                        echo "<td><label class='text-success'>Completed</label></td>";
                                      }
                                  ?>
                                    <td><button type="button" class="btn btn-inverse-primary btn-fw"
                                    data-toggle="modal" data-target="#exampleModal<?php echo $row['p_id'];?>">Update</button></td>
                                </tr>
                                
                                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal<?php echo $row['p_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Project Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    <div class="modal-body">
                                    <div class="card-body">
                                    <h4 class="card-title"><?php echo $row['p_title'];?></h4>
                                    <div class="card shadow p-3 mb-5 bg-white rounded">
                                      <!-- <div class="card-body">
                                        <form class="forms-sample" action="dashboard.php" method="POST" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label>Status</label>
                                            <div class="form-check">
                                              <label class="form-check-label">
                                              <input type="radio" class="form-check-input" name="status" id="optionsRadios1" value="0" checked>
                                              In progress
                                              </label>
                                           </div>
                                           <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" id="optionsRadios2" value="1">
                                             Completed
                                            </label>
                                           </div>
                                         </div>
                                         <div class="form-group" id="txtEditor">
                                           <label for="exampleTextarea1">Additional remarks</label>
                                           <textarea id="editor" name="addinfo" class="form-control" placeholder="Additional remarks"></textarea>
                                           <input type='hidden' name='p_id' value="<?php echo $row['p_id']?>"/>
                                          </div>
                                          <?php
                                          if($row['report']== 'NULL' || $row['report']== ''){
                                          echo "<label>Add Project report</label>
                                          <div class='form-group' id='txtEditor'>
                                          <input type='file' name = 'pFiles'></div>";
                                          }
                                          else{
                                          $pid = $row["p_id"];
                                          $report = $row['report'];
                                          // echo '<from action="../assests/fileslogic.php" method="POST">
                                          //   <input type="hidden" value="'.$pid.'" name="pid">
                                          //   <input  type="submit" name="download" value="Download Report" class="btn btn-primary">

                                          //   </form>';
                                          echo '<div class="form-group"><a href="../assests/fileslogic.php?pid='.$pid.'">Download Report</a></div>';
                                            // <a href="dashboard.php?file_id='.$pid.'">Download</a>';

                                          }
                                          ?>
                                          <div>
                                            <input  type="submit" name="save" value="save" class="btn btn-primary">
                                          </div>
                                        </form>
                                      </div>   -->
                                      <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                                          <li class="nav-item" style="text-align: center;">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#develop<?php echo $row['p_id'];?>" role="tab" aria-controls="home" aria-selected="true">Development</a>
                                          </li>
                                          <li class="nav-item" style="text-align: center;">
                                            <a class="nav-link <?php echo ($row['d_status']==0? ' disabled' : '');?>" id="profile-tab" data-toggle="tab" href="#testing<?php echo $row['p_id'];?>" role="tab" aria-controls="profile" aria-selected="false">Testing</a>
                                          </li>
                                          <li class="nav-item" style="text-align: center;">
                                            <a class="nav-link <?php echo ($row['t_status']==0? 'disabled' : '');?>" id="profile-tab"  data-toggle="tab" href="#report<?php echo $row['p_id'];?>" role="tab" aria-controls="profile" aria-selected="false">Report</a>
                                          </li>
                                      </ul>   
                                      <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="develop<?php echo $row['p_id'];?>" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="card-body">
                                        <form class="forms-sample" action="dashboard.php" method="POST" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label>Status</label>
                                            <div class="form-check">
                                              <label class="form-check-label">
                                              <input type="radio" class="form-check-input" name="status" id="optionsRadios1" value="0" <?php echo($row['d_status']==0 ? 'checked' : '');?>>
                                              In progress
                                              </label>
                                           </div>
                                           <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" id="optionsRadios2" value="1" <?php echo($row['d_status']==1 ? 'checked' : '');?>>
                                             Completed
                                            </label>
                                           </div>
                                         </div>
                                         <!-- <div class="form-group" id="txtEditor">
                                           <label for="exampleTextarea1">Additional remarks</label>
                                           <textarea id="editor" name="addinfo" class="form-control" placeholder="Additional remarks"></textarea>
                                        </div> -->
                                        <input type='hidden' name='p_id' value="<?php echo $row['p_id']?>"/>
                                          <?php
                                          if($row['d_report']== 'NULL' || $row['d_report']== ''){
                                          echo "<label>Add Project report</label>
                                          <div class='form-group' id='txtEditor'>
                                          <input type='file' name = 'pFiles' required><div class='invalid-feedback'>Please select a file</div></div>";
                                          // $_SESSION["isfile"] = 0;
                                          }
                                          else{
                                          $pid = $row["p_id"];
                                          $report = $row['d_report'];
                                          // echo "<input type='hidden' name="" value='".$row['d_report']."'>"
                                          // $_SESSION["isfile"] = 1;
                                          // echo "<input type='hidden' name = 'pFiles' value='".$report."'>";
                                          // echo '<from action="../assests/fileslogic.php" method="POST">
                                          //   <input type="hidden" value="'.$pid.'" name="pid">
                                          //   <input  type="submit" name="download" value="Download Report" class="btn btn-primary">

                                          //   </form>';
                                          echo '<div class="form-group"><a href="../assests/fileslogic.php?pid='.$pid.'">Download Report</a></div>';
                                            // <a href="dashboard.php?file_id='.$pid.'">Download</a>';

                                          }
                                          ?>
                                          <div>
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="<?php echo $row['p_id'];?>card">Close</button> -->
                                            <input  type="submit" name="Dsave" value="Save" class="btn btn-primary">
                                          </div>
                                        </form>
                                      </div>            
                                        </div>
                                        <div class="tab-pane fade" id="testing<?php echo $row['p_id'];?>" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="card-body">
                                        <form class="forms-sample" action="dashboard.php" method="POST" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label>Status</label>
                                            <div class="form-check">
                                              <label class="form-check-label">
                                              <input type="radio" class="form-check-input" name="t_status" id="optionsRadios1" value="0" <?php echo($row['t_status']==0 ? 'checked' : '');?>>
                                              In progress
                                              </label>
                                           </div>
                                           <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="t_status" id="optionsRadios2" value="1" <?php echo($row['t_status']==1 ? 'checked' : '');?>>
                                             Completed
                                            </label>
                                           </div>
                                         </div>
                                         <!-- <div class="form-group" id="txtEditor">
                                           <label for="exampleTextarea1">Additional remarks</label>
                                           <textarea id="editor" name="addinfo" class="form-control" placeholder="Additional remarks"></textarea>
                                           <input type='hidden' name='p_id' value="<?php echo $row['p_id']?>"/>
                                          </div> -->
                                          <input type='hidden' name='p_id' value="<?php echo $row['p_id']?>"/>
                                          <?php
                                          if($row['t_report']== 'NULL' || $row['t_report']== ''){
                                          echo "<label>Add Project report</label>
                                          <div class='form-group' id='txtEditor'>
                                          <input type='file' name = 'pFiles'required><div class='invalid-feedback'>Please select a file</div></div>";
                                          }
                                          else{
                                          $pid = $row["p_id"];
                                          $report = $row['t_report'];
                                          // echo '<from action="../assests/fileslogic.php" method="POST">
                                          //   <input type="hidden" value="'.$pid.'" name="pid">
                                          //   <input  type="submit" name="download" value="Download Report" class="btn btn-primary">

                                          //   </form>';
                                          echo '<div class="form-group"><a href="../assests/fileslogic.php?pid='.$pid.'">Download Report</a></div>';
                                            // <a href="dashboard.php?file_id='.$pid.'">Download</a>';

                                          }
                                          ?>
                                          <div>
                                            <input  type="submit" name="Tsave" value="Save" class="btn btn-primary">
                                          </div>
                                        </form>
                                      </div>
                                        </div>
                                        <div class="tab-pane fade " id="report<?php echo $row['p_id'];?>" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="card-body">
                                        <form class="forms-sample" action="dashboard.php" method="POST" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label>Status</label>
                                            <div class="form-check">
                                              <label class="form-check-label">
                                              <input type="radio" class="form-check-input" name="status" id="optionsRadios1" value="0" <?php echo($row['status']==0 ? 'checked' : '');?>>
                                              In progress
                                              </label>
                                           </div>
                                           <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" id="optionsRadios2" value="1" <?php echo($row['status']==1 ? 'checked' : '');?>>
                                             Completed
                                            </label>
                                           </div>
                                         </div>
                                         <!-- <div class="form-group" id="txtEditor">
                                           <label for="exampleTextarea1">Additional remarks</label>
                                           <textarea id="editor" name="addinfo" class="form-control" placeholder="Additional remarks"></textarea>
                                           <input type='hidden' name='p_id' value="<?php echo $row['p_id']?>"/>
                                          </div> -->
                                          <input type='hidden' name='p_id' value="<?php echo $row['p_id']?>"/>
                                          <?php
                                          if($row['report']== 'NULL' || $row['report']== ''){
                                          echo "<label>Add Project report</label>
                                          <div class='form-group' id='txtEditor'>
                                          <input type='file' name = 'pFiles' required><div class='invalid-feedback'>Please select a file</div></div>";
                                          }
                                          else{
                                          $pid = $row["p_id"];
                                          $report = $row['report'];
                                          // echo '<from action="../assests/fileslogic.php" method="POST">
                                          //   <input type="hidden" value="'.$pid.'" name="pid">
                                          //   <input  type="submit" name="download" value="Download Report" class="btn btn-primary">

                                          //   </form>';
                                          echo '<div class="form-group"><a href="../assests/fileslogic.php?pid='.$pid.'">Download Report</a></div>';
                                            // <a href="dashboard.php?file_id='.$pid.'">Download</a>';

                                          }
                                          ?>
                                          <div>
                                            <input  type="submit" name="Rsave" value="Save" class="btn btn-primary">
                                          </div>
                                        </form>
                                      </div>
                                        </div>
                                      </div>
                                    </div>  
                                  </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                      <script>
                                          $(function () {
                                       // when the modal is closed
                                      $("#exampleModal<?php echo $row['p_id'];?>").on('hidden.bs.modal', function () {
                                          console.log("closed");
                                      $(this).removeData('bs.modal');
                                      // and empty the modal-content element
                                        });
                                      });
                                      </script>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <!-- Modal
                                <div class="modal fade" id="exampleModal<?php echo $row['p_id'];?>">
                                <?php $_SESSION['p_id'] = $row['p_id'];?>
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Add Project Report</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      </div>
                                    <div class="modal-body">
                                      <form class="forms-sample" action="dashboard.php" method="POST">
                                        <div class="form-group">
                                          <div class="form-check">
                                            <label class="form-check-label">
                                              <input type="radio" class="form-check-input" name="status" id="optionsRadios1" value="0" checked>
                                              In progress
                                            </label>
                                        </div>
                                       <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="status" id="optionsRadios2" value="1">
                                          Completed
                                        </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="txtEditor">
                                      <label for="exampleTextarea1">Additional remarks</label>
                                      <textarea id="editor" name="addinfo" class="form-control" placeholder="Additional remarks"></textarea>
                                      <input type='hidden' name='p_id' value="<?php echo $row['p_id']?>"/>
                                    </div>
                                </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
                                <input  type="submit" name="save" value="save" class="btn btn-primary">
                                </form>
                              </div>                   
                            </div>
                          </div> -->
                          <?php $i++;}}}?>
                              </tbody>
                            </table>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
              </div>
            </div>
            <?php
                // if (isset($_POST['download'])) {
                //   $id = $_POST['pid'];
                //   echo $id;
                  // $sql = "SELECT * FROM projects WHERE id=$id";
                  // $result = mysqli_query($link, $sql);
                  // echo "<script>window.alert('".$id."')</script>";
                  // $file = mysqli_fetch_assoc($result);
                  
                  // $filepath = 'uploads/' . $file['report'];
                  // echo "<script>consle.log('".$filepath."')</script>";
                  // if (file_exists($filepath)) {
                  //     header('Content-Description: File Transfer');
                  //     header('Content-Type: application/octet-stream');
                  //     header('Content-Disposition: attachment; filename=' . basename($filepath));
                  //     header('Expires: 0');
                  //     header('Cache-Control: must-revalidate');
                  //     header('Pragma: public');
                  //     header('Content-Length: ' . filesize('uploads/' . $file['name']));
                  //     readfile('uploads/' . $file['name']);
                  //     exit;
                  // }
              
              // }
            ?>
            <?php
              if(isset($_POST['Dsave']))
              {
                if(!isset($_FILES['pFiles'])){
                  $p_id =  $_POST['p_id'];
                  $status =  $_POST['status'];
                  $sql1 = "UPDATE projects SET d_status = '$status' WHERE p_id = '$p_id' ";
                  if (!mysqli_query($link, $sql1)) {
                    // echo "File uploaded successfully";
                    printf("Errormessage: %s\n", mysqli_error($link));
                    }
                  else {
                    echo "<script>window.alert('Status Updated Successfully');window.location = 'dashboard.php'</script>";
                  }
                }else{
                $p_id =  $_POST['p_id'];
                $status =  $_POST['status'];
                $filename = $_FILES['pFiles']['name'];
                
                $sql1 = "UPDATE projects SET d_status = '$status', d_report = '$filename' WHERE p_id = '$p_id' ";
                if (!mysqli_query($link, $sql1)) {
                  // echo "File uploaded successfully";
                  printf("Errormessage: %s\n", mysqli_error($link));
                  }
                else {
                //        echo "updated status";
                //     }
                // $filename = $_POST['pFiles'];
                $destination = '../assests/uploads/' . $filename;
                // echo($destination);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $file = $_FILES['pFiles']['tmp_name'];
                $size = $_FILES['pFiles']['size'];
                if (move_uploaded_file($file, $destination)) {
              //   $sql = "INSERT INTO reports(r_id,r_remarks,p_id) VALUES ('','$addinfo','$p_id')";
              //   if (!mysqli_query($link, $sql)) {
              //   // echo "File uploaded successfully";
              //   printf("Errormessage: %s\n", mysqli_error($link));
              //   }
              // else {
                echo "<script>window.alert('Project Updated Successfully');window.location = 'dashboard.php'</script>";
                // header('Location: dashboard.html');
              //     }
                }
                else{
                   echo "<script>window.alert('Please select a file');</script>" ;    
                }
              }// echo "<script>window.alert('".$_POST['p_id']."')</script>";
              }
            }
              if(isset($_POST['Tsave']))
              {
                if(!isset($_FILES['pFiles'])){
                  $p_id =  $_POST['p_id'];
                  $status =  $_POST['t_status'];
                  $sql1 = "UPDATE projects SET t_status = '$status' WHERE p_id = '$p_id' ";
                  if (!mysqli_query($link, $sql1)) {
                    // echo "File uploaded successfully";
                    printf("Errormessage: %s\n", mysqli_error($link));
                    }
                  else {
                    echo "<script>window.alert('Status Updated Successfully');window.location = 'dashboard.php'</script>";
                  }
                }else{
                $p_id =  $_POST['p_id'];
                $t_status =  $_POST['t_status'];
                // $addinfo = $_POST['addinfo'];

                $filename = $_FILES['pFiles']['name'];
                $sql1 = "UPDATE projects SET t_status = '$t_status', t_report = '$filename' WHERE p_id = '$p_id' ";
                if (!mysqli_query($link, $sql1)) {
                  // echo "File uploaded successfully";
                  printf("Errormessage: %s\n", mysqli_error($link));
                  }
                  else {
                    //        echo "updated status";
                    //     }
                    // $filename = $_POST['pFiles'];
                    $destination = '../assests/uploads/' . $filename;
                    // echo($destination);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $file = $_FILES['pFiles']['tmp_name'];
                    $size = $_FILES['pFiles']['size'];
                    if (move_uploaded_file($file, $destination)) {
                  //   $sql = "INSERT INTO reports(r_id,r_remarks,p_id) VALUES ('','$addinfo','$p_id')";
                  //   if (!mysqli_query($link, $sql)) {
                  //   // echo "File uploaded successfully";
                  //   printf("Errormessage: %s\n", mysqli_error($link));
                  //   }
                  // else {
                    echo "<script>window.alert('Project Updated Successfully');window.location = 'dashboard.php'</script>";
                    // header('Location: dashboard.html');
                  //     }
                    }
                    else{
                       echo "<script>window.alert('Please select a file');</script>" ;    
                    }
                  }// echo "<script>window.alert('".$_POST['p_id']."')</script>";
                  }
                }
              if(isset($_POST['Rsave']))
              {
                if(!isset($_FILES['pFiles'])){
                  $p_id =  $_POST['p_id'];
                  $status =  $_POST['status'];
                  $sql1 = "UPDATE projects SET status = '$status' WHERE p_id = '$p_id' ";
                  if (!mysqli_query($link, $sql1)) {
                    // echo "File uploaded successfully";
                    printf("Errormessage: %s\n", mysqli_error($link));
                    }
                  else {
                    echo "<script>window.alert('Status Updated Successfully');window.location = 'dashboard.php'</script>";
                  }
                }else{
                $p_id =  $_POST['p_id'];
                $status =  $_POST['status'];
                // $addinfo = $_POST['addinfo'];

                $filename = $_FILES['pFiles']['name'];
                $sql1 = "UPDATE projects SET status = '$status', report = '$filename' WHERE p_id = '$p_id' ";
                if (!mysqli_query($link, $sql1)) {
                  // echo "File uploaded successfully";
                  printf("Errormessage: %s\n", mysqli_error($link));
                  }
                  else {
                    //        echo "updated status";
                    //     }
                    // $filename = $_POST['pFiles'];
                    $destination = '../assests/uploads/' . $filename;
                    // echo($destination);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $file = $_FILES['pFiles']['tmp_name'];
                    $size = $_FILES['pFiles']['size'];
                    if (move_uploaded_file($file, $destination)) {
                  //   $sql = "INSERT INTO reports(r_id,r_remarks,p_id) VALUES ('','$addinfo','$p_id')";
                  //   if (!mysqli_query($link, $sql)) {
                  //   // echo "File uploaded successfully";
                  //   printf("Errormessage: %s\n", mysqli_error($link));
                  //   }
                  // else {
                    echo "<script>window.alert('Project Updated Successfully');window.location = 'dashboard.php'</script>";
                    // header('Location: dashboard.html');
                  //     }
                    }
                    else{
                       echo "<script>window.alert('Please select a file');</script>" ;    
                    }
                  }// echo "<script>window.alert('".$_POST['p_id']."')</script>";
                  }
                }
            ?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from Bootstrapdash.com</span>
          </div>
        </footer> -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/dashboard.js"></script>
  <script src="../js/data-table.js"></script>
  <script src="../js/jquery.dataTables.js"></script>
  <script src="../js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
  <script src="../js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../chart.js"></script>
</body>

</html>

