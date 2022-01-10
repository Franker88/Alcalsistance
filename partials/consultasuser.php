<?php

    require "database.php";

    $query = mysqli_query($conn,"SELECT * FROM usuarios");
    $array = mysqli_fetch_array($query);
?>