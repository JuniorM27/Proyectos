<style>
*
{
    text-align: center;
    justify-content: center;
    font-size: 25px;
    user-select: none;
}    
.title
{
    font-size: 35px;
}
.php
{
    margin-left: 25%;
    margin-right: 25%;
    border: 2px solid brown;
    background-color: white;
}
</style>
<div class="php">
<h1 class="title">FORMULARIO</h1>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nombre = $_POST['usuario'];
        $email = $_POST['correo'];
        $contraseña = $_POST['contrasena'];
        $genero = $_POST['genero'];

        if(isset($_POST['deportes']))
        $interes1 = $_POST['deportes'];
        if(isset($_POST['musica']))
        $interes2 = $_POST['musica'];
        if(isset($_POST['peliculas']))
        $interes3 = $_POST['peliculas'];
        if(isset($_POST['juegos']))
        $interes4 = $_POST['juegos'];
        if(isset($_POST['bailar']))
        $interes5 = $_POST['bailar'];
        if(isset($_POST['programar']))
        $interes6 = $_POST['programar'];
        if(isset($_POST['participar']))
        $interes7 = $_POST['participar'];
        if(isset($_POST['multimedia']))
        $interes8 = $_POST['multimedia'];

        echo "Usuario: $nombre"."<br>";
        echo "Correo: $email"."<br>";
        echo "Contraseña: $contraseña"."<br>";
        if($genero == "M") echo "Genero: Masculino"."<br>";
        if($genero == "F") echo "Genero: Femenino"."<br>";
        
        if(isset($_POST['deportes']))
        if($interes1 == true) echo "Le interesan los deportes"."<br>";
        if(isset($_POST['musica']))
        if($interes2 == true) echo "Le interesa escuchar musica"."<br>";
        if(isset($_POST['peliculas']))
        if($interes3 == true) echo "Le interesa ver peliculas"."<br>";
        if(isset($_POST['juegos']))
        if($interes4 == true) echo "Le interesa jugar a algo"."<br>";
        if(isset($_POST['bailar']))
        if($interes5 == true) echo "Le interesa bailar"."<br>";
        if(isset($_POST['programar']))
        if($interes6 == true) echo "Le interesa programar"."<br>";
        if(isset($_POST['participar']))
        if($interes7 == true) echo "Le interesa participar en clase"."<br>";
        if(isset($_POST['multimedia']))
        if($interes8 == true) echo "Le interesa ver contenido multimedia"."<br>";

    } else 
    {
        header('Location: formulario_josie.html');
    }


?>
<br>
</div>
<script>
        window.addEventListener("load", (event) => {
        setInterval(changeColors,1000);
        });

        function changeColors()
        {
            let r = Math.floor(Math.random() * 256);
            let g = Math.floor(Math.random() * 256);
            let b = Math.floor(Math.random() * 256);
            document.body.style.backgroundColor = "rgb("+ r +","+ g +","+ b +")";
        }
</script>