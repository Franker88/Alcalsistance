<?php
    require "partials/database.php";
    require "partials/consultastrab.php";
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
    $caracas = new DateTimeZone("America/Caracas");
    $caracash = new DateTime("now",$caracas);
    $fechaactual = $caracash->format("Y-m-d");
   
    $verfecha = mysqli_query($conn,"SELECT Fecha FROM fecha_condicional");
    $mostrarfecha = mysqli_fetch_array($verfecha);

    if(empty($mostrarfecha)){
        $colocarfecha = mysqli_query($conn,"INSERT INTO fecha_condicional (id, Fecha) VALUE (1,'$fechaactual')");
    }else{
        if($mostrarfecha['Fecha'] != $fechaactual){
            $actualizarfecha = mysqli_query($conn,"UPDATE fecha_condicional SET Fecha ='$fechaactual'");
            $revisartrabajadores = mysqli_query($conn,"SELECT * FROM trabajadores WHERE Estado = 'Activo'");
    
            if(mysqli_fetch_row($revisartrabajadores)>0){
                $enumerar = mysqli_fetch_array($revisartrabajadores);
    
                foreach($revisartrabajadores as $filaasistencia){
                    $cedulatrabinsert = $filaasistencia['cedula'];
                    $nombretrabinsert = $filaasistencia['Nombre'];
                    $apellidotrabinsert = $filaasistencia['Apellido'];
                    $queryasistencia = mysqli_query($conn,"INSERT INTO asistencia (cedula, Nombre, Apellido, Fecha, Estado_asistencia, Hora_entrada, Hora_salida, Justificacion) VALUES ('$cedulatrabinsert', '$nombretrabinsert', '$apellidotrabinsert', '$fechaactual', 'Ausente' ,'00:00:00','00:00:00', '')");
                }
            }
        }
    }
        
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php'?>
    <title>Alcalsistance Principal</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div>
        <a class="cerrarsec" href="partials/cerrar.php">Cerrar sesión</a>
    </div>
    <br><br>
    <div>
        <p class="fecha">
            <?php
                echo $fechaactual;
            ?>
        </p>
    </div>
    <div class="mainer">
        <h1 class="pagetitle">Control de Horario de Trabajadores</h1>
    </div>
    <br>
    <div class="tabletitle">
        <h2 class="subtitle">Trabajadores Registrados</h2>
    </div>
    <div class="mainer tabler">
        <table>
            <thead>
                <tr>
                    <th scope="col">Cedula Trabajador</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Area de Trabajo</th>
                    <th scope="col">Estado Actual</th>
                    <th scope="col">Gestionar</th>
                    <th scope="col">Generar Reporte</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($querytrab as $rowt){ 
                        if($rowt['Estado']=='Activo'){
                            $cedrow = $rowt["cedula"];
                            $estadoactual = mysqli_query($conn,"SELECT Estado_asistencia FROM asistencia WHERE Fecha='$fechaactual' AND cedula=$cedrow");
                            $arrayestado = mysqli_fetch_array($estadoactual);
                        if(!isset($arrayestado)){
                            continue;
                        }?>
                        
                        <tr>
                            <td><?php echo $rowt["cedula"];?></td>
                            <td><?php echo $rowt["Nombre"];?></td>
                            <td><?php echo $rowt["Apellido"];?></td>
                            <td><?php echo $rowt["Puesto_trabajo"];?></td>
                            <td><?php echo $arrayestado["Estado_asistencia"];?></td>
                            <td><a href="./gestionar_asistencia.php?cedula=<?php echo $rowt['cedula']?>">Asistencia</a></td>
                            <td><a href="./filtrar_reporte.php?cedula=<?php echo $rowt['cedula']?>">Reporte</a></td>
                        </tr>
                <?php    
                        }else{}
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="mainer">
        <button class="mainbutton" onclick="location.href='./consultar_trabajadores_asistencia.php'">
            Consultar
        </button>
    </div>
</body>
</html>