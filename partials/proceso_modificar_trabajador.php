<?php
    require 'database.php';

    if(isset($_POST['trabajo']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_REQUEST['cedula'])   && isset($_POST['cedulaf'])){
        $ced=$_REQUEST['cedula'];
        $cedmod=$_POST['cedulaf'];
        $modnombretrab = $_POST['nombre'];
        $modapellidotrab = $_POST['apellido'];
        $modtrab = $_POST['trabajo'];
    }else{
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }
    

    $revisartrab = mysqli_query($conn,"SELECT cedula FROM trabajadores WHERE cedula = '$ced'");
    $vertrab = mysqli_fetch_array($revisartrab);
    if(isset($vertrab['cedula'])){
        $vertrab = $vertrab['cedula'];
    }

    $querymodtrab = mysqli_query($conn,"UPDATE trabajadores SET cedula = $cedmod, Nombre = '$modnombretrab', Apellido = '$modapellidotrab', Puesto_trabajo = '$modtrab' WHERE cedula=$vertrab");

    if($querymodtrab){
        echo "
            <script>
                alert('Trabajador modificado exitosamente');
                window.location = '../adminpage.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Problema al modificar trabajador, vuelva a intentarlo');
                window.location = '../adminpage.php';
            </script>
        ";
    }
    mysqli_close($conn);
?>