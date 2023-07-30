<?php
    $hostname = ini_get("mysqli.default_host");
    $user = "user";
    $pass = "27052004";
    $database = "foroirl";
    $conn = mysqli_connect($hostname, $user, $pass, $database);
    $result = mysqli_query($conn,"SELECT usuarios.nombre as 'USUARIO', mensajes.mensaje as 'MENSAJE' FROM mensajes INNER JOIN usuarios ON usuarios.id = mensajes.usuario ORDER BY mensajes.id DESC");
    if(!is_bool($result))
    {
    $data = mysqli_fetch_all($result);
    $head = mysqli_fetch_fields($result);
    mysqli_close($conn);

    echo "<div class='allmessages'>";
    echo "<table>";
    foreach($data as $msg)
    {
        echo "<tr>";
        echo "<td class='user'> ".$msg[0]. ": </td>";
        echo "<td class='message'> ".$msg[1]. " </td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    } else
    {
        echo "Algo ha salido mal, no se ha podido obtener los mensajes del foro desde la base de datos.";
    }
?>
