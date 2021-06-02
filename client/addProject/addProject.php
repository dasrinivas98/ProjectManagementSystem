<?php
  include('../../assests/dbconnect.php');
  if(isset($_POST['submit']))
  {
    $pTitle = ($_POST['pTitle']);
    $pDura = ($_POST['pDura']);
    $pReq = ($_POST['pReq']);
    $pAddInfo = ($_POST['pAddInfo']);
    $filename = $_FILES['pFiles']['name'];
    // $filename = $_POST['pFiles'];
    $destination = '../../assests/uploads/' . $filename;
    // echo($destination);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['pFiles']['tmp_name'];
    $size = $_FILES['pFiles']['size'];
    if (move_uploaded_file($file, $destination)) {
        $sql = "INSERT INTO projects(p_id, p_title, p_duration, p_req, p_addn_info,p_files, c_id, rd_id, d_id, t_id, dm_id) VALUES ('','$pTitle','$pDura','".$pReq."','$pAddInfo','$filename',1,1,1,1,1)";
        echo $sql;
        if (!mysqli_query($link, $sql)) {
            // echo "File uploaded successfully";
            printf("Errormessage: %s\n", mysqli_error($link));
        }
     else {
        echo "File uploaded successfully";
        header('Location: ../dashboard.html');
    }
        
    }
    else{
        
    }
  }
?>