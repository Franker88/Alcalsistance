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
	
    
    /*Proceso Eliminación*/
	$queryeliminar=mysqli_query($conn,"DELETE FROM `usuarios` WHERE `usuarios`.`id_usuario` = $idu");

    if($queryeliminar){
        echo "
            <script>
                alert('Usuario eliminado exitosamente');
                window.location = '../adminpage.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Error al eliminar usuario');
                window.location = '../adminpage.php';
            </script>
        ";
    }
	

?>