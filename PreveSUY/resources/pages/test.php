<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PreveSUY - Test de bienestar</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="index">        
<div id="logo" class="logo"><img src="../img/logo.png" id="logoimg" draggable="false"></div>
<br>

<div class="test">
    <?php
    class Pregunta
    {
        private $titulo;
        private $descripcion;
        private $opciones = [];
        private $puntos = [];

        public function __construct($_titulo, $_descripcion, $_opciones, $_puntos)
        {
            $this -> titulo = $_titulo;
            $this -> descripcion = $_descripcion;
            $this -> opciones = $_opciones;
            $this -> puntos = $_puntos;
        }

        public function getTitulo()
        {
            return $this -> titulo;
        }

        public function getDescripcion()
        {
            return $this -> descripcion;
        }

        public function getPuntos()
        {
            return $this -> puntos;
        }

        public function getOpciones()
        {
            return $this -> opciones;
        }


    }

    $preguntas = [];
    $hostname = ini_get('mysqli.default_host');
    $user = 'prevesuy';
    $pass = '';
    $database = 'prevesuy';
    $conn = mysqli_connect($hostname,$user,$pass,$database);
    $query = 'SELECT * from testdebienestar';
    $result = mysqli_query($conn, $query);
    if(is_bool($result)) {echo "Algo ha salido catastroficamente mal."; return;}
    $result = mysqli_fetch_all($result);
    mysqli_close($conn);

    foreach($result as $data)
    {
        $preguntas[] = new Pregunta($data[1],$data[2], array($data[3],$data[4],$data[5],$data[6]) , array($data[7],$data[8],$data[9],$data[10]));
    }
    if(empty($preguntas)) { echo "No se ha podido obtener las preguntas del test"; return;}
    for($i = 0; $i < count($preguntas); $i++) {
    if($i == 0) echo "<div id='quest_".$i."'>"; else echo "<div id='quest_".$i."' style='display: none;'>";
    echo "<div class='test_titulo'>";
    echo "<label><h1>". $preguntas[$i] -> getTitulo() ."</h1></label>";
    echo "</div>";
    echo "<div class='test_question'>";
    echo "<label><p>". $preguntas[$i] -> getDescripcion() ."</p></label>";
    echo "</div>";
    echo "<div class='test_options'>";
    for($j = 0; $j < count($preguntas[$i] -> getOpciones()); $j++)
    {
        if($preguntas[$i]->getOpciones()[$j] != "")
        {
        echo "<div>";
        echo "<input type='radio' name='question_".$i."' id='opt_".$i."_".$j."' value=". $preguntas[$i]->getPuntos()[$j] .">";
        echo "<label for='opt_".$i."_".$j."'>".$preguntas[$i]->getOpciones()[$j]."</label>";
        echo "</div>";
        }
    }
    echo "</div>";
    echo "<button onclick='siguiente()'>Enviar</button>";
    echo "</div>";
    }
    ?>
    <div id="test_resultado" style="display: none;">
        <h1>Resultados:</h1>
        <p id="resultado_text"></p>
        <a href="tel:+08000767">0800 0767</a>
    </div>
</div>
</body>
<script src="../scripts/testManager.js"></script>
<script src="../scripts/script.js"></script>
</html>

