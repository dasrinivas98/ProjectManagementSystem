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
          <a class="navbar-brand brand-logo" href="dashboard.php"style="width: 100%;"><img src="../images/logo.jpg" alt="logo" style="width: 100%;"></a>
          <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="../images/logomini.jpg" alt="logo"></a>
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
          <li class="nav-item">
            <a class="nav-link" href="account.php">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Account</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      
      <div class="main-panel">
        <div class="content-wrapper">
           <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Account Details</h4>
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <?php
                                $sid = $_SESSION["s_id"];
                                $sql = "select * from students where s_id = $sid";
                                if (!($result = mysqli_query($link, $sql))) { 
                                  printf("Errormessage: %s\n", mysqli_error($link));
                                }
                              else {     
                                  if(mysqli_num_rows($result) >0){
                                    $i = 1;
                                    while($row = mysqli_fetch_array($result)){
                            ?>
                        <form class="pt-3" action="account.php" method="POST">
                            <div class="form-group">
                            <label for="exampleTextarea1">Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" value="<?php echo $row['s_name'];?>" name="sname" placeholder="Name" disabled>
                            </div>
                            <div class="form-group">
                            <label for="exampleTextarea1">USN</label>
                            <input type="text" class="form-control form-control-lg" id="usn" value="<?php echo $row['s_usn'];?>" name="susn" placeholder="USN" disabled>
                            </div>
                            <div class="form-group">
                            <label for="exampleTextarea1">e-mail</label>
                            <input type="text" class="form-control form-control-lg" id="email" name="semail" value="<?php echo $row['s_email'];?>" placeholder="e-mail" disabled>
                            </div>
                            <div class="mt-3">
                            <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="button" onclick='edit()' id='edit1'  value="Edit">
                            <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" id='save' name="save" value="Save" hidden>
                            </div>
                        </form>
                        <?php }}}?>
                        </div>
                        <script>
                            function edit() {   
                                document.getElementById('name').disabled = false;
                                // document.getElementById('usn').disabled = false;
                                document.getElementById('email').disabled = false;
                                document.getElementById('save').hidden = false;
                                document.getElementById('edit1').hidden = true;
                            }
                        </script>
                        <?php 
                            if(isset($_POST['save'])){
                                $sid = $_SESSION["s_id"];
                                // $usn = $_POST['susn'];
                                $name = $_POST['sname'];
                                $email = $_POST['semail'];
                                $sql = "update students set s_name='$name',s_email='$email' where s_id = $sid";
                                if (!($result = mysqli_query($link, $sql))) { 
                                  printf("Errormessage: %s\n", mysqli_error($link));
                                }
                              else {  
                                  
                                  echo "<script>window.alert('User details sucessfully updated');window.location.href = 'account.php';</script>";
                              }
                            }
                        ?>
                    </div>
                    
                </div>
              </div>
            </div>
           </div> 
         </div>            
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

