<?php
    require 'partials/database.php';

    session_start();

    if(isset($_SESSION['user'])){
        header("location: alcalsistance.php");
    }
    if(isset($_SESSION['admin'])){
        header("location: adminpage.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php' ?>
    <title>Asistencia de Oficina</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div class="mainblock">
        <section class="mainer">
            <div class="sec-welcomer">
                <h2 class="welcomer">Bienvenido al Gestor de Asistencia de Oficina</h2>
            </div>
        </section>
        <section class="mainer imgsec">
            <div>
                <img class="mainimg objeto" src="./style/img/reloj_pared.png">
            </div>
            <div class="mainer reloj">
                <img class="mainimg objeto" src="./style/img/calendar.png">
            </div>
        </section>
        <section class="mainer imgsec">
            <div>
                <img class="mainimg" src="./style/img/oficinista.jpg">
            </div>
        </section>
        <section class="mainer buttonsindex">       
            <div>
                <button class="mainbutton" onclick="location.href='./ingresar.php'">
                    Ingresar
                </button>
            </div>
            <div>
                <button class="mainbutton" onclick="location.href='./ingresaradmin.php'">
                    Admin
                </button>
            </div>
            <div>
                <button class="mainbutton" onclick="location.href='./registrar.php'">
                    Registrarse
                </button>
            </div>
        </section>
    </div>
</body>
</html>