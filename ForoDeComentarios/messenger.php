<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: ./index.php");
} else if(isset($_POST['close']))
{
    session_destroy();
    header("Location: ./index.php");
} else
{
    $username = $_SESSION['usuario'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/styles/style.css">
    <title>FORO DE ALFREDO</title>
</head>
<body>
    <div class="container-base">
        <div class="header">
           <?php echo "<p>USUARIO: ".$username."</p>"; ?>
           <form method="POST" class="close">
            <input type="submit" name="close" value="CERRAR SESION">
            </form>
           <p id="paused">SIN PAUSA</p>
        </div>
        <div class="container">
            <div id="messages">
        </div>
        <form method="POST" class="sender">
            <textarea name="send" id="" cols="30" rows="10" required></textarea>
            <input type="submit" value="ENVIAR">
        </form>
    </div>
    </div>
</body>
<script src="./resources/js/refresh.js"></script>
<script>
    window.onpageshow = function(event) {
		if (event.persisted) {
			window.location.reload();
		}
	};
</script>
</html>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $msg = $_POST['send'];
        if(isset($msg))
        {
            $hostname = ini_get("mysqli.default_host");
            $user = "user";
            $pass = "27052004";
            $database = "foroirl";
            $conn = mysqli_connect($hostname, $user, $pass, $database);
            $forbiddenwords = mysqli_query($conn, "SELECT * FROM palabrasprohibidas");
            if(is_bool($forbiddenwords))
            {
                echo "<script>alert('No se han podido obtener las palabras prohibidas, el mensaje ha sido cancelado.'); // ". mysqli_error($conn) ."</script>";
                exit();
            }
            $forbiddenwords = mysqli_fetch_all($forbiddenwords);
            foreach($forbiddenwords as $word)
            {
                if(str_contains($msg, $word[1]))
                {
                    echo "<script>alert(`No se ha podido enviar el mensaje, el mensaje tiene una palabra prohibida: (". $word[1] .").`);</script>";
                    exit();
                }
            }
            $result = mysqli_query($conn, "CALL enviarMensaje('". $username ."', '". $msg ."');");
            if(is_bool($result))
            {
                if(!$result)
                {
                    echo "<script>alert('Algo ha salido mal.'); // ". mysqli_error($conn) ."</script>";
                }
            }
            mysqli_close($conn);
        }
    }
?>