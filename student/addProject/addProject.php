<?php
    include('../../assests/dbconnect.php');
    include('../../signin/login/login.php')
?>    
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PMS</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../images/logo.jpg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../images/logo.jpg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/faces/face5.png" alt="profile"/>
              <span class="nav-profile-name"><?php echo $_SESSION["uname"]?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <!--<a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>-->
              <a class="dropdown-item"  href="../../logout/logout.php">
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
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="../dashboard.php">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addProject.php">
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
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Project</h4>
                  <p class="card-description">
                    Synopsis
                  </p>
                  <form class="forms-sample" action="addProject.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Project title</label>
                      <input type="text" class="form-control" name="pTitle" id="exampleInputName1" placeholder="Project title">
                    </div>
                    <!-- <div class="form-group">
                        <label class="form-label">Project duration</label>
                        <input type="range"class="form-control form-range" min="3" max="36" step="3" value="3" id="duration" name="pDura" onchange="changeDur(this.value)"/>
                        <label for="exampleInputName1"><span id="cVal">3</span> : Months</label>
                        <script type="text/javascript">
                            function changeDur(value){
                              console.log(value);
                              document.getElementById("cVal").textContent = value;
                            }
                        </script>
                    </div> -->
                    <div class="form-group" id="txtEditor">
                      <label for="exampleTextarea1">Abstract</label>
                      <textarea id="editor" class="form-control" name="pAbs" placeholder="Abstract"></textarea>
                    </div>
                    <script>
                      tinymce.init({
                        selector: 'textarea#editor',
                        menubar: false,
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                      });
                    </script>
                    <div class="form-group" id="txtEditor">
                      <label for="exampleTextarea1">Objective od the Project</label>
                      <textarea id="editor1" class="form-control" name="pObj" placeholder="Objective od the Project"></textarea>
                    </div>
                    <script>
                      tinymce.init({
                        selector: 'textarea#editor1',
                        menubar: false,
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                      });
                    </script>
                    <div class="form-group" id="txtEditor">
                      <label for="exampleTextarea1">Software and hardware requirements</label>
                      <textarea id="editor2" class="form-control" name="pSHR" placeholder="Software and hardware requirements"></textarea>
                    </div>
                    <script>
                      tinymce.init({
                        selector: 'textarea#editor2',
                        menubar: false,
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                      });
                    </script>
                    <div class="form-group" id="txtEditor">
                      <label for="exampleTextarea1">Introduction</label>
                      <textarea id="editor3" class="form-control" name="pIntro" placeholder="Introduction"></textarea>
                    </div>
                    <script>
                      tinymce.init({
                        selector: 'textarea#editor3',
                        menubar: false,
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                      });
                    </script>
                    <div class="form-group" id="txtEditor">
                      <label for="exampleTextarea1">Functonal requirements</label>
                      <textarea id="editor4" class="form-control" name="pFReq" placeholder="Functonal requirements"></textarea>
                    </div>
                    <script>
                      tinymce.init({
                        selector: 'textarea#editor4',
                        menubar: false,
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                      });
                    </script>
                    <div class="form-group" id="txtEditor">
                      <label for="exampleTextarea1">Modules of the project</label>
                      <textarea id="editor5" class="form-control" name="pMod" placeholder="Modules of the project"></textarea>
                    </div>
                    <script>
                      tinymce.init({
                        selector: 'textarea#editor5',
                        menubar: false,
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                      });
                    </script>
                    <div class="form-group" id="txtEditor">
                      <label for="exampleTextarea1">Outcome of the project</label>
                      <textarea id="editor6" class="form-control" name="pOut" placeholder="Outcome of the project"></textarea>
                    </div>
                    <script>
                      tinymce.init({
                        selector: 'textarea#editor6',
                        menubar: false,
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
                      });
                    </script>
                   
                    <div class="form-group">
                      <label>Guide</label>
                      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="pGuide" style="width: 100%;">
                      <?php
                        $sql = "SELECT * FROM guides";
                        if (!($result = mysqli_query($link, $sql))) { 
                          printf("Errormessage: %s\n", mysqli_error($link));
                      }
                      else {     
                          if(mysqli_num_rows($result) >0){
                            while($row = mysqli_fetch_array($result)) {
                             
                    ?>
                        <option value="<?php echo $row["g_id"];?>"><?php echo$row["g_name"];}}}?></option>
                      </select>
                    </div>
                    <!-- <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="pFiles" class="file-upload-default" multiple>
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload relevant documents">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload</button>
                        </span>
                      </div>
                    </div> -->
                    <input type="submit" name="pSubmit" class="btn btn-primary mr-2">
                    <input type="reset" class="btn btn-light" >
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
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
  <?php
    if(isset($_POST['pSubmit'])){
      $pTitle = $_POST["pTitle"];
      $pAbs = $_POST["pAbs"];
      $pObj = $_POST["pObj"];
      $pSHR = $_POST["pSHR"];
      $pIntro = $_POST["pIntro"];
      $pFReq = $_POST["pFReq"];
      $pMod = $_POST["pMod"];
      $pOut = $_POST["pOut"];
      $pGuide = $_POST["pGuide"];
      $pStudent = $_SESSION["s_id"];
      $sql = "INSERT INTO projects(p_id,p_title, p_abs, p_obj, p_shr, p_intro, p_freq, p_mod, p_out,status, g_id, s_id) VALUES ('','$pTitle','".$pAbs."','".$pObj."','".$pSHR."','".$pIntro."','".$pFReq."','".$pMod."','".$pOut."',0,'$pGuide','$pStudent')";
      if (!mysqli_query($link, $sql)) { 
        // echo "File uploaded successfully";
        printf("Errormessage: %s\n", mysqli_error($link));
    }
    else {
      echo "<script>window.alert('Project created Successfully');window.location = '../dashboard.php'</script>";
    }
  }
  ?>
  <script src="../../vendors/base/vendor.bundle.base.js"></script>
  
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
