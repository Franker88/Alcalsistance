<?php
    require 'partials/database.php';
    require 'partials/sesion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php' ?>
    <title>Alcalsistance Registrar</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div class="mainblock">
        <div class="mainer">
            <h1 class="pagetitle">Registrar</h1>
        </div>
        <section class="mainer">
            <form action="partials/proceso_registro.php" name="formreg" method="post">
                <div class="registros">
                    <div class="nombresin">
                        <label for="nombre">Nombre</label>
                        <input required class="inputgeneral" id="nombre" name="nombre" type="text" min="4" max="20" placeholder="Ingresa tu nombre">
                    </div>
                    <div class="nombresin">
                        <label for="apellido">Apellido</label>
                        <input required class="inputgeneral" id="apellido" name="apellido" type="text" min="4" max="20" placeholder="Ingresa tu apellido">
                    </div>                        
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="usuario">Nombre de Usuario</label>
                        <input required class="inputgeneral" id="usuario" name="usuario" type="text" min="4" max="20" placeholder="Ingresar usuario">
                    </div>
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="contra">Contraseña</label>
                        <input required class="inputgeneral" id="contra" name="contra" type="password" min="6" max="20" placeholder="Ingresa tu contraseña" onchange="verificar()">
                    </div>
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="contracon">Confirmar Contraseña</label>
                        <input class="inputgeneral" id="contracon" name="contracon" type="password" min="6" max="20" placeholder="Confirma tu contraseña" onchange="verificar()">
                        <p class="checktext"><input class="check" name="mostrar" id="checkcontra" type="checkbox" onclick="mostrarcontraseñas()" value="Mostrar Contraseña">Mostrar Contraseñas</p>
                    </div>
                    
                </div>
                <div class="registros">
                    <p class="validador">Contraseñas mayores a 5 dígitos</p>
                </div>
                <div class="registros">       
                    <button id="regisbut" class="mainbutton">Registrar</button>
                </div>
            </form>
        </section>
        <div class="mainer senal">
            <h3 class="senalador">¿Ya tienes un usuario registrado? <a href="ingresar.php">Ingresa aquí</a></h3>
        </div>
        <div class="mainer botonvolver">
            <button class="mainbutton" onclick="location.href='./index.php'">
                Regresar
            </button>
        </div>
    </div>

    <script>
        let mostrar = document.getElementById("contra");
        let confir = document.getElementById("contracon");
        function mostrarcontraseñas(){
            if(mostrar.type=="password"){
                mostrar.type="text";
                confir.type="text";
            }else if(mostrar.type="text"){
                mostrar.type="password";
                confir.type="password"
            }
        }

        let subbutton = document.getElementById("regisbut");
        subbutton.disabled = true;
        function verificar(){
            let val1 = document.getElementById("contra");
            let val2 = document.getElementById("contracon");            
            if(val1.value == "" || val1.value.length < 5){
                val1.style.borderColor = "red";
                if(val1.value.length < 5){
                    alert("La contraseña debe ser mayor a 5 valores")
                    subbutton.disabled = true;
                }
            }
            if(val2.value == ""){
                val2.style.borderColor = "red";
            }else if(val1.value!==val2.value || val1.value.length < 5){                                
                val1.style.borderColor = "red";
                val2.style.borderColor = "red";
                subbutton.disabled = true;
            }else{
                val1.style.borderColor = "green";
                val2.style.borderColor = "green";
                subbutton.disabled = false;
            }
        }
    </script>
</body>
</html>