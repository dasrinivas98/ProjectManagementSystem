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
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <!-- endinject -->  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="../index.html"><img src="../images/logo.jpg"style="width: 100%;" alt="logo"></a>
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
              <span class="nav-profile-name"><?php echo $_SESSION['g_name']?></span>
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
                    echo "Welcome ".$_SESSION['g_name'];
                  ?>
                </div>
              </div>
            </div>
           </div>
           <?php    
                $gid = $_SESSION['g_id'];
                $sql = "SELECT COUNT(status) FROM projects WHERE g_id=$gid AND status=1";
                if (!($result = mysqli_query($link, $sql))) { 
                  printf("Errormessage: %s\n", mysqli_error($link));
                }
                else{
                    $completedP = mysqli_fetch_array($result);

                }
                $sql = "SELECT COUNT(status) FROM projects WHERE g_id=$gid AND status=0";
                if (!($result = mysqli_query($link, $sql))) { 
                  printf("Errormessage: %s\n", mysqli_error($link));
                }
                else{
                    $activeP = mysqli_fetch_array($result);
                }
           ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
             <div class="card">
              <div class="card-body">
                <h4 class="card-title" style="text-transform:unset;">Number of active projects</h4>
                <p class="card-description">As on : <code id="date"></code></p>
                <script>
                  function getday(){
                    let today = new Date().toISOString().slice(0, 10);
                    document.getElementById('date').textContent = today;
                    document.getElementById('date1').textContent = today;
                  }
                    window.onload = getday;
                </script>
                <div class="template-demo">
                  <h1 class="display-1" style="text-align: center;"><?php echo $activeP[0];?></h1>
                  <h1 class="display-3 text-primary" style="text-align: center;">Project(s)</h1>
                </div>
                
              </div>
             </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title" style="text-transform:unset;">Number of completed projects</h4>
                <p class="card-description">As on : <code id="date1"></code></p>
                <div class="template-demo">
                  <h1 class="display-1" style="text-align: center;"><?php echo $completedP[0];?></h1>
                  <h1 class="display-3 text-primary" style="text-align: center;">Project(s)</h1>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="row">
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
                                  $gid = $_SESSION["g_id"];
                                  $sql = "select * from projects INNER JOIN students on projects.s_id = students.s_id where g_id = $gid";
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
                          <td><button type="button" class="btn btn-inverse-primary btn-fw" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['p_id'];?>">View</button></td>
                        </tr>
                        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModalCenter<?php echo $row['p_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Project details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              
                              <?php
                                //   $pid = $row['p_id'];
                                //    $sql = "select * from projects INNER JOIN students on projects.s_id = students.s_id where p_id = $pid";
                                //    if (!($result = mysqli_query($link, $sql))) { 
                                //      printf("Errormessage: %s\n", mysqli_error($link));
                                //  }
                                //  else {   
                                //   if(mysqli_num_rows($result) >0){
                                //     $i = 1;
                                //     while($row = mysqli_fetch_array($result)) {  
                              ?>
                                  <div class="card-body">
                                  <form class="forms-sample" action="dashboard.php" method="POST" enctype="multipart/form-data">
                                          <div class="form-group row">
                                            <div class="col-6">
                                              <label class="font-weight-bold">Student name</label>
                                              <div><?php echo $row['s_name'];?></div>
                                            </div>
                                            <div class="col-6">
                                              <label class="font-weight-bold">USN</label>
                                              <div><?php echo $row['s_usn'];?></div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                          <label class="font-weight-bold">Project title</label>
                                            <div><?php echo $row['p_title'];?></div>
                                          </div>
                                          <div class="form-group">
                                            <label class="font-weight-bold">Abstract</label>
                                            <div><?php echo $row['p_abs'];?></div>
                                          </div>
                                          <div class="form-group">
                                            <label class="font-weight-bold">Abstract</label>
                                            <div><?php echo $row['p_obj'];?></div>
                                          </div>
                                          <div class="form-group">
                                            <label class="font-weight-bold">Software and hardware requirements</label>
                                            <div><?php echo $row['p_shr'];?></div>
                                          </div>
                                          <div class="form-group">
                                            <label class="font-weight-bold">Introduction</label>
                                            <div><?php echo $row['p_intro'];?></div>
                                          </div>
                                          <div class="form-group">
                                            <label class="font-weight-bold">Functional requirements</label>
                                            <div><?php echo $row['p_freq'];?></div>
                                          </div>
                                          <div class="form-group">
                                            <label class="font-weight-bold">Modules</label>
                                            <div><?php echo $row['p_mod'];?></div>
                                          </div>
                                          <div class="form-group">
                                            <label class="font-weight-bold">Outcome</label>
                                            <div><?php echo $row['p_out'];?></div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-4">
                                              <label class="font-weight-bold">Phase</label>
                                            </div>
                                            <div class="col-4">
                                            <div><label class="font-weight-bold">Status</label></div>
                                            </div>
                                            <div class="col-4">
                                            <div><label class="font-weight-bold">File</label></div>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-4">
                                              <label class="font-weight-bold">Development</label>
                                            </div>
                                            <div class="col-4">
                                            <?php if(($row['d_status']==1)){
                                              echo "<div class='text-success'>Completed</div>";}else 
                                              echo "<div class='text-danger'>Not completed</div>";?>
                                            </div>
                                            <div class="col-4">
                                            <?php if((isset($row['d_report'])&&$row['d_report']!='NULL')){
                                               $pid = $row["p_id"];
                                               $report = 'd_report';
                                              echo '<div class="text-success"><a href="../assests/fileslogic.php?pid='.$pid.'&file='.$report.'">Download Report</a></div>';}else 
                                              echo "<div class='text-danger'>No file</div>";?>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-4">
                                              <label class="font-weight-bold">Testing</label>
                                            </div>
                                            <div class="col-4">
                                            <?php if(($row['t_status']==1)){
                                              echo "<div class='text-success'>Completed</div>";}else 
                                              echo "<div class='text-danger'>Not completed</div>";?>
                                            </div>
                                            <div class="col-4">
                                            <?php if((isset($row['t_report'])&&$row['t_report']!='NULL')){
                                               $pid = $row["p_id"];
                                               $report = 't_report';
                                              echo '<div class="text-success"><a href="../assests/fileslogic.php?pid='.$pid.'&file='.$report.'">Download Report</a></div>';}else 
                                              echo "<div class='text-danger'>No Document</div>";?>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-4">
                                              <label class="font-weight-bold">Report</label>
                                            </div>
                                            <div class="col-4">
                                            <?php if(($row['status']==1)){
                                              echo "<div class='text-success'>Completed</div>";}else 
                                              echo "<div class='text-danger'>Not completed</div>";?>
                                            </div>
                                            <div class="col-4">
                                            <?php if((isset($row['report'])&&$row['report']!='NULL')){
                                               $pid = $row["p_id"];
                                               $report = 'report';
                                              echo '<div class="text-success"><a href="../assests/fileslogic.php?pid='.$pid.'&file='.$report.'">Download Report</a></div>';}else 
                                              echo "<div class='text-danger'>No Document</div>";?>
                                            </div>
                                          </div>
                                          <div class="form-group" id="txtEditor">
                                            <label for="exampleTextarea1">Remarks</label>
                                            <textarea id="editor<?php echo $row['p_id'];?>" class="form-control" name="remarks" placeholder="Add remarks if any"></textarea>
                                          </div>
                                          <script>
                                            tinymce.init({
                                              selector: 'textarea#editor<?php echo $row['p_id'];?>',
                                              menubar: false,
                                              toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                                            });
                                          </script>
                                          <input type="hidden" name="pid" value="<?php echo $row['p_id'];?>">
                                          <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="final" value=1>
                                              I acknowledge that i have gone through the "<?php echo $row['p_title'];?>" a project by <?php echo $row['s_name'];?> and accept the final submission of the same.
                                            </label>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" name="saveR">
                                          </div>
                                       </form>   
                                      </div>
                                        
                              
                              <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save</button>
                              </div> -->
                            </div>
                          </div>
                        </div>
                        <?php $i++;}}}?>
                    </tbody>
                  </table> 
                </div>
              </div>
            </div>
          </div>     
        </div>
     </div> 
     <?php  if(isset($_POST['saveR']))
              {
                $p_id = $_POST['pid'];
                 if(($_POST['remarks'] == '')){
                   $remarks = "NULL";
                 }else{
                  $remarks = $_POST['remarks'];
                 }
                  if(($_POST['final'] == '')){
                        $final = 0;
                      }
                      else{
                        $final = $_POST['final'];
                      }
                      $sql1 = "UPDATE projects SET remarks = '$remarks',finalStatus = '$final' WHERE p_id = '$p_id' ";
                      if (!mysqli_query($link, $sql1)) {
                        // echo "File uploaded successfully";
                        printf("Errormessage: %s\n", mysqli_error($link));
                        }
                      else {
                        echo "<script>window.alert('Status Updated Successfully');window.location = 'dashboard.php'</script>";
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

