<?php
    include('../../assests/dbconnect.php');
    if(isset($_POST["s_signup"]))
    {   $usn = $_POST["susn"];
        $email = $_POST["semail"];
        $name = $_POST["sname"];
        $pass = $_POST["spass"];
        $sql = "insert into students(s_id,s_usn,s_name,s_email,s_pass) values ('','$usn','$name','$email','$pass')";
        // echo '<script>alert("Welcome "+ "'.$name.'"+"\n"+"Account created successfully\nLogin to continue")</script>';
        
        if (!mysqli_query($link, $sql)) { 
            // echo "File uploaded successfully";
            printf("Errormessage: %s\n", mysqli_error($link));
        }
        else {
            echo "<html>
        <head>
        <style>
        html, body, .container {
            height: 100%;
            font-family: 'Courier New', monospace;
        }
        .container {
            display: -webkit-flexbox;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            justify-content: center;
        }
        </style>
        <script>
            function timr(){
                var count = 5;
                setInterval(function(){
                count--;
                document.getElementById('countDown').innerHTML = count;
                if (count == 0) {
                window.location = '../login/login.html'; 
                }
            },1000);
        }
        </script>
        </head>
        <body onload='timr()'>
        <div class='container'><h2>Thankyou ".$name."<br>Account Created Successfully..!<br>Redirecting to login page in <span id='countDown'>5</span> secs..</h2></div>
        </body>
        </html>";
            
        }    
    }
    if(isset($_POST["g_signup"]))
    {   
        $email = $_POST["gemail"];
        $name = $_POST["gname"];
        $pass = $_POST["gpass"];
        $sql = "insert into guides(g_id,g_name,g_email,g_pass) values ('','$name','$email','$pass')";
        // echo '<script>alert("Welcome "+ "'.$name.'"+"\n"+"Account created successfully\nLogin to continue")</script>';
        
        if (!mysqli_query($link, $sql)) { 
            // echo "File uploaded successfully";
            printf("Errormessage: %s\n", mysqli_error($link));
        }
        else {
            echo "<html>
        <head>
        <style>
        html, body, .container {
            height: 100%;
            font-family: 'Courier New', monospace;
        }
        .container {
            display: -webkit-flexbox;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            justify-content: center;
        }
        </style>
        <script>
            function timr(){
                var count = 5;
                setInterval(function(){
                count--;
                document.getElementById('countDown').innerHTML = count;
                if (count == 0) {
                window.location = '../login/login.html'; 
                }
            },1000);
        }
        </script>
        </head>
        <body onload='timr()'>
        <div class='container'><h2>Thankyou ".$name."<br>Account Created Successfully..!<br>Redirecting to login page in <span id='countDown'>5</span> secs..</h2></div>
        </body>
        </html>";
            
        }    
    }
?>