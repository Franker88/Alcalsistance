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

    $verasistencia = mysqli_query($conn,"SELECT * FROM asistencia WHERE cedula='$cedula' AND Fecha='$fechaactual'");
    $arrayver = mysqli_fetch_array($verasistencia);
    $estadoasis = $arrayver['Estado_asistencia'];
    $horaentrada = $arrayver['Hora_entrada'];
    $horasalida = $arrayver['Hora_salida'];
    $justificacion = $arrayver['Justificacion'];
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
    <title>Gestionar Asistenncia</title>
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
        <h1 class="pagetitle">Asistencia del Usuario</h1>
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
        
        <form action="partials/guardar_asistencia.php?cedula=<?php echo $cedula?>" name="formreg" method="post">
            <div class="mainer">
                <input class="radio" <?php if($estadoasis=="Ausente"){echo "checked";}?> type="radio" id="Ausente" name="estado" value="Ausente" onchange="habilitar()"><label class="radio" for="Ausente"><b>Ausente</b></label>

                <input class="radio" <?php if($estadoasis=="Presente"){echo "checked";}?> type="radio" id="Presente" name="estado" value="Presente" onchange="habilitar()"><label class="radio" for="Presente"><b>Presente</b></label>
            </div>
            <div class="mainer">
                <div class="registros">
                    <div class="nombresin">
                        <label for="nombre">Hora Entrada</label>
                        <input class="inputgeneral" id="entrada" name="entrada" type="time" value="<?php echo "$horaentrada"?>" <?php if($estadoasis=='Ausente'){ echo "disabled";}?>>
                    </div>
                    <div class="nombresin">
                        <label for="nombre">Hora Salida</label>
                        <input class="inputgeneral" id="salida" name="salida" type="time" value="<?php echo "$horasalida"?>" <?php if($estadoasis=='Ausente'){ echo "disabled";}?>>
                    </div>
                </div>
            </div>    
                <div class="registros">
                    <div class="nombresin">
                        <label for="nombre">Justificativo</label>
                        <textarea class="textarea" id="justificacion" name="justificacion" value="<?php echo "$justificacion"?>" placeholder="justificativo de asistencia/inasistencia"></textarea>
                    </div>
                </div>
            <div class="mainer">
                <button class="mainbutton">
                    Guardar
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