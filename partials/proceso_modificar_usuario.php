<?php
    require 'database.php';

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario']) && isset($_REQUEST['id_usuario'])){
        $idmod=$_REQUEST['id_usuario'];
        $modnombreuser = $_POST['nombre'];
        $modapellidouser = $_POST['apellido'];
        $moduser = $_POST['usuario'];
    }else{
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }
    

    $revisar = mysqli_query($conn,"SELECT id_usuario FROM usuarios WHERE id_usuario = '$idmod'");
    $veruser = mysqli_fetch_array($revisar);
    if(isset($veruser['id_usuario'])){
        $veruser = $veruser['id_usuario'];
    }

    $querymoduser = mysqli_query($conn,"UPDATE usuarios SET Nombre = '$modnombreuser', Apellido = '$modapellidouser', Nombre_usuario = '$moduser' WHERE id_usuario=$veruser");

    if($querymoduser){
        echo "
            <script>
                alert('Usuario modificado exitosamente');
                window.location = '../adminpage.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Problema al modificar usuario, vuelva a intentarlo');
                window.location = '../adminpage.php';
            </script>
        ";
    }
    mysqli_close($conn);
?>