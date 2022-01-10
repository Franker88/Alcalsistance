<?php
    require 'database.php';
    
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario']) && isset($_POST['contra'])){
        $nombreform = $_POST['nombre'];
        $apellidoform = $_POST['apellido'];
        $usuarioform = $_POST['usuario'];
        $contraform = $_POST['contra'];
        $confirm = false;
    }else{
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }
    

    /*Encriptado de Contraseña*/
    $contraform = hash('sha512', $contraform);

    $queryinsert = "INSERT INTO usuarios(Nombre, Apellido, Nombre_usuario, Contrasena, Confirmado) VALUES ('$nombreform', '$apellidoform', '$usuarioform', '$contraform', '$confirm')";
        
    /*Verificar que no se repita el usuario*/ 
    $verify_username = mysqli_query($conn,"SELECT * FROM usuarios WHERE Nombre_usuario = '$usuarioform'");
    
    if(mysqli_num_rows($verify_username) > 0){
        echo '
            <script>
                alert("El usuario ya está registrado, intenta con otro diferente");
                window.location = "registrar.php";
            </script>
        ';
        exit();
    }

    /*Registro Exitoso o Error*/
    $ejecutarregis = mysqli_query($conn ,$queryinsert);

    if($ejecutarregis){
        echo "
            <script>
                alert('Usuario Registrado Exitosamente');
                window.location = '../index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Ha habido un error al registrar esta cuenta, vuelva a intentarlo');
                window.location = '../registrar.php';
            </script>
        ";
    }

    mysqli_close($conn);
?>