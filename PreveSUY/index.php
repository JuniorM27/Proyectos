<!DOCTYPE html>
<html lang="es" id="index">
<?php
    $hostname = ini_get('mysqli.default_host');
    $user = 'prevesuy';
    $pass = '';
    $database = 'prevesuy';
    $conn = mysqli_connect($hostname, $user, $pass, $database);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/styles/style.css">
    <link rel="shortcut icon" href="./resources/img/logo.png" type="image/x-icon">
    <title>PreveSUY</title>
</head>

<body class="index">
    <a href="./resources/pages/test" id="test"></a>
    <div id="logo" class="logo"><img src="./resources/img/logo.png" alt="imagen de logo" id="logoimg" draggable="false"> <p>PREVENCIÓN DEL SUICIDIO</p></div>
    <div class="contenido">
        <div class="contenido-izq-der">
            <div class="contenido_izquierda">
                <button onclick="ingresar('test')">¿Como estas?</button> <!-- Test de bienestar -->
                <button>¿Como me doy cuenta?</button> <!--Signos de advertencia -->
                <button>¿Como puedo mejorar?</button> <!-- Habitos -->
                <button>¿Como actuo?</button> <!-- Como intervenir -->
            </div>
            <div class="contenido_derecha">
                <div>
                    <button onclick="ira('channel_noticias')" style="border-radius: 2vh 0% 0% 0%;">¿Que hay de nuevo?</button> <!--Noticias-->
                    <button onclick="ira('channel_ayuda')" style="border-radius: 0% 2vh 0% 0%;">¿Quienes me apoyan?</button> <!--Lineas de Ayuda-->
                </div>
                <div>
                    <button onclick="ira('channel_sabias')" style="border-radius: 0% 0% 0% 2vh;">¿Sabias esto?</button> <!-- Sabias que -->
                    <button onclick="ira('channel_info')" style="border-radius: 0% 0% 2vh 0%;">¿Que esta pasando?</button> <!--Graficos-->
                </div>
                <div class="imagenes_container"></div>
                <div id="scrollImage" class="imagenes_prevencion" value="0">
                    <?php
                    $dir = scandir("./resources/img/scrollImage/");
                    $amount = count($dir)-2;
                    for($i = 2; $i < $amount+2; $i++)
                    {
                        echo "<img src='./resources/img/scrollImage/".$dir[$i]."' draggable='false'>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="contenido_border">
        <a href="tel:+08000767">LINEA DE AYUDA: 0800 0767</a>
        </div>
    </div>
    <div class="channel info">
        <h1 id="channel_info">¿Que esta pasando?</h1>
        <?php
        echo "<div class='graficos_container'>";
        $query = 'SELECT anios.año FROM anios ORDER BY anios.año DESC LIMIT 6';
        $result2 = mysqli_query($conn, $query);
        if(!is_bool($result2)) {
            $result2 = mysqli_fetch_all($result2);
        }
        for($i = 0; $i < count($result2); $i++)
        {
            if($i == 0) echo "<div class='grafico grafico_active' id='grafico_".$result2[$i][0]."'>";
            if($i != 0) echo "<div class='grafico' id='grafico_".$result2[$i][0]."'>";
            $query = 'SELECT MAX(s_departamento.tasatotal) from s_departamento INNER JOIN anios ON anios.id = s_departamento.anios WHERE anios.año LIKE '. $result2[$i][0] . ' AND s_departamento.departamento != 20';
            $max = mysqli_query($conn, $query);
            if(!is_bool($max)) {
                $max = mysqli_fetch_all($max);
            }
            $query = 'SELECT departamento.nombre ,s_departamento.*, anios.año from s_departamento INNER JOIN departamento ON departamento.id = s_departamento.departamento INNER JOIN anios ON anios.id = s_departamento.anios WHERE anios.año LIKE '. $result2[$i][0] . ' AND departamento.id != 20';
            $result = mysqli_query($conn, $query);
            if(!is_bool($result)) {
                $result = mysqli_fetch_all($result);
            }
            for($j = 0; $j < count($result); $j++){
                $porcentaje = ((float)$result[$j][13] * 100) / $max[0][0];
                $porcentaje2 = 1 * 100 / count($result);
                if($porcentaje > 0 && $porcentaje < 4) $porcentaje = 4;
                echo "<div class='grafico_barras' title='". $result[$j][0] ."' style='height: ". $porcentaje ."%; width: ". $porcentaje2 ."%;' onclick='refreshInfoGrafico(". $result[$j][14] .", `". str_replace(" ","_",$result[$j][0]) ."`)'>";

                echo "</div>";
            }
            echo "</div>";
        }
        for($i = 0; $i < count($result2); $i++)
        {
            if($i == 0) echo "<div class='año_tabla año_tabla_active' id='año_tabla_".$result2[$i][0]."'>";
            if($i != 0) echo "<div class='año_tabla' id='año_tabla_".$result2[$i][0]."'>";

            $query = 'SELECT anios.año as "Año", departamento.nombre as "Departamento", d.tasatotal as "Tasa c/100.000 habitantes",d.hombres as "Hombres c/100.000", d.mujeres as "Mujeres c/100.000", d.menosDeCatorce as "< 14 c/100.000", d.entreQuinceYTreinta as "15 - 30 c/100.000", d.entreTreintaYUnoYSesenta as "31 - 70 c/100.000", d.entreSesentaYUnoYOchenta as "71 - 80 c/100.000", d.entreOchentaYUnoYNoventa as "81 - 90 c/100.000", d.superiorANoventa as "> 90 c/100.000", d.total as "Total de suicidios" FROM s_departamento as d INNER JOIN departamento ON departamento.id = d.departamento INNER JOIN anios ON anios.id = d.anios WHERE anios.año LIKE '. $result2[$i][0];
            $result = mysqli_query($conn, $query);
            if(!is_bool($result)) {
                $result3 = mysqli_fetch_fields($result);
                $result = mysqli_fetch_all($result);
            }
            for($l = 0; $l < count($result); $l++)
            {
                if($result[$l][1] == "URUGUAY" && $i == 0)
                echo "<table class='año_tabla_dep dep_active' id=". str_replace(" ", "_",$result[$l][1]) .">";
                else 
                echo "<table class='año_tabla_dep' id=". str_replace(" ", "_",$result[$l][1]) .">";
                for($k = 0; $k < count($result3); $k++)
                {
                    $d = get_object_vars($result3[$k]);
                    echo "<tr>";
                    if($result[$l][1] == "URUGUAY" && $k == 1) echo "<th>General</th>";
                    else echo "<th>". $d["name"] ."</th>";
                    echo "<td>". $result[$l][$k] ."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            echo "</div>";

        }
        echo "</div>";
        echo "<div class='container_botones_graficos'>";
        echo "<div class='botones_graficos'>";

        for($i = 0; $i < count($result2); $i++)
        {
            echo '<button onclick="refreshGrafico('.$result2[$i][0].')">'. $result2[$i][0] .'</button>';
        }

        echo "</div>";
        echo "<div>";
        echo "</div>";
        echo "</div>";
        ?>
    </div>
    <hr>
    <div class="channel">
        <h1 id="channel_sabias">¿Sabias esto?</h1>
        <?php
        $defaultImgUrl = "./resources/img/uploadImg/";
        $query = 'SELECT * from sabias_que LIMIT 35';
        $result = mysqli_query($conn, $query);
        $query = 'SELECT * from testimonios LIMIT 7';
        $result2 = mysqli_query($conn, $query);
        echo "<div class='contenido_datos_curiosos'>";
        if(!is_bool($result) && !is_bool($result2)) {
            $result = mysqli_fetch_all($result);
            $result2 = mysqli_fetch_all($result2);

            $amountbuttons = count($result2);
            echo "<div class='botones_testimonios'>";
            for($i = 0; $i < $amountbuttons; $i++)
            {
                if($amountbuttons != 1)
                echo "<button onclick='refreshTestimonios(`". ($i) ."`)'>". ($i+1) ."</button>";
            }
            echo "</div>";
            echo "<div id='testimonios' class='testimonios'>";
            for($i = 0; $i < count($result2); $i++)
            {
                if(($i % 1) == 0)
                {
                    if($i == 0) 
                    { 
                        echo "<div class='testimonio_active'>"; 
                    } else 
                    {                    
                        echo "</div>";
                        echo "<div>"; 
                    }
                }
                echo "<p>".$result2[$i][1]."</p><br>";
                if(($i == count($result2)-1))
                echo "</div>";
            }
            echo "</div>";
            echo "<div id='sabias_que' class='sabias_que'>";
            $amountbuttons = 0;
            for($i = 0; $i < count($result); $i++)
            {
                if(($i % 5) == 0)
                {
                    $amountbuttons++;
                    if($i != 0)
                    echo "</div>";
                    if($i == 0) { echo "<div class='sabias_active'>"; } else { echo "<div>"; }
                }
                echo "<p>".$result[$i][1]."</p><br>";
                if(($i == count($result)-1))
                echo "</div>";
            }
            echo "</div>";
            echo "<div class='botones_sabias'>";
            for($i = 0; $i < $amountbuttons; $i++)
            {
                if($amountbuttons != 1)
                echo "<button onclick='refreshSabias(`". ($i) ."`)'>". ($i+1) ."</button>";
            }
            echo "</div>";
        }
        echo "</div>";
        ?>
    </div>
    <hr>
    <div class="channel">
        <h1 id="channel_noticias">¿Que hay de nuevo?</h1>
        <div class="noticias_container">
        <div class="noticias" id="noticias_scroll">
            <?php
            $defaultImgUrl = "./resources/img/uploadImg/";
            $query = 'SELECT * from noticias WHERE Fijado LIKE 1 LIMIT 6';
            $result = mysqli_query($conn, $query);
            if (is_bool($result)) {
                echo "Algo ha salido catastroficamente mal";
                return;
            }
            $result = mysqli_fetch_all($result);
            $amount = 0;
            $elementsadded = [];
            foreach ($result as $noticia) {
                $amount++;
                $elementsadded[] = $noticia[0];
                echo "<a href='" . $noticia[4] . "'><div>";
                echo "<h1>" . $noticia[1] . "</h1>";
                echo "<img class='img-noticia' src='" . $defaultImgUrl . $noticia[2] . "'>";
                echo "<p>" . $noticia[3] . "</p>";
                echo "</div></a>";
            }
            $defaultImgUrl = "./resources/img/uploadImg/";
            $query = 'SELECT * from noticias ORDER BY Id DESC LIMIT 6';
            $result = mysqli_query($conn, $query);
            if (is_bool($result)) {
                echo "Algo ha salido catastroficamente mal";
                return;
            }
            $result = mysqli_fetch_all($result);
            foreach ($result as $noticia) {
                if ($amount >= 6) return;
                if (!in_array($noticia[0], $elementsadded)) {
                    $amount++;
                    echo "<a href='" . $noticia[4] . "'><div>";
                    echo "<h1>" . $noticia[1] . " 🆕</h1>";
                    echo "<img class='img-noticia' src='" . $defaultImgUrl . $noticia[2] . "'>";
                    echo "<p>" . $noticia[3] . "</p>";
                    echo "</div></a>";
                }
            }
            ?>
        </div>
        <div class="div_botones">

        <div class="botones_scroll">
            <?php
            $porcentaje = 5;
            for($i = 0; $i < $amount; $i++)
            {
                echo "<button onclick='ToElement(".$i.",`noticias_scroll`)'>".($i+1)."</button>";
            }
            ?>
        </div>

        </div>
        <div>

        </div>
        </div>
    </div>
<hr>
    <div class="channel channel_ayuda">
        <h1 id="channel_ayuda">¿Quienes me apoyan?</h1>
        <div class="selector_ayuda">
            <select id="map_dep">
                <?php
                    $query = 'SELECT * from departamento ORDER BY id DESC';
                    $result = mysqli_query($conn, $query);
                    $result = mysqli_fetch_all($result);

                    foreach($result as $dep)
                    {
                        echo "<option value='". $dep[0] ."'>".$dep[1]."</option>";
                    }


                ?>
            </select>
        </div>
        <div class="ayuda_info">
        <div class="ayuda_map">
            <div class="mapa">
                <div id="canvas-for-googlemap">
                    <iframe id="map" frameborder="0" src="">
                </iframe>
            </div>
        </div>
            <div id="centro_info">
                    <h1 id="titulo_centro"></h1>
                    <p id="numero_centro"></p>
                    <p id="dir_centro"></p>
            </div>
        </div>
        <div id="centros_ayuda" class="centros_ayuda">
                <?php
                    $query = 'SELECT lineas_de_ayuda.*, departamento.nombre from lineas_de_ayuda INNER JOIN departamento ON lineas_de_ayuda.departamento LIKE departamento.id ORDER BY departamento.id DESC';
                    $result = mysqli_query($conn, $query);
                    $result = mysqli_fetch_all($result);

                    foreach($result as $dato)
                    {
                        echo "<button class='centro_". $dato[1] ." centros_active' onclick='changeMapImg(`". $dato[5] ."`, `".$dato[6]."`, `".$dato[3]."`, `".$dato[2]."`, `".$dato[4]."`)'>". $dato[7] .": ".$dato[3] ."</button>";
                    }
                ?>
        </div>
        </div>
    </div>
</body>
<?php
    mysqli_close($conn);
?>
<script src="./resources/scripts/script.js"></script>
</html>