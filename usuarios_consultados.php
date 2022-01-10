<?php
    require 'partials/database.php';

    session_start();

    if(!isset($_SESSION['admin'])){
        echo '
            <script>
                alert("Debes iniciar sesión");
                window.location = "index.php";
            </script>
        ';
        session_destroy();
        die;
    }

    $nombreuserfiltro = $_POST['nombre'];
    $apellidouserfiltro = $_POST['apellido'];
    $userfiltro = $_POST['usuario'];
    if($_POST['confirmar']=='Confirmado'){
        $confirfiltro = 1;
    }elseif($_POST['confirmar']=='No Confirmado'){
        $confirfiltro = 0;
    }else{
        $confirfiltro = "";
    }

    $hacerfiltro = mysqli_query($conn,"SELECT * FROM usuarios WHERE Nombre like '%$nombreuserfiltro%' AND Apellido like '%$apellidouserfiltro%' AND Nombre_usuario like '%$userfiltro%' AND Confirmado like '%$confirfiltro%'");
    $arrayfiltro = mysqli_fetch_array($hacerfiltro);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php'?>
    <title>Alcalsistance Consulta de Usuarios</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <br>
    <div class="mainer">
        <h1 class="pagetitle">Consulta de Usuarios</h1>
    </div>
    <br>
    <div class="tabletitle">
        <h2 class="subtitle">Usuarios Registrados</h2>
    </div>
    <div class="mainer tabler">
        <table>
            <thead>
                <tr>
                    <th scope="col">Id Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Nombre Usuario</th>
                    <th scope="col">Confirmado</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($hacerfiltro as $rowfu){ ?>
                        <tr>
                            <td><?php echo $rowfu["id_usuario"];?></td>
                            <td><?php echo $rowfu["Nombre"];?></td>
                            <td><?php echo $rowfu["Apellido"];?></td>
                            <td><?php echo $rowfu["Nombre_usuario"];?></td>
                            <td><a href="partials/confirmar.php?id_usuario=<?php echo $rowfu['id_usuario']?>"><?php if($rowfu['Confirmado']==0){echo 'No';}else{echo 'Si';};?></a></td>
                            <td><a href="./modificar_usuario.php?id_usuario=<?php echo $rowfu['id_usuario']?>">Modificar</a></td>
					        <td><p class="elimin" onclick="eliminar()">Eliminar</p></td>
                        </tr>
                <?php    
                    }
                ?>

            </tbody>
            
        </table>
    </div>
    <div class="mainer">
        <button class="mainbutton" onclick="location.href='./consultar_filtro_user.php'">
            Consultar
        </button>
        <button class="mainbutton" onclick="location.href='./index.php'">
            Regresar
        </button>
        </div>    
    </div>
    <script>
        function eliminar(){
            var confirmar = confirm("¿Seguro que deseas eliminar este usuario?");
                if(confirmar){
                    window.location = 'partials/eliminar_usuario.php?id_usuario=<?php echo $rowfu['id_usuario']?>';
                }
            }
    </script>
</body>
</html>