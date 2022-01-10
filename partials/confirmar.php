<?php
    require "./database.php";

    
	if(isset($_REQUEST['id_usuario'])){
        $idu=$_REQUEST['id_usuario'];
    }else{
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }

    $consultaconf=mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuario=$idu");
    $confirmacion=mysqli_fetch_array($consultaconf);
    if(isset($confirmacion['Confirmado'])){
        $confirmacion=$confirmacion['Confirmado'];
    }

    if($confirmacion==0){
        $actualizar=mysqli_query($conn,"UPDATE usuarios SET Confirmado = 1 WHERE id_usuario=$idu");
        if($actualizar){
            echo "
                <script>
                    alert('Usuario confirmado exitosamente');
                    window.location = '../adminpage.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Problema al confirmar usuario, vuelva a intentarlo');
                    window.location = '../adminpage.php';
                </script>
            ";
        }
    }else{
        $actualizar=mysqli_query($conn,"UPDATE usuarios SET Confirmado = 0 WHERE id_usuario=$idu");
        if($actualizar){
            echo "
                <script>
                    alert('Revocación de permisos exitosa');
                    window.location = '../adminpage.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Error al revocar permisos, vuelva a intentarlo');
                    window.location = '../adminpage.php';
                </script>
            ";
        }
    }
?>