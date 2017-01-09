<?php
        $server = "localhost";
        $username = "root";
        $password = "J71f9051184!";
        $db = "steam";
        $conn = new mysqli($server,$username,$password,$db);
        if($conn->connect_error)
        {
            echo $conn->connect_error;
            exit("Connection Failed " .$conn->connect_error);
        }
?>