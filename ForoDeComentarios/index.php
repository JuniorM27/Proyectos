<?php
session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username =  $_POST['user'];
        $password =  $_POST['password'];

        $hostname = ini_get("mysqli.default_host");
        $user = "user";
        $pass = "27052004";
        $database = "foroirl";
        $conn = mysqli_connect($hostname, $user, $pass, $database);
        $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuarios.nombre LIKE '" . $username."'");
        if(!is_bool($result))
        {
            $data = mysqli_fetch_array($result);
            
            if(!empty($data))
            {
                if($data["contraseña"] == $password)
                {
                    $_SESSION['usuario'] = $username;

                    header("Location: ./messenger.php");

                } else $error = "Contraseña incorrecta";
            } else $error = "Usuario no encontrado. " ;
        } else
        {
            if(!$result)
            $error = "<script>alert('Parece que algo ha salido mal'); </script>". mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORO DE ALFREDO - LOGIN</title>
</head>
<body>
    <form action="" method="post">
        <label for="user">USUARIO: </label>
        <input type="text" name="user" id="">
        <label for="password">CONTRASEÑA: </label>
        <input type="text" name="password" id="">
        <input type="submit" value="Loguear">
    </form>
    <?php
    if(isset($error))
    {
        echo "<div class='errormsg'>";
        echo "<p> ERROR: ". $error ."</p>";
        echo "</div>";
    }
    ?>
</body>
</html>