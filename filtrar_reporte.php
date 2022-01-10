<?php
    require 'partials/database.php';

    session_start();

    if(!isset($_SESSION['user'])){
        echo '
            <script>
                alert("Debes iniciar sesión");
                window.location = "index.php";
            </script>
        ';
        session_destroy();
        die;
    }

    if(!isset($_REQUEST['cedula'])){
        echo '
            <script>
                window.location = "index.php";
            </script>
        ';
        exit;
    }

    $caracas = new DateTimeZone("America/Caracas");
    $caracash = new DateTime("now",$caracas);
    $fechaactual = $caracash->format("Y-m-d");
    $horaactual = $caracash->format("H:i");

    $cedu=$_REQUEST['cedula'];
    $consultaasistrab=mysqli_query($conn,"SELECT * FROM trabajadores WHERE cedula=$cedu and Estado='Activo'");
    $datosasistrab=mysqli_fetch_array($consultaasistrab);
    $cedula=$datosasistrab['cedula'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        require "partials/links.php";
    ?>
    <title>Filtrador de Reporte</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div>
        <p class="fecha">
            <?php
                echo $fechaactual;
            ?>
        </p>
        <p class="fecha">
            <?php
                echo $horaactual;
            ?>
        </p>
    </div>
    <div class="mainer">
        <h1 class="pagetitle">Generar reporte del Usuario</h1>
    </div>
        <div class="datosusuario mainblock">
            <h2 class="mintitle">Nombre Completo:</h2>
            <p class="datos">
                <?php
                    echo $datosasistrab['Nombre'] . " " . $datosasistrab['Apellido'] ;
                ?>
            </p>
            <h2 class="mintitle">C.I:</h2>
            <p class="datos">
                <?php
                    echo $datosasistrab['cedula'];
                ?>
            </p>
            <h2 class="mintitle">Area de Trabajo:</h2>
            <p class="datos">
                <?php
                    echo $datosasistrab['Puesto_trabajo'];
                ?>
            </p>
        </div>
        
        <form action="./print_pdf.php?cedula=<?php echo $cedula?>" name="formreg" method="post" target="_blank">
            <div class="mainer">
                <div class="nombresin">
                    <label class="datelabel"><b>Fecha Inicial</b></label>
                    <input required class="date" type="date" id="fecha1" name="fecha1">
                </div>
                <div class="nombresin">
                    <label class="datelabel"><b>Fecha Final</b></label>
                    <input required class="date" type="date" id="fecha2" name="fecha2">
                </div>               
            </div> 
            <div class="mainer">
                <button class="mainbutton">
                    Generar
                </button>
            </div> 
        </form>  
    <div class="mainer botonvolver">
        
        <button class="mainbutton" onclick="location.href='./index.php'">
            Regresar
        </button>
    </div>
    <script>
        let campo1 = document.getElementById("entrada");
        let campo2 = document.getElementById("salida");
        let checkau = document.getElementById("Ausente");
        let checkpre = document.getElementById("Presente");

        function habilitar(){
            if(checkau.checked){
                campo1.disabled = true;
                campo2.disabled = true;
            }else{
                campo1.disabled = false;
                campo2.disabled = false;
            }
        }
        
    </script>
</body>
</html>