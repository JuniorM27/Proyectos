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
    <form action="./registrardetalle.php" method="post">
        <div class="contenedor">
            <div>
                <h1>Persona</h1>
                <select name="persona" id="persona" onchange="refresh()" >
                    <option value="-1">Registrar Persona</option>
                    <?php
                        $hostname = ini_get('mysqli.default_host');
                        $user = 'user';
                        $pass = '27052004';
                        $database = 'hugopino';
                        $query = "SELECT id, nombre, apellido, telefono from clientes ORDER BY nombre";
                        $conn = mysqli_connect($hostname,$user,$pass,$database);
                        $result = mysqli_query($conn,$query);
                        $resultArray = mysqli_fetch_all($result);
                        mysqli_close($conn);
                        for($i = 0; $i < count($resultArray); $i++)
                        {
                            echo '<option value='. $resultArray[$i][0] .'>'. $resultArray[$i][1] .' '. $resultArray[$i][2].' - '. $resultArray[$i][3] .'</li>';
                        }            
                    ?>
                </select>
                <div id="rpersona">
                    <label>Nombre</label><br>
                    <input type="text" name="nombre" id="nombre" max="12" required><br>
                    <label>Apellido</label><br>
                    <input type="text" name="apellido" id="apellido" max="60" required><br>
                    <label>Telefono</label><br>
                    <input type="tel" name="telefono" id="" max="10"><br>
                </div>
            </div>

            <div>
                <h1>Vehiculo</h1>
                <label>Marca</label><br>
                <input type="text" name="marca" max="255" id="" required><br>
                <label>Modelo</label><br>
                <input type="text" name="modelo" max="255" id="" required><br>
                <label>Matricula</label><br>
                <input type="text" name="matricula" max="7" id="" required><br>
            </div>

            <div>
                <h1>Detalles</h1>
                <label>Titulo</label><br>
                <input type="text" name="dtitulo" max="100" id=""><br>
                <label>Descripción</label><br>
                <textarea name="ddesc" id="" maxlength="500" cols="30" rows="10" required></textarea><br>
                <label>Precio</label><br>
                <input type="number" name="dprecio" min="1" id="" required><br><br>
            </div>
        </div>
        <div>
            <input type="submit" value="Agregar">
        </div>
    </form>
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