<?php

    require "database.php";

    $querytrab = mysqli_query($conn,"SELECT * FROM trabajadores");
    $arraytrab = mysqli_fetch_array($querytrab);
?>