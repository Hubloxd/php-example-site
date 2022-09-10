<?php
    $conn = mysqli_connect("localhost", "root", "", "website");
    if(!$conn){
        throw new Exception("Error Connecting To The Database", 1);
    }
?>