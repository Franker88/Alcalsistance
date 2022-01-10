<?php
    require "./database.php";
    require "./consultastrab.php";
    session_start();

    if(!isset($_REQUEST['cedula']) && !isset($_POST['estado']) && !isset($_POST['entrada']) && !isset($_POST['salida']) && !isset($_POST['justificacion'])){
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }

    $caracas = new DateTimeZone("America/Caracas");
    $caracash = new DateTime("now",$caracas);
    $fechaactual = $caracash->format("Y-m-d");

    $cedu=$_REQUEST['cedula'];
    $consultaasistrab=mysqli_query($conn,"SELECT * FROM trabajadores WHERE cedula=$cedu and Estado='Activo'");
    $datosasistrab=mysqli_fetch_array($consultaasistrab);

    if(!empty($_POST['estado'])){
        if($_POST['estado']=="Ausente"){
            $estadoasis="Ausente";
        }else{
            $estadoasis = "Presente";
        }
    }
    if(empty($_POST['entrada']) || $_POST['estado']=="Ausente"){
        $horaentrada="00:00:00";
    }else{
        $horaentrada = $_POST['entrada'];
    }   
    if(empty($_POST['salida']) || $_POST['estado']=="Ausente"){
        $horasalida="00:00:00";
    }else{
        $horasalida = $_POST['salida'];
    }
    $justifyasis = $_POST['justificacion'];
    
    $actualizar = mysqli_query($conn,"UPDATE asistencia SET Estado_asistencia = '$estadoasis', Hora_entrada = '$horaentrada', Hora_salida = '$horasalida', Justificacion = '$justifyasis' WHERE cedula='$cedu' AND Fecha='$fechaactual'");

    if($actualizar){
        echo "
            <script>
                alert('Asistencia Modificada');
                window.location = '../index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Ha ocurrido un error, vuelva a intentarlo');
                window.location = '../index.php';
            </script>
        ";
    }
    mysqli_close($conn);
?>