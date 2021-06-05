<?php
    
    //  include('../../assests/dbconnect.php');
     $link = mysqli_connect("localhost", "root", "", "pms1");
    if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
   }
     session_start();
    if(isset($_POST["s_login"]))
	{
       
		$email = $_POST["s_email"];
        $pwd = $_POST["s_pass"];
        $sql = "SELECT * FROM students where s_email = '$email'";
        if (!($result = mysqli_query($link, $sql))) { 
            printf("Errormessage: %s\n", mysqli_error($link));
        }
        else {     
            if(mysqli_num_rows($result) >0){
				$row = mysqli_fetch_row($result);
				if($row[3] == $email)
					if($row[4]==$pwd)
                    {
                    $_SESSION["email"] = $row[3];
                    $_SESSION['uname'] = $row[2];
                    $_SESSION['s_id'] = $row[0];
					header('Location: ../../student/dashboard.php');
                    }
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
        }
    } 
    if(isset($_POST["g_login"]))
	{
		$email = $_POST["g_email"];
        $pwd = $_POST["g_pass"];
        $sql = "SELECT * FROM guides where g_email = '$email'";
        if (!($result = mysqli_query($link, $sql))) { 
            printf("Errormessage: %s\n", mysqli_error($link));
        }
        else {     
            if(mysqli_num_rows($result) >0){
				$row = mysqli_fetch_row($result);
				if($row[2] == $email)
					if($row[3]==$pwd)
                    {
                    $_SESSION['g_id'] = $row[0];
                    $_SESSION['g_name'] = $row[1];
					header('Location: ../../guide/dashboard.php');}
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
        }
    }   
?>