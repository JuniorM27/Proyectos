<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Panel de Control</title>
</head>
<?php
?>
<body class="indice_body">
    <a href="./php/historialdevehiculos.php" id="hdv"></a>
    <a href="./php/listadeprecios.php" id="ldp"></a>
    <div class="indice_titulo"><img src="./img/logo.png"><h1>Hugohpino Electromecanica</h1><h2>aaa</h2></div>
    <div class="indice">
        <div>
            <label>Historial de vehiculos</label>
        </div>
        <div>
            <button onclick="ingresar('hdv')">Ingresar</button>
        </div>
        <div>
            <label>Lista de precios</label>
        </div>
        <div>
            <button onclick="ingresar('ldp')">Ingresar</button>
        </div>
    </div>
</body>
<script>
    function ingresar(code)
    {
        document.getElementById(code).click();
    }
</script>
</html>