<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./resources/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./resources/styles/style2.css">
    <title>PreveSUY - Panel admin</title>
</head>
<body>
    <div class="panel">
    <div id="logo" class="logo"><img src="./resources/img/logo.png" alt="imagen de logo" id="logoimg" draggable="false"></div>
    <h1 class="titulo">Panel Administrativo</h1>
    <div class="boton_container">
        <button onclick="abrir('form_centros','flex', this)" class="boton">Agregar centros</button>
        <button onclick="abrir('form_not','flex', this)" class="boton">Agregar Noticia</button>
        <button onclick="abrir('gestor_not','flex', this)" class="boton">Gestionar noticias</button>
        <button onclick="abrir('form_dep','flex', this)" class="boton">Agregar datos de departamento</button>
        <button onclick="abrir('form_sabias','flex', this)" class="boton">Agregar sabias que</button>
        <button onclick="abrir('gestor_sabias','flex', this)" class="boton">Gestionar sabias</button>
        <button onclick="abrir('form_testimonios','flex', this)" class="boton">Agregar testimonio</button>
        <button onclick="abrir('gestor_testimonios','flex', this)" class="boton">Gestionar testimonios</button>
    </div>
    <hr>
    </div>

    <table id="gestor_not" style="display: none;">
        <?php
        $hostname = ini_get('mysqli.default_host');
        $user = 'prevesuy';
        $pass = '';
        $database = 'prevesuy';
        $conn = mysqli_connect($hostname, $user, $pass, $database);
        $query = 'SELECT * FROM noticias ORDER BY Id DESC';
        $result = mysqli_query($conn, $query);
        if (!is_bool($result)) {
            $result = mysqli_fetch_all($result);
            for ($i = 0; $i < count($result); $i++) {
                echo "<tr>";
                echo "<td>" . $result[$i][1] . " </td>";
                echo "<td> <img src='./resources/img/uploadImg/" . $result[$i][2] . "' width='30vw' height='30vh'>.</td>";
                if ($result[$i][5] == 1) echo "<td> - Fijado </td>";
                else echo "<td> - Sin fijar </td>";
                echo "<td> <button onclick='fijar(`" . $result[$i][0] . "`, `". $result[$i][5]."`)'>Fijar</button> </td>";
                echo "<td> <button onclick='del(`" . $result[$i][0] . "`)'>Eliminar</button> </td>";
                echo "</tr>";
            }
        }
        mysqli_close($conn);
        ?>
    </table>
    <br>
    <form action="" method="post" id="form_dep" enctype="multipart/form-data" style="display: none;">
        <input type="text" name="type" value="add_dep" hidden>
        <div>
        <h1>Agregar Dato departamento</h1>
        </div>
        <div>
        <label>Año: </label>
        </div>
        <div>
        <input type="number" name="año" <?php echo 'min="'.( ((int)date("Y"))-100).'"'; echo 'max="'.( ((int)date("Y"))).'"'; echo 'value="'.( ((int)date("Y"))).'"'; ?> required>
        </div>
        <div class="dato_graficos">
        <?php 
            $hostname = ini_get('mysqli.default_host');
            $user = 'prevesuy';
            $pass = '';
            $database = 'prevesuy';
            $conn = mysqli_connect($hostname, $user, $pass, $database);
            $query = 'SELECT * FROM departamento ORDER BY Id DESC';
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            if (is_bool($result)) { return; }
            $result = mysqli_fetch_all($result);
            for ($i = 0; $i < count($result); $i++) {
                $departamento = str_replace(" ", "_", strtoupper($result[$i][1]));
         echo '
         <div>
         <label style="color: transparent; user-select: none;">SEPARACION</label>';
         if($result[$i][0] != 20) echo '<label>Departamento: <b>'. strtoupper($result[$i][1]) .'</b></label>';
         else echo '<label>General: <b>'. strtoupper($result[$i][1]) .'</b></label>';
         echo '
         <label style="color: transparent; user-select: none;">SEPARACION</label>
         <label>Total: </label>
         <input type="number" name="'. $departamento .'_total" min="0" required>
         <label style="color: transparent; user-select: none;">SEPARACION</label>';

        echo '<label><b>Tasa c/100.000: </b></label>
        <input type="number" name="' . $departamento .'_tasa" min="0" step=".01" required>
        ';
        
         if($result[$i][0] == 20) echo '
         <label>Hombres: </label>
         <input type="number" name="'. $departamento .'_hombre" min="0" step=".01" required>
         <label>Mujeres: </label>
         <input type="number" name="'. $departamento .'_mujer" min="0" step=".01" required>
         <label>< 14: </label>
         <input type="number" name="'. $departamento .'_<14" min="0" step=".01" required>
         <label>> 15 < 30: </label>
         <input type="number" name="'. $departamento .'_>15<30" min="0" step=".01" required>
         <label>> 31 < 70: </label>
         <input type="number" name="'. $departamento .'_>31<70" min="0" step=".01" required>
         <label>> 71 < 80: </label>
         <input type="number" name="'. $departamento .'_>71<80" min="0" step=".01" required>
         <label>> 81 < 90: </label>
         <input type="number" name="'. $departamento .'_>81<90" min="0" step=".01" required>
         <label>> 91: </label>
         <input type="number" name="'. $departamento .'_>91" min="0" step=".01" required>
         <label style="color: transparent; user-select: none;">SEPARACION</label>
         '; 
         echo '</div>';
        }
         ?>
        </div>
         <input type="submit" value="Subir">
    </form>
    <br>
    <form action="" method="post" id="form_centros" enctype="multipart/form-data" style="display: none;">
        <input type="text" name="type" value="add_centro" hidden>
        <h1>Agregar centros</h1>
        <label>Nombre local</label>
        <input type="text" name="titulo" maxlength="60" required>
        <label>Departamento</label>
        <select name="departamento">
            <?php
                $hostname = ini_get('mysqli.default_host');
                $user = 'prevesuy';
                $pass = '';
                $database = 'prevesuy';
                $conn = mysqli_connect($hostname, $user, $pass, $database);

                $query = 'SELECT * from departamento ORDER BY id DESC';
                $result = mysqli_query($conn, $query);
                mysqli_close($conn);
                $result = mysqli_fetch_all($result);
            
                foreach($result as $dep)
                {
                    echo "<option value='".$dep[0]."'>".$dep[1]."</option>";
                }
            
            ?>
        </select>
        <label>Latitud</label>
        <input type="text" name="lat" required>
        <label>Longitud</label>
        <input type="text" name="long" required>
        <label>Numero de ayuda</label>
        <input type="text" name="numero" maxlength="11" required>
        <label>Dirección</label>
        <input type="text" name="dir" maxlength="120" required>
        <input type="submit" value="Subir">
    </form>


    <form action="" method="post" id="form_not" enctype="multipart/form-data" style="display: none;">
        <input type="text" name="type" value="add" hidden>
        <h1>Agregar Noticia</h1>
        <label>Titulo</label>
        <input type="text" name="titulo" maxlength="80" required>
        <label>Imagen</label>
        <input type="file" name="files[]" required>
        <label>Resumen</label>
        <input type="text" name="resumen" maxlength="500" required>
        <label>Link de referencia</label>
        <input type="text" name="link" maxlength="500" required>
        <input type="submit" value="Subir">
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
    </form>
    <form action="" method="post" id="form_testimonios" style="display: none;">
        <h1>Agregar testimonio</h1>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <input type="text" name="type" value="add_testimonio" hidden>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <label>Testimonio:</label>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <textarea name="testimonio_text" maxlength="1000" required></textarea>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <input type="submit">
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
    </form>
    <form action="" method="post" id="form_sabias" style="display: none;">
        <h1>Agregar ¿Sabias que?</h1>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <input type="text" name="type" value="add_sabias" hidden>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <label>¿Sabias que?</label>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <textarea name="sabias_text" maxlength="500" required></textarea>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <input type="submit">
        <label style="color: transparent; user-select: none;">SEPARACION</label>
        <label style="color: transparent; user-select: none;">SEPARACION</label>
    </form>
    <form action="" method="post" id="del_not">
        <input type="text" name="type" value="del" hidden>
        <input type="number" name="del_id" id="del_id" hidden>
        <input type="submit" value="" id="del_send">
    </form>
    <form action="" method="post" id="check_not">
        <input type="text" name="type" value="check" hidden>
        <input type="number" name="check_id" id="check_id" hidden>
        <input type="number" name="check_state" id="check_state" hidden>
        <input type="submit" value="" id="check_send">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        switch ($_POST['type']) {
            case "check":
                $hostname = ini_get('mysqli.default_host');
                $user = 'prevesuy';
                $pass = '';
                $database = 'prevesuy';
                $conn = mysqli_connect($hostname, $user, $pass, $database);
                $query = "UPDATE noticias SET Fijado = '". $_POST['check_state'] ."' WHERE id LIKE " . $_POST['check_id'];
                $result = mysqli_query($conn, $query);
                if($result == true)
                {
                    echo "<script> alert('Se ha fijado la noticia')</script>";
                } else echo "<script> alert('No se ha podido fijar la noticia')</script>";
                mysqli_close($conn);
                break;
            case "del":
                $hostname = ini_get('mysqli.default_host');
                $user = 'prevesuy';
                $pass = '';
                $database = 'prevesuy';
                $conn = mysqli_connect($hostname, $user, $pass, $database);
                $query = "SELECT imagen FROM noticias WHERE id LIKE " . $_POST['del_id'];
                $result2 = mysqli_query($conn, $query);
                $result2 = mysqli_fetch_all($result2);
                $query = "DELETE FROM noticias WHERE Id LIKE " . $_POST['del_id'];
                $result = mysqli_query($conn, $query);
                if($result == true)
                {
                    unlink('./resources/img/uploadImg/'. $result2[0][0] );
                    echo "<script> alert('Se ha eliminado la noticia') console.log('". $_POST['del_id']."')</script>";
                } else echo "<script> alert('No se ha podido eliminar la noticia')</script>";
                mysqli_close($conn);
                break;
                case "add_centro":
                    $hostname = ini_get('mysqli.default_host');
                    $user = 'prevesuy';
                    $pass = '';
                    $database = 'prevesuy';
                    $conn = mysqli_connect($hostname, $user, $pass, $database);
    
                    $query = "INSERT INTO `lineas_de_ayuda`(`departamento`, `numero`, `nombre`, `direccion`, `latitud`, `longitud`) VALUES ('" . $_POST['departamento'] . "','" . $_POST['numero'] . "','" . $_POST['titulo'] . "','" . $_POST['dir'] . "','" . $_POST['lat'] . "','" . $_POST['long'] . "')";
                    $result = mysqli_query($conn, $query);
                    mysqli_close($conn);
                    if (is_bool($result)) {
                        if ($result == false)
                            echo "<script> alert('No se ha podido subir el centro debido a un error inesperado') //". mysqli_error($conn) ."</script>";
                    }
                    break;
                case "add":
                $hostname = ini_get('mysqli.default_host');
                $user = 'prevesuy';
                $pass = '';
                $database = 'prevesuy';
                $conn = mysqli_connect($hostname, $user, $pass, $database);
                $allowedExt = array('webp', 'jpg', 'png', 'jpeg', 'svg', 'bmp', 'gif');
                $files = $_FILES['files'];
                $ext = pathinfo($files['name'][0], PATHINFO_EXTENSION);
                if (!in_array($ext, $allowedExt)) {
                    echo "<script> alert('No se ha podido agregar la noticia, " . htmlspecialchars(basename($files['name'][0])) . " la extension no es compatible.'); </script>";
                } else {
                    $newname = base64_encode($_POST['titulo']) . date('dmy') . time() . "." . $ext;
                    if (move_uploaded_file($files['tmp_name'][0], "./resources/img/uploadImg/" . $newname)) {
                        $uploaded = true;
                    } else {
                        echo "<script> alert('No se ha podido subir el archivo: " . htmlspecialchars(basename($files['name'][0])) . "')</script>";
                        $uploaded = false;
                    }
                }

                if($uploaded == true) {
                $query = "INSERT INTO `noticias`(`titulo`, `enlace`, `descripcion`, `Fijado`, `imagen`) VALUES ('" . $_POST['titulo'] . "','" . $_POST['link'] . "','" . $_POST['resumen'] . "',0,'" . $newname . "')";
                $result = mysqli_query($conn, $query);
                if (is_bool($result)) {
                    if ($result == false)
                        echo "<script> alert('No se ha podido subir la noticia debido a un error inesperado') //". mysqli_error($conn) ."</script>";
                }
                }
                mysqli_close($conn);
                break;
                case "add_testimonio":
                    $hostname = ini_get('mysqli.default_host');
                    $user = 'prevesuy';
                    $pass = '';
                    $database = 'prevesuy';
                    $conn = mysqli_connect($hostname, $user, $pass, $database);

                    $query = 'INSERT INTO testimonios(Historia) VALUES ("'. $_POST['testimonio_text'] .'");';
                    $result = mysqli_query($conn, $query);
                    if(is_bool($result))
                    {
                        if($result == true)
                        {
                            echo "<script>alert('Subido')</script>";
                        } else
                        {
                            echo "<script>alert('". mysqli_error($conn) ."')</script>";
                        }
                    }
                    mysqli_close($conn);
                    break;
                case "add_sabias":
                    $hostname = ini_get('mysqli.default_host');
                    $user = 'prevesuy';
                    $pass = '';
                    $database = 'prevesuy';
                    $conn = mysqli_connect($hostname, $user, $pass, $database);

                    $query = 'INSERT INTO sabias_que(sabiasque) VALUES ("'. $_POST['sabias_text'] .'");';
                    $result = mysqli_query($conn, $query);
                    if(is_bool($result))
                    {
                        if($result == true)
                        {
                            echo "<script>alert('Subido')</script>";
                        } else
                        {
                            echo "<script>alert('". mysqli_error($conn) ."')</script>";
                        }
                    }
                    mysqli_close($conn);
                break;
                case "add_dep":
                    $hostname = ini_get('mysqli.default_host');
                    $user = 'prevesuy';
                    $pass = '';
                    $database = 'prevesuy';
                    $conn = mysqli_connect($hostname, $user, $pass, $database);

                    $query = 'SELECT * FROM anios WHERE anios.año LIKE '. $_POST['año'];
                    $año = mysqli_query($conn, $query);
                    $año = mysqli_fetch_all($año);
                    if(count($año) == 0)
                    {
                    $query = 'INSERT INTO anios(año) VALUES ('. $_POST['año'] .')';
                    $result = mysqli_query($conn, $query);
                    if($result == false) return;

                    $query = 'SELECT * FROM anios WHERE anios.año LIKE '. $_POST['año'];
                    $año = mysqli_query($conn, $query);
                    $año = mysqli_fetch_all($año);

                    $query = 'SELECT * FROM departamento ORDER BY Id DESC';
                    $result = mysqli_query($conn, $query);

                    if (is_bool($result)) { return; }
                    $result = mysqli_fetch_all($result);
                    for ($i = 0; $i < count($result); $i++) {
                        $departamento = str_replace(" ", "_",strtoupper($result[$i][1]));
                        if($result[$i][0] == 20)
                        {
                            $query = 'INSERT INTO s_departamento(`departamento`, `hombres`, `mujeres`, `menosDeCatorce`, `entreQuinceYTreinta`, `entreTreintaYUnoYSesenta`, `entreSesentaYUnoYOchenta`, `entreOchentaYUnoYNoventa`, `superiorANoventa`, `total`, `anios`, `tasatotal`) VALUES ('.$result[$i][0].','.$_POST[$departamento.'_hombre'].','.$_POST[$departamento.'_mujer'].','.$_POST[$departamento.'_<14'].','.$_POST[$departamento.'_>15<30'].','.$_POST[$departamento.'_>31<70'].','.$_POST[$departamento.'_>71<80'].','.$_POST[$departamento.'_>81<90'].','.$_POST[$departamento.'_>91'].','.$_POST[$departamento.'_total'].','.$año[0][0].','.$_POST[$departamento.'_tasa'].')';
                        } else $query = 'INSERT INTO s_departamento(`departamento`, `total`, `anios`, `tasatotal`) VALUES ('.$result[$i][0].','.$_POST[$departamento.'_total'].','.$año[0][0].','.$_POST[$departamento.'_tasa'].')';
                        mysqli_query($conn, $query);
                        echo mysqli_error($conn);
                    }
                    }
                    mysqli_close($conn);
                    break;
    

            }
    }
    ?>
    <hr>
</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    function abrir(va, displaymode, el) {
        if (document.getElementById(va).style.display == "none") {
            el.style.backgroundColor = "rgba(255, 172, 47, 0.829)";
            document.getElementById(va).style.display = displaymode;
        } else 
        {
            document.getElementById(va).style.display = "none";
            el.style.backgroundColor = "rgba(255, 172, 47, 0.534)";
        }
    }
    function fijar(id, state)
    {
        document.getElementById('check_id').value = id;
        if(state == 1)
        document.getElementById('check_state').value = 0;
        else
        document.getElementById('check_state').value = 1;
        document.getElementById('check_send').click();
    }
    function del(id)
    {
        document.getElementById('del_id').value = id;
        document.getElementById('del_send').click();
    }
</script>
</html>