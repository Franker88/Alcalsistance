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

    $validar_login = mysqli_query($conn,"SELECT * FROM usuarios WHERE Nombre_usuario = '$usuariolog' AND Contrasena = '$contralog'");
    $confirmación = mysqli_fetch_array($validar_login);
    if(isset($confirmación['Confirmado'])){
        $confirmación =  $confirmación['Confirmado'];
    }

    if(mysqli_num_rows($validar_login)>0){
        if($confirmación){
            $_SESSION['user'] = $usuariolog;
            header("location: ../alcalsistance.php");
            exit;
        }else{ 
            echo '
                <script>
                    alert("El usuario no está confirmado por el administrador, pida una confirmación");
                    window.location = "../index.php";
                </script>
            ';
            exit;
        }
    }else{
        echo '
            <script>
                alert("El usuario no está registrado o ingresó mal sus datos, vuelva a intentarlo o registre una cuenta");
                window.location = "../index.php";
            </script>
        ';
        exit;
    }
    mysqli_close($conn);
?>