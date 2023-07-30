<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        echo "Registrado con éxito $nombre, se pondran en contacto por su email: $email";
    } else 
    {
        header('Location: josiematonte.html');
    }


?>