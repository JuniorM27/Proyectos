<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Gestor de matriculas</title>
</head>
<body>
    <form action="./php/result.php" method="post">
    <div>
            <label>BUSCAR: </label>
            <input type="search" name="search" autocomplete="off" id="search">
    </div>
    <div>
        <label>BUSCAR POR:</label>
        <select name="searchfor" id="searchfor">
            <option value="matricula">Matricula</option>
            <option value="nombre">Nombre</option>
            <option value="apellido">Apellido</option>
            <option value="ci">CI</option>
        </select>
    </div>
    <div class="listDiv">
        <label>MATRICULAS: </label>
        <ol>
            <?php
            $hostname = ini_get('mysqli.default_host');
            $user = 'user';
            $pass = '';
            $database = 'gdm';
            $query = 'SELECT * FROM matriculas';
            $conn = mysqli_connect($hostname,$user,$pass,$database);

            $result = mysqli_query($conn,$query);
            $resultArray = mysqli_fetch_all($result);
            for($i = 0; $i < count($resultArray); $i++)
            {
                echo '<li onclick="listrefresh(`'. $resultArray[$i][1] .'`)">'. $resultArray[$i][1] .'</li>';
            }
            mysqli_close($conn);
            ?>
        </ol>
    </div>
        <input type="submit" style="display: none;" id="submit">
    </form>
</body>
<script>
function listrefresh(v)
{
    let prv = document.getElementById('search').value; 
    let sv = document.getElementById('searchfor').value; 
    document.getElementById('search').value = v; 
    document.getElementById('searchfor').value = 'matricula';
    document.getElementById('submit').click(); 
    document.getElementById('searchfor').value = sv;
    document.getElementById('search').value= prv
}
</script>
</html>