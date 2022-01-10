<?php
    require "partials/database.php";
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
    <?php require 'partials/links.php' ?>
    <title>Trabajadores Inactivos</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>
    <br>
    <div class="tabletitle">
        <h2 class="subtitle">Trabajadores Inactivos</h2>
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
                        if($rowt['Estado']=='Inactivo'){?>
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
    <div class="mainer botonvolver">
        <button class="mainbutton" onclick="location.href='./index.php'">
            Regresar
        </button>
    </div>
</body>
</html>


