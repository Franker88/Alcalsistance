<?php

    require "partials/consultasuser.php";
    require "partials/consultastrab.php";
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'partials/links.php'?>
    <title>Alcalsistance Administrador</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <div>
        <a class="cerrarsec" href="partials/cerrar.php">Cerrar sesión</a>
    </div>
    <br>
    <div class="mainer">
        <h1 class="pagetitle">Página del Administrador</h1>
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
                    foreach($query as $row){ ?>
                        <tr>
                            <td><?php echo $row["id_usuario"];?></td>
                            <td><?php echo $row["Nombre"];?></td>
                            <td><?php echo $row["Apellido"];?></td>
                            <td><?php echo $row["Nombre_usuario"];?></td>
                            <td><a href="partials/confirmar.php?id_usuario=<?php echo $row['id_usuario']?>"><?php if($row['Confirmado']==0){echo 'No';}else{echo 'Si';};?></a></td>
                            <td><a href="./modificar_usuario.php?id_usuario=<?php echo $row['id_usuario']?>">Modificar</a></td>
					        <td><p class="elimin" onclick="eliminar()">Eliminar</p></td>
                        </tr>
                <?php    
                    }
                ?>
            </tbody>
        </table>   
    </div>
    <div class="mainer tabler">
        <button class="mainbutton" onclick="location.href='./consultar_filtro_user.php'">
            Consultar
        </button>
    </div> 
    <div class="tabletitle">
        <h2 class="subtitle">Trabajadores Registrados</h2>
    </div>
    <div class="mainer tabler">
        <table>
            <thead>
                <tr>
                    <th scope="col">Cedula Trabajador</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Area de Trabajo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($querytrab as $rowt){ 
                        if($rowt['Estado']=='Activo'){?>
                        <tr>
                            <td><?php echo $rowt["cedula"];?></td>
                            <td><?php echo $rowt["Nombre"];?></td>
                            <td><?php echo $rowt["Apellido"];?></td>
                            <td><?php echo $rowt["Puesto_trabajo"];?></td>
                            <td><a href="partials/cambiar_estado.php?cedula=<?php echo $rowt['cedula']?>"><?php echo $rowt['Estado']?></a></td>
                            <td><a href="./modificar_trabajador.php?cedula=<?php echo $rowt['cedula']?>">Modificar</a></td>
                        </tr>
                <?php    
                        }else{}
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="mainer">
        <button class="mainbutton" onclick="agregartrab()">
            Nuevo
        </button>
        <button class="mainbutton" onclick="location.href='./inactivos.php'">
            Inactivos
        </button>
        <button class="mainbutton" onclick="location.href='./consultar_filtro_trabajadores.php'">
            Consultar
        </button>
    </div>
    <script>
        function eliminar(){
            var confirmar = confirm("¿Seguro que deseas eliminar este usuario?");
            if(confirmar){
                window.location = 'partials/eliminar_usuario.php?id_usuario=<?php echo $row['id_usuario']?>';
            }
        }

        function agregartrab(){
            var agregar = confirm("¡Precaución! Una vez registrado un trabajador no puede ser eliminado. ¿Desea Continuar?");
            if(agregar){
                window.location = './registrar_trabajador.php'
            }
        }
    </script>
</body>
</html>