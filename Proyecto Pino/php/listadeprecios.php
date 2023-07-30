<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Panel de Control - Lista de precios</title>
</head>
<body class="historialdevehiculos">
    <nav>
    <a href="../index.php" id="rgs"></a>
    <a href="./agregarproducto.php" id="agp"></a>
        <div class="titulohistorialdevehiculos">
            <button onclick="ingresar('rgs')" >Regresar al panel</button>
            <h1>Lista de precios</h1>
            <button onclick="ingresar('agp')" >Agregar producto</button>
        </div>
        <div>
            <form action="" method="post">
                <label>Buscar: </label>
                <input type="text" name="search" id="">
                <label >Por: </label>
                <select name="searchfor" id="">
                    <option value="codigo">Codigo</option>
                    <option value="producto">Producto</option>
                    <option value="precioc">Precio Compra</option>
                    <option value="preciov">Precio Venta</option>
                </select>
                <label>Orden: </label>
                <select name="order" id="">
                    <option value="ASC">Ascendente</option>
                    <option value="DESC">Descendente</option>
                </select>
                <label>Limite: </label>
                <select name="limit" id="">
                    <option value="-1">¡Sin Limite!</option>
                    <option value="5">5</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                </select>
            </form>
        </div>
    </nav>
    <form action="./editarproducto.php" method="post" style="display: none;">
    <input type="text" name="editProductID" id="editID">
    <input type="submit" id="edit">
    </form>
    <form action="./eliminarproducto.php" method="post" style="display: none;">
    <input type="text" name="deleteProductID" id="deleteField">
    <input type="submit" id="delete">
    </form>
    <div class="cartelDescripciones" id="cartelDescripciones">

    </div>
    <table class="resultado">
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $hostname = ini_get('mysqli.default_host');
            $user = 'user';
            $pass = '27052004';
            $database = 'hugopino';
            $order = $_POST['order'];
            $limit = $_POST['limit'];
            if(isset($_POST['search']))
            {
                $val = $_POST['search'];
            } else
            {
                echo 'Oops! Algo ha salido mal. ponte en contacto con un supervisor.';
                exit();
            }
            switch($_POST['searchfor'])
            {
                case "codigo":
                    $query = 'SELECT producto.codigo as Code, producto.nombre as "Nombre de producto", producto.descripcion as "Descripción de producto", producto.costo as "Precio Compra", producto.precio as "Precio Venta" FROM producto WHERE producto.codigo LIKE "%'. $val.'%" ORDER BY "Nombre de producto" '. $order;
                    break;
                case "producto":
                    $query = 'SELECT producto.codigo as Code, producto.nombre as "Nombre de producto", producto.descripcion as "Descripción de producto", producto.costo as "Precio Compra", producto.precio as "Precio Venta" FROM producto WHERE producto.nombre LIKE "%'. $val.'%" ORDER BY "Nombre de producto" '. $order;
                    break;
                case "precioc":
                    $query = 'SELECT producto.codigo as Code, producto.nombre as "Nombre de producto", producto.descripcion as "Descripción de producto", producto.costo as "Precio Compra", producto.precio as "Precio Venta" FROM producto WHERE costo LIKE "'. $val.'" ORDER BY "Nombre de producto" '. $order;
                    break;
                case "preciov":
                    $query = 'SELECT producto.codigo as Code, producto.nombre as "Nombre de producto", producto.descripcion as "Descripción de producto", producto.costo as "Precio Compra", producto.precio as "Precio Venta" FROM producto WHERE Precio LIKE "'. $val.'" ORDER BY "Nombre de producto" '. $order;
                    break;
            }
            if($limit == -1)
            {
                $query = $query.';';
            } else
            {
                $query = $query.' LIMIT '. $limit. ';';
            }
            $conn = mysqli_connect($hostname,$user,$pass,$database);
            $result = mysqli_query($conn,$query);
            echo '<script>console.error("'.mysqli_error($conn).'");'.'console.log("'.$query.'");'.'</script>';
            mysqli_close($conn);
            if(!is_bool($result))
            {
                $columns = mysqli_fetch_fields($result);
                $resultArray = mysqli_fetch_all($result);
                if(count($resultArray) > 0)
                {
                    echo '<tr>';
                    for($i = 0; $i < count($columns)+2; $i++)
                    {
                        if(count($columns) == $i)
                        {
                            echo "<th class='head'> Editar </th>";
                        } else
                        if(count($columns)+1 == $i)
                        {
                            echo "<th class='head'> Eliminar </th>";
                        } else
                        if(is_object($columns[$i]))
                        {
                            $Vars = get_object_vars($columns[$i]);
                            echo "<th class='head'> ".$Vars['name']. " </th>";
                        }
                    }
                    echo '</tr>';
                    for($j = 0; $j < count($resultArray); $j++)
                    {
                        echo "<tr>";
                        for($i = 0; $i < count($columns)+2; $i++)
                        {
                            if(count($columns) == $i)
                            {
                                echo "<td><button onclick='editar(`". $resultArray[$j][0] ."`)'>Editar</td>";
                            } else
                            if(count($columns)+1 == $i)
                            {
                                echo "<td><button onclick='eliminar(`". $resultArray[$j][0] ."`)'>Eliminar</td>";
                            } else    
                            if($i == 4 || $i == 3)
                            {
                                if(is_array($resultArray[$j]))
                                {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j][$i]."$ </td>";
                                } else
                                {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j]."$ </td>";
                                }    
                            } else {
                            if(is_array($resultArray[$j]))
                            {
                                if(empty($resultArray[$j][$i]))
                                {
                                    if($i < count($columns))
                                    echo "<td> Sin dato. </td>";
                                } else
                                {
                                    if($i < count($columns))
                                    echo "<td>". $resultArray[$j][$i]." </td>";
                                }
                            } else
                            {
                                if(empty($resultArray[$j]))
                                {
                                    if($i < count($columns))
                                    echo "<td> Sin dato. </td>";
                                } else
                                {
                                    if($i < count($columns))
                                    echo "<td>". $resultArray[$j]." </td>";
                                }
                            }
                        }
                        }
                        echo "</tr>";
                    }        
                } else
                {
                    echo '<h1>No se han encontrado datos.</h1>';
                }
            } else
            {
                echo 'Oops! Algo ha salido mal. ponte en contacto con un supervisor.';
                exit();
            }
        } else
        {
            $hostname = ini_get('mysqli.default_host');
            $user = 'user';
            $pass = '27052004';
            $database = 'hugopino';
            $query = 'SELECT producto.codigo as Code, producto.nombre as "Nombre de producto", producto.descripcion as "Descripción de producto", producto.costo as "Precio Compra", producto.precio as "Precio Venta" FROM producto;';
            $conn = mysqli_connect($hostname,$user,$pass,$database);
            $result = mysqli_query($conn,$query);
            mysqli_close($conn);
            if(!is_bool($result))
            {
                $columns = mysqli_fetch_fields($result);
                $resultArray = mysqli_fetch_all($result);
                if(count($resultArray) > 0)
                {
                    echo '<tr>';
                    for($i = 0; $i < count($columns)+2; $i++)
                    {
                        if(count($columns) == $i)
                        {
                            echo "<th class='head'> Editar </th>";
                        } else
                        if(count($columns)+1 == $i)
                        {
                            echo "<th class='head'> Eliminar </th>";
                        } else
                        if(is_object($columns[$i]))
                        {
                            $Vars = get_object_vars($columns[$i]);
                            echo "<th class='head'> ".$Vars['name']. " </th>";
                        }
                    }
                    echo '</tr>';
                    for($j = 0; $j < count($resultArray); $j++)
                    {
                        echo "<tr>";
                        for($i = 0; $i < count($columns)+2; $i++)
                        {
                            if(count($columns) == $i)
                            {
                                echo "<td><button onclick='editar(`". $resultArray[$j][0] ."`)'>Editar</td>";
                            } else
                            if(count($columns)+1 == $i)
                            {
                                echo "<td><button onclick='eliminar(`". $resultArray[$j][0] ."`)'>Eliminar</td>";
                            } else    
                            if($i == 4 || $i == 3)
                            {
                                if(is_array($resultArray[$j]))
                                {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j][$i]."$ </td>";
                                } else
                                {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j]."$ </td>";
                                }    
                            } else {
                            if(is_array($resultArray[$j]))
                            {
                                if(empty($resultArray[$j][$i]))
                                {
                                    if($i < count($columns))
                                    echo "<td> Sin dato. </td>";
                                } else
                                {
                                    if($i < count($columns))
                                    echo "<td>". $resultArray[$j][$i]." </td>";
                                }
                            } else
                            {
                                if(empty($resultArray[$j]))
                                {
                                    if($i < count($columns))
                                    echo "<td> Sin dato. </td>";
                                } else
                                {
                                    if($i < count($columns))
                                    echo "<td>". $resultArray[$j]." </td>";
                                }
                            }
                        }
                        }
                        echo "</tr>";
                    } 
                } else
                {
                    echo '<h1>No se han encontrado datos.</h1>';
                }
            } else
            {
                echo 'Oops! Algo ha salido mal. ponte en contacto con un supervisor.';
                exit();
            }        
        }
        ?>
    </table>
</body>
<script>
    var cartel = document.getElementById('cartelDescripciones');
    function ingresar(code)
    {
        document.getElementById(code).click();
    }

    function editar(code)
    {
        document.getElementById('editID').value = code;
        document.getElementById('edit').click();
    }

    function eliminar(code)
    {
        document.getElementById('deleteField').value = code;
        document.getElementById('delete').click();
    }

    function centrar()
    {
        var ventana = window.scrollY;
        cartel.style.top = (ventana + (document.documentElement.clientHeight / 2.5)) + "px";
        console.log((ventana + (document.documentElement.clientHeight / 2.5)) + "px");
    }
    function show(text)
    {
        centrar();
        cartel.innerHTML = text;
        cartel.style.display = "block";
    }
    function hide()
    {
        cartel.style.display = "none";
    }

    window.onpageshow = function(event) {
		if (event.persisted) {
			window.location.reload();
		}
	};
</script>
</html>