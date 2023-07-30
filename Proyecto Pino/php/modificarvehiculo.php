<?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $hostname = ini_get('mysqli.default_host');
            $user = 'user';
            $pass = '27052004';
            $database = 'hugopino';
            $conn = mysqli_connect($hostname,$user,$pass,$database);
            $persona = $_POST['persona'];
            if($persona == -1)
            {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                if(isset($_POST['telefono'])) $telefono = $_POST['telefono'];
                $query = 'INSERT INTO clientes (nombre, apellido, telefono) VALUES ("'.$nombre.'","'.$apellido.'","'.$telefono.'")';
                $result = mysqli_query($conn,$query);
                if($result == true)
                {
                    $query = 'SELECT id, nombre, apellido FROM clientes WHERE nombre LIKE "'.$nombre.'" AND apellido LIKE "'.$apellido.'" AND telefono LIKE "'.$telefono.'"';
                    $persona = mysqli_query($conn, $query);
                    $persona = mysqli_fetch_all($persona);
                } else
                {
                    echo 'Oops! Algo ha salido mal al registrar el cliente. ponte en contacto con un supervisor.';
                    echo '<script>console.error("'.mysqli_error($conn).'");'.'console.log("'.$query.'");'.'</script>';
                    exit();
                }
            } else 
            {
                $query = 'SELECT id, nombre, apellido FROM clientes WHERE id LIKE "'.$persona.'"';
                $persona = mysqli_query($conn, $query);
                $persona = mysqli_fetch_all($persona);
            }

            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $matricula = $_POST['matricula'];

            $query = 'SELECT id, marca, modelo FROM vehiculo WHERE matricula LIKE "' .$matricula.'"';
            $result = mysqli_query($conn, $query);
            $resultArray = mysqli_fetch_all($result);
            $count = count($resultArray);
            if($count != 0)
            {
                $marca = $resultArray[0][1];
                $modelo = $resultArray[0][2];
                $vehiculo = $resultArray;
            } else
            {
                $query = 'INSERT INTO vehiculo (marca, modelo, matricula) VALUES ("'.$marca.'","'.$modelo.'","'.$matricula.'")';
                $result2 = mysqli_query($conn,$query);
                if($result2 == true)
                {
                    $query = 'SELECT id FROM vehiculo WHERE matricula LIKE "'.$matricula.'"';
                    $vehiculo2 = mysqli_query($conn, $query);
                    if(!is_bool($vehiculo2))
                    {
                        $vehiculo = mysqli_fetch_all($vehiculo2);
                    }
                } else
                {
                    echo 'Oops! Algo ha salido mal al registrar el vehiculo. ponte en contacto con un supervisor.';
                    echo '<script>console.error("'.mysqli_error($conn).'");'.'console.log("'.$query.'");'.'</script>';
                    exit();
                }
            }
            if(isset($_POST['dtitulo'])) 
            {
                if(!empty($_POST['dtitulo'])) 
                {
                    $titulo = $_POST['dtitulo']; 
                } else $titulo = "SIN TITULO";
            } else $titulo = "SIN TITULO";
            $desc = $_POST['ddesc'];
            $fecha = 'CONCAT(CURRENT_DATE, " ", CURRENT_TIME)';
            $precio = $_POST['dprecio'];
            $query = 'UPDATE detalles set titulo = "'.$titulo.'", descripcion = "'.$desc.'", fecha = '.$fecha.', precio = '. $precio .', cliente = '.$persona[0][0].', vehiculo = '.$vehiculo[0][0].' WHERE detalles.id LIKE ' . $_POST["detalleID"];
            $result = mysqli_query($conn,$query);
            if(is_bool($result))
            {
                if($result == true)
                {
                    echo "<div class='factura'>";
                    $query = 'SELECT titulo, descripcion,fecha, precio FROM detalles WHERE Titulo LIKE "'.$titulo.'" AND descripcion LIKE "'. $desc .'" AND precio LIKE "'.$precio.'" AND cliente LIKE "'. $persona[0][0].'" AND vehiculo LIKE "'. $vehiculo[0][0] .'" ORDER BY detalles.fecha DESC LIMIT 1';
                    $result = mysqli_query($conn,$query);
                    $result = mysqli_fetch_all($result);
                    echo "Titulo: " . $result[0][0];
                    echo "<br>Descripción: " . $result[0][1];
                    echo "<br>Fecha: ". $result[0][2];
                    echo "<br>Precio: " . $result[0][3]."$";
                    echo "<br>Cliente: " . $persona[0][1] . " " . $persona[0][2];
                    echo "<br>Vehiculo: " . $marca. " " . $modelo . " " . $matricula;
                    echo "</div>";
                } else
                {
                    echo 'Oops! Algo ha salido mal al actualizar el detalle. ponte en contacto con un supervisor.';
                    echo '<script>console.error("'.mysqli_error($conn).'");'.'console.log("'.$query.'");'.'</script>';
                    exit();
                }
            }
            mysqli_close($conn);
        }
?>
