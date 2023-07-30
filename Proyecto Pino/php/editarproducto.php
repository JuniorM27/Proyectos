<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Panel de Control - Lista de precios - Editar Producto</title>
</head>
<body class="agregarvehiculo">
<a href="./listadeprecios.php" id="rgs"></a>
<div class="titulohistorialdevehiculos">
            <button onclick="ingresar('rgs')" >Regresar al panel</button>
        </div>
    <form action="./modificarproducto.php" method="post">
    <input type="text" name="tipodedetalle" id="nombre" max="12" style="display: none;" value="producto">
        <div class="contenedor">
            <div>
            <?php 
                $hostname = ini_get('mysqli.default_host');
                $user = 'user';
                $pass = '27052004';
                $database = 'hugopino';
                $conn = mysqli_connect($hostname,$user,$pass,$database);
                $query = "SELECT * FROM producto WHERE codigo LIKE '" . $_POST['editProductID'] . "'";
                $result = mysqli_query($conn,$query);
                if(!is_bool($result))
                {
                    $result = mysqli_fetch_all($result);

                    echo "<h1>Producto</h1>";
                    echo "<label>Codigo</label><br>";
                    echo '<input type="text" name="codigo" max="20" id="" value="'. $result[0][0] .'" required readonly><br>';
                    echo "<label>Titulo</label><br>";
                    echo '<input type="text" name="titulo" max="100" id="" value="'. $result[0][1] .'" required><br>';
                    echo "<label>Descripción</label><br>";
                    echo '<textarea name="desc" id="" maxlength="500" cols="30" rows="10">'.$result[0][2].'</textarea><br>';
                    echo "<label>Precio Compra</label><br>";
                    echo '<input type="number" name="precioc" min="1" id="" value="'. $result[0][3] .'" required><br><br>';
                    echo "<label>Precio Venta</label><br>";
                    echo '<input type="number" name="preciov" min="1" id="" value="'. $result[0][4] .'" required><br><br>';
                    echo '<div>';
                    echo '<input type="submit" value="Editar">';
                    echo '</div>';
                } else
                {
                    echo "<h1>Producto</h1>";
                    echo 'Oops! Algo ha salido mal. ponte en contacto con un supervisor.';
                }
?>
        </div>
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