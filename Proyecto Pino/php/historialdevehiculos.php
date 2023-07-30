<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Panel de Control - Historial de vehiculos</title>
</head>
<body class="historialdevehiculos">
    <nav>
    <a href="../index.php" id="rgs"></a>
    <a href="./agregarvehiculo.php" id="agv"></a>
        <div class="titulohistorialdevehiculos">
            <button onclick="ingresar('rgs')" >Regresar al panel</button>
            <h1>Historial de vehiculos</h1>
            <button onclick="ingresar('agv')" >Agregar Vehiculo al historial</button>
        </div>
        <div>
            <form action="" method="post">
                <label>Buscar: </label>
                <input type="text" name="search" id="">
                <label >Por: </label>
                <select name="searchfor" id="">
                    <option value="matricula">Matricula</option>
                    <option value="marca">Marca</option>
                    <option value="modelo">Modelo</option>
                    <option value="nombre">Nombre</option>
                    <option value="apellido">Apellido</option>
                    <option value="telefono">Telefono</option>
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
    <div class="cartelDescripciones" id="cartelDescripciones">

    </div>
    <form action="./editarvehiculo.php" method="post" style="display: none;">
    <input type="text" name="editDetalleID" id="editDID">
    <input type="text" name="editPersonaID" id="editPID">
    <input type="text" name="editVehiculoID" id="editVID">
    <input type="submit" id="edit">
    </form>
    <form action="./eliminarvehiculo.php" method="post" style="display: none;">
    <input type="text" name="deleteDetalleID" id="deleteField">
    <input type="submit" id="delete">
    </form>

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
                case "matricula":
                    $query = 'SELECT detalles.titulo as Titulo, detalles.descripcion as Descripción, CONCAT(UPPER(SUBSTRING(nombre,1,1)), LOWER(SUBSTRING(nombre,2,LENGTH(nombre))), " ", UPPER(SUBSTRING(apellido,1,1)), LOWER(SUBSTRING(apellido,2,LENGTH(apellido)))) as Cliente, clientes.telefono as Telefono,CONCAT(vehiculo.marca, " ", vehiculo.modelo) as Vehiculo, vehiculo.matricula as Matricula, detalles.fecha as "Fecha de registro", detalles.precio as Precio, detalles.id, vehiculo.id, clientes.id from detalles INNER JOIN clientes ON detalles.cliente = clientes.id INNER JOIN vehiculo ON vehiculo.id = detalles.vehiculo WHERE vehiculo.matricula LIKE "%'. $val .'%" ORDER BY detalles.titulo '. $order;
                    break;
                case "marca":
                    $query = 'SELECT detalles.titulo as Titulo, detalles.descripcion as Descripción,CONCAT(UPPER(SUBSTRING(nombre,1,1)), LOWER(SUBSTRING(nombre,2,LENGTH(nombre))), " ", UPPER(SUBSTRING(apellido,1,1)), LOWER(SUBSTRING(apellido,2,LENGTH(apellido)))) as Cliente, clientes.telefono as Telefono,CONCAT(vehiculo.marca, " ", vehiculo.modelo) as Vehiculo, vehiculo.matricula as Matricula, detalles.fecha as "Fecha de registro", detalles.precio as Precio, detalles.id, vehiculo.id, clientes.id from detalles INNER JOIN clientes ON detalles.cliente = clientes.id INNER JOIN vehiculo ON vehiculo.id = detalles.vehiculo WHERE vehiculo.marca LIKE "%'. $val .'%" ORDER BY detalles.titulo '. $order;
                    break;
                case "modelo":
                    $query = 'SELECT detalles.titulo as Titulo, detalles.descripcion as Descripción,CONCAT(UPPER(SUBSTRING(nombre,1,1)), LOWER(SUBSTRING(nombre,2,LENGTH(nombre))), " ", UPPER(SUBSTRING(apellido,1,1)), LOWER(SUBSTRING(apellido,2,LENGTH(apellido)))) as Cliente, clientes.telefono as Telefono,CONCAT(vehiculo.marca, " ", vehiculo.modelo) as Vehiculo, vehiculo.matricula as Matricula, detalles.fecha as "Fecha de registro", detalles.precio as Precio, detalles.id, vehiculo.id, clientes.id from detalles INNER JOIN clientes ON detalles.cliente = clientes.id INNER JOIN vehiculo ON vehiculo.id = detalles.vehiculo WHERE vehiculo.modelo LIKE "%'. $val .'%" ORDER BY detalles.titulo '. $order;
                    break;
                case "nombre":
                    $query = 'SELECT detalles.titulo as Titulo, detalles.descripcion as Descripción,CONCAT(UPPER(SUBSTRING(nombre,1,1)), LOWER(SUBSTRING(nombre,2,LENGTH(nombre))), " ", UPPER(SUBSTRING(apellido,1,1)), LOWER(SUBSTRING(apellido,2,LENGTH(apellido)))) as Cliente, clientes.telefono as Telefono,CONCAT(vehiculo.marca, " ", vehiculo.modelo) as Vehiculo, vehiculo.matricula as Matricula, detalles.fecha as "Fecha de registro", detalles.precio as Precio, detalles.id, vehiculo.id, clientes.id from detalles INNER JOIN clientes ON detalles.cliente = clientes.id INNER JOIN vehiculo ON vehiculo.id = detalles.vehiculo WHERE clientes.nombre LIKE "%'. $val .'%" ORDER BY detalles.titulo '. $order;
                    break;
                case "apellido":
                    $query = 'SELECT detalles.titulo as Titulo, detalles.descripcion as Descripción,CONCAT(UPPER(SUBSTRING(nombre,1,1)), LOWER(SUBSTRING(nombre,2,LENGTH(nombre))), " ", UPPER(SUBSTRING(apellido,1,1)), LOWER(SUBSTRING(apellido,2,LENGTH(apellido)))) as Cliente, clientes.telefono as Telefono,CONCAT(vehiculo.marca, " ", vehiculo.modelo) as Vehiculo, vehiculo.matricula as Matricula, detalles.fecha as "Fecha de registro", detalles.precio as Precio, detalles.id, vehiculo.id, clientes.id from detalles INNER JOIN clientes ON detalles.cliente = clientes.id INNER JOIN vehiculo ON vehiculo.id = detalles.vehiculo WHERE clientes.apellido LIKE "%'. $val .'%" ORDER BY detalles.titulo '. $order;
                    break;
                case "telefono":
                    $query = 'SELECT detalles.titulo as Titulo, detalles.descripcion as Descripción,CONCAT(UPPER(SUBSTRING(nombre,1,1)), LOWER(SUBSTRING(nombre,2,LENGTH(nombre))), " ", UPPER(SUBSTRING(apellido,1,1)), LOWER(SUBSTRING(apellido,2,LENGTH(apellido)))) as Cliente, clientes.telefono as Telefono,CONCAT(vehiculo.marca, " ", vehiculo.modelo) as Vehiculo, vehiculo.matricula as Matricula, detalles.fecha as "Fecha de registro", detalles.precio as Precio, detalles.id, vehiculo.id, clientes.id from detalles INNER JOIN clientes ON detalles.cliente = clientes.id INNER JOIN vehiculo ON vehiculo.id = detalles.vehiculo WHERE clientes.telefono LIKE "%'. $val .'%" ORDER BY detalles.titulo '. $order;
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
                        switch($i)
                        {
                            case count($columns):
                                echo "<th class='head'> Editar </th>";
                                break;
                            case count($columns)+1:
                                echo "<th class='head'> Eliminar </th>";
                                break;
                            case 8:
                                break;
                            case 9:
                                break;
                            case 10:
                                break;

                            default:
                                if(is_object($columns[$i]))
                                {
                                    $Vars = get_object_vars($columns[$i]);
                                    echo "<th class='head'> ".$Vars['name']. " </th>";
                                }    
                                break;
                        }
                    }
                    echo '</tr>';
                    for($j = 0; $j < count($resultArray); $j++)
                    {
                        echo "<tr>";
                        for($i = 0; $i < count($columns)+2; $i++)
                        {
                            switch($i)
                            {
                                case 1:
                                    if(is_array($resultArray[$j]))
                                    {
                                        if($i < count($columns))
                                        echo "<td><p><a onmouseleave='hide()' onmouseover='show(`".$resultArray[$j][$i] ."`)'>Mostrar Descripción</p></a></td>";
                                    } else
                                    {
                                        echo "<td><p><a onmouseleave='hide()' onmouseover='show(`".$resultArray[$j][$i] ."`)'>Mostrar Descripción</p></a></td>";
                                    }    
                                    break;
                                case 7:
                                    if(is_array($resultArray[$j]))
                                    {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j][$i]."$ </td>";
                                    } else
                                    {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j]."$ </td>";
                                    }
                                    break;
                                case count($columns):
                                    echo "<td><button onclick='editar(`". $resultArray[$j][8] ."`,`". $resultArray[$j][9] ."`,`". $resultArray[$j][10] ."`)'>Editar</td>";
                                    break;
                                case count($columns)+1:
                                    echo "<td><button onclick='eliminar(`". $resultArray[$j][8] ."`)'>Eliminar</td>";
                                    break;
                                case 8:
                                    break;
                                case 9:
                                    break;
                                case 10:
                                    break;
                                default:
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
                                    break;
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
            $query = 'SELECT detalles.titulo as Titulo, detalles.descripcion as Descripción, CONCAT(UPPER(SUBSTRING(nombre,1,1)), LOWER(SUBSTRING(nombre,2,LENGTH(nombre))), " ", UPPER(SUBSTRING(apellido,1,1)), LOWER(SUBSTRING(apellido,2,LENGTH(apellido)))) as Cliente, clientes.telefono as Telefono,CONCAT(vehiculo.marca, " ", vehiculo.modelo) as Vehiculo, vehiculo.matricula as Matricula, detalles.fecha as "Fecha de registro", detalles.precio as Precio, detalles.id, vehiculo.id, clientes.id  from detalles INNER JOIN clientes ON detalles.cliente = clientes.id INNER JOIN vehiculo ON vehiculo.id = detalles.vehiculo';
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
                        switch($i)
                        {
                            case count($columns):
                                echo "<th class='head'> Editar </th>";
                                break;
                            case count($columns)+1:
                                echo "<th class='head'> Eliminar </th>";
                                break;
                            case 8:
                                break;
                            case 9:
                                break;
                            case 10:
                                break;

                            default:
                                if(is_object($columns[$i]))
                                {
                                    $Vars = get_object_vars($columns[$i]);
                                    echo "<th class='head'> ".$Vars['name']. " </th>";
                                }    
                                break;
                        }
                    }
                    echo '</tr>';
                    for($j = 0; $j < count($resultArray); $j++)
                    {
                        echo "<tr>";
                        for($i = 0; $i < count($columns)+2; $i++)
                        {
                            switch($i)
                            {
                                case 1:
                                    if(is_array($resultArray[$j]))
                                    {
                                        if($i < count($columns))
                                        echo "<td><p><a onmouseleave='hide()' onmouseover='show(`".$resultArray[$j][$i] ."`)'>Mostrar Descripción</p></a></td>";
                                    } else
                                    {
                                        echo "<td><p><a onmouseleave='hide()' onmouseover='show(`".$resultArray[$j][$i] ."`)'>Mostrar Descripción</p></a></td>";
                                    }    
                                    break;
                                case 7:
                                    if(is_array($resultArray[$j]))
                                    {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j][$i]."$ </td>";
                                    } else
                                    {
                                        if($i < count($columns))
                                        echo "<td>". $resultArray[$j]."$ </td>";
                                    }
                                    break;
                                case count($columns):
                                    echo "<td><button onclick='editar(`". $resultArray[$j][8] ."`,`". $resultArray[$j][9] ."`,`". $resultArray[$j][10] ."`)'>Editar</td>";
                                    break;
                                case count($columns)+1:
                                    echo "<td><button onclick='eliminar(`". $resultArray[$j][8] ."`)'>Eliminar</td>";
                                    break;
                                case 8:
                                    break;
                                case 9:
                                    break;
                                case 10:
                                    break;
                                default:
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
                                    break;
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

    function editar(dID, vID, pID)
    {
        document.getElementById('editDID').value = dID;
        document.getElementById('editVID').value = vID;
        document.getElementById('editPID').value = pID;
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