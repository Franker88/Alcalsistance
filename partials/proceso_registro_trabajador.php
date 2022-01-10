<?php
    require 'database.php';

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['trabajo'])){
        $nombreform = $_POST['nombre'];
        $apellidoform = $_POST['apellido'];
        $cedulaform = $_POST['cedula'];
        $trabajoform = $_POST['trabajo'];
        $estado = 'Activo';
    }else{
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }
    
    

    /*Encriptado de Contraseña*/

    $queryinsert = "INSERT INTO trabajadores(cedula, Nombre, Apellido, Puesto_trabajo, Estado) VALUES ('$cedulaform','$nombreform', '$apellidoform', '$trabajoform', '$estado')";
        
    /*Verificar que no se repita el usuario*/ 
    $verify_ci = mysqli_query($conn,"SELECT * FROM trabajadores WHERE cedula = '$cedulaform'");
    
    if(mysqli_num_rows($verify_ci) > 0){
        echo '
            <script>
                alert("El trabajador ya está registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    /*Registro Exitoso o Error*/
    $ejecutarregis = mysqli_query($conn ,$queryinsert);

    if($ejecutarregis){
        echo "
            <script>
                alert('Trabajador Registrado Exitosamente');
                window.location = '../adminpage.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Ha habido un error al registrar este trabajador, vuelva a intentarlo');
                window.location = '../registrar_trabajador.php';
            </script>
        ";
    }

    mysqli_close($conn);
?>