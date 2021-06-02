<?php
	include('../assests/dbconnect.php');
	if(isset($_POST["login"]))
	{
		$uname = $_POST["u_name"];
		// $link = mysqli_connect("localhost", "root", "", "pms");
		
 
// Check connection
		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
      
// Attempt select query execution
if(($_POST["user_type"] == 0))
{
		$sql = "SELECT * FROM client where c_uname = '$uname'";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) >0){
				$row = mysqli_fetch_row($result);
				if($row[3] == $uname)
					if($row[5]==$_POST["p_wd"])
					header('Location: ../client/dashboard.html');
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
				
		}
	}
	else if(($_POST["user_type"] == 1))
	{
		$sql = "SELECT * FROM requirementanalysis_design_team where rd_user_name = '$uname'";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) >0){
				$row = mysqli_fetch_row($result);
				if($row[1] == $uname)
					if($row[2]==$_POST["p_wd"])
					header('Location: ../req_and_des/dashboard.html');
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
				
		}
	}
	else if(($_POST["user_type"] == 2))
	{
		$sql = "SELECT * FROM development_team where d_user_name = '$uname'";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) >0){
				$row = mysqli_fetch_row($result);
				if($row[1] == $uname)
					if($row[2]==$_POST["p_wd"])
					header('Location: ../development/dashboard.html');
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
				
		}
	}
	else if(($_POST["user_type"] == 3))
	{
		$sql = "SELECT * FROM testing_team where t_user_name = '$uname'";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) >0){
				$row = mysqli_fetch_row($result);
				if($row[1] == $uname)
					if($row[2]==$_POST["p_wd"])
					header('Location: ../testing/dashboard.html');
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
				
		}
	}	
	else if(($_POST["user_type"] == 4))
	{
		$sql = "SELECT * FROM delivery_maintenance_team where dm_user_name = '$uname'";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) >0){
				$row = mysqli_fetch_row($result);
				if($row[1] == $uname)
					if($row[2]==$_POST["p_wd"])
					header('Location: ../delivery/dashboard.html');
					else
						echo "incorrect password";
			}	
			else
				echo "user not found";
				
		}
	}	
}	
?>