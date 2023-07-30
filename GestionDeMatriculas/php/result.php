<style>
    body
    {
        text-align: center;
        justify-content: center;
        align-items: center;
        vertical-align: middle;
        font-size: auto;
        height: 100vh;
        user-select: none;
        display: flex;
        flex-wrap: wrap;
        margin-left: 5vh;
        margin-right: 5vh;
        margin-bottom: 5vh;
    }
    div
    {
        border: 1px solid gray;
        background-color: lightgray;
    }
    p
    {
        padding-left: 5px;
        padding-right: 5px;
    }
    .head
    {
        background-color: khaki;
    }
</style>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $hostname = ini_get('mysqli.default_host');
        $user = 'user';
        $pass = '';
        $database = 'gdm';
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
                $query = 'SELECT empleados.nombre, empleados.apellido, empleados.telefono, empleados.CI, matriculas.matricula FROM empleados LEFT JOIN matriculas ON empleados.vehiculo = matriculas.ID where vehiculo LIKE matriculas.ID AND matriculas.matricula LIKE "%'. $val .'%"';
                break;
            case "nombre":
                $query = 'SELECT empleados.nombre, empleados.apellido, empleados.telefono, empleados.CI, matriculas.matricula FROM empleados LEFT JOIN matriculas ON empleados.vehiculo = matriculas.ID WHERE empleados.nombre LIKE "%'. $val .'%"';
                break;
            case "apellido":
                $query = 'SELECT empleados.nombre, empleados.apellido, empleados.telefono, empleados.CI, matriculas.matricula FROM empleados LEFT JOIN matriculas ON empleados.vehiculo = matriculas.ID WHERE empleados.apellido LIKE "%'. $val .'%"';
                break;
            case "ci":
                $query = 'SELECT empleados.nombre, empleados.apellido, empleados.telefono, empleados.CI, matriculas.matricula FROM empleados LEFT JOIN matriculas ON empleados.vehiculo = matriculas.ID WHERE empleados.ci LIKE "%'. $val .'%"';
                break;
        }
        $conn = mysqli_connect($hostname,$user,$pass,$database);
        $result = mysqli_query($conn,$query);
        if(!is_bool($result))
        {
            $columns = mysqli_fetch_fields($result);
            $resultArray = mysqli_fetch_all($result);
            if(count($resultArray) > 0)
            {
                for($i = 0; $i < count($columns); $i++)
                {
                    echo '<div>';
                    if(is_object($columns[$i]))
                    {
                        $Vars = get_object_vars($columns[$i]);
                        echo "<p class='head'> ".$Vars['name']. " </p><br>";
                    }
                    for($j = 0; $j < count($resultArray); $j++)
                    {
                        if(is_array($resultArray[$j]))
                        {
                            if($i < count($columns))
                            echo "<hr><p>". $resultArray[$j][$i]." </p><br>";
                        } else
                        {
                            echo "<hr><p>". $resultArray[$j]." </p><br>";
                        }
                    }
                    echo '</div>';
                }        
            } else
            {
                echo '<h1>No se han encontrado datos.</h1>';
            }
        }
        mysqli_close($conn);
    }
?>