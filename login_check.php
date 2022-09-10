<?php
    session_start();

    if(!empty($_SESSION) && $_SESSION["loggedIn"] === true){
        header("Location: /dashboard.php");
    }
?>