<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
            $hostname = ini_get('mysqli.default_host');
            $user = 'user';
            $pass = '27052004';
            $database = 'hugopino';
            $conn = mysqli_connect($hostname,$user,$pass,$database);

            $code = $_POST['deleteProductID'];
            $query = 'DELETE FROM producto WHERE codigo LIKE "'.$code.'"';
            $result = mysqli_query($conn, $query);
            if($result == false)
            {
                echo 'Oops! Algo ha salido mal al eliminar el producto.';
                echo '<script>console.error("'.mysqli_error($conn).'");'.'console.log("'.$query.'");'.'</script>';
            } else
            {
                echo 'Producto <b>'.$code. '</b> se ha eliminado con éxito.';
            }
            mysqli_close($conn);
    }
?>