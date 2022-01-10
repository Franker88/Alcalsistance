<?php
    
    require 'database.php';

    session_start();

    if(isset($_POST['usuario']) && isset($_POST['contra'])){
        $usuariolog = $_POST['usuario'];
        $contralog = $_POST['contra'];
        $contralog = hash('sha512', $contralog);
    }else{
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }

    

    $validar_login = mysqli_query($conn,"SELECT * FROM administradores WHERE Nombre_usuario = '$usuariolog' AND Contrasena = '$contralog'");

    if(mysqli_num_rows($validar_login)>0){
        $_SESSION['admin'] = $usuariolog;
        header("location: ../adminpage.php");
        exit;
    }else{
        echo '
            <script>
                alert("Administrador no existente");
                window.location = "../index.php";
            </script>
        ';
    }
?>
