<?php
    include('../../assests/dbconnect.php');
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
					header('Location: ../../client/dashboard.html');
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
					header('Location: ../../client/dashboard.html');
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
        }
    }   
?>