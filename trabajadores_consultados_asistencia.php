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

    if(!isset($_POST['nombre']) && !isset($_POST['apellido']) && !isset($_POST['cedula']) && !isset($_POST['trabajo'])){
        echo '
            <script>
                window.location = "index.php";
            </script>
        ';
        exit;
    }

    $nombretrabfiltro = $_POST['nombre'];
    $apellidotrabfiltro = $_POST['apellido'];
    $cedulafiltro = $_POST['cedula'];
    $trabfiltro = $_POST['trabajo'];

    $filtrartrab = mysqli_query($conn,"SELECT * FROM trabajadores WHERE cedula like '%$cedulafiltro%' AND Nombre like '%$nombretrabfiltro%' AND Apellido like '%$apellidotrabfiltro%' AND Puesto_trabajo like '%$trabfiltro%' AND Estado='Activo'");
    $arrayfiltrotrab = mysqli_fetch_array($filtrartrab);
    
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php'?>
    <title>Alcalsistance Consulta de Trabajadores</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <br>
    <div class="mainer">
        <h1 class="pagetitle">Consulta de Trabajadores</h1>
    </div>
    <br>
    <div class="tabletitle">
        <h2 class="subtitle">Trabajadores Registrados</h2>
    </div>
    <div class="mainer tabler">
        <table>
            <thead>
                <tr>
                    <th scope="col">Cedula de Identidad</th>
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
                    foreach($filtrartrab as $rowft){
                        $cedrow = $rowft["cedula"];
                        $verasistencia = mysqli_query($conn,"SELECT Estado_asistencia FROM asistencia WHERE cedula=$cedrow");
                        $asistencia = mysqli_fetch_array($verasistencia);
                        if(!isset($asistencia)){
                            continue;
                            }?>
                        <tr>
                            <td><?php echo $rowft["cedula"];?></td>
                            <td><?php echo $rowft["Nombre"];?></td>
                            <td><?php echo $rowft["Apellido"];?></td>
                            <td><?php echo $rowft["Puesto_trabajo"];?></td>
                            <td><?php echo $asistencia["Estado_asistencia"];?></td>
                            <td><a href="./gestionar_asistencia.php?cedula=<?php echo $rowft['cedula']?>">Asistencia</a></td>
                            <td><a href="./filtrar_reporte.php?cedula=<?php echo $rowft['cedula']?>">Reporte</a></td>
                        </tr>
                <?php    
                    }
                ?>

            </tbody>
            
        </table>
    </div>
    <div class="mainer">
        <button class="mainbutton" onclick="location.href='./consultar_trabajadores_asistencia.php'">
            Consultar
        </button>
        <button class="mainbutton" onclick="location.href='./index.php'">
            Regresar
        </button>
        </div>    
    </div>
</body>
</html>