<?php

    session_start();

    if(isset($_SESSION['user'])){
        header("location: alcalsistance.php");
    }
    if(isset($_SESSION['admin'])){
        header("location: adminpage.php");
    }
?>