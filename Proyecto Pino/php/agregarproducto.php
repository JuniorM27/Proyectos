<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Panel de Control - Lista de precios - Agregar Producto</title>
</head>
<body class="agregarvehiculo">
<a href="./listadeprecios.php" id="rgs"></a>
<div class="titulohistorialdevehiculos">
            <button onclick="ingresar('rgs')" >Regresar al panel</button>
        </div>
    <form action="./registrarproducto.php" method="post">
    <input type="text" name="tipodedetalle" id="nombre" max="12" style="display: none;" value="producto">
        <div class="contenedor">
            <div>
                <h1>Producto</h1>
                <label>Codigo</label><br>
                <input type="text" name="codigo" max="20" id="" required><br>
                <label>Titulo</label><br>
                <input type="text" name="titulo" max="100" id="" required><br>
                <label>Descripción</label><br>
                <textarea name="desc" id="" maxlength="500" cols="30" rows="10"></textarea><br>
                <label>Precio Compra</label><br>
                <input type="number" name="precioc" min="1" id="" required><br><br>
                <label>Precio Venta</label><br>
                <input type="number" name="preciov" min="1" id="" required><br><br>
            </div>
            <div>
            <input type="submit" value="Agregar">
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