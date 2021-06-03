<?php
    session_destroy();
    echo $_SESSION["uname"];
    header('Location: ../signin/login/login.html');
?>