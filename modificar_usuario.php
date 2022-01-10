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
    
    $idu=$_REQUEST['id_usuario'];
    $consultamod=mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuario=$idu");
    $datosmod=mysqli_fetch_array($consultamod);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php' ?>
    <title>Alcalsistance Modificar Usuario</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div class="mainblock">
        <div class="mainer">
            <h1 class="pagetitle">Modificar</h1>
        </div>
        <section class="mainer">
            <form action="partials/proceso_modificar_usuario.php?id_usuario=<?php echo $datosmod['id_usuario']?>" name="formreg" method="post">
                <div class="registros">
                    
                    <div class="nombresin">
                        <label for="nombre">Nombre</label>
                        <input required class="inputgeneral" id="nombre" name="nombre" type="text" min="4" max="20" placeholder="Ingresa tu nombre" value="<?php echo $datosmod['Nombre']?>">
                    </div>
                    <div class="nombresin">
                        <label for="apellido">Apellido</label>
                        <input required class="inputgeneral" id="apellido" name="apellido" type="text" min="4" max="20" placeholder="Ingresa tu apellido" value="<?php echo $datosmod['Apellido']?>">
                    </div>                        
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="usuario">Nombre de Usuario</label>
                        <input required class="inputgeneral" id="usuario" name="usuario" type="text" min="4" max="20" placeholder="Ingresar usuario" value="<?php echo $datosmod['Nombre_usuario']?>">
                    </div>
                </div>

                <div class="registros">
                    <p class="validador">No se permite cambiar contraseña</p>
                </div>
                <div class="registros">       
                    <button id="modibut" class="mainbutton">Modificar</button>
                </div>
            </form>
        </section>

        <div class="mainer botonvolver">
            <button class="mainbutton" onclick="location.href='./adminpage.php'">
                Regresar
            </button>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>