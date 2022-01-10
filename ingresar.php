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
    <?php require 'partials/links.php'?>
    <title>Alcalsistance Ingresar</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    
    <div class="mainblock">
        <div class="mainer">
            <h1 class="pagetitle">Ingresar</h1>
        </div>
        <section class="mainer">
            
                <form action="partials/proceso_login.php" method="post">
                    <div class="divform">
                        <label for="usuario">Usuario</label>
                        <input required class="inputgeneral" id="usuario" name="usuario" type="text" min="4" max="20" placeholder="Ingresar usuario">
                    </div>
                    <div class="divform">
                        <label for="contraseña">Contraseña</label>
                        <div class="inputcontra">
                            <input required class="inputgeneral" id="contra" name="contra" type="password" min="6" max="20" placeholder="Ingresa tu contraseña">                      
                        </div>
                        <p class="checktext"><input class="check" name="mostrar" id="checkcontra" type="checkbox" onclick="mostrarcontraseña()" value="Mostrar Contraseña">Mostrar Contraseña</p>
                    </div>
                    <div class="divform">
                        <button class="mainbutton">Ingresar</button>
                    </div>       
                </form>            
        </section>
        <div class="mainer senal">
            <h3 class="senalador">¿No has registrado ningún usuario? <a href="registrar.php">Registrate aquí</a></h3>
        </div>
        <div class="mainer botonvolver">
            <button class="mainbutton" onclick="location.href='./index.php'">
                Regresar
            </button>
        </div>
    </div>
    <script>



        let mostrar = document.getElementById("contra");
        function mostrarcontraseña(){
            if(mostrar.type=="password"){
                mostrar.type="text";
            }else if(mostrar.type="text"){
                mostrar.type="password";
            }
        }
    </script>
</body>
</html>