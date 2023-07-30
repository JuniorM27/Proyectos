<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>File Encoder</title>
</head>
<body>
    <div>
    <form action="encode.php" method="post" enctype="multipart/form-data" class="UploaderForm" >
        <textarea name="codigo" class="codigo"></textarea>
        <br>
        <select name="cifrado">
            <option value="1">Cifrar</option>
            <option value="2">Descifrar</option>
            <option value="3">Descifrar y Correr</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Encriptar 🔐">
    </form>
</div>

</body>
</html>