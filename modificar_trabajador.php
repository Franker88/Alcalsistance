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
    
    $cedu=$_REQUEST['cedula'];
    $consultamodtrab=mysqli_query($conn,"SELECT * FROM trabajadores WHERE cedula=$cedu");
    $datosmodtrab=mysqli_fetch_array($consultamodtrab);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php' ?>
    <title>Alcalsistance Modificar Trabajador</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div class="mainblock">
        <div class="mainer">
            <h1 class="pagetitle">Modificar Trabajador</h1>
        </div>
        <section class="mainer">
            <form action="partials/proceso_modificar_trabajador.php?cedula=<?php echo $datosmodtrab['cedula']?>" name="formreg" method="post">
                <div class="registros">
                    <div class="nombresin">
                        <label for="nombre">Nombre</label>
                        <input required class="inputgeneral" id="nombre" name="nombre" type="text" min="4" max="20" placeholder="Nombre del trabajador" value="<?php echo $datosmodtrab['Nombre']?>">
                    </div>
                    <div class="nombresin">
                        <label for="apellido">Apellido</label>
                        <input required class="inputgeneral" id="apellido" name="apellido" type="text" min="4" max="20" placeholder="Apellido del trabajador" value="<?php echo $datosmodtrab['Apellido']?>">
                    </div>                        
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="cedula">Cedula de Identidad</label>
                        <input required class="inputgeneral" id="cedulaf" name="cedulaf" type="number" min="1" max="9999999999999" value="<?php echo $datosmodtrab['cedula']?>">
                    </div>
                </div>
                <div class="registros">
                    <div class="nombresin">
                        <label for="trabajo">Puesto de Trabajo</label>
                        <input required class="inputgeneral" id="trabajo" name="trabajo" type="text" min="6" max="30" placeholder="Puesto de trabajo" value="<?php echo $datosmodtrab['Puesto_trabajo']?>">
                    </div>
                </div>
                <div class="registros">
                </div>
                <div class="registros">       
                    <button id="regisbut" class="mainbutton">Modificar</button>
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