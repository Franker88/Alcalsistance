<?php
    require 'partials/database.php';
    
    session_start();

    if(!isset($_SESSION['admin'])){
        echo '
            <script>
                alert("Debes iniciar sesión");
                window.location = "index.php";
            </script>
        ';
        session_destroy();
        die;
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php' ?>
    <title>Alcalsistance Filtrar Trabajadores</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div class="mainblock">
        <div class="mainer">
            <h1 class="pagetitle">Filtar</h1>
        </div>
        <section class="mainer">
            <form action="./trabajadores_consultados.php" name="formreg" method="post">
                <div class="registros">
                    <div class="nombresin">
                        <label for="nombre">Nombre</label>
                        <input class="inputgeneral" id="nombre" name="nombre" type="text" min="4" max="20" placeholder="Ingresar nombre">
                    </div>
                    <div class="nombresin">
                        <label for="apellido">Apellido</label>
                        <input class="inputgeneral" id="apellido" name="apellido" type="text" min="4" max="20" placeholder="Ingresar apellido">
                    </div>                        
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="usuario">Cedula de Identidad</label>
                        <input class="inputgeneral" id="cedula" name="cedula" type="number" min="1" max="9999999999999">
                    </div>
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="trabajo">Puesto de Trabajo</label>
                        <input class="inputgeneral" id="trabajo" name="trabajo" type="text" min="4" max="50" placeholder="Ingresar Puesto">
                    </div>
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="estado">Estado de Actividad</label>
                        <select name="estado" id="estado">
                            <option value="">--SELECCIONAR--</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="registros">
                    <p class="validador">Al dejar las casillas en blanco se filtratán todos los trabajadores</p>
                </div>
                <div class="registros">       
                    <button id="regisbut" class="mainbutton">Consultar</button>
                </div>
            </form>
        </section>
        <div class="mainer botonvolver">
            <button class="mainbutton" onclick="location.href='./index.php'">
                Regresar
            </button>
        </div>
    </div>
</body>
</html>