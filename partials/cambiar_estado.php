<?php
    require "./database.php";

    if(isset($_REQUEST['cedula'])){
        $cedul=$_REQUEST['cedula'];
    }else{
        echo '
            <script>
                window.location = "../index.php";
            </script>
        ';
        exit;
    }

	

    $consultaconf=mysqli_query($conn,"SELECT * FROM trabajadores WHERE cedula=$cedul");
    $confirmacion=mysqli_fetch_array($consultaconf);
    if(isset($confirmacion['Estado'])){
        $confirmacion=$confirmacion['Estado'];
    }

    if($confirmacion=='Activo'){
        $actualizar=mysqli_query($conn,"UPDATE trabajadores SET Estado = 'Inactivo' WHERE cedula=$cedul");
        if($actualizar){
            echo "
                <script>
                    alert('Cambio de estado exitoso');
                    window.location = '../adminpage.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Error al cambiar estado, vuelva a intentarlo');
                    window.location = '../adminpage.php';
                </script>
            ";
        }
    }elseif($confirmacion=='Inactivo'){
        $actualizar=mysqli_query($conn,"UPDATE trabajadores SET Estado = 'Activo' WHERE cedula=$cedul");
        if($actualizar){
            echo "
                <script>
                    alert('Cambio de estado exitoso');
                    window.location = '../adminpage.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Error al cambiar estado, vuelva a intentarlo');
                    window.location = '../adminpage.php';
                </script>
            ";
        }
    }
?>