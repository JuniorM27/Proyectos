<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Panel de Control - Historial de vehiculos - Agregar Vehiculo</title>
</head>
<body class="agregarvehiculo">
<a href="./historialdevehiculos.php" id="rgs"></a>
<div class="titulohistorialdevehiculos">
            <button onclick="ingresar('rgs')" >Regresar al panel</button>
        </div>
        <?php
        $hostname = ini_get('mysqli.default_host');
        $user = 'user';
        $pass = '27052004';
        $database = 'hugopino';
        $conn = mysqli_connect($hostname,$user,$pass,$database);
        $result = mysqli_query($conn, "SELECT id, nombre, apellido, telefono from clientes ORDER BY nombre");
        if(!is_bool($result)) $result = mysqli_fetch_all($result);
        $result2 = mysqli_query($conn, "SELECT id, marca, modelo, matricula FROM vehiculo WHERE vehiculo.id LIKE ". $_POST["editVehiculoID"]);
        if(!is_bool($result2)) $result2 = mysqli_fetch_all($result2);
        $result3 = mysqli_query($conn, "SELECT id, titulo, descripcion, precio, fecha FROM detalles WHERE detalles.id LIKE " . $_POST["editDetalleID"]);
        if(!is_bool($result3)) $result3 = mysqli_fetch_all($result3);
        mysqli_close($conn);

        if(is_bool($result) || is_bool($result3) || is_bool($result2)) { echo "Algo ha ocurrido mal."; exit();}

            echo '<form action="./modificarvehiculo.php" method="post" style="display: flex;justify-content: center;flex-direction: column;align-items: center;">';
            echo '<input type="text" name="detalleID" value="'. $_POST['editDetalleID'] .'" readonly style="display: none;">';
            echo '<div class="contenedor">';
            echo '  <div>';
            echo '      <h1>Persona</h1>';
            echo '      <select name="persona" id="persona" onchange="refresh()">';
            echo '      <option value="-1">Registrar Persona</option>';
                        for($i = 0; $i < count($result); $i++)
                        {
                            if($result[$i][0] == $_POST['editPersonaID'])
                            {
                                echo '<option value='. $result[$i][0] .' selected>'. $result[$i][1] .' '. $result[$i][2].' - '. $result[$i][3] .'</option>';
                            } else
                            echo '<option value='. $result[$i][0] .'>'. $result[$i][1] .' '. $result[$i][2].' - '. $result[$i][3] .'</option>';
                        }
            echo '        </select>';
            echo '
                    <div id="rpersona">
                        <label>Nombre</label><br>
                        <input type="text" name="nombre" id="nombre" max="12" required><br>
                        <label>Apellido</label><br>
                        <input type="text" name="apellido" id="apellido" max="60" required><br>
                        <label>Telefono</label><br>
                        <input type="tel" name="telefono" id="" max="10"><br>
                    </div>
                </div>';    

        echo '
            <div>
                <h1>Vehiculo</h1>
                <label>Marca</label><br>
                <input type="text" name="marca" max="255" id="" value="'. $result2[0][1] .'" required><br>
                <label>Modelo</label><br>
                <input type="text" name="modelo" max="255" id="" value="'. $result2[0][2] .'" required><br>
                <label>Matricula</label><br>
                <input type="text" name="matricula" max="7" id="" value="'. $result2[0][3] .'" required><br>
            </div>';

        echo '
            <div>
                <h1>Detalles</h1>
                <label>Titulo</label><br>
                <input type="text" name="dtitulo" max="100" id="" value="'. $result3[0][1] .'" ><br>
                <label>Descripción</label><br>
                <textarea name="ddesc" id="" maxlength="500" cols="30" rows="10" required>'. $result3[0][2] .'</textarea><br>
                <label>Precio</label><br>
                <input type="number" name="dprecio" min="1" id="" value="'. $result3[0][3] .'"  required><br><br>
            </div>';

        echo '</div>';
        echo '<div>';
        echo '    <input type="submit" value="Editar">';
        echo '</div>';
    echo '</form>';
    ?>
</body>
<script>
    var select = document.getElementById('persona');
    var div = document.getElementById('rpersona');
    refresh();

    function ingresar(code)
    {
        document.getElementById(code).click();
    }

    function refresh()
    {
        if(select.value != -1)
        {
            rpersona.style.display = "none";
            document.getElementById('nombre').required = false;
            document.getElementById('apellido').required = false;
        } else
        {
            rpersona.style.display = "block";
            document.getElementById('nombre').required = true;
            document.getElementById('apellido').required = true;
        }
    }
</script>
</html>