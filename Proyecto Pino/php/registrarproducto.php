<?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $hostname = ini_get('mysqli.default_host');
            $user = 'user';
            $pass = '27052004';
            $database = 'hugopino';
            $conn = mysqli_connect($hostname,$user,$pass,$database);

            $titulo = $_POST['titulo'];
            $code = $_POST['codigo'];
            $query = 'SELECT codigo FROM producto WHERE codigo LIKE "'. $code .'"';
            $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_all($result);
            if(count($result) != 0)
            {
                echo 'Oops! Algo ha salido mal al registrar el producto.';
                echo '<br>El codigo del producto ya se encuentra registrado, si no es así ponte en contacto con un supervisor.';
                exit();
            }

            $desc = $_POST['desc'];
            if(empty($desc))
            {
                $desc = "Sin descripción";
            }

            $precioc = $_POST['precioc'];
            $preciov = $_POST['preciov'];
            $query = 'INSERT INTO producto (codigo, nombre, descripcion, costo, precio) VALUES ("'.$code.'","'.$titulo.'","'.$desc.'",'. $precioc.','. $preciov.')';
            $result = mysqli_query($conn,$query);
            if(is_bool($result))
            {
                if($result == true)
                {
                    echo "<div class='factura'>";
                    $query = 'SELECT codigo, nombre, descripcion, costo, precio FROM producto WHERE codigo LIKE "'. $code .'" ORDER BY producto.codigo DESC LIMIT 1';
                    $result = mysqli_query($conn,$query);
                    $result = mysqli_fetch_all($result);
                    echo "Codigo: " . $result[0][0];
                    echo "<br>Titulo: " . $result[0][1];
                    echo "<br>Descripción: " . $result[0][2];
                    echo "<br>Precio Compra: " . $result[0][3]."$";
                    echo "<br>Precio Venta: " . $result[0][4]."$";
                    echo "</div>";
                } else
                {
                    echo 'Oops! Algo ha salido mal al registrar el producto. ponte en contacto con un supervisor.';
                    echo '<script>console.error("'.mysqli_error($conn).'");'.'console.log("'.$query.'");'.'</script>';
                    exit();
                }
            }
            mysqli_close($conn);
        }
?>
